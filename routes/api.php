<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationsController;
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

Route::group(['prefix' => 'v1'], function () {
  Route::post('registrations', [RegistrationsController::class, 'post']);
  Route::post('login', [LoginController::class, 'post']);
  Route::post('logout', [LogoutController::class, 'post']);

  Route::group(['prefix' => 'users'], function () {
    Route::get('{user_id}', [UsersController::class, 'get']);
    Route::get('{user_id}/favorites', [UsersController::class, 'get_favorites']);
    Route::get('{user_id}/reservations', [UsersController::class, 'get_reservations']);
  });

  Route::group(['prefix' => 'shops'], function () {
    Route::get('', [ShopsController::class, 'get']);
    Route::get('{shop_id}', [ShopsController::class, 'show']);
    Route::put('{shop_id}/favorites', [ShopsController::class, 'put']);
    Route::post('{shop_id}/reservations', [ShopsController::class, 'post']);
    // Route::post('registrations', [ShopsController::class, 'register']);
    Route::delete('{shop_id}/reservations', [ShopsController::class, 'delete']);
  });
});
