<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CaptureAffiliateLink
{
    public function handle(Request $request, Closure $next)
    {
        // ✅ Skip all logic if user is authenticated
        if (Auth::check()) {
            return $next($request);
        }

        $incomingLink = $request->query('affiliateLink');
        $existingCookie = $request->cookie('affiliateLink');

        // ✅ Set or update the affiliate cookie if URL contains affiliateLink
        if ($incomingLink && $incomingLink !== $existingCookie) {
            Cookie::queue('affiliateLink', $incomingLink, 60 * 24 * 7); // 7 days
        }

        return $next($request);
    }
}
