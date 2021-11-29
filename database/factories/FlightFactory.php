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
            'PlaneId' => rand(1, 100),
            'FromAirportId' => rand(1, 157),
            'ToAirportId' => rand(1, 157),
            'DepartureTime' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'ArrivalTime' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'Status' => 'Laukiamas',
            'PassengersCount' => rand(100, 250),
            'TicketsPrice' => rand(125, 575) / 10
        ];
    }
}
