<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//  jwt api self try
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/verify/{token}', [AuthController::class, 'verify'])->name('verify');

// Edit
Route::get('/update/{verification_token}', [AuthController::class, 'update']);
// Retrive
Route::get('/retrieve/{id}', [AuthController::class, 'retrieve']);
// Delete
Route::get('/delete/{verification_token}', [AuthController::class, 'delete']);
