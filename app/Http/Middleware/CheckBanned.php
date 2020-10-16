<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
        if (auth()->check() && auth()->user()->banned_until && now()->lessThan(auth()->user()->banned_until)) {
            $banned_days = now()->diffInDays(auth()->user()->banned_until);
            auth()->logout();

            if ($banned_days > 14) {
                $message = 'Your account has been suspended. Please obey the rules and guidelines to prevent a suspension.';
            } else {
                $message = 'Your account has been suspended for '.$banned_days.' '.str_plural('day', $banned_days).'. Please obey the rules and guidelines to prevent a suspension.';
            }

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
