<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Shop extends Model
{
    use HasFactory;
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    protected $fillable = [
        'shop_name',
        'shop_profile',
        'shop_image',
    ];

    public static function getShops()
    {
        $shops = Shop::with('areas', 'genres', 'favorites')->get();
        return $shops;
    }

    public static function getShop($shop_id)
    {
        $shop = Shop::with('areas', 'genres', 'favorites', 'reservations')->find($shop_id);
        return $shop;
    }

    public static function updateFavorite(Request $request, $shop_id)
    {
        $addFavorite = Favorite::create([
            "shop_id" => $shop_id,
            "user_id" => $request->user_id,
        ]);
        return $addFavorite;
    }

    public static function deleteFavorite(Request $request, $shop_id)
    {
        $checkFavorite = Favorite::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        return $checkFavorite;
    }

    public static function addReservation(Request $request, $shop_id)
    {
        $addReservation = Reservation::create([
            "shop_id" => $shop_id,
            "user_id" => $request->user_id,
            "reservation_date" => $request->reservation_date,
            "reservation_time" => $request->reservation_time,
            "reservation_number" => $request->reservation_number,
        ]);
        return $addReservation;
    }

    public static function deleteReservation(Request $request, $shop_id)
    {
        $checkReservation = Reservation::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        return $checkReservation;

    }

    // public static function addShops(Request $request)
    // { {
    //         $item1 = Shop::create([
    //             "shop_name" => $request->shop_name,
    //             "shop_profile" => $request->shop_profile,
    //             "shop_image" => $request->shop_image,
    //         ]);

    //         $item2 = Area::create([
    //             "shop_id" => $request->shop_id,
    //             "shop_area" => $request->shop_area
    //         ]);

    //         $item3 = Genre::create([
    //             "shop_id" => $request->shop_id,
    //             "shop_genre" => $request->shop_genre,
    //         ]);

    //         return response()->json([
    //             'message' => 'Shop created successfully',
    //             'data1' => $item1,
    //             'data2' => $item2,
    //             'data3' => $item3
    //         ], 201);
    //     }
    // }
}
