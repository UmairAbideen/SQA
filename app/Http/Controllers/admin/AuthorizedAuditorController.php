<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TrainingRecordSa;
use App\Models\AuthorizedAuditor;
use App\Http\Controllers\Controller;
use App\Imports\AuthorizedAuditorImport;
use Maatwebsite\Excel\Facades\Excel;

class AuthorizedAuditorController extends Controller
{
    public function show($id)
    {
        $record = AuthorizedAuditor::with('staff.user')->findOrFail($id);
        return view('admin.training.sa.aa.single', compact('record'));
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

        return view('admin.training.sa.aa.add', compact('staff'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'scope' => 'nullable|string',
        ]);

        AuthorizedAuditor::create($request->all());

        return redirect()->route('admin.training.view')->with('status', 'Authorized Auditor added.');
    }

    public function edit($id)
    {
        $record = AuthorizedAuditor::findOrFail($id);
        $staff = Staff::with('user')->get();
        return view('admin.training.sa.aa.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'scope' => 'required|string',
        ]);

        AuthorizedAuditor::where('id', $id)->update($request->only([
            'scope',
        ]));

        return redirect()->route('admin.auditor.single', ['id' => $id])
            ->with('status', 'Authorized Auditor updated successfully.');
    }

    public function delete($id)
    {
        AuthorizedAuditor::destroy($id);
        return redirect()->route('admin.training.view')->with('status', 'Authorized Auditor deleted.');
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

        return Pdf::loadView('admin.training.sa.aa.pdf', compact('record', 'training'))
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

        $training = TrainingRecordSa::where('staff_id', $record->staff_id)->first();
        return Pdf::loadView('admin.training.sa.aa.pdf', compact('record', 'training'))
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
