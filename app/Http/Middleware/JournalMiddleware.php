<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class JournalMiddleware
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
        $admins = journal_admins();
        $user = Auth::user();
        if($user['username'] && $admins->contains($user->username))
            return $next($request);
        else
            return redirect()->route('landing');
    }
}
