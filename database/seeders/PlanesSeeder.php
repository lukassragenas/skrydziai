<?php

namespace Database\Seeders;

use App\Models\Plane;
use Illuminate\Database\Seeder;

class PlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plane::factory()->times(100)->create();
    }
}
