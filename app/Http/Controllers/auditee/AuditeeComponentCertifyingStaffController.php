<?php

namespace App\Http\Controllers\Auditee;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TrainingRecordSes;
use App\Http\Controllers\Controller;
use App\Models\ComponentCertifyingStaff;


class AuditeeComponentCertifyingStaffController extends Controller
{
    public function show($id)
    {
        $record = ComponentCertifyingStaff::with('staff.user')->findOrFail($id);
        return view('auditee.training.ses.ccs.single', compact('record'));
    }

    public function print($id)
    {
        $record = ComponentCertifyingStaff::with(['staff.user'])->findOrFail($id);
        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditee.training.ses.ccs.pdf', compact('record', 'training'))
            ->stream('Component-Certifying-Staff.pdf');
    }

    public function download($id)
    {
        $record = ComponentCertifyingStaff::with(['staff.user'])->findOrFail($id);
        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditee.training.ses.ccs.pdf', compact('record', 'training'))
            ->download('Component-Certifying-Staff.pdf');
    }
}
