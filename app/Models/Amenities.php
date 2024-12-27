<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;
    protected $primaryKey = 'amenity_id';
    protected $fillable = [
        'amenity_name',
        'description',
        'price_per_use',
    ];
}