<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/register', [UserController::class, 'showRegister']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLogin']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/email/send', [EmailController::class, 'sendIndex'])->middleware(['is-active']);
Route::post('/email/send', [EmailController::class, 'send'])->middleware(['is-active']);

Route::get('/email/verify', [EmailController::class, 'verifyIndex']);
Route::get('/email/resend', [EmailController::class, 'resend']);
Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'verify'])->name('verification.verify');


