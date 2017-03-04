<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class AskController extends Controller
{
    public static function routes(){
        Route::group(['prefix'=>'ask','as'=>'ask.'],function (){
            Route::get('/participation', 'AskController@participation')->name('participation');
            Route::post('/participation', 'AskController@participationAction')->name('participation');

        });
    }

    public function participation(){
        return View::make('pages.ask_participation');
    }
    public function participationAction(Request $request){
        $input = $request->only(['participation','number','email','phone']);
        $messages = [
            'email.required' => 'اطلاعات وارد شده کامل نیست',
            'email.email' => 'ایمیل وارد شده صحیح نیست',
            'phone.email' => 'لطفا تلفن را وارد کنید',
        ];
        $val =  Validator::make($input, [
            'email' => 'required|email',
            'phone' => 'required',
        ], $messages);
        if($val->fails())
            return redirect()->back()->withErrors($val);
        $user = Auth::user();
        $user->primary_email = $input['email'];
        $user->primary_phone = $input['phone'];
        $user->participation = $input['participation'];
        $user->participation_number = $input['number'];
        $user->save();
        return redirect()->route('home')->with('success','اطلاعات با موفقیت ثبت شد');

    }
}
