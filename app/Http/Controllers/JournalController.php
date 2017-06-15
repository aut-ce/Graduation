<?php

namespace App\Http\Controllers;

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

            Route::get('/cover', 'JournalController@cover')->name('cover');
            Route::get('/written-articles', 'JournalController@writtenArticles')->name('writtenArticles');
            Route::get('/articles', 'JournalController@articles')->name('articles');

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

    public function articles(Request $request)
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
}
