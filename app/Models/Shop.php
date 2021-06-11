<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Shop extends Model
{
    use HasFactory;
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

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

    protected $fillable = [
        'shop_name',
        'shop_profile',
        'shop_image',
    ];

    public static function getShops()
    {
        $shop = Shop::with('areas', 'genres', 'reviews', 'favorites')->get();
        $shops = [];
        for ($i = 0; $i < count($shop); $i++) {
            $favoriteLists = $shop[$i]->favorites;
            $checkFavorite = $favoriteLists->contains('user_id', Auth::user()->id);
            $shops[] = array(
                'id' => $shop[$i]->id,
                'shop_name' => $shop[$i]->shop_name,
                'shop_image' => $shop[$i]->shop_image,
                'shop_area' => $shop[$i]->areas[0]->shop_area,
                'shop_genre' => $shop[$i]->genres[0]->shop_genre,
                'shop_star' => round($shop[$i]->reviews->avg('shop_star'), 2),
                'check_favorite' => $checkFavorite,
            );
        }
        return $shops;
    }

    public static function getShopsAreas()
    {
        $shopsAreas = Area::distinct()->select('shop_area')->get();
        return $shopsAreas;
    }

    public static function getShopsGenres()
    {
        $shopsGenres = Genre::distinct()->select('shop_genre')->get();
        return $shopsGenres;
    }

    public static function getShop($shop_id)
    {
        $shopInfo = Shop::with('areas', 'genres', 'reviews', 'reservations')->find($shop_id);
        $shop = array(
            'id' => $shop_id,
            'shop_name' => $shopInfo->shop_name,
            'shop_image' => $shopInfo->shop_image,
            'shop_profile' => $shopInfo->shop_profile,
            'shop_area' => $shopInfo->areas[0]->shop_area,
            'shop_genre' => $shopInfo->genres[0]->shop_genre,
            'reservation' => $shopInfo->reservations,
            'today' => date('Y-m-d'),
            'shop_star' => round($shopInfo->reviews->avg('shop_star'), 2),
            'user_comment' => $shopInfo->reviews->pluck('user_comment', 'id'),
        );
        return $shop;
    }

    public static function updateFavorite($shop_id)
    {
        $addFavorite = Favorite::create([
            "shop_id" => $shop_id,
            "user_id" => Auth::user()->id,
        ]);
        return $addFavorite;
    }

    public static function deleteFavorite($shop_id)
    {
        $checkFavorite = Favorite::where('shop_id', $shop_id)->where('user_id', Auth::user()->id)->first();
        return $checkFavorite;
    }

    public static function addReservation(Request $request, $shop_id)
    {
        $addReservation = Reservation::create([
            "shop_id" => $shop_id,
            "user_id" => Auth::user()->id,
            "reservation_date" => $request->reservation_date,
            "reservation_time" => $request->reservation_time,
            "reservation_number" => $request->reservation_number,
        ]);
        return $addReservation;
    }

    public static function updateReservation(Request $request, $shop_id)
    {
        $existingReservation = Reservation::where('shop_id', $shop_id)->where('user_id', Auth::user()->id)->first();
        $updatedReservation = $existingReservation->fill([
            "reservation_date" => $request->reservation_date,
            "reservation_time" => $request->reservation_time,
            "reservation_number" => $request->reservation_number,
        ]);
        $updatedReservation->save();
        return $updatedReservation;
    }

    public static function deleteReservation($shop_id)
    {
        $checkReservation = Reservation::where('shop_id', $shop_id)->where('user_id', Auth::user()->id)->first();
        return $checkReservation;
    }

    public static function addVisit()
    {
        $userReservedShopId = User::with('reservations')->find(Auth::user()->id)->reservations->pluck('shop_id');
        $userReservedShops = Shop::with('reservations')->find($userReservedShopId);
        $shops = collect([]);
        for ($i = 0; $i < count($userReservedShops); $i++) {
            $ReservedLists = $userReservedShops[$i]->reservations->where('user_id', Auth::user()->id)->first();
            $ReservedDate = $ReservedLists->reservation_date;
            $today = date('Y-m-d');
            if ($ReservedDate < $today) {
                $addVisits = Visit::create([
                    "shop_id" => $ReservedLists->shop_id,
                    "user_id" => Auth::user()->id,
                ]);
                $shops[] = $addVisits;
            }
        }
        return $shops;
    }

    public static function deleteVisit($shop_id)
    {
        $checkVisit = Visit::where('shop_id', $shop_id)->where('user_id', Auth::user()->id)->first();
        return $checkVisit;
    }

    public static function getReview($shop_id)
    {
        $shop = Shop::with('reviews')->find($shop_id)->reviews;
        return $shop;
    }

    public static function addReview(Request $request, $shop_id)
    {
        $addReview = Review::create([
            "shop_id" => $shop_id,
            "user_id" => Auth::user()->id,
            "shop_star" => $request->shop_star,
            "user_comment" => $request->user_comment,
        ]);
        return $addReview;
    }

    public static function updateReview(Request $request, $shop_id)
    {
        $existingReview = Review::where('shop_id', $shop_id)->where('user_id', Auth::user()->id)->first();
        $updatedReview = $existingReview->fill([
            "shop_star" => $request->shop_star,
            "user_comment" => $request->user_comment,
        ]);
        $updatedReview->save();
        return $updatedReview;
    }

    public static function deleteReview($shop_id)
    {
        $checkReview = Review::where('shop_id', $shop_id)->where('user_id', Auth::user()->id)->first();
        return $checkReview;
    }

    // public static function addShops(Request $request)
    // { {
    //         $item1 = Shop::create([
    //             "shop_name" => $request->shop_name,
    //             "shop_profile" => $request->shop_profile,
    //             "shop_image" => $request->shop_image,
    //         ]);

    //         $item2 = Area::create([
    //             "shop_id" => $request->shop_id,
    //             "shop_area" => $request->shop_area
    //         ]);

    //         $item3 = Genre::create([
    //             "shop_id" => $request->shop_id,
    //             "shop_genre" => $request->shop_genre,
    //         ]);

    //         return response()->json([
    //             'message' => 'Shop created successfully',
    //             'data1' => $item1,
    //             'data2' => $item2,
    //             'data3' => $item3
    //         ], 201);
    //     }
    // }
}
