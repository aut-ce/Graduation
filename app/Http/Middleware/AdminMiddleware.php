<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admins = collect([
            '9231069',
            '9231036',
            '9231011',
            '9231051',
            '9231902'
        ]);
        $user = Auth::user();
        if($admins->contains($user->username))
            return $next($request);
        else
            return redirect()->route('landing');
    }
}
