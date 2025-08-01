<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\StaffImport;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
    public function view(Request $request)
    {
        $query = Staff::with('user');

        // Filter by user name
        if ($request->filled('name')) {
            $query->whereHas(
                'user',
                fn($q) =>
                $q->where('username', 'like', '%' . $request->name . '%')
            );
        }

        // Filter by SES number
        if ($request->filled('ses_no')) {
            $query->whereHas(
                'user',
                fn($q) =>
                $q->where('ses_no', 'like', '%' . $request->ses_no . '%')
            );
        }

        // Filter by org
        if ($request->filled('org')) {
            $query->whereHas(
                'user',
                fn($q) =>
                $q->where('org', 'like', '%' . $request->org . '%')
            );
        }

        // Filter by auth_type
        if ($request->filled('auth_type')) {
            $query->where('auth_type', $request->auth_type);
        }

        $allStaff = $query->orderByDesc('id')->get();

        return view('admin.training.view', compact('allStaff'));
    }

    public function form()
    {
        // Make sure to include 'org' in the selected columns
        $users = User::select('id', 'username', 'ses_no', 'org')->get();
        return view('admin.training.add', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'auth_type' => 'required|string|max:255',
            'auth_no' => 'required|string|max:255',
            'function' => 'nullable|string|max:255',
            'ini_issue_date' => 'nullable|date',
        ]);

        // ❗ Prevent duplicate authorization type for same user
        $duplicate = Staff::where('user_id', $request->user_id)
            ->where('auth_type', $request->auth_type)
            ->exists();

        if ($duplicate) {
            return redirect()->back()->withErrors([
                'auth_type' => 'This user already has this authorization assigned.'
            ])->withInput();
        }

        Staff::create([
            'user_id' => $request->user_id,
            'auth_type' => $request->auth_type,
            'auth_no' => $request->auth_no,
            'function' => $request->function,
            'ini_issue_date' => $request->ini_issue_date,
        ]);

        return redirect()->route('admin.staff.form')->with('status', 'Staff authorization added successfully.');
    }

    public function edit($id)
    {
        $staff = Staff::with('user')->findOrFail($id);
        $users = User::all(); // if you need to allow changing user
        return view('admin.training.update', compact('staff', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'auth_type' => 'required|string|max:255',
            'auth_no' => 'required|string|max:255',
            'function' => 'nullable|string|max:255',
            'ini_issue_date' => 'nullable|date',
        ]);

        $staff = Staff::findOrFail($id);

        // 🛡️ Prevent duplicate authorization types (excluding the current record)
        $exists = Staff::where('user_id', $staff->user_id)
            ->where('auth_type', $request->auth_type)
            ->where('id', '!=', $staff->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['auth_type' => 'The user already has this authorization assigned.'])
                ->withInput();
        }

        $staff->update([
            'auth_type' => $request->auth_type,
            'auth_no' => $request->auth_no,
            'function' => $request->function,
            'ini_issue_date' => $request->ini_issue_date,
        ]);

        return redirect()->route('admin.training.view')->with('status', 'Training Record - SA updated successfully.');
    }

    public function delete($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.training.view')->with('status', 'Staff authorization deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new StaffImport, $request->file('excel_file'));

        return back()->with('success', 'Staff imported successfully!');
    }
}
