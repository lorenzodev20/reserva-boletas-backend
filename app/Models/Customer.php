<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
