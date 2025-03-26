@extends('layouts.admin')

@section('title', 'Add Customer')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4 mt-5 mx-auto" style="max-width: 500px; border-radius: 15px;">
        <h2 class="text-center mb-4 text-primary fw-bold">Add New Customer</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" name="name" class="form-control rounded-pill shadow-sm" required placeholder="Enter customer name">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-pill shadow-sm" placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control rounded-pill shadow-sm" placeholder="Enter phone number">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Assign Employee</label>
                <select name="employee_id" class="form-select rounded-pill shadow-sm selectpicker" data-live-search="true" required>
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success w-100 rounded-pill shadow-sm">
                    <i class="fas fa-user-plus"></i> Add Customer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
