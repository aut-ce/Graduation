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
        $admins = collect([
            '9231069',
            '9231030',
            '9231073',
            '9231011',

        ]);
        $user = Auth::user();
        if($admins->contains($user->username))
            return $next($request);
        else
            return redirect()->route('landing');
    }
}
