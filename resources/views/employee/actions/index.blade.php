@extends('layouts.employee')

@section('title', 'All Actions')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">All Actions</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Type</th>
                <th>Result</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actions as $action)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $action->customer->name }}</td>
                    <td><span class="badge bg-info">{{ ucfirst($action->type) }}</span></td>
                    <td>{{ $action->result }}</td>
                    <td>{{ $action->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
