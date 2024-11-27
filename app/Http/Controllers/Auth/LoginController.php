<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware(function ($request,$next){
            if(auth()->check()){
                return redirect()->route('home');
            }
            return $next($request);
        })->only('showLoginForm');
    }

    public function username()
    {
        return 'email';
    }

    public function login(Request $request)
{
    $input = $request->all();
    $this->validate($request, [
        'email' => 'required|email', // Update validation,
        'password' => 'required|string',
    ]);

    if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('home.admin');
        }
        elseif (auth()->user()->role == 'teacher') {
            return redirect()->route('home.teacher');
        }
        elseif (auth()->user()->role == 'bursar') {
            return redirect()->route('home.bursar');
        }
        else {
            return redirect()->route('home.student');
        }
    } else {
        return redirect('/')->with('error', 'Incorrect username or password'); // Redirect to the welcome page
    }

}

}
