<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Reserve::all();
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
        $item = new Reserve;
        $item->shop_id = $request->shop_id;
        $item->shop_name = $request->shop_name;
        $item->user_id = $request->user_id;
        $item->reservation_date = $request->reservation_date;
        $item->reservation_time = $request->reservation_time;
        $item->reservation_number = $request->reservation_number;
        $item->save();
        return response()->json([
            'message' => 'Reservation was created successfully',
            'data' => $item
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $item = Reserve::where('id', $reservation->id)->delete();
        if ($item) {
            return response()->json(
                ['message' => 'Reservation was deleted successfully'],
                200
            );
        } else {
            return response()->json(
                ['message' => 'Reservation not found'],
                404
            );
        }
    }
}
