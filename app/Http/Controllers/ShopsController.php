<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Shop::all();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $items = Shop::where('id', $shop->id)->first();
        if ($items) {
            $areas = Shop::find($shop->id)->areas->first()->shop_area;
            $genres = Shop::find($shop->id)->genres->first()->shop_genre;
            $shop_area = 'shop_area';
            $shop_genre = 'shop_genre';
            $items -> $shop_area = $areas;
            $items -> $shop_genre = $genres;
            return response()->json([
                'message' => 'OK',
                'data' => $items
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
