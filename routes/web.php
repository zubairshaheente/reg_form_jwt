<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleApiController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JwtController;

Route::get('googleLogin', [GoogleApiController::class, 'googleLogin'])->name('google');
Route::get('/login/google/callback', [GoogleApiController::class, 'callback'])->name('callback');
Route::post('/', [GoogleApiController::class, 'loginsend'])->name('loginsend');

Route::get('/', function () { return view('welcome'); });

Route::get('/email/verify', function () { return view('auth.verify-email'); })->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
})->middleware(['auth', 'verified']);
//
// Route::post('/registration_form', [AuthController::class, 'register'])->name('register');
// Route::get('/registration_form', function () {
//      return view('registration_form');
//  });

//  jwt api self try
// Route::get('/registration_form', [JwtController::class, 'registration_fun' ])->name('registration_fun');
// Route::post('/login', [JwtController::class, 'indexsend' ])->name('indexsend');

// for sending email verification
// Route::get('/verify/{token}', [JwtController::class, 'verify'])->name('verify');
