<?php

namespace App\Http\Controllers;
use App\Models\User;

class UsersController extends Controller
{
    public function get($user_id)
    {
        if ($user_id) {
            $items = User::with('favorites', 'reservations')->find($user_id);
            return response()->json([
                'message' => 'User got successfully',
                'data' => $items
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public function get_favorites($user_id)
    {
        if ($user_id) {
            $items = User::with('favorites')->find($user_id)->favorites;
            return response()->json([
                'message' => 'Favorites of user got successfully',
                'data' => $items
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public function get_reservations($user_id)
    {
        if ($user_id) {
            $items = User::with('reservations')->find($user_id)->reservations;
            return response()->json([
                'message' => 'Reservations of user got successfully',
                'data' => $items
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }
}