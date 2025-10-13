<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use App\Models\TrainingRecordSES;


class AuditeeTrainingRecordSesController extends Controller
{
    public function show($id)
    {
        $record = TrainingRecordSES::with('staff.user')->findOrFail($id);
        return view('auditee.training.ses.training.single', compact('record'));
    }
}
