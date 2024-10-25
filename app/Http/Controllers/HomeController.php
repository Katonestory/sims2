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
        return view('home',["msg"=>"i am a student role"]);
    }
    public function teacherHome()
    {
        return view('home',["msg"=>"i am a teacher role"]);
    }
    public function adminHome()
    {
        return view('home',["msg"=>"i am a admin role"]);
    }
}
 