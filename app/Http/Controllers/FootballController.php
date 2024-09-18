<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;

class FootballController extends Controller
{
    private string $folder = 'Administration/Manage/Football/';

    public function index(Request $request)
    {
        $clubs = collect(DB::select('select * from clubs'));

        return Inertia::render($this->folder . 'index', [
            'clubs' => $clubs,
        ]);
    }

    public function searchClub(Request $request)
    {
        $term = $request->input('term');
    }


    public function upsertClub(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|unique:clubs,name' . (empty($request->input('id')) ? '' : ',' . $request->input('id')),
        ];

        // Custom error messages
        $messages = [
            'name.required' => 'Name is required.',
            'name.unique' => 'Name must be unique.',
            'logo.required' => 'Logo is required.',
            'logo.file' => 'Logo must be a file.',
            'logo.mimes' => 'Logo must be a file of type: jpg, jpeg, png.',
            'logo.max' => 'Logo must be less than 2MB.',
        ];

        if (empty($request->input('id'))) {
            $rules['logo'] = 'required|file|mimes:jpg,jpeg,png|max:2048';
        } else {
            if ($request->hasFile('logo')) {
                $rules['logo'] = 'required|file|mimes:jpg,jpeg,png|max:2048';
            } else {
                $rules['logo'] = 'required|string';
            }
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        // Save the club to the database
        if (empty($request->input('id'))) {
            // Create a new club
            $club = new Club();
        } else {
            // Update an existing club
            $club = Club::findOrFail($request->input('id'));

            // Delete the old logo file if a new file is provided
            if ($request->hasFile('logo')) {
                Storage::delete('System/TeamLogos/' . $club->logo);
            }
        }

        $club->name = $request->name;

        if ($request->hasFile('logo')) {
            // Sanitize the team name for use in the filename
            $teamNameSlug = Str::slug($request->name, '-');
            // Get the file's original extension
            $extension = $request->file('logo')->getClientOriginalExtension();
            // Create a unique filename
            $filename = $teamNameSlug . '-' . time() . '.' . $extension;
            // Store the logo in the 'public/System/TeamLogos' directory
            $logoPath = $request->file('logo')->storeAs('System/TeamLogos', $filename, 'public');
            $club->logo = $filename;
        }

        $club->save();
        return redirect()->back();
    }

    public function deleteClub(Request $request,Club $club)
    {
        $response = $club->forceDelete();

        return [
            'status' => true
        ];
    }
}
