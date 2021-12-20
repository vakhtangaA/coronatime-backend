<?php

use Illuminate\Support\Facades\Route;
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

Route::view('/', 'dashboard')->name('dashboard');

Route::middleware('guest')->group(function () {
	Route::get('/register', [\App\Http\Livewire\Components\Register::class, '__invoke'])->name('register');
	Route::get('/login', [\App\Http\Livewire\Components\Login::class, '__invoke'])->name('login');
});

Route::middleware('auth')->group(function () {
	Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::prefix('/email/verify')->group(function () {
	Route::view(
		'/',
		'auth.verify-email'
	)->middleware('auth')->name('verification.notice');

	Route::get('/{id}/{hash}', [VerificationController::class, 'index'])->middleware(['auth', 'signed'])->name('verification.verify');
});
