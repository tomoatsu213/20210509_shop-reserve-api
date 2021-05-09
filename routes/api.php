<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ReservesController;
use App\Http\Controllers\RegistersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;


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

Route::apiResource('/v1/users/{user_id}/favorites', FavoritesController::class);
Route::apiResource('/v1/shops/{shop_id}/favorites', FavoritesController::class);
Route::apiResource('/v1/users/{user_id}/reservations', ReservesController::class);
Route::apiResource('/v1/shops/{shop_id}/reservations', ReservesController::class);
Route::apiResource('/v1/shops', ShopsController::class);
Route::post('/v1/registrations', [RegistersController::class, 'post']);
Route::post('/v1/login', [LoginController::class, 'post']);
Route::post('/v1/logout', [LogoutController::class, 'post']);
Route::get('/v1/users/{user_id}', [UsersController::class, 'get']);