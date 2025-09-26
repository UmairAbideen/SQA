<?php

namespace App\Http\Controllers\auditor;

use App\Models\Manual;
use App\Http\Controllers\Controller;

class AuditorController extends Controller
{
    public function dashboard()
    {
        $manual = Manual::get();
        return view('auditor.documents.manual.view', ['manuals' => $manual]);
    }
}
