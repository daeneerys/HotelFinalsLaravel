<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DineController extends Controller
{
    public function index(): Factory|View
    {
        return view('dine');
    }
}