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
use App\Models\ParentModel;
use App\Models\ParentStudent;

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
    public function studentHome(Request $request)
    {
        // Check if a parent selected a student and stored it in the session
        $selectedStudentId = $request->session()->get('selected_student_id');

        if ($selectedStudentId) {
        // Fetch student data based on the selected student ID
        $student = Student::find($selectedStudentId);

        if (!$student) {
            return redirect()->route('home.parent')->with('error', 'Selected student not found.');
        }
        } else {
            // Regular student access: fetch data based on the authenticated user's ID
            $userId = auth()->id();
            $student = Student::where('user_id', $userId)->first();

        if (!$student) {
            return redirect()->route('login')->with('error', 'Student not found.');
            }
        }

        // Fetch announcements
        $announcements = Announcement::where('endDate', '>=', now())->latest()->get();

            // Render the student dashboard
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

        $teachers = Teacher::paginate(10, ['*'], 'teacher_page');
        $teacherCount = Teacher::count();

        $students = Student::paginate(10, ['*'], 'student_page');
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
        $parentId = ParentModel::where('user_id', auth()->id())->value('id'); // Get parent's actual ID

        if (!$parentId) {
            return back()->with('error', 'Parent record not found.');
        }

        session()->forget(['selected_student_id', 'selected_student_role']);

        $students = Student::join('parent_student', 'students.id', '=', 'parent_student.student_id')
            ->where('parent_student.parent_id', $parentId)
            ->select('students.*')
            ->get();

        return view('parent.dashboard', compact('students'));

    }

    public function showChangePasswordForm()
    {
        return view('parent.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('parent.change-password')->with('success', 'Password successfully updated!');
    }

    public function selectStudent(Request $request)
    {
        $student = \App\Models\Student::find($request->student_id);

        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        // Store selected student ID in session
        $request->session()->put('selected_student_id', $student->id);
        $request->session()->put('selected_student_role', 'student'); // Store role as student

        return redirect()->route('home.student');
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

