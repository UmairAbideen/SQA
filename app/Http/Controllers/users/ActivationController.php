<?php

namespace App\Http\Controllers\users;

use App\Models\User;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function active($id)
    {
        $user = User::where('id', $id)->first();
        $user->status = "active";
        $user->updated_at->now();
        $user->save();
        return back()->with('status', 'User is Activated Successfully.');
    }

    public function deactive($id)
    {
        $user = User::where('id', $id)->first();
        $user->status = "deactive";
        $user->updated_at->now();
        $user->save();
        return back()->with('status', 'User has been De-Activated.');
    }
}
