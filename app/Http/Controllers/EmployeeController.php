<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
   
    // Show all employees with 'employee' role
    public function index()
    {
        $employees = User::where('role', 'employee')->get(); // Retrieve users with role 'employee'
        return view('admin.index', compact('employees'));
    }

    // Show the form to create a new employee
    public function create()
    {
        return view('admin.createuser');
    }

    // Store a new employee
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
        ];
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Confirms password matches password_confirmation.
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee', // Default role
        ]);

        return redirect()->route('admin.employees')->with('success', 'Employee created successfully.');
    }

    // Show the form to edit an existing employee
    public function edit(User $employee)
    {
        return view('admin.edituser', compact('employee'));
    }

    // Update an existing employee
    public function update(Request $request, User $employee)
        {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $employee->id,
                'phone_number' => 'required|string|max:15',
            ]);

            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone_number = $request->phone_number;

            if ($request->filled('password')) {
                $request->validate(['password' => 'min:8|confirmed']);
                $employee->password = Hash::make($request->password);
            }

            $employee->save();

            return redirect()->route('admin.employees')->with('success', 'Employee updated successfully.');
        }
        public function destroy(User $employee)
        {
            // Delete the employee
            $employee->delete();

            // Redirect back with a success message
            return redirect()->route('admin.employees')->with('success', 'Employee deleted successfully.');
        }

}
?>