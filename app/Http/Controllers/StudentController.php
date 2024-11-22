<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function mySubjects()
    {
        return view('student.my-subjects');
    }

    public function materials()
    {
        return view('student.materials');
    }

    public function assignments()
    {
        return view('student.assignments');
    }

    public function results()
    {
        return view('student.results');
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
