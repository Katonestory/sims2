@extends('admin.dashboard')
@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Register Subjects</span>
        <span>Admin > Register Subjects</span>
    </div>
</div>

<!-- Content section for Registering Subjects -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Register New Subject
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('admin.store-subjects') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="subject-name" style="font-weight: bold;">Subject Name:</label>
            <p><input type="text" id="subject-name" name="name" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px;"></p>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="subject-code" style="font-weight: bold;">Subject Code:</label>
            <p><input type="text" id="subject-code" name="code" placeholder="OPTIONAL" style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px;"></p>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="department-id" style="font-weight: bold;">Department:</label>
            <p>
                <select id="department-id" name="department_id" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px;">
                    <option value="" disabled selected>Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </p>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="credits" style="font-weight: bold;">Credits:</label>
            <p><input type="number" id="credits" name="credits" min="1" max="10" placeholder="OPTIONAL" style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px;"></p>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="description" style="font-weight: bold;">Description:</label>
            <p><textarea id="description" name="description" rows="4" placeholder="OPTIONAL" style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px;"></textarea></p>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="status" style="font-weight: bold;">Status:</label>
            <p>
                <select id="status" name="status" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; border-radius:5px;">
                    <option value="" disabled selected>Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </p>
        </div>

        <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px; border-radius:5px;">
            Register Subject
        </button>
    </form>

    </div>
</div>
@endsection
