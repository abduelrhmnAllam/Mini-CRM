@extends('layouts.admin')

@section('title', 'Manage Employees')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">Manage Employees</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            ➕ Add Employee
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Name</th>
                    <th class="text-start">Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class="text-start">{{ $employee->name }}</td>
                        <td class="text-start">{{ $employee->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this employee?');">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
