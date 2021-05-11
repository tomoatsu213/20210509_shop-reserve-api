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
        // \App\Models\User::factory(1)->create();
        // \App\Models\Shop::factory(1)->create();
        // \App\Models\Area::factory(5)->create();
        // \App\Models\Genre::factory(5)->create();
        // \App\Models\Favorite::factory(5)->create();
        // \App\Models\Reservation::factory(5)->create();
        $this->call(ShopsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
