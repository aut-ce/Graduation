<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AskController extends Controller
{
    public static function routes(){
        Route::group(['prefix'=>'ask','as'=>'ask.'],function (){
            Route::get('/participation', 'AskController@participation')->name('participation');

        });
    }

    public function participation(){
        return View::make('pages.ask_participation');
    }
}
