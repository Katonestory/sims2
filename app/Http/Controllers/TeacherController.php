<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Class;

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
