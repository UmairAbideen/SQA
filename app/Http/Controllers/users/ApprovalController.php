<?php

namespace App\Http\Controllers\users;

use App\Models\User;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    public function approve($id)
    {
        $user = User::where('id', $id)->first();
        $user->approval = "approved";
        $user->updated_at->now();
        $user->save();
        return back()->with('status', 'User is Approved Successfully.');
    }

    public function disapprove($id)
    {
        $user = User::where('id', $id)->first();
        $user->approval = "pending";
        $user->updated_at->now();
        $user->save();
        return back()->with('status', 'User has been Dis-Approved.');
    }
}
