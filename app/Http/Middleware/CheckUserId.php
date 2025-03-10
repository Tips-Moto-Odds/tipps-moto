<?php

namespace App\Http\Middleware;

use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $threshold = 3): Response
    {
        $user = auth()->user();

        if (!$user || $user->role_id <= (int)$threshold) {
            return redirect('/');
        }

        return $next($request);
    }

}
