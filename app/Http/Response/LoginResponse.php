<?php

namespace App\Http\Response;

use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request): RedirectResponse|Response
    {
        return redirect()->route('home');
    }
}
