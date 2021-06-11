<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function getUserFavorites()
    {
        if (Auth::user()->id) {
            $userFavoriteShops = User::getUserFavorites(Auth::user()->id);
            return response()->json([
                'message' => 'Favorites of user got successfully',
                'data' => $userFavoriteShops
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public function getUserReservations()
    {
        if (Auth::user()->id) {
            $userReservedShops = User::getUserReservations(Auth::user()->id);
            return response()->json([
                'message' => 'Reservations of user got successfully',
                'data' => $userReservedShops
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public function getUserVisits()
    {
        if (Auth::user()->id) {
            $userReviewedShops = User::getUserVisits(Auth::user()->id);
            return response()->json([
                'message' => 'Reviews of user got successfully',
                'data' => $userReviewedShops
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }
}
