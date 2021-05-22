<?php

namespace App\Http\Controllers;
use App\Models\User;

class UsersController extends Controller
{
    public function getUser($user_id)
    {
        $param = User::getUser($user_id);
        return $param;
    }

    public function getUserFavorites($user_id)
    {
        $param = User::getUserFavorites($user_id);
        return $param;
    }

    public function getUserReservations($user_id)
    {
        $param = User::getUserReservations($user_id);
        return $param;
    }
}