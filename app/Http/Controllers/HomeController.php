<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function studentHome()
    {
        return view('student.dashboard');
    }
    public function teacherHome()
    {
        return view('teacher.dashboard');
    }
    public function adminHome()
    {
        return view('admin.dashboard');
    }

    public function bursarHome()
    {
        return view('bursar.dashboard');
    }
}
