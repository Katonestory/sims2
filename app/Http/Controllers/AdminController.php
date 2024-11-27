<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AdminController extends Controller
{
     // Display the Upload Announcement page
     public function showUploadAnnouncementForm()
     {
         return view('admin.upload-announcement');
     }

     // Display the Register Classes page
     public function registerClasses()
     {
         return view('admin.register-classes');
     }

     // Display the Register Teachers page
     public function registerTeachers()
     {
         return view('admin.register-teachers');
     }

     // Display the Register Students page
     public function registerStudents()
     {
         return view('admin.register-students');
     }

     // Display the Register Subjects page
     public function registerSubjects()
     {
         return view('admin.register-subjects');
     }

     // Display the Register Exams page
     public function registerExams()
     {
         return view('admin.register-exams');
     }

     // Display the Change Password page
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


    public function showDashboard()
    {
        // Fetch active announcements for the admin
        $announcements = Announcement::whereDate('startDate', '<=', now())
            ->whereDate('endDate', '>=', now())
            ->get();

            dd($announcements);

        // Pass announcements to the admin dashboard view
        return view('admin.dashboard', compact('announcements'));
    }
}
