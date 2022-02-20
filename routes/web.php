<?php

use App\Http\Controllers\CountryController;
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

Route::redirect('/', 'en/login')->middleware('guest');
Route::redirect('/', 'en/')->middleware('verified');

Route::group(['prefix' => '{language}'], function () {
	Route::middleware('guest')->group(function () {
		Route::get('register', [Register::class, '__invoke'])->name('register');

		Route::get('login', [Login::class, '__invoke'])->name('login');
	});

	Route::get('email/verify', [VerificationController::class, 'notifyEmailSent'])->name('verification.notice');
	Route::get('reset/sent', [VerificationController::class, 'notifyPasswordResetMailSent'])->name('passwordReset.notice');
	Route::get('verified/email', [VerificationController::class, 'accountIsConfirmed'])->name('account.verified.notice');
	Route::get('reseted/password', [VerificationController::class, 'passwordIsReseted'])->name('passwordReseted');
	Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'index'])->middleware(['auth', 'signed'])->name('verification.verify');
	Route::post('email/verification-notification', [VerificationController::class, 'resend'])->name('verification.send');

	Route::get('reset-password/{token}', [ResetPassword::class, '__invoke'])->name('password.reset');

	Route::get('forgot-password', [ForgotPassword::class, '__invoke'])->name('password.email');

	Route::middleware(['verified', 'auth'])->group(function () {
		Route::get('/', [CountryController::class, 'index'])->name('dashboard');
		Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
	});
});

Route::view('/api/swagger', 'swagger');
