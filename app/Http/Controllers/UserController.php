<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display the login page.
     */
    public function index(): Factory|View
    {
        return view('login');
    }

    /**
     * Display the registration page.
     */
    public function register(): Factory|View
    {
        return view('register');
    }

    /**
     * Handle the user registration process.
     */
    public function store(Request $request)
    {
        // Custom validation messages
        $messages = [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'phone_number.required' => 'Phone Number is required',
            'phone_number.unique' => 'Phone Number is already registered',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and confirmation do not match.',
            'privacy_terms.accepted' => 'You must agree to the privacy terms.',
            'create_account.accepted' => 'You must agree to create an account.',
        ];
        // Validate the request inputs
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Confirms password matches password_confirmation.
            'privacy_terms' => 'accepted',
            'create_account' => 'accepted',
        ]);

        // Create the user
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Default role
        ]);

        // Redirect to login or dashboard after registration
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    public function login(Request $request)
{
    // Validate login input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Attempt login
    if (Auth::attempt($credentials)) {
        // Regenerate session to prevent fixation attacks
        $request->session()->regenerate();

        // Get the authenticated user's role
        $user = Auth::user();

        // Debugging: Log the authenticated user's role
        Log::debug('Authenticated User Role:', ['role' => $user->role]);

        // Redirect based on role
        if ($user->role === 'admin' || $user->role ==='employee') {
            return redirect()->route('dashboard'); // Redirect to admin dashboard
        } else {
            return redirect()->intended('my-reservation'); // Redirect to default user dashboard
        }
    }

    // Return back with error message if login fails
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function viewReservations(Request $request)
    {
        $query = Reservation::query();
    
        // Check if there's a search term
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            
            // Filter by reservation ID, user name, or other fields
            $query->where('reservation_id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('room', function($q) use ($search) {
                      $q->where('room_name', 'like', "%{$search}%");
                  });
        }
    
        $reservations = $query->paginate(10); // Adjust pagination as needed
    
        return view('admin.viewReservations', compact('reservations'));
    }
}
