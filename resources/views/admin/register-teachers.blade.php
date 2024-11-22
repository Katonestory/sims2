@extends('admin.dashboard')
@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Register Teachers</span>
        <span>Admin > Register Teachers</span>
    </div>
</div>

<!-- Content section for Registering Teachers -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Register New Teacher
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <form action="{{ route('admin.register-teachers') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="teacher-first-name" style="font-weight: bold;">First Name:</label>
                <p><input type="text" id="teacher-first-name" name="first_name" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="teacher-middle-name" style="font-weight: bold;">Middle Name:</label>
                <p><input type="text" id="teacher-middle-name" name="middle_name" style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="teacher-surname" style="font-weight: bold;">Surname:</label>
                <p><input type="text" id="teacher-surname" name="surname" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="teacher-email" style="font-weight: bold;">Email:</label>
                <p><input type="email" id="teacher-email" name="email" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="teacher-phone" style="font-weight: bold;">Phone Number:</label>
                <p><input type="tel" id="teacher-phone" name="phone_number" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="hire-date" style="font-weight: bold;">Hire Date:</label>
                <p><input type="date" id="hire-date" name="hire_date" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Register Teacher
            </button>
        </form>
    </div>
</div>
@endsection
