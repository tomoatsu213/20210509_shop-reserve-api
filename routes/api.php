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
  Route::post('registrations', [RegistrationsController::class, 'registration']);
  Route::post('login', [LoginController::class, 'login']);
  Route::post('logout', [LogoutController::class, 'logout']);

  Route::group(['prefix' => 'users'], function () {
    Route::get('{user_id}', [UsersController::class, 'getUser']);
    Route::get('{user_id}/favorites', [UsersController::class, 'getUserFavorites']);
    Route::get('{user_id}/reservations', [UsersController::class, 'getUserReservations']);
  });

  Route::group(['prefix' => 'shops'], function () {
    Route::get('', [ShopsController::class, 'getShops']);
    Route::get('{shop_id}', [ShopsController::class, 'getShop']);
    // Route::post('registrations', [ShopsController::class, 'addShops']);
    Route::put('{shop_id}/favorites', [ShopsController::class, 'updateFavorite']);
    Route::delete('{shop_id}/favorites', [ShopsController::class, 'deleteFavorite']);
    Route::post('{shop_id}/reservations', [ShopsController::class, 'addReservation']);
    Route::delete('{shop_id}/reservations', [ShopsController::class, 'deleteReservation']);
  });
});
