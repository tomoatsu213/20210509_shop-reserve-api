<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => $this->faker->randomNumber(1),
            'user_id' => $this->faker->randomNumber(1),
            'reservation_date' => $this->faker->date(),
            'reservation_time' => $this->faker->dateTimeThisMonth(),
            'reservation_number' => $this->faker->randomNumber(1),
        ];
    }
}
