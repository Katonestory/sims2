<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Models\Classes;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\User;
use App\Models\Department;
use App\Models\Stream;
use App\Models\ParentModel;
use App\Models\ParentStudent;


class AdminController extends Controller
{

    public function showUploadAnnouncementForm()
     {
         return view('admin.upload-announcement');
     }


    public function registerClass(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'string|max:255',

    ]);

    Classes::create([
        'name' => $request->name,
        'description' => $request->description,

    ]);

    return redirect()->back()->with('success', 'Class registered successfully!');
    }

    public function showRegisterClassForm()
    {
    return view('admin.register-classes');

    }

    public function registerTeachers(Request $request)
     {
         if ($request->isMethod('get')) {
             return view('admin.register-teachers');
         }

         if ($request->isMethod('post')) {
             try {
                 // Validate the form inputs
                 $request->validate([
                     'first_name' => 'required|string|max:255',
                     'middle_name' => 'nullable|string|max:255',
                     'surname' => 'required|string|max:255',
                     'DoB' => 'required|date',
                     'gender' => 'required|in:Male,Female',
                     'email' => 'required|email|unique:users,email|unique:teachers,email', // Ensure email is unique in both tables
                     'phone_number' => 'required|string|max:15',
                     'address' => 'nullable|string',
                     'hireDate' => 'required|date',
                     'status' => 'required|in:0,1',
                     'photoPath' => 'nullable|image|max:2048', // Limit the image size to 2MB
                 ]);



                 // Generate the default password using the surname in uppercase
                 $defaultPassword = strtoupper($request->surname);

                 // Create a user account
                 $user = User::create([
                     'name' => $request->first_name . ' ' . $request->surname,
                     'email' => $request->email,
                     'password' => bcrypt($defaultPassword),
                     'role' => 1,
                 ]);

                 // Handle photo upload
                 $photoPath = null;
                 if ($request->hasFile('photoPath')) {
                     $photoPath = $request->file('photoPath')->store('photos', 'public');
                 }

                 // Save the teacher details
                 Teacher::create([
                     'user_id' => $user->id,
                     'first_name' => $request->first_name,
                     'middle_name' => $request->middle_name,
                     'surname' => $request->surname,
                     'DoB' => $request->DoB,
                     'gender' => $request->gender,
                     'email' => $request->email,
                     'phone_number' => $request->phone_number,
                     'address' => $request->address,
                     'hireDate' => $request->hireDate,
                     'status' => $request->status,
                     'photoPath' => $photoPath,
                 ]);

                 return redirect()->back()->with('success', 'Teacher registered successfully! Default password is their surname in uppercase.');

             } catch (\Exception $e) {
                 // Log the error for debugging
                 \Log::error('Error registering teacher: ' . $e->getMessage());

                 // Redirect back with error message
                 return redirect()->back()->with('error', 'An error occurred while registering the teacher. Please try again.');
             }
         }
     }

    public function showRegisterDepartmentForm()
    {
    return view('admin.register-department');
    }

    public function storeDepartment(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255|unique:departments,name',
        'code' => 'required|string|max:3|unique:departments,code',
        'description' => 'nullable|string|max:1000',
    ]);

    Department::create([
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.register-department')->with('success', 'Department registered successfully!');
    }

    public function showRegisterStreamForm()
    {
    // Fetch classes and teachers for dropdowns
    $classes = Classes::all();
    $teachers = Teacher::all();

    // Return the view with classes and teachers data
    return view('admin.register-stream', compact('classes', 'teachers'));
    }

    public function registerStream(Request $request)
    {
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'class_id' => 'required|exists:classes,id',
        'class_teacher_id' => 'required|exists:teachers,id',
    ]);

    // Create a new stream
    Stream::create([
        'name' => $request->name,
        'class_id' => $request->class_id,
        'class_teacher_id' => $request->class_teacher_id,
    ]);

    // Redirect back with success message
    return redirect()->route('admin.register-stream')->with('success', 'Stream registered successfully');
    }


    public function registerStudents(Request $request)
    {
        if ($request->isMethod('get')) {
            // Fetch available classes and streams to populate the dropdown.
            $classes = Classes::all();
            $streams = Stream::all();

            return view('admin.register-students', compact('classes', 'streams'));
        }

        if ($request->isMethod('post')) {
            try {
                // Validate the student inputs.
                $request->validate([
                    'first_name'   => 'required|string|max:255',
                    'middle_name'  => 'nullable|string|max:255',
                    'surname'      => 'required|string|max:255',
                    'DoB'          => 'required|date',
                    'gender'       => 'required|in:Male,Female',
                    'email'        => 'required|email|unique:users,email',
                    'phone_number' => 'required|string|max:15',
                    'student_id'   => 'nullable|string|unique:students,student_id',
                    'address'      => 'nullable|string',
                    'class_id'     => 'required|exists:classes,id',
                    'stream_id'    => 'required|exists:streams,id',
                    'status'       => 'required|in:0,1',
                    'photoPath'    => 'nullable|image|max:2048', // Limit the image size to 2MB.
                ]);

                // Generate the default password using the surname in uppercase for the student.
                $defaultPassword = strtoupper($request->surname);

                // Create a user account for the student.
                $studentUser = User::create([
                    'name'     => $request->first_name . ' ' . $request->surname,
                    'email'    => $request->email,
                    'password' => bcrypt($defaultPassword),
                    'role'     => 0,  // Adjust the role for students as needed.
                ]);

                $photoPath = null;
                if ($request->hasFile('photoPath')) {
                    $photoPath = $request->file('photoPath')->store('photos', 'public');
                }

                // Save the student details.
                $student = Student::create([
                    'user_id'      => $studentUser->id,
                    'first_name'   => $request->first_name,
                    'middle_name'  => $request->middle_name,
                    'surname'      => $request->surname,
                    'email'        => $request->email,
                    'phone_number' => $request->phone_number,
                    'student_id'   => $request->student_id,
                    'DoB'          => $request->DoB,
                    'gender'       => $request->gender,
                    'address'      => $request->address,
                    'class_id'     => $request->class_id,
                    'stream_id'    => $request->stream_id,
                    'status'       => $request->status,
                    'photoPath'    => $photoPath,
                ]);

                // Handle parent registration if provided.
                if ($request->has('parent_first_name') && is_array($request->parent_first_name)) {
                    $parentFirstNames = $request->input('parent_first_name');
                    $parentSurnames   = $request->input('parent_surname');
                    $parentEmails     = $request->input('parent_email');
                    $parentPhones     = $request->input('parent_phone');

                    // Loop over each provided parent.
                    for ($i = 0; $i < count($parentFirstNames); $i++) {
                        $pFirstName = $parentFirstNames[$i];
                        $pSurname   = $parentSurnames[$i];
                        $pEmail     = $parentEmails[$i];
                        $pPhone     = $parentPhones[$i];

                        // Check if the parent already exists.
                        $existingUser = User::where('email', $pEmail)->first();

                        if ($existingUser) {
                            // Parent already exists, retrieve the parent record.
                            $parentRecord = ParentModel::where('user_id', $existingUser->id)->first();

                            if (!$parentRecord) {
                                // Handle the edge case where the User exists but not the ParentModel.
                                $parentRecord = ParentModel::create([
                                    'user_id'      => $existingUser->id,
                                    'phone_number' => $pPhone,
                                ]);
                            }
                        } else {
                            // Parent does not exist, create new User and ParentModel.
                            $parentUser = User::create([
                                'name'     => $pFirstName . ' ' . $pSurname,
                                'email'    => $pEmail,
                                'password' => bcrypt(strtoupper($pSurname)),
                                'role'     => 4,
                            ]);

                            $parentRecord = ParentModel::create([
                                'user_id'      => $parentUser->id,
                                'phone_number' => $pPhone,
                            ]);
                        }

                        // Create a pivot entry to relate this parent to the student.
                        if (!$parentRecord->student()->where('parent_student.student_id', $student->id)->exists()) {
                            $parentRecord->student()->attach($student->id);
                        }

                    }
                }

                return redirect()->back()->with('success', 'Student and parent(s) registered successfully! The student and Parent default password is their surname in uppercase.');
            } catch (\Exception $e) {
                // Log the error for debugging.
                \Log::error('Student Registration Error: ' . $e->getMessage());

                return redirect()->back()->with('error', 'An error occurred during registration. Please try again or contact support.');
            }
        }
    }



    public function showRegisterSubjectsForm()
     {
         $departments = Department::all();
         return view('admin.register-subjects', compact('departments'));
     }

    public function storeSubject(Request $request)
     {
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'code' => 'nullable|string|max:20|unique:subjects,code',
             'description' => 'nullable|string',
             'department_id' => 'required|exists:departments,id',
             'credits' => 'nullable|integer|min:1|max:10',
             'status' => 'required|in:1,0',
         ]);

         try {
            Subject::create($validatedData);

            return redirect()->route('admin.register-subjects')->with('success', 'Subject registered successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to register subject: ' . $e->getMessage());
        }
     }

    public function registerExams()
     {
        $subjects = Subject::all();
        $classes = Classes::all();

         return view('admin.register-exams', compact('subjects', 'classes'));
     }

    public function storeExam(Request $request)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'subject_id' => 'required|exists:subjects,id',
             'class_id' => 'required|exists:classes,id',
             'exam_date' => 'required|date',
             'academic_year' => 'required|string|max:9',
         ]);

         try {
             Exam::create($request->all());

             return redirect()->route('admin.register-exams')->with('success', 'Exam registered successfully!');
         } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Failed to register exam: ' . $e->getMessage());
         }
     }
    public function changePassword()
     {
         return view('admin.change-password');
     }

    public function uploadAnnouncement(Request $request)
     {
            $request->validate([
            'title' => 'required|string|max:255|min:10',
            'message' => 'required|string|min:40',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
            ]);

         Announcement::create([
            'title' => $request->title,
            'message' => $request->message,
            'created_by' => auth()->id(),
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            ]);

            return redirect()->route('admin.upload-announcement-form')
            ->with('success', 'Announcement posted successfully!');

     }

    public function showPromoteForm()
    {
        $classes = Classes::all(); // Or get classes from your DB
        return view('admin.promote', compact('classes'));
    }

    public function promoteStudent(Request $request)
    {
        // Fetch student by their ID (not student_id)
        $student = Student::find($request->student_id);  // Ensure the correct ID is passed

        if ($student) {
            $student->class_id = $request->class;
            $student->stream_id = $request->stream;
            $student->save();

            return redirect()->route('admin.promote')->with('success', 'Student promoted successfully!');
        }

        return back()->with('error', 'Student not found');
    }
      public function showAssignClassTeacherForm()
    {
        $classes = Classes::all();
        $teachers = Teacher::all();

        return view('admin.assign-class-teacher', compact('classes', 'teachers'));
    }

    public function assignClassTeacher(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'stream_id' => 'required|exists:streams,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // Update the stream with the selected teacher
        $stream = Stream::find($request->stream_id);
        $stream->class_teacher_id = $request->teacher_id;
        $stream->save();

        return redirect()->back()->with('success', 'Class teacher assigned successfully.');
    }

    public function getStreamsByClasses(Request $request)
    {
        $streams = Stream::where('class_id', $request->class_id)->get();
        return response()->json($streams);
    }

    public function getStreamsByClass($classId)
    {
        // Get streams associated with a particular class
        $streams = Stream::where('class_id', $classId)->get(['id', 'name']);
        return response()->json($streams);
    }

    public function searchStudent(Request $request)
    {
    $query = $request->input('query');

    $students = DB::table('students')
    ->where(DB::raw("CONCAT(first_name, ' ', middle_name, ' ', surname)"), 'like', '%' . $query . '%')
    ->get(['id', DB::raw("CONCAT(first_name, ' ', middle_name, ' ', surname) as name")]);

    return response()->json($students);
    }

}
