<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EntracneYear
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
        $user = Auth::user();
        if(!isset($user['others']))
            return $next($request);
        else
            return redirect()->route('landing')->withErrors(['شما به این قسمت دسترسی ندارید']);
    }
}
