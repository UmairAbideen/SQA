<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use App\Models\QualifyingMechanic;
use App\Models\TrainingRecordSes;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditeeQualifyingMechanicController extends Controller
{
    public function show($id)
    {
        $record = QualifyingMechanic::with('staff.user')->findOrFail($id);

        return view('auditee.training.ses.qm.single', compact('record'));
    }

    public function print($id)
    {
        $record = QualifyingMechanic::with(['staff.user'])->findOrFail($id);
        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.ses.qm.pdf', compact('record', 'training'))
            ->stream('Qualifying-Mechanic.pdf');
    }

    public function download($id)
    {
        $record = QualifyingMechanic::with(['staff.user'])->findOrFail($id);
        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.ses.qm.pdf', compact('record', 'training'))
            ->download('Qualifying-Mechanic.pdf');
    }
}
