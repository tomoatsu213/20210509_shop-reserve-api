<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Shop;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public static function registration(Request $request)
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
    public static function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
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

    public static function getUser($user_id)
    {
        if ($user_id) {
            $items = User::find($user_id);
            return response()->json([
                'message' => 'User got successfully',
                'data' => $items
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public static function getUserFavorites($user_id)
    {
        if ($user_id) {
            $items = User::with('favorites')->find($user_id)->favorites->pluck('shop_id');
            $params = Shop::with('areas', 'genres')->find($items);
            return response()->json([
                'message' => 'Favorites of user got successfully',
                'data' => $params
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }

    public static function getUserReservations($user_id)
    {
        if ($user_id) {
            $items = User::with('reservations')->find($user_id)->reservations->pluck('shop_id');
            $params = Shop::with('reservations')->find($items);
            return response()->json([
                'message' => 'Reservations of user got successfully',
                'data' => $params
            ], 200);
        } else {
            return response()->json(['status' => 'unauthorized'], 401);
        }
    }
}
