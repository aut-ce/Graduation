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
            Route::get('/show', 'ContentController@show')->name('show');

            Route::get('/', function () {
                return redirect()->route('content.list');
            })->name('main');
        });
    }

    public function file(File $file = null)
    {
        if (!$file) {
            $user = Auth::user();
            $user->files()->where('path', -1)->forceDelete();
            $file = File::create(['title' => '', 'description' => '', 'path' => -1]);
            $user->files()->save($file);
        }
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
        $file->save();
        return redirect()->route('content.main')->with(['success' => 'با موفقیت بارگذاری شد']);
    }

    public function fileDelete(File $file)
    {
        $file->delete();
        return redirect()->back()->with(['success' => 'با موفقیت حذف شد']);
    }

    public function article($article = null, Request $request)
    {
        if ($article) {
            $article = Article::where('_id', $article)->first();
        } else {
            $user = Auth::user();
            $user->articles()->where('title', -1)->forceDelete();
            $article = Article::create(['title' => -1, 'content' => '', 'picture' => -1]);
            $user->articles()->save($article);
        }
        $article->load('texter');
        $for = $request->get('for') | $request->get('cover');
        return view('pages.content.article', [
            'article' => $article,
            'for' => $for,
            'cover' => $request->get('cover'),
        ]);
    }

    public
    function articleAction($article, Request $request)
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

    public
    function articleDelete(Article $article)
    {
        $article->delete();
        return redirect()->back()->with(['success' => 'با موفقیت حذف شد']);
    }

    public
    function list()
    {
        $user = Auth::user();
        $contents = $user->articles()->where('title', '<>', -1)->get()
            ->merge($user->files()->where('path', '<>', -1)->get())->sortByDesc('updated_at');;
        return view('pages.content.list', [
            'content' => $contents
        ]);
    }
}
