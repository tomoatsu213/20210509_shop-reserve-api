<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function getShops()
    {
        $shops = Shop::getShops();
        return response()->json([
            'message' => 'OK',
            'data' => $shops
        ], 200);
    }

    public function getShop($shop_id)
    {
        $shop = Shop::getShop($shop_id);
        return response()->json([
            'message' => 'OK',
            'data' => $shop
        ], 200);
    }

    // public function addShops(Request $request)
    // {
    //     $param = Shop::addShops($request);
    //     return $param;
    // }

    public function updateFavorite(Request $request, $shop_id)
    {
        $checkFavorite = Favorite::where('shop_id', $shop_id)->where('user_id', $request->user_id)->first();
        if (!$checkFavorite) {
            $addFavorite = Shop::updateFavorite($request, $shop_id);
            return response()->json([
                'message' => 'Favorite created successfully',
                'data' => $addFavorite
            ], 201);
        } else {
            return response()->json(['status' => 'Not Acceptable'], 406);
        }
    }

    public function deleteFavorite(Request $request, $shop_id)
    {
        $checkFavorite = Shop::deleteFavorite($request, $shop_id);
        if ($checkFavorite) {
            $deletedFavorite = $checkFavorite->delete();
            return response()->json([
                'message' => 'Favorite deleted successfully',
                'data' => $deletedFavorite
            ], 200);
        } else {
            return response()->json(['status' => 'Not Found'], 404);
        }
    }

    public function addReservation(Request $request, $shop_id)
    {
        $addReservation = Shop::addReservation($request, $shop_id);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $addReservation,
        ], 201);
    }

    public function deleteReservation(Request $request, $shop_id)
    {
        $checkReservation = Shop::deleteReservation($request, $shop_id);
        if ($checkReservation) {
            $deletedReservation = $checkReservation->delete();
            return response()->json([
                'message' => 'Reservation deleted successfully',
                'data' => $deletedReservation
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
