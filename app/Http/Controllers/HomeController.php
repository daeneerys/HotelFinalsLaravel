<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class HomeController extends Controller
{
    //Homepage
    public function index(): Factory|View
    {
        return view('home');
    }
    //Offer
    public function offers():Factory|View
    {
        return view('offer');
    }
    public function update(): void
    {
        // Update method if needed
    }
}
