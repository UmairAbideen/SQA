<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use App\Models\AircraftCertifyingStaff;
use App\Models\TrainingRecordSes;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditeeAircraftCertifyingStaffController extends Controller
{
    public function show($id)
    {
        $record = AircraftCertifyingStaff::with('staff.user')->findOrFail($id);

        return view('auditee.training.ses.acs.single', compact('record'));
    }

    public function print($id)
    {
        $record = AircraftCertifyingStaff::with(['staff.user'])->findOrFail($id);
        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.ses.acs.pdf', compact('record', 'training'))
            ->stream('Aircraft-Certifying-Staff.pdf');
    }

    public function download($id)
    {
        $record = AircraftCertifyingStaff::with(['staff.user'])->findOrFail($id);
        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.ses.acs.pdf', compact('record', 'training'))
            ->download('Aircraft-Certifying-Staff.pdf');
    }

}
