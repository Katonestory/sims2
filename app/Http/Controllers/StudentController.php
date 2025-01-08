<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;

class StudentController extends Controller
{
    public function mySubjects()
    {
        // Fetch all subjects from the database
        $subjects = Subject::all();

        if ($subjects->isEmpty()) {
            return view('student.my-subjects', ['subjects' => [], 'message' => 'No subjects registered yet.']);
        }

        return view('student.my-subjects', ['subjects' => $subjects, 'message' => null]);
    }



    public function assignments()
    {
        $assignments = Assignment::latest()->get();
        return view('student.assignments',compact('assignments'));
    }

    public function results()
    {
        $studentId = auth()->user()->id;
        $results = Result::where('student_id', $studentId)->with('exam')->get();

        return view('student.results', compact('results'));
    }

    // Method to display the change password form
    public function changePassword()
    {
        return view('student.change-password');
    }

    // Method to update the password
    public function updatePassword(Request $request)
    {
        // Validate the form inputs
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' checks if the password and confirm password match
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('student.change-password')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Check if the current password matches the stored password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->route('student.change-password')
                             ->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Redirect back with a success message
        return redirect()->route('student.change-password')
                         ->with('status', 'Your password has been updated successfully.');
    }

}
