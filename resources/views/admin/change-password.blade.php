@extends('admin.dashboard')
@section('content')
<div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Change Password</span>
        <span>Admin > Change Password</span>
    </div>
</div>

<!-- Content section for Changing Password -->
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Change Password
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <form action="{{ route('admin.change-password') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="current-password" style="font-weight: bold;">Current Password:</label>
                <p><input type="password" id="current-password" name="current_password" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="new-password" style="font-weight: bold;">New Password:</label>
                <p><input type="password" id="new-password" name="new_password" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="confirm-password" style="font-weight: bold;">Confirm New Password:</label>
                <p><input type="password" id="confirm-password" name="confirm_password" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Change Password
            </button>
        </form>
    </div>
</div>
@endsection
