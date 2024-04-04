<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SampleEmail;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verification_token' => null
        ]);

        $token = auth()->login($user);

        $user->verification_token = $token;
        $user->save();

        Mail::to($request->email)->send(new SampleEmail($user, $token));

        return response()->json([
            'message' => 'User registered successfully. Verification email has been sent.',
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
                // 'verification_token' => null,
            ]);
            return redirect()->route('login')->with('success', 'Your account has been verified successfully. Please log in.');
        } else {
            return redirect()->route('login')->with('error', 'Invalid verification token.');
        }
    }

    public function login(){
        return view('login');
    }

    // Edit the user record
    public function update(Request $request, $verification_token){
        // $user = User::find($verification_token);
        $user = User::where('verification_token', $verification_token)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update($request->all());
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    // Retrive the user record
    public function retrieve($id){
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        } else {
            return response()->json(['message' => 'User Retrieve the record Successfully', 'user' => $user]);
        }
    }
    // Delete the user record
    public function delete($verification_token){
        // dd('delete');
        // $user = User::find($id);
        $user = User::where('verification_token', $verification_token)->first();
        if(!$user){
            return response()->json(['message' => 'User Record not Found'], 404);
        }
        $user->delete();
            return response()->json(['message' => 'User Deleted Successfully']);
    }
}
