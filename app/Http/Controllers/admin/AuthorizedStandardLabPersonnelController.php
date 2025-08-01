<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthorizedStandardLabPersonnel;
use App\Models\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\AuthorizedStandardLabPersonnelImport;
use Maatwebsite\Excel\Facades\Excel;

class AuthorizedStandardLabPersonnelController extends Controller
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

        return view('admin.training.ses.lab.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'scope' => 'nullable|string',
        ]);

        AuthorizedStandardLabPersonnel::create($request->only(['staff_id', 'scope']));

        return redirect()->route('admin.training.view')->with('status', 'Authorized Standard Lab Personnel added.');
    }

    public function edit($id)
    {
        $record = AuthorizedStandardLabPersonnel::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('admin.training.ses.lab.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'scope' => 'nullable|string',
        ]);

        AuthorizedStandardLabPersonnel::where('id', $id)->update($request->only(['scope']));

        return redirect()->route('admin.training.standard_lab.single', ['id' => $id])
            ->with('status', 'Record updated successfully.');
    }

    public function delete($id)
    {
        AuthorizedStandardLabPersonnel::destroy($id);
        return redirect()->route('admin.training.view')->with('status', 'Record deleted.');
    }

    public function show($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);
        return view('admin.training.ses.lab.single', compact('record'));
    }

    public function print($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find related training record for same user
        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('admin.training.ses.lab.pdf', compact('record', 'training'))
            ->stream('Standard-Lab-Personnel.pdf');
    }

    public function download($id)
    {
        $record = AuthorizedStandardLabPersonnel::with('staff.user')->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('admin.training.ses.lab.pdf', compact('record', 'training'))
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
