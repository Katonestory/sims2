<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function uploadMaterials()
    {
        return view('teacher.upload-materials');
    }

    public function uploadAssignments()
    {
        return view('teacher.upload-assignments');
    }

    public function uploadResults()
    {
        return view('teacher.upload-results');
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
    public function showDashboard()
    {
        // Fetch active announcements
        $announcements = Announcement::whereDate('startDate', '<=', now())
            ->whereDate('endDate', '>=', now())
            ->get();

        // Pass announcements to the teacher dashboard view
        return view('teacher.dashboard', compact('announcements'));
    }
}
