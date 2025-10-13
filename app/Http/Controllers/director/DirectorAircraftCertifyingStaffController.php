<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\AircraftCertifyingStaff;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AircraftCertifyingStaffImport;

class DirectorAircraftCertifyingStaffController extends Controller
{
    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SES')
                    ->where('auth_type', 'Aircraft Certifying Staff');
            })
            ->doesntHave('aircraftCert')
            ->get();

        return view('director.training.ses.acs.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'aml_no' => 'required|string',
            'aircraft' => 'required|string',
            'cat' => 'required|string',
            'scope' => 'nullable|string',
            'privileges' => 'nullable|string',
            'aml_expiry' => 'nullable|date',
        ]);

        AircraftCertifyingStaff::create($request->all());

        return redirect()->route('director.training.view')
            ->with('status', 'Aircraft Certifying Staff added.');
    }

    public function edit($id)
    {
        $record = AircraftCertifyingStaff::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('director.training.ses.acs.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'aml_no' => 'required|string',
            'aircraft' => 'required|string',
            'cat' => 'required|string',
            'scope' => 'nullable|string',
            'privileges' => 'nullable|string',
            'aml_expiry' => 'nullable|date',
        ]);

        AircraftCertifyingStaff::where('id', $id)->update($request->only([
            'aml_no',
            'aircraft',
            'cat',
            'scope',
            'privileges',
            'aml_expiry'
        ]));

        return redirect()->route('director.training.acs.single', ['id' => $id])
            ->with('status', 'Record updated successfully.');
    }

    public function delete($id)
    {
        AircraftCertifyingStaff::destroy($id);

        return redirect()->route('director.training.view')
            ->with('status', 'Record deleted.');
    }

    public function show($id)
    {
        $record = AircraftCertifyingStaff::with('staff.user')->findOrFail($id);

        return view('director.training.ses.acs.single', compact('record'));
    }

    public function print($id)
    {
        $record = AircraftCertifyingStaff::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('director.training.ses.acs.pdf', compact('record', 'training'))
            ->stream('Aircraft-Certifying-Staff.pdf');
    }

    public function download($id)
    {
        $record = AircraftCertifyingStaff::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return Pdf::loadView('director.training.ses.acs.pdf', compact('record', 'training'))
            ->download('Aircraft-Certifying-Staff.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new AircraftCertifyingStaffImport, $request->file('excel_file'));

        return back()->with('success', 'Aircraft Certifying Staff imported successfully!');
    }
}
