<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->integer('plane_id');
            $table->integer('from_airport_id');
            $table->integer('to_airport_id');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->string('status')->default('Laukiamas');
            $table->integer('passengers_count');
            $table->decimal('tickets_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
