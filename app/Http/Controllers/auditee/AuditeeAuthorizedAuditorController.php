<?php

namespace App\Http\Controllers\Auditee;

use App\Http\Controllers\Controller;
use App\Models\AuthorizedAuditor;
use App\Models\TrainingRecordSa;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditeeAuthorizedAuditorController extends Controller
{
    public function show($id)
    {
        $record = AuthorizedAuditor::with('staff.user')->findOrFail($id);
        return view('auditee.training.sa.aa.single', compact('record'));
    }

    public function print($id)
    {
        $record = AuthorizedAuditor::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find trainingSes for the same user_id via staff table
        $training = TrainingRecordSa::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.sa.aa.pdf', compact('record', 'training'))
            ->stream('Authorized-Auditor.pdf');
    }

    public function download($id)
    {
        $record = AuthorizedAuditor::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find trainingSes for the same user_id via staff table
        $training = TrainingRecordSa::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditee.training.sa.aa.pdf', compact('record', 'training'))
            ->download('Authorized-Auditor.pdf');
    }
}
