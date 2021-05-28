<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function getUser($user_id)
    {
        if ($user_id) {
            $user = User::getUser($user_id);
            return response()->json([
                'message' => 'User got successfully',
                'data' => $user
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public function getUserFavorites($user_id)
    {
        if ($user_id) {
            $userFavoriteShops = User::getUserFavorites($user_id);
            return response()->json([
                'message' => 'Favorites of user got successfully',
                'data' => $userFavoriteShops
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public function getUserReservations($user_id)
    {
        if ($user_id) {
            $userFavoriteShops = User::getUserReservations($user_id);
            return response()->json([
                'message' => 'Reservations of user got successfully',
                'data' => $userFavoriteShops
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }
}
