<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Shop::factory(10)->create();
        \App\Models\Area::factory(10)->create();
        \App\Models\Genre::factory(10)->create();
        \App\Models\Favorite::factory(10)->create();
        \App\Models\Reservation::factory(10)->create();
    }
}
