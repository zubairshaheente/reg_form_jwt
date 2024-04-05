<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\SampleEmail;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phn_num' => $request->phn_num,
            'password' => bcrypt($request->password),
            'verification_token' => null
        ]);

        $token = auth()->login($user); // Generate JWT token

        $user->verification_token = $token; // Set verification token
        $user->save();

        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $twilio->messages->create(
            $request->input('phn_num'),
            [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => 'Your verification code is: ' . $token // Use $token directly
            ]
        );


        Mail::to($request->email)->send(new SampleEmail($user, $token));

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function verify(Request $request, $token)
    {
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            $user->update([
                'email_verified_at' => now(),
                'verification_token' => null,
            ]);
            return redirect()->route('login')->with('success', 'Your account has been verified successfully. Please log in.');
        } else {
            return redirect()->route('login')->with('error', 'Invalid verification token.');
        }
    }

    public function login(){
        return view('login');
        dd('hello');
    }

    public function twilio(){
        dd('Twilio');
    }
}
