@extends('bursar.dashboard')
@section('content')
   <!-- Header displaying login info and date -->
   <div style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
        <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
        <span>Academic Year: 2024/2025</span>
        <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
    </div>
    <div style="display: flex; justify-content: space-between; font-size: 14px;">
        <span>Change Password</span>
    </div>
</div>
<div style="height: auto; background-color: #f8f9fa; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
        Change Password
    </div>
    <div style="font-size: 14px; line-height: 1.6;">
        <form action="{{ route('bursar.updatePassword') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="currentPassword" style="font-weight: bold;">Current Password:</label>
                <p><input type="password" id="currentPassword" name="currentPassword" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="newPassword" style="font-weight: bold;">New Password:</label>
                <p><input type="password" id="newPassword" name="newPassword" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;" oninput="checkPasswordStrength()"></p>
                <div id="password-strength" class="password-strength" style="margin-top: 10px; padding: 5px; width: 100%; display: none;"></div>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="confirmPassword" style="font-weight: bold;">Confirm New Password:</label>
                <p><input type="password" id="confirmPassword" name="confirmPassword" required style="width: 50%; padding: 8px; border: 1px solid #ccc; margin-top: 5px;"></p>
            </div>
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; margin-top: 10px;">
                Change Password
            </button>
        </form>
    </div>
</div>

<script>
    function checkPasswordStrength() {
        var password = document.getElementById("newPassword").value;
        var strengthBar = document.getElementById("password-strength");
        var strength = 0;

        if (password.length >= 6) strength += 1;
        if (password.match(/[a-z]/)) strength += 1;
        if (password.match(/[A-Z]/)) strength += 1;
        if (password.match(/[0-9]/)) strength += 1;
        if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

        if (strength == 0) {
            strengthBar.style.display = 'none';
        } else if (strength <= 2) {
            strengthBar.style.display = 'block';
            strengthBar.className = 'weak';
            strengthBar.textContent = 'Weak';
        } else if (strength == 3) {
            strengthBar.style.display = 'block';
            strengthBar.className = 'medium';
            strengthBar.textContent = 'Medium';
        } else {
            strengthBar.style.display = 'block';
            strengthBar.className = 'strong';
            strengthBar.textContent = 'Strong';
        }
    }
</script>

@endsection
