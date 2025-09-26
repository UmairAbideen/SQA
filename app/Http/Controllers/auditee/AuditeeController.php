<?php

namespace App\Http\Controllers\auditee;

use App\Models\Manual;
use App\Http\Controllers\Controller;

class AuditeeController extends Controller
{
    public function dashboard()
    {
        $manual = Manual::get();
        return view('auditee.documents.manual.view', ['manuals' => $manual]);
    }
}
