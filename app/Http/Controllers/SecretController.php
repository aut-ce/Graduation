<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SecretController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('secreter');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'secret', 'as' => 'secret.'], function () {
            Route::get('/list', 'SecretController@home')->name('home');

            Route::get('/cover', 'SecretController@cover')->name('cover');
            Route::get('/written-cover', 'SecretController@writtenCover')->name('writtenCover');
            Route::get('/written-articles', 'SecretController@writtenArticles')->name('writtenArticles');
            Route::get('/articles', 'SecretController@articles')->name('articles');

            Route::get('/bests', 'SecretController@bests')->name('bests');
            Route::get('/inst-bests', 'SecretController@instBests')->name('instBests');

            Route::get('/user-list/{offset?}', 'SecretController@userList')->name('userList');

            Route::get('/bests/given-votes', 'SecretController@givenVotes')->name('givenVotes');
            Route::get('/bests/given-votes-details', 'SecretController@givenVotesDetails')->name('givenVotesDetails');

            Route::get('/', function () {
                return redirect()->route('secret.home');
            });
        });
    }

    public function home()
    {
        return view('secret.secret_home');
    }

    public function userList($offset = 0)
    {
        $users = User::orderBy('create_at')->skip($offset * 25)->take(25)->get();
        return view('secret.list', [
            'users' => $users,
            'pages' => floor(User::count() / 25),
            'current' => $offset
        ]);
    }

    public function cover(Request $request)
    {
        $articles = [];
        $user = null;
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $articles = $user->texts()->with('user')->where('cover', 1)->get();
        }
        return view('secret.cover', [
            'covers' => $articles,
            'user' => $user
        ]);

    }

    public function writtenCover(Request $request)
    {
        $articles = [];
        $user = null;
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user)
                $articles = $user->articles()->with('user')->where('cover', 1)->get();
        }
        return view('secret.written_cover', [
            'covers' => $articles,
            'user' => $user
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
                $articles = $user->articles()->with('texter')->where('cover', 'exists', false)->get();
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
                $articles = $user->texts()->with('user')->where('cover', 'exists', false)->get();
        }
        return view('journal.written_for', [
            'articles' => $articles,
            'user' => $user
        ]);

    }

    public function bests(Request $request)
    {
        $bests = [];
        $user = null;
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user && isset($user['bests_q']))
                $bests = json_decode($user['bests_q'], true);
        }
        return view('secret.bests', [
            'titles' => BestController::titles(),
            'answers' => $bests,
            'user' => $user
        ]);
    }

    public function instBests(Request $request)
    {
        $bests = [];
        $user = null;
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
            if ($user && isset($user['bests_q_inst']))
                $bests = json_decode($user['bests_q_inst'], true);
        }
        return view('secret.bests', [
            'titles' => BestController::instTitles(),
            'answers' => $bests,
            'user' => $user
        ]);
    }

    public function givenVotes(Request $request)
    {
        $user = null;
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
        }
        $res1 = BestController::titles();
        if($user){
            $users = User::where('username', 'like', '92%')->get();
            foreach ($users as $u) {
                if (!isset($u['bests_q']) || !$u['bests_q'] || $u['bests_q'] == "null")
                    continue;
                $bests = json_decode($u['bests_q'], true);
                foreach ($bests as $key => $b) {
                    if($b == $user['_id']){
                        if (!is_numeric($res1[$key]))
                            $res1[$key] = 0;
                        $res1[$key]++;
                    }
                }
            }
        }
        $res = [];
        foreach ($res1 as $key => $r){
            if(is_numeric($r))
                $res[$key] = $r;
        }
        $res = collect($res)->sort()->reverse();
        return view('secret.given_votes', [
            'titles' => BestController::titles(),
            'answers' => $res,
            'user' => $user
        ]);
    }

    public function givenVotesDetails(Request $request)
    {
        $user = null;
        $username = $request->get('username');
        $key = $request->get('key');
        if ($username) {
            $user = User::where('username', $username)->first();
            if (!$user)
                $user = User::where('email', $username)->first();
        }
        $res =[];
        if($user){
            $users = User::where('username', 'like', '92%')->get();
            foreach ($users as $u) {
                if (!isset($u['bests_q']) || !$u['bests_q'] || $u['bests_q'] == "null")
                    continue;
                $bests = json_decode($u['bests_q'], true);
                if(isset($bests[$key]) && $bests[$key] == $user['_id']){
                    $res[] = $u['_id'];
                }
            }
        }
        return view('secret.given_votes_details', [
            'title' => BestController::titles()[$key],
            'users' => $res,
            'user' => $user
        ]);
    }


}
