<?php

namespace App\Http\Controllers;


use App\Models\Assignment;
use App\Models\Result;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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

     // Method to display student's results
     public function showResults()
     {
         try {
             // Get the authenticated user
             $user = auth()->user();

             // Fetch the student based on user_id from the students table
             $student = Student::where('user_id', $user->id)->first();

             if (!$student) {
                 return view('student.results')->with('message', 'Student not found.');
             }

             // Fetch results for the student using student_id
             $results = Result::where('student_id', $student->id)
                 ->with(['exam.subject'])  // Eager load the exam and subject relationship
                 ->get();

             // Check if results are found
             if ($results->isEmpty()) {
                 return view('student.results')->with('message', 'No results available at the moment. Please check back later.');
             }

             return view('student.results', compact('results'));
         } catch (\Exception $e) {
             return view('student.results')->with('message', 'Failed to fetch results: ' . $e->getMessage());
         }
     }


     // Method to download results as a CSV file
        public function downloadResults($studentId)
     {
         // Fetch results for the student
         $results = Result::where('student_id', $studentId)
             ->with(['exam.subject'])
             ->get();

         // Prepare the CSV file content
         $csvContent = "Subject,Score,Grade,Remarks\n"; // CSV Header

         foreach ($results as $result) {
             $csvContent .= "{$result->exam->subject->name},{$result->score},{$result->grade}," . ($result->remarks ?? 'No remarks') . "\n";
         }

         // Create a file name
         $fileName = "results_{$studentId}.csv";

         // Store the CSV file in the storage and return a download response
         return response($csvContent)
             ->header('Content-Type', 'text/csv')
             ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
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
