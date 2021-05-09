<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::factory()->count(1)->forShop(['shop_id' => '1',])->create();
        Area::factory()->count(1)->forShop(['shop_id' => '2',])->create();
        Area::factory()->count(1)->forShop(['shop_id' => '3',])->create();
    }
}
