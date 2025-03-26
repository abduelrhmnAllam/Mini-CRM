@extends('layouts.employee')

@section('title', 'employee Dashboard')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="bg-white shadow-lg rounded-4 p-5 text-center">
        <h1 class="text-primary fw-bold mb-4">Welcome, {{ auth('employee')->user()->name }}!</h1>



        <a href="{{ route('employee.customers') }}"
        class="btn btn-success btn-lg fw-semibold shadow-sm px-4 py-2 transition">
         <i class="fas fa-user-friends me-2"></i> My Customers
     </a>
</div>


@endsection
