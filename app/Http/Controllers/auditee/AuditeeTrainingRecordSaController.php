<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use App\Models\TrainingRecordSa;

class AuditeeTrainingRecordSaController extends Controller
{
    public function show($id)
    {
        $record = TrainingRecordSa::with('staff.user')->findOrFail($id);
        return view('auditee.training.sa.training_sa.single', compact('record'));
    }
}
