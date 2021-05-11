<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Shop::factory()->hasAreas(1)->create();
        // Shop::factory()->hasFavorites(1)->create();
        // Shop::factory()->hasReservations(1)->create();
        // Shop::factory()->hasAreas(1)->create();
        Shop::factory(5)->hasAreas(1)->hasGenres(1)->hasFavorites(1)->hasReservations(1)->create();
    }
}
