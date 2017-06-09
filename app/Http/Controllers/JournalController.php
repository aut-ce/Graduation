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
        $this->middleware('admin');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'journal', 'as' => 'journal.'], function () {
            Route::get('/list', 'JournalController@home')->name('home');

            Route::get('/cover', 'JournalController@cover')->name('cover');
            //Route::get('/writes', 'JournalController@writes')->name('writes');
            //Route::get('/written-for', 'JournalController@writtenFor')->name('writtenFor');

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
        $covers = [];
        $user = $request->get('username');
        if ($user)
            $user = User::where('username', $user)->first();
        if ($user)
            $covers = $user->texts()->with('user')->where('cover', 'exists', true)->get();
        return view('journal.cover', [
            'covers' => $covers,
            'user' => $user
        ]);

    }

    public function writes(Request $request)
    {
        $articles = [];
        $user = null;
        $username = $request->get('username');
        if ($username){
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $articles = $user->articles()->with('texter')->where('cover', 'exists', false)->get();
        }
        return view('journal.writes', [
            'articles' => $articles,
            'user' => $user
        ]);

    }

    public function writtenFor(Request $request)
    {
        $articles = [];
        $user = null;
        $username = $request->get('username');
        if ($username){
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $articles = $user->texts()->with('user')->where('cover', 'exists', false)->get();
        }
        return view('journal.written_for', [
            'articles' => $articles,
            'user' => $user
        ]);

    }
}
