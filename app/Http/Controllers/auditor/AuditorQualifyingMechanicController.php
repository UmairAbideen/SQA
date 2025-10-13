<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\QualifyingMechanic;
use App\Imports\QualifyingMechanicImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditorQualifyingMechanicController extends Controller
{
    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SES')
                    ->where('auth_type', 'Qualifying Mechanics');
            })
            ->doesntHave('qualifyingMechanic')
            ->get();

        return view('auditor.training.ses.qm.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'category' => 'nullable|string',
            'auth_date' => 'nullable|date',
            'scope' => 'nullable|string',
        ]);

        QualifyingMechanic::create($request->all());

        return redirect()->route('auditor.training.view')
            ->with('status', 'Qualifying Mechanic added.');
    }

    public function edit($id)
    {
        $record = QualifyingMechanic::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('auditor.training.ses.qm.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'nullable|string',
            'auth_date' => 'nullable|date',
            'scope' => 'nullable|string',
        ]);

        QualifyingMechanic::where('id', $id)->update($request->only([
            'category',
            'auth_date',
            'scope'
        ]));

        return redirect()->route('auditor.training.qm.single', ['id' => $id])
            ->with('status', 'Record updated successfully.');
    }

    public function delete($id)
    {
        QualifyingMechanic::destroy($id);

        return redirect()->route('auditor.training.view')
            ->with('status', 'Record deleted.');
    }

    public function show($id)
    {
        $record = QualifyingMechanic::with('staff.user')->findOrFail($id);

        return view('auditor.training.ses.qm.single', compact('record'));
    }

    public function print($id)
    {
        $record = QualifyingMechanic::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find trainingSes for the same user_id via staff table
        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditor.training.ses.qm.pdf', compact('record', 'training'))
            ->stream('Qualifying-Mechanic.pdf');
    }

    public function download($id)
    {
        $record = QualifyingMechanic::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('auditor.training.ses.qm.pdf', compact('record', 'training'))
            ->download('Qualifying-Mechanic.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new QualifyingMechanicImport, $request->file('excel_file'));

        return back()->with('success', 'Qualifying Mechanics imported successfully!');
    }
}

