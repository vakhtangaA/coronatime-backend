<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'dashboard')->name('dashboard');

Route::middleware('guest')->group(function () {
	Route::get('/register', [\App\Http\Livewire\Components\Register::class, '__invoke'])->name('register');
	Route::get('/login', [\App\Http\Livewire\Components\Login::class, '__invoke'])->name('login');
});

Route::middleware('auth')->group(function () {
	Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::get('/email/verify', function () {
	return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();

	auth()->logout();

	return redirect()->route('login')->with('success', 'Your account is verified, please sign in');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);
