<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flight;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['flight_id', 'passeger_id', 'seat_number', 'seat_class', 'status'];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
