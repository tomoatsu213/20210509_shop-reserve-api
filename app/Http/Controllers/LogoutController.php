<?php

namespace App\Http\Controllers;

class LogoutController extends Controller
{
    public function logout()
    {
        return response()->json(['auth' => false], 200);
    }
}