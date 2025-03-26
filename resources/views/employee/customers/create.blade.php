@extends('layouts.employee')

@section('title', 'Add Customer')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">Add New Customer</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
     @endif
    <form action="{{ route('employee.customers.store') }}" method="POST">
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

        <div class="text-center">
            <button type="submit" class="btn btn-success w-100 rounded-pill shadow-sm">
                <i class="fas fa-user-plus"></i> Add Customer
            </button>
        </div>
    </form>
</div>
@endsection

