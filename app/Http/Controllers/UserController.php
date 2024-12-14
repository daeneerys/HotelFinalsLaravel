<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): Factory|View
    {
        return view('login');
    }
    public function register(): Factory|View
    {
        return view('register');
    }
}
