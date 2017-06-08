<?php

namespace App\Http\Middleware;

use Closure;

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
            '9231030'
        ]);
        $user = Auth::user();
        if($admins->contains($user->username))
            return $next($request);
        else
            return redirect()->route('landing');
    }
}
