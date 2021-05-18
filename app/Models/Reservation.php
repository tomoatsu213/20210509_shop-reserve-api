<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
