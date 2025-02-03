<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Department;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Stream;

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

    // Fetch data for each component
    $departments = Department::all();
    $departmentCount = $departments->count();

    $classes = Classes::with(['streams.teacher'])->get();
    $classCount = $classes->count();

    $subjects = Subject::all();
    $subjectCount = $subjects->count();

    $exams = Exam::all();
    $examCount = $exams->count();

    $teachers = Teacher::paginate(10); // Add pagination for teachers
    $teacherCount = Teacher::count();

    $students = Student::paginate(10); // Add pagination for students
    $studentCount = Student::count();

    // Pass all data to the view
    return view('admin.dashboard', compact(
        'announcements',
        'departments',
        'departmentCount',
        'classes',
        'classCount',
        'subjects',
        'subjectCount',
        'exams',
        'examCount',
        'teachers',
        'teacherCount',
        'students',
        'studentCount'
    ));
}

    public function bursarHome()
    {
        $announcements = Announcement::where('endDate', '>=', now())->latest()->get();

        return view('bursar.dashboard', compact('announcements'));
    }

    public function parentHome()
    {
        $announcements = Announcement::where('endDate', '>=', now())->latest()->get();

        return view('parent.dashboard', compact('announcements'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search in the students table
        $students = Student::where('first_name', 'LIKE', "%$query%")
            ->orWhere('middle_name', 'LIKE', "%$query%")
            ->orWhere('surname', 'LIKE', "%$query%")
            ->get();

        return response()->json($students);
    }

    public function searching(Request $request)
    {
        $query = $request->input('query');

        // Search in the teachers table
        $teachers = Teacher::where('first_name', 'LIKE', "%$query%")
            ->orWhere('middle_name', 'LIKE', "%$query%")
            ->orWhere('surname', 'LIKE', "%$query%")
            ->get();

        $html = '';
        foreach ($teachers as $teacher){
            $html .='
            <tr>
            <td>'.$teacher->first_name .'</td>
            <td>'.$teacher->middle_name .'</td>
            <td>'.$teacher->surname .'</td>
            <td>'.$teacher->DoB  .'</td>
            <td>'.$teacher->gender .'</td>
            <td>'.$teacher->phone_number .'</td>
            <td>'.$teacher->email .'</td>
            <td>'.$teacher->hireDate .'</td>
            <td>'.$teacher->address .'</td>
            </tr>
            ';
        }

        return response()->json($html);
    }
}

