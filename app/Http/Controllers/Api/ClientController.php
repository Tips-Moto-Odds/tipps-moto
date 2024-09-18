<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function authenticate(Request $request): false|string
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:users,name',
            'client_secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid credentials'], 400)->getContent();
        }

        $user = User::where('name', $request->input('client_id'))->first();

        if (!Hash::check($request->client_secret, $user->password))
            return response()->json(['message' => 'Invalid credentials'], 401)->getContent();

        // Revoke existing tokens if needed
        $existingToken = $user->tokens->first();

        if ($existingToken) {
            $existingToken->delete(); // Revoke the old token
        }

        // Create a new token
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->accessToken;

        // Prepare the response
        $response = [
            'token_type' => 'Bearer',
            'access_token' => $token->token,
        ];

        return response()->json($response, 200)->getContent();
    }
}
