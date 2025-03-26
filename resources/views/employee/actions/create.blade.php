@extends('layouts.employee')

@section('title', 'Add Action')

@section('content')
<div class="container bg-white shadow-sm rounded-lg p-4">
    <h1 class="fs-3 fw-bold text-dark mb-4">Add Action for {{ $customer->name }}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
     @endif
    <form action="{{ route('employee.customers.actions.store', $customer->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Action Type</label>
            <select name="type" class="form-select">
                <option value="call">Call</option>
                <option value="visit">Visit</option>
                <option value="follow_up">Follow-up</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Result</label>
            <textarea name="result" class="form-control" rows="3" placeholder="Enter action result"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Save Action
        </button>
    </form>
</div>
@endsection
