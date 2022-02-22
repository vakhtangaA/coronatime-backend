<?php

use App\Http\Controllers\api\AuthorizationController;
use App\Http\Controllers\api\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('register', [AuthorizationController::class, 'register']);
Route::post('login', [AuthorizationController::class, 'login']);
Route::post('logout', [AuthorizationController::class, 'logout']);
Route::get('is-logged', [AuthorizationController::class, 'isLogged']);

Route::get('all-countries', [StatisticsController::class, 'allCountries']);
Route::get('statistics-sum', [StatisticsController::class, 'statisticsSum']);
