<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
     // Display the Upload Announcement page
     public function uploadAnnouncement()
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
}
