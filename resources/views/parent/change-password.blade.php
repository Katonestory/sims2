@extends('student.dashboard')
@section('content')
    <!-- Header displaying login info and date -->
    <div
        style="height: 3cm; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px;">
        <div style="display: flex; justify-content: space-between; font-size: 16px; font-weight: bold;">
            <span>Logged in as: <span style="color: blue;">{{ auth()->user()->name }}</span></span>
            <span>Academic Year: 2024/2025</span>
            <span style="color: blue;">{{ \Carbon\Carbon::now()->format('l, jS F Y') }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; font-size: 14px;">
            <span>Change Password</span>
        </div>
    </div>

    <!-- Content section for Change Password -->
    <div
        style="height: auto; background-color: #f8f9fa; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 20px; margin-top: 5px; border-radius: 8px;">
        <div
            style="font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
            Change Password
        </div>

        <!-- Status Message -->
        @if (session('status'))
            <div style="background-color: #28a745; color: white; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                {{ session('status') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div style="background-color: #dc3545; color: white; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.update-password') }}" method="POST">
            @csrf

            <!-- Current Password -->
            <div style="margin-bottom: 20px;">
                <label for="current_password" style="font-size: 14px; font-weight: bold;">Current Password</label>
                <div style="position: relative; width: 50%;">
                    <input type="password" id="current_password" name="current_password" class="form-control"
                        style="width: 100%; padding: 10px; border-radius: 5px; margin-top: 5px;" required>
                    <span onclick="togglePassword('current_password')"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        <i class="fa fa-eye" id="current_password_eye"></i>
                    </span>
                </div>
            </div>

            <!-- New Password -->
            <div style="margin-bottom: 20px;">
                <label for="new_password" style="font-size: 14px; font-weight: bold;">New Password</label>
                <div style="position: relative; width: 50%;">
                    <input type="password" id="new_password" name="new_password" class="form-control"
                        style="width: 100%; padding: 10px; border-radius: 5px; margin-top: 5px;" required
                        onkeyup="checkStrength(this.value)">
                    <span onclick="togglePassword('new_password')"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        <i class="fa fa-eye" id="new_password_eye"></i>
                    </span>
                    <div id="strength_message" style="margin-top: 5px; font-size: 12px; font-weight: bold;"></div>
                </div>
            </div>

            <!-- Confirm New Password -->
            <div style="margin-bottom: 20px;">
                <label for="new_password_confirmation" style="font-size: 14px; font-weight: bold;">Confirm New
                    Password</label>
                <div style="position: relative; width: 50%;">
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                        class="form-control" style="width: 100%; padding: 10px; border-radius: 5px; margin-top: 5px;"
                        required>
                    <span onclick="togglePassword('new_password_confirmation')"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        <i class="fa fa-eye" id="new_password_confirmation_eye"></i>
                    </span>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary"
                    style="padding: 10px 20px; background-color: #3498db; border: none; color: white; font-size: 16px; border-radius: 5px;">Update
                    Password</button>
            </div>
        </form>
    </div>

    <!-- Password Strength Checker Script -->
    <script>
        function checkStrength(password) {
            let strengthMessage = document.getElementById('strength_message');
            let strength = 0;

            if (password.length >= 8) strength += 1;
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[@$!%*?&#]/.test(password)) strength += 1;

            switch (strength) {
                case 1:
                    strengthMessage.style.color = 'red';
                    strengthMessage.textContent = 'Weak';
                    break;
                case 2:
                    strengthMessage.style.color = 'orange';
                    strengthMessage.textContent = 'Moderate';
                    break;
                case 3:
                    strengthMessage.style.color = 'blue';
                    strengthMessage.textContent = 'Strong';
                    break;
                case 4:
                    strengthMessage.style.color = 'green';
                    strengthMessage.textContent = 'Very Strong';
                    break;
                default:
                    strengthMessage.textContent = '';
            }
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '_eye');

            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
