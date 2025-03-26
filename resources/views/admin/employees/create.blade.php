@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4 mt-5 mx-auto" style="max-width: 500px; border-radius: 15px;">
        <h2 class="text-center mb-4 text-primary fw-bold">Add New Employee</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
         @endif
        <form action="{{ route('admin.employees.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" name="name" class="form-control rounded-pill shadow-sm" placeholder="Enter employee name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-pill shadow-sm" placeholder="Enter employee email" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-pill shadow-sm" placeholder="Enter password" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone Number</label>
                <input type="text" name="phone" class="form-control rounded-pill shadow-sm" placeholder="Enter phone number">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Position</label>
                <input type="text" name="position" class="form-control rounded-pill shadow-sm" placeholder="Enter position">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success w-100 rounded-pill shadow-sm">
                    <i class="fas fa-user-plus"></i> Add Employee
                </button>
            </div>
        </form>
    </div>
</div>


@endsection
