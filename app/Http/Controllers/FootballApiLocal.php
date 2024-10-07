<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FootballApiLocal extends Controller
{
    public function postAPI(Request $request): array
    {
        return collect($data = $this->data())->first();
    }


    public function data(): array
    {
        // Define the file path
        $path = storage_path("app/system/respnse.json");

        // Check if the file exists
        if (!file_exists($path)) {
            // Handle the case where the file doesn't exist
            return ['error' => 'File not found.'];
        }

        // Get the contents of the file
        $jsonContents = file_get_contents($path);

        // Decode the JSON into an array
        $data = json_decode($jsonContents, true);

        // Return the decoded data or an error if decoding fails
        return $data ?? ['error' => 'Failed to decode JSON.'];
    }

}
