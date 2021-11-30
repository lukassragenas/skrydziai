<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flight;

class Airport extends Model
{
    use HasFactory;

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
