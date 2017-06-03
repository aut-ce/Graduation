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
            '58bb393f69ac230e5734e504',
            '58bb393e69ac230e5734e4e0',
            '58bb393b69ac230e5734e496',
            '58bb393d69ac230e5734e4c6',
            '58bb394169ac230e5734e538'
        ]);
        $user = Auth::user();
        if($admins->contains($user->_id))
            return $next($request);
        else
            return redirect()->route('landing');
    }
}
