@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="bg-white shadow-lg rounded-4 p-5 text-center">
        <h1 class="text-primary fw-bold mb-4">Welcome, {{ auth('admin')->user()->name }}!</h1>

        <div class="d-grid gap-3">
            <a href="{{ route('employees.index') }}"
                class="btn btn-primary btn-lg fw-semibold shadow-sm px-4 py-2 transition">
                <i class="fas fa-users me-2"></i> Manage Employees
            </a>

            <a href="{{ route('customers.index') }}"
                class="btn btn-success btn-lg fw-semibold shadow-sm px-4 py-2 transition">
                <i class="fas fa-user-friends me-2"></i> Manage Customers
            </a>
        </div>
    </div>
</div>


@endsection
