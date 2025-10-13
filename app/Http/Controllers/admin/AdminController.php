<?php

namespace App\Http\Controllers\admin;

use App\Models\Manual;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function dashboard()
    {
        $manual = Manual::get();
        return view('admin.documents.manual.view', ['manuals' => $manual]);
    }
}
