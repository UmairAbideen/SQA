<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use App\Models\QualityAuditor;
use App\Models\TrainingRecordSes;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditeeQualityAuditorController extends Controller
{
    public function show($id)
    {
        $record = QualityAuditor::with('staff.user')->findOrFail($id);
        return view('auditee.training.ses.quality.single', compact('record'));
    }

    public function print($id)
    {
        $record = QualityAuditor::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.ses.quality.pdf', compact('record', 'training'))
            ->stream('Quality-Auditor.pdf');
    }

    public function download($id)
    {
        $record = QualityAuditor::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.ses.quality.pdf', compact('record', 'training'))
            ->download('Quality-Auditor.pdf');
    }
}
