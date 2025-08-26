<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingRecordSes;
use App\Models\Staff;
use App\Imports\TrainingRecordSESImport;
use Maatwebsite\Excel\Facades\Excel;

class TrainingRecordSESController extends Controller
{
    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SES')
                    ->where('auth_type', 'Training Record - SES');
            })
            ->doesntHave('trainingSes')
            ->get();

        return view('admin.training.ses.training.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'hf' => 'nullable|string',
            'op' => 'nullable|string',
            'cdccl' => 'nullable|string',
            'tt' => 'nullable|string',
            'sms' => 'nullable|string',
            'ewis' => 'nullable|string',
            'al' => 'nullable|string',
            'at_1' => 'nullable|string',
            'at_2' => 'nullable|string',
            'at_3' => 'nullable|string',
            'at_4' => 'nullable|string',
        ]);

        TrainingRecordSes::create($request->only([
            'staff_id',
            'hf',
            'op',
            'cdccl',
            'tt',
            'sms',
            'ewis',
            'al',
            'at_1',
            'at_2',
            'at_3',
            'at_4'
        ]));

        return redirect()->route('admin.training.view')->with('status', 'Training record added.');
    }

    public function edit($id)
    {
        $record = TrainingRecordSES::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('admin.training.ses.training.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hf' => 'nullable|string',
            'op' => 'nullable|string',
            'cdccl' => 'nullable|string',
            'tt' => 'nullable|string',
            'sms' => 'nullable|string',
            'ewis' => 'nullable|string',
            'al' => 'nullable|string',
            'at_1' => 'nullable|string',
            'at_2' => 'nullable|string',
            'at_3' => 'nullable|string',
            'at_4' => 'nullable|string',
        ]);

        $record = TrainingRecordSES::findOrFail($id);
        $record->update($request->only([
            'hf',
            'op',
            'cdccl',
            'tt',
            'sms',
            'ewis',
            'al',
            'at_1',
            'at_2',
            'at_3',
            'at_4'
        ]));

        return redirect()->route('admin.training.training_ses.single', ['id' => $id])
            ->with('status', 'Training record updated successfully.');
    }

    public function delete($id)
    {
        TrainingRecordSES::destroy($id);
        return redirect()->route('admin.training.view')->with('status', 'Training record deleted.');
    }

    public function show($id)
    {
        $record = TrainingRecordSES::with('staff.user')->findOrFail($id);
        return view('admin.training.ses.training.single', compact('record'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new TrainingRecordSESImport, $request->file('excel_file'));

        return back()->with('success', 'Training Record SES imported successfully!');
    }
}
