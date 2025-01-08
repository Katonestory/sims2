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
        @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.register-teachers.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="font-size: 14px; line-height: 1.6;">
            <!-- First Name -->
            <div style="margin-bottom: 15px;">
                <label for="first_name" style="font-weight: bold;">First Name:</label>
                <p><input type="text" id="first_name" name="first_name" required
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;"></p>
            </div>

            <!-- Middle Name -->
            <div style="margin-bottom: 15px;">
                <label for="middle_name" style="font-weight: bold;">Middle Name:</label>
                <p><input type="text" id="middle_name" name="middle_name"
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;"></p>
            </div>

            <!-- Surname -->
            <div style="margin-bottom: 15px;">
                <label for="surname" style="font-weight: bold;">Surname:</label>
                <p><input type="text" id="surname" name="surname" required
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;"></p>
            </div>

            <!-- Date of Birth -->
            <div style="margin-bottom: 15px;">
                <label for="DoB" style="font-weight: bold;">Date of Birth:</label>
                <p><input type="date" id="DoB" name="DoB" required
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;"></p>
            </div>

            <!-- Gender -->
            <div style="margin-bottom: 15px;">
                <label for="gender" style="font-weight: bold;">Gender:</label>
               <p>
                   <select id="gender" name="gender" required
                            style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
               </p>
            </div>

            <!-- Email -->
            <div style="margin-bottom: 15px;">
                <label for="email" style="font-weight: bold;">Email:</label>
                <p><input type="email" id="email" name="email" required
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;"></p>
            </div>

            <!-- Phone Number -->
            <div style="margin-bottom: 15px;">
                <label for="phone_number" style="font-weight: bold;">Phone Number:</label>
                <p><input type="tel" id="phone_number" name="phone_number" required
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;"></p>
            </div>

            <!-- Address -->
            <div style="margin-bottom: 15px;">
                <label for="address" style="font-weight: bold;">Address:</label>
                <p><textarea id="address" name="address" required
                          style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;"
                          rows="3"></textarea></p>
            </div>

            <!-- Hire Date -->
            <div style="margin-bottom: 15px;">
                <label for="hireDate" style="font-weight: bold;">Hire Date:</label>
               <p>
                   <input type="date" id="hireDate" name="hireDate" required
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;">
               </p>
            </div>

            <!-- Status -->
            <div style="margin-bottom: 15px;">
                <label for="status" style="font-weight: bold;">Status:</label>
                <p>
                    <select id="status" name="status" required
                            style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </p>
            </div>

            <!-- Photo Upload -->
            <div style="margin-bottom: 15px;">
                <label for="photoPath" style="font-weight: bold;">Photo:</label>
               <p>
                   <input type="file" id="photoPath" name="photoPath" accept="image/*"
                       style="width: 50%; padding: 10px; border: 1px solid #ccc; margin-top: 5px; border-radius: 5px;">
               </p>
            </div>

            <!-- Submit Button -->
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px; border-radius:5px">
                Register Teacher
            </button>
        </div>
    </form>


    </div>
</div>
@endsection
