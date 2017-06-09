<?php

namespace App\Http\Controllers;

use App\Article;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ask.participation');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'content', 'as' => 'content.'], function () {

            Route::get('/file/{file?}', 'ContentController@file')->name('file');
            Route::post('/file', 'ContentController@fileAction')->name('fileAction');
            Route::get('/file/delete/{file}', 'ContentController@fileDelete')->name('fileDelete');

            Route::get('/article/{article?}', 'ContentController@article')->name('article');
            Route::post('/article/{article}', 'ContentController@articleAction')->name('articleAction');
            Route::get('/article/delete/{article}', 'ContentController@articleDelete')->name('articleDelete');

            Route::get('/list', 'ContentController@list')->name('list');
            Route::get('/writers', 'ContentController@writers')->name('writers');

            Route::get('/articles', 'ContentController@articles')->name('articles');

            Route::post('/show-article', 'ContentController@showArticle')->name('showArticle');

            Route::get('/', function () {
                return redirect()->route('content.list');
            })->name('main');
        });
    }

    public function file(File $file = null)
    {
        if (!$file->_id) {
            $user = Auth::user();
            $user->files()->where('path', -1)->forceDelete();
            $file = File::create(['title' => '', 'description' => '', 'path' => -1]);
            $file->save();
            $user->files()->save($file);
        }
        if ($file->user_id != $user->_id)
            return redirect()->route('landing')->withErrors(['اجازه ویرایش ندارید']);
        return view('pages.content.file', [
            'file' => $file
        ]);
    }

    public function fileAction(Request $request)
    {
        $user = Auth::user();
        if (!$request->has('id'))
            return redirect()->route('landing');
        $file = File::find($request->get('id'));
        $sent_file = $request->file('file');
        if (!$request->hasFile('file') && $file['path'] == -1)
            return redirect()->back()->withErrors(['ppic' => 'لطفا یک فایل انتخاب کنید']);
        Storage::disk('cdn')->makeDirectory('files/' . $user['username']);
        if ($request->hasFile('file') || $file['path'] == -1) {
            $path = Storage::disk('cdn')
                ->putFileAs('files/' . $user['username'], $sent_file, $file['id'] . '.' . $sent_file->extension());
            $file->path = $path;
        }
        $file->title = $request['title'];
        $file->description = $request['description'];
        $file->name = $request['name'];
        if ($file->user_id != $user->_id)
            return redirect()->route('landing')->withErrors(['اجازه ویرایش ندارید']);
        $file->save();
        return redirect()->route('content.main')->with(['success' => 'با موفقیت بارگذاری شد']);
    }

    public function fileDelete(File $file)
    {
        if ($file->user_id != Auth::user()->_id)
            return redirect()->route('landing')->withErrors(['اجازه ویرایش ندارید']);
        $file->delete();
        return redirect()->back()->with(['success' => 'با موفقیت حذف شد']);
    }

    public function article($article = null, Request $request)
    {
        $user = Auth::user();
        if ($article) {
            $article = Article::where('_id', $article)->first();
        } else {
            $user->articles()->where('title', -1)->forceDelete();
            $article = Article::create(['title' => -1, 'content' => '', 'picture' => -1]);
            $user->articles()->save($article);
        }
        $article->load('texter');
        $for = $request->get('for') | $request->get('cover');
        if ($article->user_id != $user->_id)
            return redirect()->route('landing')->withErrors(['اجازه ویرایش ندارید']);
        return view('pages.content.article', [
            'article' => $article,
            'for' => $for,
            'cover' => $request->get('cover'),
        ]);
    }

    public function articleAction($article, Request $request)
    {
        if (!$article)
            return redirect()->route('landing');
        $article = Article::where('_id', $article)->first();
        if ($request->hasFile('picture')) {
            $sent_file = $request->file('picture');
            Storage::disk('cdn')->makeDirectory('articles/');
            $path = Storage::disk('cdn')
                ->putFileAs('articles', $sent_file, $article['id'] . '.jpg');
            $article->picture = $path;
        }
        if ($request->has('texter'))
            $article->texter_id = $request['texter'];
        if ($request->has('cover'))
            $article->cover = 1;
        $article->title = $request['title'];
        $article->content = $request['description'];
        $article->save();
        return redirect()->route('content.main')->with(['success' => 'با موفقیت ارسال شد']);
    }

    public function articleDelete(Article $article)
    {
        $article->delete();
        return redirect()->back()->with(['success' => 'با موفقیت حذف شد']);
    }

    public function list()
    {
        $user = Auth::user();
        $contents = $user->articles()->where('title', '<>', -1)->get()
            ->merge($user->files()->where('path', '<>', -1)->get())->sortByDesc('updated_at');
        return view('pages.content.list', [
            'content' => $contents
        ]);
    }

    public function writers()
    {
        $articles = $this->writers_article();
        return view('pages.content.writers', [
            'articles' => $articles['articles'],
            'text' => $articles['texts'],
            'cover' => $articles['covers']
        ]);
    }

    protected function writers_article()
    {
        $user = Auth::user();
        $covers = $user->texts()->where('cover', 1)->with('user')->get();
        $texts = $user->texts()->where(function ($query) {
            $query->where('cover', 'exists', false)->orWhere('cover', '=', 0);
        })->with('user')->get();
        $output = [];
        /*
        foreach ($covers as $c){
            if(!isset($output[user_to_name($c['user'])]['cover']))
                $output[user_to_name($c['user'])]['cover'] = 1;
            else
                $output[user_to_name($c['user'])]['cover'] ++;
        }
        */
        foreach ($texts as $t) {
            if (!isset($output[user_to_name($t['user'])]['text']))
                $output[user_to_name($t['user'])]['text'] = 1;
            else
                $output[user_to_name($t['user'])]['text']++;
        }
        return [
            'articles' => $output,
            'covers' => count($covers),
            'texts' => count($texts),
        ];
    }


    public function articles()
    {
        $user = Auth::user();
        $articles = $user->texts()->with('user')->where('cover', 'exists', false)->get();
        return view('pages.content.my_articles', [
            'articles' => $articles,
            'user' => $user
        ]);
    }

    public function showArticle(Request $request)
    {
        $data = $request->only(['id', 'show']);
        $user = Auth::user();
        $article = null;
        if ($data['id'])
            $article = Article::where('_id', $data['id'])->first();
        if (!$article || $user['id'] != $article['texter_id'])
            return 0;
        $article['show'] = $data['show'];
        $article->timestamps = false;
        $article->save();
        return 1;
    }
}
