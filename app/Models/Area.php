<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    public function shops()
    {
        return $this->belongsTo(Shop::class);
    }
    
    protected $fillable = [
        'shop_id',
        'shop_area',
    ];
}
