<?php

namespace App\Http\Controllers\Auditee;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TrainingRecordSes;
use App\Http\Controllers\Controller;
use App\Models\StoreQualityInspector;

class AuditeeStoreQualityInspectorController extends Controller
{
    public function show($id)
    {
        $record = StoreQualityInspector::with('staff.user')->findOrFail($id);
        return view('auditee.training.ses.store.single', compact('record'));
    }

    public function print($id)
    {
        $record = StoreQualityInspector::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find trainingSes for the same user_id via staff table
        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditee.training.ses.store.pdf', compact('record', 'training'))
            ->stream('Store-Quality-Inspector.pdf');
    }

    public function download($id)
    {
        $record = StoreQualityInspector::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find trainingSes for the same user_id via staff table
        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditee.training.ses.store.pdf', compact('record', 'training'))
            ->download('Store-Quality-Inspector.pdf');
    }
}

