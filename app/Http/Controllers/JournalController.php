<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class JournalController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('journal');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'journal', 'as' => 'journal.'], function () {
            Route::get('/list', 'JournalController@home')->name('home');

            Route::get('/written-articles', 'JournalController@writtenArticles')->name('writtenArticles');
            Route::get('/cover', 'JournalController@cover')->name('cover');
            Route::get('/articles', 'JournalController@articles')->name('articles');

            Route::get('/mini', 'JournalController@mini')->name('mini');
            Route::post('/mini', 'JournalController@miniAction')->name('miniAction');

            Route::get('/questions', 'JournalController@questions')->name('questions');
            Route::post('/questions', 'JournalController@questionsAction')->name('questionsAction');


            Route::get('/editArt/{article}', 'JournalController@editArt')->name('editArt');
            Route::post('/editArt/{article}', 'JournalController@editArtAction')->name('editArtAction');

            Route::get('/', function () {
                return redirect()->route('journal.home');
            })->name('main');
        });
    }

    public function home()
    {
        return view('journal.journal_home');
    }

    public function cover(Request $request)
    {
        $user = $request->get('username');

        if ($user)
            $user = User::where('username', $user)->first();
        return view('journal.cover', [
            'covers' => isset($user['cover']) ? $user['cover'] : 'تایید نشده',
            'user' => $user,
            'confirm' => isset($user['cover'])
        ]);

    }

    public function writtenArticles(Request $request)
    {
        $articles = [];
        $user = null;
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $articles = $user->articles()
                    ->with('texter')
                    ->where('content', '<>', '')
                    ->where('cover', 'exists', false)
                    ->where('texter_id','exists',false)
                    ->get();
        }
        return view('journal.writes', [
            'articles' => $articles,
            'user' => $user
        ]);

    }

    public function test(Request $request)
    {
        $articles = [];
        $user = null;
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $articles = $user->texts()
                    ->with('user')
                    ->where('content', '<>', '')
                    ->where('show','true')
                    ->where('cover', 'exists', false)
                    ->get();
        }
        return view('journal.written_for', [
            'articles' => $articles,
            'user' => $user
        ]);

    }

    public function mini(Request $request){
        $user = null;
        $answers = [];
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $answers = $user['mini_q'] ? json_decode($user['mini_q'], true) : [];
        }
        return view('journal.mini_question', [
            'questions' => PersonalPageController::mini_questions(),
            'answers' => $answers,
            'user' => $user
        ]);
    }

    public function miniAction(Request $request){
        $username = $request->get('username');
        if(!$username)
            return redirect()->back();
        $user = User::where('username',$username)->first();
        $q = $request->get('q');
        $user->mini_q = json_encode($q);
        $user->save();
        return redirect()->back()->with('success', 'با موفقیت ثبت شد');
    }

    public function questions(Request $request){
        $user = null;
        $answers = [];
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $answers = $user['questions'] ? json_decode($user['questions'], true) : [];
        }
        return view('journal.questions', [
            'questions' => PersonalPageController::long_questions(),
            'answers' => $answers,
            'user' => $user
        ]);
    }

    public function questionsAction(Request $request){
        $username = $request->get('username');
        if(!$username)
            return redirect()->back();
        $user = User::where('username',$username)->first();
        $q = $request->get('q');
        $user->questions = json_encode($q);
        $user->save();
        return redirect()->back()->with('success', 'با موفقیت ثبت شد');
    }

    public function articles(Request $request){
        $user = null;
        $content = [];
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $content = $user->texts()
                    ->where('show','true')
                    ->where('cover', 'exists', false)
                    ->get();
        }
        return view('journal.list', [
            'content' => $content,
            'user' => $user
        ]);
    }

    public function editArt(Article $article, Request $request)
    {
        if(!$article)
            return redirect()->back()->withErrors(['یافت نشد']);
        $article->load('user');
        return view('journal.article', [
            'article' => $article,
        ]);
    }

    public function editArtAction(Article $article,Request $request)
    {
        $article->title = $request['title'];
        $article->content = $request['description'];
        $article->done = 1;
        $article->save();
        return redirect()->route('journal.articles')->with(['success' => 'با موفقیت ثبت شد شد']);
    }
}
