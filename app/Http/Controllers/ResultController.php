<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Result;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class ResultController extends Controller
{
    public function uploadResults(Request $request)
{
    $request->validate([
        'class_id' => 'required|integer',
        'subject_id' => 'required|integer',
        'exam_id' => 'required|integer',
        'file' => 'required|file|mimes:csv,txt',
     ]);

        try {
        // Get the uploaded file
        $file = $request->file('file');

        // Open and read the CSV file
        $data = array_map('str_getcsv', file($file->getRealPath()));

        // Extract and normalize the header, remove BOM if present
        $header = array_map(function($value) {
            return strtolower(trim(preg_replace('/\x{FEFF}/u', '', $value))); // Remove BOM and normalize
        }, $data[0]);

        $rows = array_slice($data, 1);

        foreach ($rows as $row) {
            $rowData = array_combine($header, $row);

            // Access columns using normalized keys
            $studentId = $rowData['s/n'];
            $name = $rowData['name'];
            $score = $rowData['score'];
            $examId = $request->input('exam_id');

            // Calculate grade and remarks
            $grade = $this->calculateGrade($score);
            $remarks = $this->generateRemarks($score);

            // Insert into the results table
            DB::table('results')->insert([
                'student_id' => $studentId,
                'exam_id' => $examId,
                'score' => $score,
                'grade' => $grade,
                'remarks' => $remarks,
            ]);
        }

        return redirect()->back()->with('success', 'Results uploaded successfully!');
        } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to upload results: ' . $e->getMessage());
    }
}


// Helper method to calculate grade
private function calculateGrade($score)
{
    if ($score >= 90) {
        return 'A';
    } elseif ($score >= 80) {
        return 'B';
    } elseif ($score >= 70) {
        return 'C';
    } elseif ($score >= 60) {
        return 'D';
    } else {
        return 'F';
    }
}

// Helper method to generate remarks
private function generateRemarks($score)
{
    if ($score >= 90) {
        return 'Excellent';
    } elseif ($score >= 80) {
        return 'Very Good';
    } elseif ($score >= 70) {
        return 'Good';
    } elseif ($score >= 60) {
        return 'Pass';
    } else {
        return 'Fail';
    }
}

    public function index()
    {
    // Get the logged-in student's results
    $studentId = Auth::id();
    $results = Result::with('exam.subject')
        ->where('student_id', $studentId)
        ->orderBy('exam_date', 'desc')
        ->get();

    return view('students.results', compact('results'));
    }


    public function downloadResults()
    {
    $studentId = Auth::id();
    $results = Result::with('exam.subject')
        ->where('student_id', $studentId)
        ->get();

    // Generate PDF logic here
    $pdf = PDF::loadView('students.results-pdf', compact('results'));
    return $pdf->download('results.pdf');
    }


    public function getExamTitles(Request $request)
    {
        $classId = $request->query('class_id');
        $subjectId = $request->query('subject_id');

        $examTitles = Exam::where('class_id', $classId)
                      ->where('subject_id', $subjectId)
                      ->distinct()
                      ->get(['id', 'title']);  // Ensure 'id' and 'title' are included

        return response()->json($examTitles);  // Return the full list
    }


}
