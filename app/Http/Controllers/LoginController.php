<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $items = User::where('email', $request->email)->first();
        $isPasswordCheck = Hash::check($request->password, $items->password);
        if ($isPasswordCheck) {
            return response()->json([
                'auth' => true,
                'data' => $items->id
            ], 200);
        } else {
            return response()->json(['auth' => false], 401);
        }
    }
}
