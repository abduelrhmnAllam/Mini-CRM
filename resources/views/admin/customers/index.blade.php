@extends('layouts.admin')

@section('title', 'Manage Customers')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">Manage Customers</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            ➕ Add Customer
        </a>

    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Name</th>
                    <th class="text-start">Assigned Employee</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td class="text-start">{{ $customer->name }}</td>
                        <td class="text-start">{{ $customer->employee->name ?? 'Not Assigned' }}</td>
                        <td class="text-center">
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-info btn-sm text-white shadow-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                    onclick="return confirm('Are you sure you want to delete this customer?');">
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
