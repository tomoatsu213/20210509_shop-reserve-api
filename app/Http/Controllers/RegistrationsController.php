<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegistrationsController extends Controller
{
    public function post(Request $request)
    {
        $hashed_password = Hash::make($request->password);
        $param = User::create([
            "user_name" => $request->user_name,
            "email" => $request->email,
            "password" => $hashed_password,
        ]);
        return response()->json([
            'message' => 'User created successfully',
            'data' => $param
        ], 201);
    }
}
