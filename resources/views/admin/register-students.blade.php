@extends('admin.dashboard')
@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Register Students</span>
        <span>Admin > Register Students</span>
    </div>
</div>

<!-- Content section for Registering Students -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Register New Student
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <form action="{{ route('admin.register-students') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="student-first-name" style="font-weight: bold;">First Name:</label>
                <p><input type="text" id="student-first-name" name="first_name" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="student-middle-name" style="font-weight: bold;">Middle Name:</label>
                <p><input type="text" id="student-middle-name" name="middle_name" style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="student-surname" style="font-weight: bold;">Surname:</label>
                <p><input type="text" id="student-surname" name="surname" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="student-email" style="font-weight: bold;">Email:</label>
                <p><input type="email" id="student-email" name="email" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="student-phone" style="font-weight: bold;">Phone Number:</label>
                <p><input type="tel" id="student-phone" name="phone_number" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="student-id" style="font-weight: bold;">Student ID:</label>
                <p><input type="text" id="student-id" name="student_id" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="dob" style="font-weight: bold;">Date of Birth:</label>
                <p><input type="date" id="dob" name="dob" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="gender" style="font-weight: bold;">Gender:</label>
                <p>
                    <select id="gender" name="gender" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="address" style="font-weight: bold;">Address:</label>
                <p><textarea id="address" name="address" rows="3" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></textarea></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="class-id" style="font-weight: bold;">Class:</label>
                <p>
                    <select id="class-id" name="class_id" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
                        <option value="" disabled selected>Select Class</option>
                        {{-- @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach --}}
                    </select>
                </p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="status" style="font-weight: bold;">Status:</label>
                <p>
                    <select id="status" name="status" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;">
                        <option value="" disabled selected>Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="photo" style="font-weight: bold;">Photo:</label>
                <p><input type="file" id="photo" name="photoPath" accept="image/*" style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Register Student
            </button>
        </form>
    </div>
</div>
@endsection
