<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FootballController extends Controller
{
    private string $folder = 'Administration/Manage/Football/';

    public function index(Request $request)
    {
        return Inertia::render($this->folder.'index');
    }
}
