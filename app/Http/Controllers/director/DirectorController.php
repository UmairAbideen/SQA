<?php

namespace App\Http\Controllers\director;

use App\Models\Manual;
use App\Http\Controllers\Controller;

class DirectorController extends Controller
{
     public function dashboard()
    {
        $manual = Manual::get();
        return view('director.documents.manual.view', ['manuals' => $manual]);
    }
}
