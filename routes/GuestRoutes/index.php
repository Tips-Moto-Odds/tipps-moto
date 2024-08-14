<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {

    Route::get('/sign-up', function () {
        return Inertia::render('Home/SignUp');
    })
        ->name('sign-up');

    Route::get('/sign-in', function () {
        return Inertia::render('Home/SignIn');
    })
        ->name('sign-in');

    Route::get('/reset-password', function () {
        return Inertia::render('Home/ResetPassword');
    })
        ->name('reset-password');

    Route::post('/validatePhoneNumber', function (Request $request) {

        //TODO:remember to validate
        $email = $request->get('email');
        $phoneNumber = $request->get('phone');

        $user = User::where('email', $email)->first();

        //phone number validation
        //get the last 10 digits of the phone number
        $phoneNumber = substr($phoneNumber, -9);
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        //do the same for the user's phone number
        $userPhoneNumber = substr($user->phone, -9);

        //compare the two phone numbers
        if ($phoneNumber !== $userPhoneNumber) {
            return response()->json(['error' => 'Invalid phone number'], 400);
        }

        //generate a code for password validation
        $code = rand(100000, 999999);

        $password_reset_token = DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email], // Search criteria
            ['token' => $code, 'created_at' => now()] // Data to insert or update
        );

        //TODO:remove this
        //send the code to the users phone return success
        return [
            'status' => true,
            'code' => $code
        ];
    })
        ->name('validatePhoneNumber');

    Route::post("/changePassword",function (Request $request){
        //Remember to validate
        $code = $request->get('code');
        $email = $request->get('email');
        $password = $request->get('password');

        //get the reset token where the email matches the provided email
        $password_reset_token = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $code)
            ->where('created_at', '>=', now()->subMinutes(10)) // Token is valid for 10 minutes
            ->orderBy('created_at', 'desc') // Get the latest token
            ->first();

        //if the token is not found or is expired return error
        if(!$password_reset_token){
            return response()->json(['error' => 'Invalid code'], 400);
        }

        //update the user's password
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($password);
        $user->save();

        //delete the token
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        //redirect to /login
        return redirect()->route('sign-in')->with('status', 'Password has been changed successfully');

    })->name('changePassword');

});
