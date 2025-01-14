@extends('admin.dashboard')
@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Register Department</span>
        <span>Admin > Register Department</span>
    </div>
</div>
<div style="font-size: 14px; line-height: 1.6;">
    <h2 style="font-weight: bold; margin-bottom: 20px;">Register Department</h2>
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.store-department') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="department-name" style="font-weight: bold;">Department Name:</label>
            <p>
                <input type="text" id="department-name" name="name" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;border-radius:5px">
            </p>
        </div>
        <div style="margin-bottom: 15px;">
            <label for="department-code" style="font-weight: bold;">Department Code:</label>
            <p>
                <input type="text" id="department-code" name="code" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px">
            </p>
        </div>
        <div style="margin-bottom: 15px;">
            <label for="department-description" style="font-weight: bold;">Description (optional):</label>
            <p>
                <textarea id="department-description" name="description" style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px" rows="3"></textarea>
            </p>
        </div>
        <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px; border-radius:5px">
            Register Department
        </button>
    </form>
</div>
@endsection
