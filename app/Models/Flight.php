<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['plane_id', 'from_airport_id', 'to_airport_id', 'departure_time', 'arrival_time', 'status', 'passengers_count', 'tickets_price'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function airport_from()
    {
        return $this->belongsTo(Airport::class, 'from_airport_id');
    }
    public function airport_to()
    {
        return $this->belongsTo(Airport::class, 'to_airport_id');
    }
}
