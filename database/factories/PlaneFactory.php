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
            'tail_number' => $this->faker->unique()->text(10),
            'airlines_name' => $this->faker->name(),
            'model_name' => $this->faker->name(),
            'available_seats' => rand(100, 250)
        ];
    }
}
