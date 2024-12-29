@extends('layouts.app')

@section('TigerDen', 'Manage Employees')

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-semibold text-gray-700 mb-6">Manage Employees</h2>

    <div class="mb-4">
        <a href="{{ route('admin.employees.create') }}" class="bg-blue-600 text-white p-2 rounded">Add Employee</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td class="border p-2">{{ $employee->name }}</td>
                    <td class="border p-2">{{ $employee->email }}</td>
                    <td class="border p-2">
                        <a href="{{ route('admin.employees.edit', $employee->id) }}" class="text-blue-600">Edit</a> |
                        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
