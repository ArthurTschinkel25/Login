<?php
use Illuminate\Http\Request;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/create-movies', [MovieController::class, 'create'])->name('movies.create');
Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

Route::get('/Register', [\App\Http\Controllers\UserController::class, 'Register'])->name('user.register');
Route::get('/Login', [\App\Http\Controllers\UserController::class, 'login'])->name('user.login');
Route::get('/Alterar_senha', [\App\Http\Controllers\UserController::class, 'AlterarSenha'])->name('user.alterar_senha');
Route::put('/Alterar_senha', [\App\Http\Controllers\UserController::class, 'Update'])->name('user.update_senha');
Route::post('/Register', [\App\Http\Controllers\UserController::class, 'Create'])->name('user.create');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
