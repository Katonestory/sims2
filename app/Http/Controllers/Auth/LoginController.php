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
        $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        return 'email'; ;
    }

    public function login(Request $request)
{
    $input = $request->all();
    $this->validate($request, [
        'email' => 'required|email', // Update validation,
        'password' => 'required'
    ]);

    if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('home.admin');
        } elseif (auth()->user()->role == 'teacher') {
            return redirect()->route('home.teacher');
        } else {
            return redirect()->route('home');
        }
    } else {
        return redirect('/')->with('error', 'Incorrect username or password'); // Redirect to the welcome page
    }
}

}
