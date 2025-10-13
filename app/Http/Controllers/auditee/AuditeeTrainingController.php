<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class AuditeeTrainingController extends Controller
{
    // ======================== VIEW ===============================
    // public function view(Request $request)
    // {
    //     $query = Staff::with('user');

    //     // Filter by user name
    //     if ($request->filled('name')) {
    //         $query->whereHas('user', function ($q) use ($request) {
    //             $q->where('username', 'like', '%' . $request->name . '%');
    //         });
    //     }

    //     // Filter by SES number
    //     if ($request->filled('ses_no')) {
    //         $query->whereHas('user', function ($q) use ($request) {
    //             $q->where('ses_no', 'like', '%' . $request->ses_no . '%');
    //         });
    //     }

    //     // Filter by organization
    //     if ($request->filled('org')) {
    //         $query->whereHas('user', function ($q) use ($request) {
    //             $q->where('org', 'like', '%' . $request->org . '%');
    //         });
    //     }

    //     // Filter by auth_type
    //     if ($request->filled('auth_type')) {
    //         $query->where('auth_type', $request->auth_type);
    //     }

    //     $allStaff = $query->orderByDesc('id')->get();

    //     return view('auditee.training.view', compact('allStaff'));
    // }



    public function view(Request $request)
    {
        $user = auth()->user();

        // Fetch all staff records linked to the logged-in user
        $allStaff = Staff::with(['user'])
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get();

        // If no records exist, redirect back or show message
        // if ($allStaff->isEmpty()) {
        //     return redirect()->back()->with('error', 'No staff records found for this user.');
        // }

        return view('auditee.training.view', compact('allStaff'));
    }
}
