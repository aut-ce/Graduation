<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Route;

class AuthController extends Controller
{
    public static function routes()
    {

        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('password/change', 'AuthController@changePass')->name('password.change');
        Route::post('password/change', 'AuthController@changePassAction')->name('password.change');
    }

    public function changePass()
    {
        return view('auth.change_pass');
    }

    public function changePassAction(Request $request)
    {
        $rules = [
            'password' => 'required|confirmed|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors(['لطفا اطلاعات را درست وارد کنید. حداقل ۶ حرف']);
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->route('landing')->with(['success' => 'رمز عبور شما با موفقیت تغییر یافت']);


    }


}
