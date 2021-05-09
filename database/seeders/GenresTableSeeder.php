<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::factory()->count(1)->forShop(['shop_id' => '1',])->create();
        Genre::factory()->count(1)->forShop(['shop_id' => '2',])->create();
        Genre::factory()->count(1)->forShop(['shop_id' => '3',])->create();
    }
}
