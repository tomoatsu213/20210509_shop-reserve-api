<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function getShops()
    {
        $param = Shop::getShops();
        return $param;
    }

    public function getShop($shop_id)
    {
        $param = Shop::getShop($shop_id);
        return $param;
    }

    // public function addShops(Request $request)
    // {
    //     $param = Shop::addShops($request);
    //     return $param;
    // }

    public function updateFavorite(Request $request, $shop_id)
    {
        $param = Shop::updateFavorite($request, $shop_id);
        return $param;
    }

    public function deleteFavorite(Request $request, $shop_id)
    {
        $param = Shop::deleteFavorite($request, $shop_id);
        return $param;
    }

    public function addReservation(Request $request, $shop_id)
    {
        $param = Shop::addReservation($request, $shop_id);
        return $param;
    }

    public function deleteReservation(Request $request, $shop_id)
    {
        $param = Shop::deleteReservation($request, $shop_id);
        return $param;
    }
}
