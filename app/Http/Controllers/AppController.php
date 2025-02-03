<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Check if the user with the provided email exists
        $user = DB::table('users')->where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            // Check if the user ID exists in the 'students' table
            $student = DB::table('students')
                ->where('user_id', $user->id)
                ->first();

            if ($student) {
                // Fetch the class and stream details
                $class = DB::table('classes')->where('id', $student->class_id)->first();
                $stream = DB::table('streams')->where('id', $student->stream_id)->first();

                // Prepare the response
                $response = [
                    'Name' => $student->first_name . ' ' . $student->middle_name . ' ' . $student->surname,
                    'Student ID' => $student->student_id ?? 'N/A',
                    'Date of Birth' => $student->DoB,
                    'Gender' => $student->gender,
                    'Email' => $student->email,
                    'Phone Number' => $student->phone_number,
                    'Address' => $student->address,
                    'Class' => $class->name ?? 'N/A',
                    'Stream' => $stream->name ?? 'N/A',
                    'Class Teacher' => $stream->class_teacher_id ? DB::table('users')->where('id', $stream->class_teacher_id)->value('name') : 'N/A',
                    'Class Teacher\'s Phone' => $stream->class_teacher_id ? DB::table('teachers')->where('id', $stream->class_teacher_id)->value('phone_number') : 'N/A',
                ];

                // Return a successful response
                return response()->json($response, 200);
            } else {
                // If the user ID is not in the 'students' table
                return response()->json(['error' => 'Student record not found'], 404);
            }
        } else {
            // If email and password do not match
            return response()->json(['error' => 'Invalid email or password'], 401);
        }
    }
    public function getAssignments(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
        ]);

        // Fetch only title, dueDate, and description from the assignments table
        $assignments = DB::table('assignments')
            ->select('title', 'dueDate', 'description')
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->get();

        // Return the data as JSON
        return response()->json([
            'status' => 'success',
            'data' => $assignments,
        ]);
    }
    public function getAssignmentDetails(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'id' => 'required|integer', // Assignment ID
        ]);

        // Fetch assignment details and teacher's full name
        $assignmentDetails = DB::table('assignments')
            ->join('teachers', 'assignments.teacher_id', '=', 'teachers.id') // Adjust 'teachers' to match your table name
            ->select(
                'assignments.*',
                DB::raw("CONCAT(teachers.first_name, ' ', COALESCE(teachers.middle_name, ''), ' ', teachers.surname) AS teacher_full_name")
            )
            ->where('assignments.id', $request->id)
            ->first();

        if ($assignmentDetails) {
            return response()->json([
                'status' => 'success',
                'data' => $assignmentDetails,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Assignment not found',
        ], 404);
    }


    public function getSubjects(Request $request)
    {
        $subjects = DB::table('subjects')
        ->leftJoin('departments', 'subjects.department_id', '=', 'departments.id')
        ->select('subjects.name','subjects.id', 'subjects.code', 'subjects.description', 'departments.name as department_name', 'subjects.credits', 'subjects.status')
        ->get();


        return response()->json($subjects);
    }


}


