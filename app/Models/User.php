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
        return $param;
    }
    public static function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return $user;
    }

    public static function getUser($user_id)
    {
        $user = User::find($user_id);
        return $user;
    }

    public static function getUserFavorites($user_id)
    {
        $userFavoriteShopId = User::with('favorites')->find($user_id)->favorites->pluck('shop_id');
        $userFavoriteShops = Shop::with('areas', 'genres')->find($userFavoriteShopId);
        return $userFavoriteShops;
    }

    public static function getUserReservations($user_id)
    {
        $userReservedShopId = User::with('reservations')->find($user_id)->reservations->pluck('shop_id');
        $userReservedShops = Shop::with('reservations')->find($userReservedShopId);
        return $userReservedShops;
    }
}
