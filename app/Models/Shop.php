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
        $items = Shop::with('areas', 'genres', 'favorites')->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    public static function getShop($shop_id)
    {
        $items = Shop::with('areas', 'genres', 'favorites', 'reservations')->find($shop_id);
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    public static function updateFavorite(Request $request, $shop_id)
    {
        $checkFavorite = Favorite::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        if (!$checkFavorite) {
            $param = Favorite::create([
                "shop_id" => $shop_id,
                "user_id" => $request->user_id,
            ]);
            return response()->json([
                'message' => 'Favorite created successfully',
                'data' => $param
            ], 201);
        }
    }

    public static function deleteFavorite(Request $request, $shop_id)
    {
        $checkFavorite = Favorite::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        if ($checkFavorite) {
            $param = $checkFavorite->delete();
            return response()->json([
                'message' => 'Favorite deleted successfully',
                'data' => $param
            ], 200);
        }
    }

    public static function addReservation(Request $request, $shop_id)
    {
        $param = Reservation::addReservation($request, $shop_id);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $param,
        ], 201);
    }

    public static function deleteReservation(Request $request, $shop_id)
    {
        $checkReservation = Reservation::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        if ($checkReservation) {
            $param = $checkReservation->delete();
            return response()->json([
                'message' => 'Reservation deleted successfully',
                'data' => $param
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
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
