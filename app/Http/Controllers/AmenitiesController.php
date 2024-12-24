<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Models\Amenities;

class AmenitiesController extends Controller
{
    public function index(): Factory|View
    {
        $amenities = Amenities::skip(5)->take(100)->get(); 
        return view('amenities', compact('amenities'));
    }
}
