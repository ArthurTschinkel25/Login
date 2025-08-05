<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use \App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Routes that require a logged-in AND verified user
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/create-movies', [MovieController::class, 'create'])->name('movies.create');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
});


// User Auth Routes
Route::get('/Register', [UserController::class, 'Register'])->name('user.register');
Route::get('/Login', [UserController::class, 'login'])->name('login');
Route::get('/Alterar_senha', [UserController::class, 'AlterarSenha'])->name('user.alterar_senha');
Route::put('/Alterar_senha', [UserController::class, 'Update'])->name('user.update_senha');
Route::post('/Register', [UserController::class, 'Create'])->name('user.create');
Route::post('/Login', [UserController::class, 'authenticate'])->name('user.login');


// Email Verification Routes (already correct)
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    // Redirect to a dashboard or home page after verification
    return redirect('/movies');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
