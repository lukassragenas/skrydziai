<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Flight;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'plane_id' => rand(1, 100),
            'from_airport_id' => rand(1, 157),
            'to_airport_id' => rand(1, 157),
            'departure_time' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'arrival_time' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'status' => 'Laukiamas',
            'passengers_count' => rand(100, 250),
            'tickets_price' => rand(125, 575) / 10
        ];
    }
}
