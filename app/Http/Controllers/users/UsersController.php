<?php

namespace App\Http\Controllers\users;

use App\Models\User;
use App\Exports\UsersExport;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function users()
    {
        $users = User::get();
        return view('admin.users.view', ['users' => $users]);
    }
    public function usersform()
    {
        return view('admin.users.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'department' => 'required|string',
            'role' => 'required|string',
            'designation' => 'required|string',
            'org' => 'nullable|string',
            'ses_no' => 'nullable|string',
            'approval' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department' => $request->department,
            'role' => $request->role,
            'designation' => $request->designation,
            'org' => $request->org,
            'ses_no' => $request->ses_no,
            'approval' => $request->approval,
            'status' => $request->status,
            'created_at' => now(),
        ]);

        return back()->with('status', 'New User is Successfully Created.');
    }


    public function single($id)
    {
        $user = User::find($id);
        return view('admin.users.single', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.update', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'department' => 'required|string',
            'role' => 'required|string',
            'designation' => 'required|string',
            'org' => 'nullable|string',
            'ses_no' => 'nullable|string',
            'approval' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);

        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->department = $request->department;
        $user->role = $request->role;
        $user->designation = $request->designation;
        $user->org = $request->org;
        $user->ses_no = $request->ses_no;
        $user->approval = $request->approval;
        $user->status = $request->status;
        $user->updated_at = now();
        $user->save();

        return back()->with('status', 'User Details Updated Successfully.');
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('status', 'User has been Deleted Successfully.');
    }


    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new UsersImport, $request->file('excel_file'));

        return redirect()->back()->with('status', 'User(s) imported successfully.');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users_template.xlsx');
    }
}
