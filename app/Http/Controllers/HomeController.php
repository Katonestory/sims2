<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

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

        $announcements = Announcement::latest()->get();

        return view('student.dashboard', compact('announcements'));
    }
    public function teacherHome()
    {
        $announcements = Announcement::latest()->get();

        return view('teacher.dashboard', compact('announcements'));
    }
    public function adminHome()
    {
        $announcements = Announcement::latest()->get();

        // Pass them to the dashboard view
        return view('admin.dashboard', compact('announcements'));
    }

    public function bursarHome()
    {
        $announcements = Announcement::latest()->get();

        return view('bursar.dashboard', compact('announcements'));
    }
}
