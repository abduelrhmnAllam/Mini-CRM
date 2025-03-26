@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">Edit Customer</h1>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control rounded-pill shadow-sm" value="{{ $customer->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control rounded-pill shadow-sm" value="{{ $customer->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Phone</label>
            <input type="text" name="phone" class="form-control rounded-pill shadow-sm" value="{{ $customer->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Assign Employee</label>
            <select name="employee_id" class="form-control rounded-pill shadow-sm">
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $customer->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                <i class="fas fa-save"></i> Update Customer
            </button>
        </div>
    </form>
</div>
@endsection
