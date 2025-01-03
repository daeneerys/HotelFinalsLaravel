<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservation_id'; // Custom primary key

    protected $fillable = [
        'user_id',
        'room_id',
        'amenity_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'reservation_status',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function amenity()
    {
        return $this->belongsTo(Amenities::class, 'amenity_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }
}
