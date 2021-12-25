<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Components\Login;
use App\Http\Livewire\Components\Register;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\VerificationController;

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

Route::redirect('/', 'en');

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
		Route::view(
			'/',
			'auth.verify-email'
		)->name('verification.notice');

		Route::get('/{id}/{hash}', [VerificationController::class, 'index'])->middleware(['auth', 'signed'])->name('verification.verify');
	});
});
