<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\AuthorizedStandardLabPersonnel;
use App\Imports\AuthorizedStandardLabPersonnelImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AuditorAuthorizedStandardLabPersonnelController extends Controller
{
    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SES')
                    ->where('auth_type', 'Authorized Standard Lab Personnel');
            })
            ->doesntHave('labPersonnel')
            ->get();

        return view('auditor.training.ses.lab.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'scope' => 'nullable|string',
        ]);

        AuthorizedStandardLabPersonnel::create($request->only(['staff_id', 'scope']));

        return redirect()->route('auditor.training.view')
            ->with('status', 'Authorized Standard Lab Personnel added.');
    }

    public function edit($id)
    {
        $record = AuthorizedStandardLabPersonnel::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('auditor.training.ses.lab.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'scope' => 'nullable|string',
        ]);

        AuthorizedStandardLabPersonnel::where('id', $id)
            ->update($request->only(['scope']));

        return redirect()->route('auditor.training.standard_lab.single', ['id' => $id])
            ->with('status', 'Record updated successfully.');
    }

    public function delete($id)
    {
        AuthorizedStandardLabPersonnel::destroy($id);

        return redirect()->route('auditor.training.view')
            ->with('status', 'Record deleted.');
    }

    public function show($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);

        return view('auditor.training.ses.lab.single', compact('record'));
    }

    public function print($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditor.training.ses.lab.pdf', compact('record', 'training'))
            ->stream('Standard-Lab-Personnel.pdf');
    }

    public function download($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('auditor.training.ses.lab.pdf', compact('record', 'training'))
            ->download('Standard-Lab-Personnel.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new AuthorizedStandardLabPersonnelImport, $request->file('excel_file'));

        return back()->with('success', 'Authorized Standard Lab Personnel imported successfully!');
    }
}

