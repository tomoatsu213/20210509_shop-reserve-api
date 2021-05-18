<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function get()
    {
        $items = Shop::with('areas', 'genres', 'favorites')->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    public function show($shop_id)
    {
        $items = Shop::with('areas', 'genres', 'favorites', 'reservations')->where('id', $shop_id)->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    public function post(Request $request, $shop_id)
    {
        $param = Reservation::create([
            // "user_id" => auth()->id(),
            "shop_id" => $shop_id,
            "user_id" => $request->user_id,
            "reservation_date" => $request->reservation_date,
            "reservation_time" => $request->reservation_time,
            "reservation_number" => $request->reservation_number,
        ]);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $param
        ], 201);
    }

    // public function register(Request $request)
    // {
    //     $item1 = Shop::create([
    //         "shop_name" => $request->shop_name,
    //         "shop_profile" => $request->shop_profile,
    //         "shop_image" => $request->shop_image,
    //     ]);

    //     $item2 = Area::create([
    //         "shop_id" => $request->shop_id,
    //         "shop_area" => $request->shop_area
    //     ]);

    //     $item3 = Genre::create([
    //         "shop_id" => $request->shop_id,
    //         "shop_genre" => $request->shop_genre,
    //     ]);

    //     return response()->json([
    //         'message' => 'Shop created successfully',
    //         'data1' => $item1,
    //         'data2' => $item2,
    //         'data3' => $item3
    //     ], 201);
    // }

    public function put(Request $request, $shop_id)
    {
        $checkFavorite = Favorite::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        if (!$checkFavorite) {
            $param = Favorite::create([
                "shop_id" => $shop_id,
                "user_id" => $request->user_id,
                // "user_id" => auth()->id(),
            ]);
            return response()->json([
                'message' => 'Favorite created successfully',
                'data' => $param
            ], 201);
        } else {
            $param = $checkFavorite->delete();
            return response()->json([
                'message' => 'Favorite deleted successfully',
                'data' => $param
            ], 200);
        }
    }

    public function delete(Request $request, $shop_id)
    {
        $checkReservation = Reservation::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        if ($checkReservation) {
            $items = $checkReservation->delete();
            return response()->json([
                'message' => 'Reservation deleted successfully',
                'data' => $items
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
