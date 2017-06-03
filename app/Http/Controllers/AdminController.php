<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::get('/list', 'AdminController@home')->name('home');
            Route::get('/bests', 'AdminController@bests')->name('bests');
            Route::get('/written', 'AdminController@written')->name('written');
            Route::get('/written-for', 'AdminController@writtenFor')->name('writtenFor');
            Route::get('/cover', 'AdminController@cover')->name('cover');

            Route::get('/', function () {
                return redirect()->route('admin.home');
            })->name('main');
        });
    }


    public function home()
    {
        return view('admin.admin_home');
    }

    public function bests()
    {
        $users = User::where('username', 'like', '9231%')->get();
        $res1 = BestController::titles();
        foreach ($users as $user) {
            if (!isset($user['bests_q']) || !$user['bests_q'] || $user['bests_q'] == "null")
                continue;
            $bests = json_decode($user['bests_q'], true);
            foreach ($bests as $key => $b) {
                if (!is_array($res1[$key]))
                    $res1[$key] = [];
                $res1[$key][] = $b;
            }
        }
        foreach ($res1 as $key => $value) {
            $count_array = [];
            foreach ($value as $id) {
                if (isset($count_array[$id]))
                    $count_array[$id]++;
                else $count_array[$id] = 1;
            }
            $count_array_obj = [];
            foreach ($count_array as $key2 => $value) {
                $item['id'] = $key2;
                $item['num'] = $value;
                $count_array_obj[] = $item;
            }
            $count_array = collect($count_array_obj)->sortByDesc('num');
            $res2[$key] = $count_array->values()->all();
        }
        return view('admin.bests', [
            'titles' => BestController::titles(),
            'answers' => $res2,
        ]);

    }

    public function written()
    {
        $articles = Article::where('content', '<>', '')->get();
        $res = [];
        foreach ($articles as $art) {
            if (isset($art['cover']) && $art['cover']){
                if (!isset($res[$art['user_id']]['cover']))
                    $res[$art['user_id']]['cover'] = 1;
                else $res[$art['user_id']]['cover']++;
            }
            else{
                if (!isset($res[$art['user_id']]['art']))
                    $res[$art['user_id']]['art'] = 1;
                else $res[$art['user_id']]['art']++;
            }
        }
        return view('admin.written',[
            'written' => $res
        ]);

    }

    public function writtenFor(){
        $articles = Article::where('content', '<>', '')->get();
        $res = [];
        foreach ($articles as $art) {
            if (isset($art['cover']) && $art['cover']){
                if (!isset($res[$art['texter_id']]['cover']))
                    $res[$art['texter_id']]['cover'] = 1;
                else $res[$art['texter_id']]['cover']++;
            }
            else{
                if (!isset($res[$art['texter_id']]['art']))
                    $res[$art['texter_id']]['art'] = 1;
                else $res[$art['texter_id']]['art']++;
            }
        }
        return view('admin.written_for',[
            'written' => $res
        ]);
    }

}
