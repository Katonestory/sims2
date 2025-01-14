<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Teacher;
use App\Models\Student;

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

        $userId = auth()->id(); // Get the authenticated user's ID

        // Fetch student data, joining with the users table
        $student = Student::where('user_id', $userId)->first();

        $announcements = Announcement::where('endDate', '>=', now())->latest()->get();

        return view('student.dashboard', compact('student', 'announcements'));
    }
    public function teacherHome()
    {
        $userId = auth()->id(); // Get the authenticated user's ID

        // Fetch teacher's data, joining with the users table
        $teacher = Teacher::where('user_id', $userId)->first();
        $announcements = Announcement::where('endDate', '>=', now())->latest()->get();

        return view('teacher.dashboard', compact('teacher', 'announcements'));
    }
    public function adminHome()
    {
        $announcements = Announcement::where('endDate', '>=', now())->latest()->get();

        // Pass them to the dashboard view
        return view('admin.dashboard', compact('announcements'));
    }

    public function bursarHome()
    {
        $announcements = Announcement::where('endDate', '>=', now())->latest()->get();

        return view('bursar.dashboard', compact('announcements'));
    }
}
