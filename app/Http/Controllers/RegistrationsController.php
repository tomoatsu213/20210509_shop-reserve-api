<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistrationsController extends Controller
{
    public function registration(Request $request)
    {
        $param = User::registration($request);
        return $param;
    }
}
