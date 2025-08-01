<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TrainingRecordSes;
use App\Http\Controllers\Controller;
use App\Models\ComponentCertifyingStaff;
use App\Imports\ComponentCertifyingStaffImport;
use Maatwebsite\Excel\Facades\Excel;

class ComponentCertifyingStaffController extends Controller
{
    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SES')
                    ->where('auth_type', 'Component Certifying Staff');
            })
            ->doesntHave('componentCert')
            ->get();

        return view('admin.training.ses.ccs.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'component_rating' => 'nullable|string|max:255',
            'cma_no' => 'nullable|string|max:255',
            'scope' => 'nullable|string',
            'limitation' => 'nullable|string',
        ]);

        ComponentCertifyingStaff::create($request->all());

        return redirect()->route('admin.training.view')->with('status', 'Component Certifying Staff added.');
    }

    public function edit($id)
    {
        $record = ComponentCertifyingStaff::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('admin.training.ses.ccs.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'component_rating' => 'nullable|string|max:255',
            'cma_no' => 'nullable|string|max:255',
            'scope' => 'nullable|string',
            'limitation' => 'nullable|string',
        ]);

        ComponentCertifyingStaff::where('id', $id)->update($request->only([
            'component_rating',
            'cma_no',
            'scope',
            'limitation',
        ]));

        return redirect()->route('admin.training.ccs.single', ['id' => $id])
            ->with('status', 'Record updated successfully.');
    }

    public function delete($id)
    {
        ComponentCertifyingStaff::destroy($id);
        return redirect()->route('admin.training.view')->with('status', 'Record deleted.');
    }

    public function show($id)
    {
        $record = ComponentCertifyingStaff::with('staff.user')->findOrFail($id);
        return view('admin.training.ses.ccs.single', compact('record'));
    }

    public function print($id)
    {
        $record = ComponentCertifyingStaff::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('admin.training.ses.ccs.pdf', compact('record', 'training'))
            ->stream('Component-Certifying-Staff.pdf');
    }

    public function download($id)
    {
        $record = ComponentCertifyingStaff::with(['staff.user'])->findOrFail($id);

        $userId = $record->staff->user->id;

        $training = TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('admin.training.ses.ccs.pdf', compact('record', 'training'))
            ->download('Component-Certifying-Staff.pdf');
    }


    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new ComponentCertifyingStaffImport, $request->file('excel_file'));

        return back()->with('success', 'Component Certifying Staff imported successfully!');
    }
}
