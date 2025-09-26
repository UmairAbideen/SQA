<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->approval !== 'approved') {
                return back()->with('pending', 'Your account approval request is pending.');
            }

            if ($user->status !== 'active') {
                return back()->with('activation', 'Your account is deactivated. Contact your admin.');
            }

            return $this->redirectToDashboard($user);
        }

        return back()->with('error', 'Invalid login credentials.');
    }

    private function redirectToDashboard($user)
    {
        switch ($user->role) {
            case 'Admin':
                return redirect('/admin/dashboard');
            case 'Auditor':
                return redirect('/auditor/dashboard');
            case 'Auditee':
                return redirect('/auditee/dashboard');
            default:
                return back()->with('error', 'Unauthorized role.');
        }
    }
}
