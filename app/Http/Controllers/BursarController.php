<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BursarController extends Controller
{

    public function feeStructureManagement()
    {
        return view('bursar.fee-structure-management');
    }

    public function financialReport()
    {
        return view('bursar.financial-report');
    }

    public function generateInvoice()
    {
        return view('bursar.generate-invoice');
    }

    public function viewAndManagePayments()
    {
        return view('bursar.view-and-manage-payments');
    }

    public function changePassword()
    {
        return view('bursar.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches the stored password
        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'Current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->route('bursar.changePassword')->with('status', 'Password updated successfully!');
    }
}
