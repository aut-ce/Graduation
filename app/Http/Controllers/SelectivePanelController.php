<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SelectivePanelController extends Controller
{
    function __construct()
    {
    }

    public static function routes()
    {
        Route::get('/morty/free-articles', 'SelectivePanelController@freeArticles')->name('mortyFreeArticles');
        Route::get('/morty/edit-article/{article}', 'SelectivePanelController@editArt')->name('selectiveEditArt');
    }

    public function freeArticles()
    {

        $user = Auth::user();
        if ($user['username'] != '9231020')
            return redirect()->route('landing')->withErrors('تو که مرتی نیستی');
        $content = Article::where('texter_id', 'exists', false)
            ->where('cover', 'exists', false)
            ->where('content', '<>', '')
            ->get();
        return view('journal.list', [
            'content' => $content,
            'user' => $user,
            'selective' => 1
        ]);
    }

    public function editArt(Article $article, Request $request)
    {
        if ($user['username'] != '9231020')
            return redirect()->route('landing')->withErrors('تو که مرتی نیستی');
        if (!$article)
            return redirect()->back()->withErrors(['یافت نشد']);
        $article->load('user');
        return view('journal.article', [
            'article' => $article,
        ]);
    }
}
