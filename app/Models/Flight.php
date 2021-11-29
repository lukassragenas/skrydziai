<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['PlaneId', 'FromAirportId', 'ToAirportId', 'DepartureTime', 'ArrivalTime', 'Status', 'PassengersCount', 'TicketsPrice'];
}
