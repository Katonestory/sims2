<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Exam;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Class;
use App\Models\Teacher;
use App\Models\Stream;
use App\Models\Student;


use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function uploadResults()
    {
            // Fetch exams from the database
            $exams = Exam::all();
            $subjects= Subject::all();
            $classes= Classes::all();

            return view('teacher.upload-results', compact('exams' , 'subjects' , 'classes'));
    }

    public function markAttendance()
    {
        $userId = Auth::id();
        $teacher = Teacher::where('user_id', $userId)->first();

        if (!$teacher) {
            return view('teacher.mark-attendance')->with('message', 'You are not a teacher.');
        }

        $stream = Stream::where('class_teacher_id', $teacher->id)->first();

        if (!$stream) {
            return view('teacher.mark-attendance')->with('message', 'You are not a class teacher.');
        }

        $students = Student::where('class_id', $stream->id)->get();

        return view('teacher.mark-attendance', compact('stream', 'students'));
    }



    public function saveAttendance(Request $request)
    {
    $attendanceData = $request->input('attendance');

    foreach ($attendanceData as $studentId => $data) {
        \DB::table('attendance')->insert([
            'student_id' => $studentId,
            'date' => now(),
            'status' => $data['status'],
            'remarks' => $data['status'] === 'absent' ? $data['remarks'] : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->route('teacher.mark-attendance')->with('success', 'Attendance recorded successfully!');
    }





    public function changePassword()
    {
        return view('teacher.change-password');

    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        auth()->user()->update(['password' => Hash::make($request->new_password)]);

        return back()->with('status', 'Password updated successfully!');
    }

}
