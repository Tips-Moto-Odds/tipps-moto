<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TipsController extends Controller
{
    private string $folder = 'Administration/Manage/';

    public function index(Request $request)
    {
        $tips = Tips::paginate(10);

        return Inertia::render($this->folder.'Tips/Index',[
            'tips' => $tips
        ]);
    }

    public function view(Request $request,Tips $tip)
    {
        return Inertia::render($this->folder.'Tips/view',[
            'tip' => $tip
        ]);
    }
}
