<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Reservation extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function shops()
    {
        return $this->belongsTo(Shop::class);
    }

    protected $fillable = [
        'shop_id',
        'user_id',
        'reservation_date',
        'reservation_time',
        'reservation_number',
    ];

    public static function addReservation(Request $request, $shop_id)
    {
        $param = Reservation::create([
            // "user_id" => auth()->id(),
            "shop_id" => $shop_id,
            "user_id" => $request->user_id,
            "reservation_date" => $request->reservation_date,
            "reservation_time" => $request->reservation_time,
            "reservation_number" => $request->reservation_number,
        ]);
        return $param;
    }
}
