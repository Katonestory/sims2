<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCHOOL INFORMATION MANAGEMENT SYSTEM</title>
    <link rel="icon" href="{{ asset('images/graduatehat.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            color: #2c3e50;
        }
        .left-side {
            width: 70%;
            background: url('/images/welcome.jpg') no-repeat center center;
            background-size: cover;
        }
        .right-side {
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background: #ffffff;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
            font-family: 'Times New Roman', serif;
        }
        .header {
            font-size: 2rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #053463;
            margin-bottom: 100px;
            text-align: center;
        }
        .form-card {
            width: 100%;
            max-width: 400px;
            padding: 60px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
            font-weight: bold;

        }
        label {
            font-size: 1.2rem;
            color: #2c3e50;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            color: #34495e;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }
        .btn-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn {
            padding: 12px 30px;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            text-decoration: none;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-login {
            background-color: #3498db;
        }
        .btn-login:hover {
            background-color: #2980b9;
        }

        .feature-section {
            text-align: center;
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 20px;

        }
        .alert {
    padding: 10px;
    border: 1px solid red; /* You can adjust the border color */
    background-color: #f8d7da; /* Light red background */
    border-radius: 5px;
               }

    </style>
</head>
<body>
    <div class="left-side"></div>

    <div class="right-side">
        <div class="header">School Information Management System</div>

          <!-- Error Message Section -->
    @if(session('error'))
    <div class="alert" style="color: red; text-align: center; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

        <div class="form-card">
            <form method="POST" action="/login">
                @csrf
                <div class="form-group">
                    <label for="email"><b>E-mail</b></label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group" style="position: relative;">
                    <label for="password"><b>Password</b></label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required style="padding-right: 10px;">
                    <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 55%;  cursor: pointer;"></i>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-login" style="cursor: pointer;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>

                </div>
            </form>
        </div>

        <div class="feature-section">
            Access your student information securely and conveniently.
        </div>
    </div>

    <script>
          document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
    </script>
</body>
</html>
