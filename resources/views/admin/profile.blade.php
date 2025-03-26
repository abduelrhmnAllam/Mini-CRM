@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>ملف الأدمن الشخصي</h1>
        <p>مرحبًا {{ Auth::guard('admin')->user()->name }}</p>
        <p>البريد الإلكتروني: {{ Auth::guard('admin')->user()->email }}</p>
    </div>
@endsection
