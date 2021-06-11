<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
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

    public function getShopsAreas()
    {
        $shopsAreas = Shop::getShopsAreas();
        return response()->json([
            'message' => 'OK',
            'data' => $shopsAreas
        ], 200);
    }

    public function getShopsGenres()
    {
        $shopsGenres = Shop::getShopsGenres();
        return response()->json([
            'message' => 'OK',
            'data' => $shopsGenres
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

    public function updateFavorite($shop_id)
    {
        $checkFavorite = Favorite::where('shop_id', $shop_id)->where('user_id', Auth::user()->id)->first();
        if (!$checkFavorite) {
            $addFavorite = Shop::updateFavorite($shop_id);
            return response()->json([
                'message' => 'Favorite was created successfully',
                'data' => $addFavorite
            ], 201);
        } else {
            return response()->json(['status' => 'Not Acceptable'], 406);
        }
    }

    public function deleteFavorite($shop_id)
    {
        $checkFavorite = Shop::deleteFavorite($shop_id);
        if ($checkFavorite) {
            $deletedFavorite = $checkFavorite->delete();
            return response()->json([
                'message' => 'Favorite was deleted successfully',
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
            'message' => 'Reservation was created successfully',
            'data' => $addReservation,
        ], 201);
    }

    public function updateReservation(Request $request, $shop_id)
    {
        $updateReservation = Shop::updateReservation($request, $shop_id);
        return response()->json([
            'message' => 'Reservation was updated successfully',
            'data' => $updateReservation,
        ], 200);
    }

    public function deleteReservation($shop_id)
    {
        $checkReservation = Shop::deleteReservation($shop_id);
        if ($checkReservation) {
            $deletedReservation = $checkReservation->delete();
            return response()->json([
                'message' => 'Reservation was deleted successfully',
                'data' => $deletedReservation
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }

    public function addVisit()
    {
        $addVisit = Shop::addVisit();
        return response()->json([
            'message' => 'Visit was created successfully',
            'data' => $addVisit,
        ], 201);
    }

    public function deleteVisit($shop_id)
    {
        $checkVisit = Shop::deleteVisit($shop_id);
        if ($checkVisit) {
            $deletedVisit = $checkVisit->delete();
            return response()->json([
                'message' => 'Visit was deleted successfully',
                'data' => $deletedVisit
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }

    public function getReview($shop_id)
    {
        $getReview = Shop::getReview($shop_id);
        return response()->json([
            'message' => 'Review got successfully',
            'data' => $getReview,
        ], 200);
    }

    public function addReview(Request $request, $shop_id)
    {
        $addReview = Shop::addReview($request, $shop_id);
        return response()->json([
            'message' => 'Review was created successfully',
            'data' => $addReview,
        ], 201);
    }

    public function updateReview(Request $request, $shop_id)
    {
        $updateReview = Shop::updateReview($request, $shop_id);
        return response()->json([
            'message' => 'Review was updated successfully',
            'data' => $updateReview,
        ], 200);
    }

    public function deleteReview($shop_id)
    {
        $checkReview = Shop::deleteReview($shop_id);
        if ($checkReview) {
            $deletedReview = $checkReview->delete();
            return response()->json([
                'message' => 'Review was deleted successfully',
                'data' => $deletedReview
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
