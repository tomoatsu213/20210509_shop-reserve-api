<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Shop;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'role',
        'locked_flg',
        'error_count',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email',
        'password',
        // 'role',
        'locked_flg',
        'error_count',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function getUserFavorites()
    {
        $userFavoriteShopId = User::with('favorites')->find(Auth::user()->id)->favorites->pluck('shop_id');
        $userFavoriteShops = Shop::with('areas', 'genres', 'reviews')->find($userFavoriteShopId);
        for ($i = 0; $i < count($userFavoriteShops); $i++) {
            $shops[] = array(
                'id' => $userFavoriteShops[$i]->id,
                'shop_name' => $userFavoriteShops[$i]->shop_name,
                'shop_image' => $userFavoriteShops[$i]->shop_image,
                'shop_area' => $userFavoriteShops[$i]->areas[0]->shop_area,
                'shop_genre' => $userFavoriteShops[$i]->genres[0]->shop_genre,
                'shop_star' => round($userFavoriteShops[$i]->reviews->avg('shop_star'), 2),
                'check_favorite' => true,
            );
        }
        return $shops;
    }

    public static function getUserReservations()
    {
        $userReservedShopId = User::with('reservations')->find(Auth::user()->id)->reservations->pluck('shop_id');
        $userReservedShops = Shop::with('reservations')->find($userReservedShopId);
        $shops = collect([]);
        for ($i = 0; $i < count($userReservedShops); $i++) {
            $ReservedLists = $userReservedShops[$i]->reservations->where('user_id', Auth::user()->id)->first();
            $ReservedDate = $ReservedLists->reservation_date;
            $today = date('Y-m-d');
            if ($ReservedDate >= $today) {
                $shops[] = array(
                    'id' => $userReservedShops[$i]->id,
                    'shop_name' => $userReservedShops[$i]->shop_name,
                    'reservation_date' => $ReservedLists->reservation_date,
                    'reservation_time' => $ReservedLists->reservation_time,
                    'reservation_number' => $ReservedLists->reservation_number,
                    'hide_edit' => true,
                );
            } else {
                $ReservedLists->delete();
            }
        }
        return $shops;
    }

    public static function getUserVisits()
    {
        $userVisitedShopId = User::with('visits')->find(Auth::user()->id)->visits->pluck('shop_id');
        $userVisitedShops = Shop::with('areas', 'genres', 'reviews')->find($userVisitedShopId);
        $shops = [];
        for ($i = 0; $i < count($userVisitedShops); $i++) {
            $ReviewedLists = $userVisitedShops[$i]->reviews->where('user_id', Auth::user()->id)->first();
            if ($ReviewedLists !== null) {
                $shops[] = array(
                    'id' => $userVisitedShops[$i]->id,
                    'shop_name' => $userVisitedShops[$i]->shop_name,
                    'shop_image' => $userVisitedShops[$i]->shop_image,
                    'shop_area' => $userVisitedShops[$i]->areas[0]->shop_area,
                    'shop_genre' => $userVisitedShops[$i]->genres[0]->shop_genre,
                    'shop_star' => $ReviewedLists->shop_star,
                    'user_comment' => $ReviewedLists->user_comment,
                    'reviewed' => true,
                );
            } else {
                $shops[] = array(
                    'id' => $userVisitedShops[$i]->id,
                    'shop_name' => $userVisitedShops[$i]->shop_name,
                    'shop_image' => $userVisitedShops[$i]->shop_image,
                    'shop_area' => $userVisitedShops[$i]->areas[0]->shop_area,
                    'shop_genre' => $userVisitedShops[$i]->genres[0]->shop_genre,
                    'shop_star' => null,
                    'user_comment' => null,
                    'reviewed' => false,
                );
            }
        }
        return $shops;
    }
}
