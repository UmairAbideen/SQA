<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\TrainingRecordSa;
use App\Imports\TrainingRecordSaImport;
use Maatwebsite\Excel\Facades\Excel;

class AuditorTrainingRecordSaController extends Controller
{
    public function create()
    {
        // Only show staff where related user has org = 'SA'
        $staff = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('org', 'SA')
                    ->where('auth_type', 'Training Record - SA');
            })
            ->doesntHave('trainingSa')
            ->get();

        return view('auditor.training.sa.training_sa.add', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',

            // Validate as nullable strings instead of booleans
            'pcca_regulation' => 'nullable|string|max:255',
            'mcm' => 'nullable|string|max:255',
            'amp' => 'nullable|string|max:255',
            'reliability' => 'nullable|string|max:255',
            'ad_sb' => 'nullable|string|max:255',
            'maintenance' => 'nullable|string|max:255',
            'record_keeping' => 'nullable|string|max:255',
            'quality_monitoring' => 'nullable|string|max:255',
            'level1_training' => 'nullable|string|max:255',
            'fuel_tank' => 'nullable|string|max:255',
            'quality_auditor' => 'nullable|string|max:255',
            'ramp_insp' => 'nullable|string|max:255',
            'engine_health' => 'nullable|string|max:255',
            'hf' => 'nullable|string|max:255',
            'sms' => 'nullable|string|max:255',
            'ewis' => 'nullable|string|max:255',
        ]);

        TrainingRecordSa::create($request->all());

        return redirect()->route('auditor.training.view')
            ->with('status', 'Training Record SA created.');
    }

    public function edit($id)
    {
        $record = TrainingRecordSa::findOrFail($id);
        $staff = Staff::with('user')->get();

        return view('auditor.training.sa.training_sa.update', compact('record', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pcca_regulation' => 'nullable|string|max:255',
            'mcm' => 'nullable|string|max:255',
            'amp' => 'nullable|string|max:255',
            'reliability' => 'nullable|string|max:255',
            'ad_sb' => 'nullable|string|max:255',
            'maintenance' => 'nullable|string|max:255',
            'record_keeping' => 'nullable|string|max:255',
            'quality_monitoring' => 'nullable|string|max:255',
            'level1_training' => 'nullable|string|max:255',
            'fuel_tank' => 'nullable|string|max:255',
            'quality_auditor' => 'nullable|string|max:255',
            'ramp_insp' => 'nullable|string|max:255',
            'engine_health' => 'nullable|string|max:255',
            'hf' => 'nullable|string|max:255',
            'sms' => 'nullable|string|max:255',
            'ewis' => 'nullable|string|max:255',
        ]);

        $record = TrainingRecordSa::findOrFail($id);

        $record->update([
            'pcca_regulation' => $request->pcca_regulation,
            'mcm' => $request->mcm,
            'amp' => $request->amp,
            'reliability' => $request->reliability,
            'ad_sb' => $request->ad_sb,
            'maintenance' => $request->maintenance,
            'record_keeping' => $request->record_keeping,
            'quality_monitoring' => $request->quality_monitoring,
            'level1_training' => $request->level1_training,
            'fuel_tank' => $request->fuel_tank,
            'quality_auditor' => $request->quality_auditor,
            'ramp_insp' => $request->ramp_insp,
            'engine_health' => $request->engine_health,
            'hf' => $request->hf,
            'sms' => $request->sms,
            'ewis' => $request->ewis,
        ]);

        // ✅ Redirect to the show route with success message
        return redirect()
            ->route('auditor.training_sa.single', $record->id)
            ->with('status', 'Training Record SA updated successfully.');
    }

    public function delete($id)
    {
        TrainingRecordSa::destroy($id);
        return redirect()->route('auditor.training.view')->with('status', 'Training Record SA deleted.');
    }

    public function show($id)
    {
        $record = TrainingRecordSa::with('staff.user')->findOrFail($id);
        return view('auditor.training.sa.training_sa.single', compact('record'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new TrainingRecordSaImport, $request->file('excel_file'));

        return back()->with('success', 'Training Record SA imported successfully!');
    }
}
