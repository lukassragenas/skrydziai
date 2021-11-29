<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Plane;

class PlaneFactory extends Factory
{
    protected $model = Plane::class;

    public function definition()
    {
        return [
            'TailNumber' => $this->faker->unique()->text(10),
            'AirlinesName' => $this->faker->name(),
            'ModelName' => $this->faker->name(),
            'AvailableSeats' => rand(100, 250)
        ];
    }
}
