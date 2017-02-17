<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function routes(){
        Route::get('/', 'HomeController@index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('temp_home');
    }
}
