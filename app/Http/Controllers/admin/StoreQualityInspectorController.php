<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreQualityInspector;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\StoreQualityInspectorImport;
use Maatwebsite\Excel\Facades\Excel;

class StoreQualityInspectorController extends Controller
{
    public function create()
    {
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SES')
                    ->where('auth_type', 'Store Quality Inspector');
            })
            ->doesntHave('storeInspector')
            ->get();

        return view('admin.training.ses.store.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'category' => 'nullable|string',
            'scope' => 'nullable|string',
        ]);

        StoreQualityInspector::create($request->only(['staff_id', 'category', 'scope']));

        return redirect()->route('admin.training.view')->with('status', 'Store Quality Inspector added.');
    }

    public function edit($id)
    {
        $record = StoreQualityInspector::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('admin.training.ses.store.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'nullable|string',
            'scope' => 'nullable|string',
        ]);

        StoreQualityInspector::where('id', $id)->update($request->only(['category', 'scope']));

        return redirect()->route('admin.training.store_inspector.single', ['id' => $id])
            ->with('status', 'Record updated successfully.');
    }

    public function delete($id)
    {
        StoreQualityInspector::destroy($id);
        return redirect()->route('admin.training.view')->with('status', 'Record deleted.');
    }

    public function show($id)
    {
        $record = StoreQualityInspector::with('staff.user')->findOrFail($id);
        return view('admin.training.ses.store.single', compact('record'));
    }

    public function print($id)
    {
        $record = \App\Models\StoreQualityInspector::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find trainingSes for the same user_id via staff table
        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('admin.training.ses.store.pdf', compact('record', 'training'))
            ->stream('Store-Quality-Inspector.pdf');
    }

    public function download($id)
    {
        $record = \App\Models\StoreQualityInspector::with(['staff.user'])->findOrFail($id);

        // Get the user_id from the staff record
        $userId = $record->staff->user->id;

        // Find trainingSes for the same user_id via staff table
        $training = \App\Models\TrainingRecordSes::whereHas('staff', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->first();

        return PDF::loadView('admin.training.ses.store.pdf', compact('record', 'training'))
            ->download('Store-Quality-Inspector.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new StoreQualityInspectorImport, $request->file('excel_file'));

        return back()->with('success', 'Store Quality Inspectors imported successfully!');
    }
}
