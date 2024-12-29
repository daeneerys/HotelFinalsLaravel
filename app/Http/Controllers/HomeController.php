<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use App\Models\User;
use App\Models\Reservation;


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
    public function adminDashboard()
    {
         // Fetch total number of users with role "customer" using Eloquent
    $totalCustomers = User::where('role', 'customer')->count();
    $totalReservations = Reservation::count();

    // Pass the data to the view
    return view('admin.dashboard', compact('totalCustomers', 'totalReservations'));
    }

    public function update(): void
    {
        // Update method if needed
    }
}
