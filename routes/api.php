<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\AuthController;

/*///////////////////////////////////////////////
(1) Userログイン後（registrationsとloginのみ認証不要）
*////////////////////////////////////////////////
Route::group([
  'prefix' => 'v1'
], function () {
  Route::group([
    'middleware' => 'api',
  ], function ($router) {
    Route::post('/registrations', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/refresh', [AuthController::class, 'refresh']);

    Route::group(['prefix' => 'users'], function () {
      Route::get('favorites', [UsersController::class, 'getUserFavorites']);
      Route::get('reservations', [UsersController::class, 'getUserReservations']);
      Route::get('visits', [UsersController::class, 'getUserVisits']);
    });

    Route::group(['prefix' => 'shops'], function () {
      Route::get('', [ShopsController::class, 'getShops']);
      Route::get('areas', [ShopsController::class, 'getShopsAreas']);
      Route::get('genres', [ShopsController::class, 'getShopsGenres']);
      Route::get('{shop_id}', [ShopsController::class, 'getShop']);
      // Route::post('registrations', [ShopsController::class, 'addShops']);
      Route::put('{shop_id}/favorites', [ShopsController::class, 'updateFavorite']);
      Route::delete('{shop_id}/favorites', [ShopsController::class, 'deleteFavorite']);
      Route::post('{shop_id}/reservations', [ShopsController::class, 'addReservation']);
      Route::patch('{shop_id}/reservations', [ShopsController::class, 'updateReservation']);
      Route::delete('{shop_id}/reservations', [ShopsController::class, 'deleteReservation']);
      Route::post('visits', [ShopsController::class, 'addVisit']);
      Route::delete('{shop_id}/visits', [ShopsController::class, 'deleteVisit']);
      Route::get('{shop_id}/reviews', [ShopsController::class, 'getReview']);
      Route::post('{shop_id}/reviews', [ShopsController::class, 'addReview']);
      Route::patch('{shop_id}/reviews', [ShopsController::class, 'updateReview']);
      Route::delete('{shop_id}/reviews', [ShopsController::class, 'deleteReview']);
    });
  });
  /*////////////////////////////////////////////////
(2) Adminログイン後（registrationsとloginのみ認証不要）
*/ ////////////////////////////////////////////////
  Route::group([
    'middleware' => ['auth', 'can:admin'],
    'prefix' => 'admin'
  ], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/admin-profile', [AuthController::class, 'userProfile']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
  });
});
