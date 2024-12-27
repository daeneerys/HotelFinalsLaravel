<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'room_id';
    protected $fillable = [
        'room_number',
        'room_name',
        'room_type',
        'room_size',
        'room_details',
        'description',
        'capacity',
        'price_per_night',
        'availability_status',
        'images',
    ];

    protected $casts = [
        'images' => 'array', // Automatically cast JSON to array
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'room_id');
    }
}
