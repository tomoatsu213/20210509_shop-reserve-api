<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    public function area()
    {
        return $this->hasMany(Area::class);
    }

    public function genre()
    {
        return $this->hasMany(Genre::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
