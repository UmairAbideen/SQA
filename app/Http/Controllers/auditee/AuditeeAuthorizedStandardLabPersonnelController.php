<?php

namespace App\Http\Controllers\Auditee;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Controllers\Controller;
use App\Models\AuthorizedStandardLabPersonnel;


class AuditeeAuthorizedStandardLabPersonnelController extends Controller
{

    public function show($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);
        return view('auditee.training.ses.lab.single', compact('record'));
    }

    public function print($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditee.training.ses.lab.pdf', compact('record', 'training'))
            ->stream('Standard-Lab-Personnel.pdf');
    }

    public function download($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditee.training.ses.lab.pdf', compact('record', 'training'))
            ->download('Standard-Lab-Personnel.pdf');
    }
}
