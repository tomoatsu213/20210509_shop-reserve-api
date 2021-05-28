<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::login($request);
        $isPasswordCheck = Hash::check($request->password, $user->password);
        if ($isPasswordCheck) {
            return response()->json([
                'auth' => true,
                'data' => $user->id
            ], 200);
        } else {
            return response()->json(['auth' => false], 401);
        }
    }
}
