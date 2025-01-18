<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'type',
        'capacity',
        'price_per_day',
        'status',
        'description',
        'created_at',
        'updated_at',
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
