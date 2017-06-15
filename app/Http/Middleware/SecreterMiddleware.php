<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SecreterMiddleware
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
        $admins = secret_admins();
        $user = Auth::user();
        if(isset($user['username']) && $admins->contains($user->username))
            return $next($request);
        else
            return redirect()->route('landing');
    }
}
