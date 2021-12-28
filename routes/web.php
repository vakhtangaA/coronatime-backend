<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Components\Login;
use App\Http\Livewire\Components\Register;
use App\Http\Controllers\SessionController;
use App\Http\Livewire\Components\ResetPassword;
use App\Http\Controllers\VerificationController;
use App\Http\Livewire\Components\ForgotPassword;

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

Route::redirect('/', 'en/');

Route::prefix('{language}')->group(function () {
	Route::view('/', 'dashboard')->name('dashboard');

	Route::middleware('guest')->group(function () {
		Route::get('/register', [Register::class, '__invoke'])->name('register');
		Route::get('/login', [Login::class, '__invoke'])->name('login');
	});

	Route::middleware('auth')->group(function () {
		Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
	});

	Route::prefix('/email/verify')->group(function () {
		Route::view('/', 'auth.mail-sent-feedback', ['button' => true, 'text' => 'We have sent you a confirmation email'])->name('verification.notice');
	});

	Route::view('/reset/sent', 'auth.mail-sent-feedback', ['button' => false, 'text' => 'We have sent you a password reset link'])->name('passwordReset.notice');

	Route::view('verified', 'auth.verified', ['text' => 'Your account is confirmed, you can sign in'])->name('verified');
	Route::view('verified', 'auth.verified', ['text' => 'Your password is changed, you can sign in'])->name('passwordReseted');

	Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

	Route::get('/verify/after', [VerificationController::class, 'afterVerification'])->name('afterVerify');

	Route::get('/reset-password/{token}', [ResetPassword::class, '__invoke'])->middleware('guest')->name('password.reset');
	Route::get('/forgot-password', [ForgotPassword::class, '__invoke'])->middleware('guest')->name('password.email');
});

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'index'])->middleware(['auth', 'signed'])->name('verification.verify');
