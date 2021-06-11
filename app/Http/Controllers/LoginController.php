<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LoginController extends Controller
// {
//     public function login(Request $request)
//     {
//         // $user = User::login($request);
//         // $isPasswordCheck = Hash::check($request->password, $user->password);
//         $credentials = $request->only('email', 'password');
//         if (Auth::attempt($credentials)) {
//             // $request->session()->regenerate();
//             return response()->json([
//                 'auth' => true,
//                 'data' => Auth::user()->id
//             ], 200);
//         } else {
//             return response()->json(['status' => 'unauthorized'], 401);
//         }
//     }
// }
