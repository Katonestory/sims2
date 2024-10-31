<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCHOOL INFORMATION MANAGEMENT SYSTEM</title>

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
            font-size: 0.9rem;
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
        .btn-register {
            background-color: #1abc9c;
        }
        .btn-register:hover {
            background-color: #16a085;
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
                    <label for="email"><b>Email</b></label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password"><b>Password</b></label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
        
                <div class="btn-container">
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-register">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="feature-section">
            Access your student information securely and conveniently.
        </div>
    </div>
</body>
</html>
