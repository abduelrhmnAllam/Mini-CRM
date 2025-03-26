@extends('layouts.admin')

@section('title', 'Edit Employee')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">Edit Employee</h1>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" value="{{ $employee->name }}" class="form-control rounded-pill shadow-sm" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" value="{{ $employee->email }}" class="form-control rounded-pill shadow-sm" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
