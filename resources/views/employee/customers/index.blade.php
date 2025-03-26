@extends('layouts.employee')

@section('title', 'My Customers')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">My Customers</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('employee.customers.create') }}" class="btn btn-success fw-semibold shadow-sm">
            <i class="fas fa-user-plus"></i> Add Customer
        </a>

        <a href="{{ route('employee.customers.actions.all') }}" class="btn btn-info fw-semibold shadow-sm">
            <i class="fas fa-tasks"></i> View All Actions
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th> <!-- عرض جميع العمليات الخاصة بالعميل -->
                <th>Add Action</th> <!-- زر إضافة عملية جديدة -->
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>

                    <!-- عرض جميع أنواع العمليات الخاصة بالعميل -->
                    <td>
                        @if($customer->actions->isNotEmpty())
                            @foreach($customer->actions as $action)
                                <span class="badge bg-warning text-dark">
                                    {{ ucfirst($action->type) }} ({{ $action->created_at->format('Y-m-d') }})
                                </span>
                            @endforeach
                        @else
                            <span class="badge bg-secondary">No Actions</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('employee.customers.actions.create', $customer->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-plus-circle"></i> Add Action
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
