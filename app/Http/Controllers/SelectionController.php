<?php

namespace App\Http\Controllers;

use App\Models\Selection;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Packages;

class SelectionController extends Controller
{
    public function index(Request $request){
        $selections = Selection::all();

        return Inertia::render('Dashboards/Manager/Selection/Index', [
            'selections' => $selections
        ]);
    }

    public function view(Request $request,Selection $selection){
        return Inertia::render('Dashboards/Manager/Selection/View', [
            'selection' => $selection,
            'packages' => Packages::all(),
        ]);
    }

    public function create(Request $request){

        $packages = Packages::all();

        return Inertia::render('Dashboards/Manager/Selection/create',[
            'packages' => $packages
        ]);
    }
    public function store(Request $request){

        $selection = new Selection();

        $selection->package_id = $request->input('packages');
        $selection->date_for = $request->input('date_for');
        $selection->status = $request->input('active');
        $selection->tips = json_encode($request->input('tips'));
        $selection->save();

        return redirect()->route('dashboard.selection.listSelections');
    }

    public function update(Request $request,Selection $selection){
        $selection->package_id = $request->input('packages');
        $selection->date_for = $request->input('date_for');
        $selection->status = $request->input('active');
        $selection->tips = json_encode($request->input('tips'));
        $selection->save();

        return redirect()->route('dashboard.selection.listSelections');
    }

    public function delete(Request $request,Selection $selection){
        $selection->delete();

        return redirect()->route('dashboard.selection.listSelections');
    }
}
