<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render("Administrator/Profile/Account");
    }

}
