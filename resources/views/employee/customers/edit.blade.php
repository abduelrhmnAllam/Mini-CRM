
@extends('layouts.employee')

@section('title', 'Edit Customer')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">Edit Customer</h1>

    <form action="{{ route('employee.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control rounded-pill shadow-sm" required
                   value="{{ old('name', $customer->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control rounded-pill shadow-sm"
                   value="{{ old('email', $customer->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Phone</label>
            <input type="text" name="phone" class="form-control rounded-pill shadow-sm"
                   value="{{ old('phone', $customer->phone) }}">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
