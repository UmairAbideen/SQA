<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\QualityAuditor;
use App\Models\TrainingRecordSes;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QualityAuditorImport;

class DirectorQualityAuditorController extends Controller
{
    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SES')
                    ->where('auth_type', 'Quality Auditor');
            })
            ->doesntHave('qualityAuditor')
            ->get();

        return view('director.training.ses.quality.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'scope' => 'nullable|string',
        ]);

        QualityAuditor::create($request->only(['staff_id', 'scope']));

        return redirect()->route('director.training.view')->with('status', 'Quality Auditor added.');
    }

    public function edit($id)
    {
        $record = QualityAuditor::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('director.training.ses.quality.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'scope' => 'nullable|string',
        ]);

        QualityAuditor::where('id', $id)->update($request->only(['scope']));

        return redirect()->route('director.training.quality.single', ['id' => $id])
            ->with('status', 'Record updated successfully.');
    }

    public function delete($id)
    {
        QualityAuditor::destroy($id);
        return redirect()->route('director.training.view')->with('status', 'Record deleted.');
    }

    public function show($id)
    {
        $record = QualityAuditor::with('staff.user')->findOrFail($id);
        return view('director.training.ses.quality.single', compact('record'));
    }

    public function print($id)
    {
        $record = QualityAuditor::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('director.training.ses.quality.pdf', compact('record', 'training'))
            ->stream('Quality-Auditor.pdf');
    }

    public function download($id)
    {
        $record = QualityAuditor::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('director.training.ses.quality.pdf', compact('record', 'training'))
            ->download('Quality-Auditor.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new QualityAuditorImport, $request->file('excel_file'));

        return back()->with('success', 'Quality Auditors imported successfully!');
    }
}
