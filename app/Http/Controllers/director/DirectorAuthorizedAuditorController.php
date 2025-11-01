<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthorizedAuditor;
use App\Models\Staff;
use App\Models\TrainingRecordSa;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AuthorizedAuditorImport;

class DirectorAuthorizedAuditorController extends Controller
{
    public function show($id)
    {
        $record = AuthorizedAuditor::with('staff.user')->findOrFail($id);
        return view('director.training.sa.aa.single', compact('record'));
    }

    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SA')
                      ->where('auth_type', 'Authorized Auditor');
            })
            ->doesntHave('auditor')
            ->get();

        return view('director.training.sa.aa.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'scope' => 'nullable|string',
        ]);

        AuthorizedAuditor::create($request->all());

        return redirect()->route('director.training.view')
            ->with('status', 'Authorized Auditor added.');
    }

    public function edit($id)
    {
        $record = AuthorizedAuditor::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('director.training.sa.aa.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'scope' => 'required|string',
        ]);

        AuthorizedAuditor::where('id', $id)->update($request->only(['scope']));

        return redirect()->route('director.auditor.single', ['id' => $id])
            ->with('status', 'Authorized Auditor updated successfully.');
    }

    public function delete($id)
    {
        AuthorizedAuditor::destroy($id);

        return redirect()->route('director.training.view')
            ->with('status', 'Authorized Auditor deleted.');
    }

    public function print($id)
    {
        $record = AuthorizedAuditor::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find related training record for the same user
        $training = TrainingRecordSa::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('director.training.sa.aa.pdf', compact('record', 'training'))
            ->stream('Authorized-Auditor.pdf');
    }

    public function download($id)
    {
        $record = AuthorizedAuditor::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = TrainingRecordSa::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('director.training.sa.aa.pdf', compact('record', 'training'))
            ->download('Authorized-Auditor.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new AuthorizedAuditorImport, $request->file('excel_file'));

        return back()->with('success', 'Authorized Auditors imported successfully!');
    }
}

