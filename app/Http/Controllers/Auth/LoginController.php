<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        // Custom middleware to redirect authenticated users to their appropriate home page
        $this->middleware(function ($request, $next) {
            if (auth()->check()) {
                // Redirect based on user role
                if (auth()->user()->role == 'admin') {
                    return redirect()->route('home.admin');
                } elseif (auth()->user()->role == 'teacher') {
                    return redirect()->route('home.teacher');
                } elseif (auth()->user()->role == 'bursar') {
                    return redirect()->route('home.bursar');
                } elseif (auth()->user()->role == 'parent') {
                    return redirect()->route('home.parent');
                } else {
                    return redirect()->route('home.student');
                }
            }
            return $next($request);
        })->only('showLoginForm');  // Apply this logic only when showing the login form
    }

    public function username()
    {
        return 'email';
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $response = null;

            // Redirect based on user role
            if (auth()->user()->role == 'admin') {
                $response = redirect()->route('home.admin');
            }
            elseif (auth()->user()->role == 'teacher') {
                $response = redirect()->route('home.teacher');
            }
            elseif (auth()->user()->role == 'bursar') {
                $response = redirect()->route('home.bursar');
            }
            elseif (auth()->user()->role == 'parent') {
                $response = redirect()->route('home.parent');
            }
            else {
                $response = redirect()->route('home.student');
            }

            // Prevent the login page from being cached
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', '0');

            return $response;
        } else {
            return redirect('/')->with('error', 'Incorrect username or password');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You need to login');
    }

    public function showLoginForm()
    {
        return view('welcome'); // Make sure to create the custom-login view
    }

}
