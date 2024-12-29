<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string',
            'phone_number' => 'required|string|max:15',
        ]);

        $employee = new User();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->save();

        return redirect()->route('admin.index')->with('success', 'Employee created successfully.');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->id,
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        if ($request->password) {
            $request->validate(['password' => 'min:8|confirmed']);
            $employee->password = Hash::make($request->password);
        }
        $employee->save();

        return redirect()->route('admin.index')->with('success', 'Employee updated successfully.');
    }

    // Delete an employee
    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('admin.index')->with('success', 'Employee deleted successfully.');
    }
}
?>