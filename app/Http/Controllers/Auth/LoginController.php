<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function attemptLogin(Request $request)
    {
        $first = $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
        if ($first)
            return $first;
        return $this->guard()->attempt(
            ['username' => $request->get($this->username()), 'password' => $request->get('password')],
            $request->has('remember')
        );
    }

    public function showLoginForm()
    {
        return view('auth.auth');
    }
}
