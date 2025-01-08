<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AssignmentsController extends Controller
{
    public function uploadForm()
    {
        try {
            $classes = Classes::all();
            $subjects = Subject::all();
            return view('teacher.upload-assignments', compact('classes', 'subjects'));
        } catch (\Exception $e) {
            Log::error('Failed to load upload form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load upload form.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'description' => 'nullable|string',
            'filepath' => 'required|mimes:pdf,doc,docx|max:2048',
            'dueDate' => 'required|date',
        ]);


         // Get the authenticated user's ID
    $userId = auth()->user()->id;

    // Find the corresponding teacher ID from the teachers table
    $teacher = \App\Models\Teacher::where('user_id', $userId)->first();

        try {
            // Attempt to store the uploaded file
            $filePath = $request->file('filepath')->store('assignments', 'public');
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'File upload failed. Please try again.');
        }

        try {
            // Create the assignment
            Assignment::create([
                'title' => $validatedData['title'],
                'teacher_id' =>  $teacher->id,
                'class_id' => $validatedData['class_id'],
                'subject_id' => $validatedData['subject_id'],
                'description' => $validatedData['description'],
                'filepath' => $filePath,
                'dueDate' => $validatedData['dueDate'],
            ]);

            return redirect()->back()->with('success', 'Assignment uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Assignment creation failed: ' . $e->getMessage(), [
                'data' => $validatedData,
                'filePath' => $filePath ?? 'File not uploaded',
            ]);
            return redirect()->back()->with('error', 'Failed to save assignment. Please try again.');
        }
    }
}
