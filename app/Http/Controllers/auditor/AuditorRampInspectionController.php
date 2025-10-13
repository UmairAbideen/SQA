<?php

namespace App\Http\Controllers\Auditor;

use Illuminate\Http\Request;
use App\Models\RampInspection;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\RampReplyExport;
use App\Imports\RampReplyImport;
use App\Mail\FindingReminderMail;
use App\Exports\RampFindingExport;
use App\Imports\RampFindingImport;
use App\Models\RampInspectionReply;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RampInspectionExport;
use App\Imports\RampInspectionImport;
use App\Models\RampInspectionFinding;
use Illuminate\Support\Facades\Storage;

class AuditorRampInspectionController extends Controller
{
    // ================== Auditor Ramp Inspection Methods ==================

    public function view()
    {
        $rampInspections = RampInspection::with('rampInspectionFinding')->get(); // preload findings
        return view('auditor.rampinspection.view', ['rampInspections' => $rampInspections]);
    }

    public function form()
    {
        return view('auditor.rampinspection.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'inspection_time' => 'nullable|date_format:H:i',
            'aircraft_reg' => 'nullable|string|max:255',
            'aircraft_type' => 'nullable|string|max:255',
            'arrival_station' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'flight_no' => 'nullable|string|max:255',
            'bay_no' => 'nullable|string|max:255',
            'inspection_ref_no' => 'nullable|string|max:255',
            'inspection_type' => 'nullable|string|max:255',
            'inspector' => 'nullable|string|max:255',
        ]);

        RampInspection::create([
            'date' => $request->date,
            'inspection_time' => $request->inspection_time,
            'aircraft_reg' => $request->aircraft_reg,
            'aircraft_type' => $request->aircraft_type,
            'arrival_station' => $request->arrival_station,
            'destination' => $request->destination,
            'flight_no' => $request->flight_no,
            'bay_no' => $request->bay_no,
            'inspection_ref_no' => $request->inspection_ref_no,
            'inspection_type' => $request->inspection_type,
            'inspector' => $request->inspector,
            'status' => 'Open',
            'created_at' => now(),
        ]);

        return back()->with('status', 'Aircraft Inspection Form has been Created.');
    }

    public function edit($id)
    {
        $rampinspection = RampInspection::find($id);
        return view('auditor.rampinspection.update', ['rampinspection' => $rampinspection]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'inspection_time' => 'nullable',
            'aircraft_reg' => 'nullable|string|max:255',
            'aircraft_type' => 'nullable|string|max:255',
            'arrival_station' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'flight_no' => 'nullable|string|max:255',
            'bay_no' => 'nullable|string|max:255',
            'inspection_ref_no' => 'nullable|string|max:255',
            'inspection_type' => 'nullable|string|max:255',
            'inspector' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $rampInspection = RampInspection::findOrFail($id);

        $rampInspection->update([
            'date' => $request->date,
            'inspection_time' => $request->inspection_time,
            'aircraft_reg' => $request->aircraft_reg,
            'aircraft_type' => $request->aircraft_type,
            'arrival_station' => $request->arrival_station,
            'destination' => $request->destination,
            'flight_no' => $request->flight_no,
            'bay_no' => $request->bay_no,
            'inspection_ref_no' => $request->inspection_ref_no,
            'inspection_type' => $request->inspection_type,
            'inspector' => $request->inspector,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return back()->with('status', 'Aircraft Inspection Form updated successfully.');
    }

    public function delete($id)
    {
        $rampInspection = RampInspection::findOrFail($id);
        $rampInspection->delete();
        return back()->with('status', 'Ramp Inspection Form has been removed.');
    }

    public function generatePdf($id)
    {
        $rampInspection = RampInspection::with('rampInspectionFinding')->findOrFail($id);

        return Pdf::loadView('auditor.rampinspection.pdf', compact('rampInspection'))
            ->setPaper('a4', 'landscape')
            ->stream('RampInspection.pdf');
    }

    public function downloadPdf($id)
    {
        $rampInspection = RampInspection::with('rampInspectionFinding')->findOrFail($id);

        return Pdf::loadView('auditor.rampinspection.pdf', compact('rampInspection'))
            ->setPaper('a4', 'landscape')
            ->download('RampInspection.pdf');
    }

    public function exportRampInspectionsByDate(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        $rampInspections = RampInspection::whereBetween('date', [$start, $end])
            ->orderBy('date', 'asc')
            ->get();

        if ($rampInspections->isEmpty()) {
            return redirect()->back()->with('error', 'No ramp inspections found in the selected date range.');
        }

        return Pdf::loadView('auditor.rampinspection.range_pdf', compact('rampInspections', 'start', 'end'))
            ->setPaper('a4', 'landscape')
            ->stream('RampInspections_' . $start . '_to_' . $end . '.pdf');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new RampInspectionImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'Ramp Inspections imported successfully.');
    }

    public function exportExcelByDate(Request $request)
    {
        $start = $request->query('start_date');
        $end = $request->query('end_date');

        if (!$start || !$end) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        return Excel::download(new RampInspectionExport($start, $end), "RampInspections_{$start}_to_{$end}.xlsx");
    }




















    // ================================   Auditor Findings   ======================================

    // All findings
    public function findingView($id)
    {
        $rampInspection = RampInspection::with('rampInspectionFinding')->findOrFail($id);

        return view('auditor.rampinspection.finding.view', [
            'rampInspection' => $rampInspection,
        ]);
    }

    // Open findings
    public function findingViewOpen($id)
    {
        $rampInspection = RampInspection::with(['rampInspectionFinding' => function ($query) {
            $query->where('status', 'Open');
        }])->findOrFail($id);

        return view('auditor.rampinspection.finding.view', [
            'rampInspection' => $rampInspection,
        ]);
    }

    // Closed findings
    public function findingViewClose($id)
    {
        $rampInspection = RampInspection::with(['rampInspectionFinding' => function ($query) {
            $query->where('status', 'Close');
        }])->findOrFail($id);

        return view('auditor.rampinspection.finding.view', [
            'rampInspection' => $rampInspection,
        ]);
    }


    public function findingForm($id)
    {
        $rampInspection = RampInspection::find($id);
        return view('auditor.rampinspection.finding.add', ['rampInspection' => $rampInspection]);
    }


    public function findingCreate(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'finding' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $rampInspection = RampInspection::find($request->ramp_inspection_id);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/finding/attachment',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        $rampInspection->rampInspectionFinding()->create([
            'code' => $request->code,
            'category' => $request->category,
            'finding' => $request->finding,
            'attachment' => $attachmentPath,
            'status' => 'Open',
            'created_at' => now(),
        ]);

        return back()->with('status', 'Aircraft Inspection Finding has been Created.');
    }


    public function findingEdit($id)
    {
        $rampinspectionfinding = RampInspectionFinding::find($id);
        $rampInspection = RampInspection::where('id', $rampinspectionfinding->ramp_inspection_id)->first();
        return view('auditor.rampinspection.finding.update', [
            'rampinspectionfinding' => $rampinspectionfinding,
            'rampInspection' => $rampInspection
        ]);
    }


    public function findingUpdate(Request $request, $id)
    {
        $request->validate([
            'code' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'finding' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => 'nullable|string|max:255',
            'closed_by' => 'nullable|string|max:255',
        ]);

        $rampInspectionFinding = RampInspectionFinding::find($id);

        $attachmentPath = $rampInspectionFinding->attachment;

        if ($request->hasFile('attachment')) {
            if ($rampInspectionFinding->attachment && Storage::disk('public')->exists($rampInspectionFinding->attachment)) {
                Storage::disk('public')->delete($rampInspectionFinding->attachment);
            }

            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/finding/attachment',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        $rampInspectionFinding->update([
            'code' => $request->code,
            'category' => $request->category,
            'finding' => $request->finding,
            'attachment' => $attachmentPath,
            'status' => $request->status,
            'closed_by' => $request->closed_by,
        ]);

        return back()->with('status', 'Aircraft Inspection Finding updated successfully.');
    }


    public function findingDelete($id)
    {
        $rampInspectionFinding = RampInspectionFinding::find($id);
        $rampInspectionFinding->delete();
        return back()->with('status', 'Ramp Inspection Finding has been removed.');
    }


    public function printRampFinding($findingId)
    {
        $finding = RampInspectionFinding::with('rampInspection')->findOrFail($findingId);
        $rampInspection = $finding->rampInspection;

        $pdf = Pdf::loadView('auditor.rampinspection.finding.pdf', compact('rampInspection', 'finding'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('RampInspectionFinding.pdf');
    }


    public function downloadRampFinding($findingId)
    {
        $finding = RampInspectionFinding::with('rampInspection')->findOrFail($findingId);
        $rampInspection = $finding->rampInspection;

        $pdf = Pdf::loadView('auditor.rampinspection.finding.pdf', compact('rampInspection', 'finding'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('RampInspectionFinding.pdf');
    }


    public function exportRampFindingsByDateRange(Request $request, $rampId)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        $rampInspection = RampInspection::with('rampInspectionFinding')->findOrFail($rampId);

        $findings = $rampInspection->rampInspectionFinding()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        if ($findings->isEmpty()) {
            return redirect()->back()->with('error', 'No findings found in the selected date range.');
        }

        $pdf = Pdf::loadView('auditor.rampinspection.finding.range_pdf', compact('rampInspection', 'findings', 'startDate', 'endDate'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('RampInspectionFindingsRange.pdf');
    }


    public function importRampFindings(Request $request, $rampId)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new RampFindingImport($rampId), $request->file('excel_file'));

        return back()->with('success', 'Findings imported successfully.');
    }


    public function exportRampFindingsExcelByDateRange(Request $request, $rampId)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        return Excel::download(new RampFindingExport($rampId, $startDate, $endDate), 'RampFindings_' . $startDate . '_to_' . $endDate . '.xlsx');
    }


    public function sendFindingEmail(Request $request, $findingId)
    {
        $request->validate([
            'to' => 'required|email',
            'cc' => 'nullable|string',
            'bcc' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $finding = RampInspectionFinding::with('rampInspection')->findOrFail($findingId);

        $cc = $request->cc ? array_map('trim', explode(',', $request->cc)) : [];
        $bcc = $request->bcc ? array_map('trim', explode(',', $request->bcc)) : [];

        Mail::to($request->to)
            ->cc($cc)
            ->bcc($bcc)
            ->send(new FindingReminderMail($finding, $request->subject, $request->body));

        return back()->with('status', 'Email sent successfully.');
    }

















    //=============================== Reply (Auditor) ===============================

    public function replyView($id)
    {
        $rampInspectionFinding = RampInspectionFinding::with('rampInspectionReply')
            ->with('rampInspection')
            ->where('id', $id)
            ->first();

        return view('auditor.rampinspection.finding.reply.view', [
            'rampInspectionFindings' => $rampInspectionFinding,
        ]);
    }

    public function replyform($id)
    {
        $rampInspectionFinding = RampInspectionFinding::find($id);

        return view('auditor.rampinspection.finding.reply.add', [
            'rampInspectionFinding' => $rampInspectionFinding,
        ]);
    }

    public function replyCreate(Request $request)
    {
        $request->validate([
            'reply' => 'nullable|string|max:255',
            'reply_by' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'remarks_by' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $rampInspectionFinding = RampInspectionFinding::find($request->finding_id);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/reply/attachment',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        $rampInspectionFinding->rampInspectionReply()->create([
            'reply' => $request->reply,
            'reply_by' => $request->reply_by,
            'remarks' => $request->remarks,
            'remarks_by' => $request->remarks_by,
            'attachment' => $attachmentPath,
            'status' => 'Open',
            'created_at' => now(),
        ]);

        return back()->with('status', 'Finding Reply has been Created.');
    }

    public function replyEdit($id)
    {
        $rampInspectionReply = RampInspectionReply::with('rampInspectionFinding')
            ->where('id', $id)
            ->first();

        return view('auditor.rampinspection.finding.reply.update', [
            'rampInspectionReply' => $rampInspectionReply,
        ]);
    }

    public function replyUpdate(Request $request, $id)
    {
        $request->validate([
            'reply' => 'nullable|string|max:255',
            'reply_by' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'remarks_by' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => 'nullable|string|max:255',
        ]);

        $reply = RampInspectionReply::find($id);
        $attachmentPath = $reply->attachment;

        if ($request->hasFile('attachment')) {
            if ($reply->attachment && Storage::disk('public')->exists($reply->attachment)) {
                Storage::disk('public')->delete($reply->attachment);
            }
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/reply/attachment',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        $reply->update([
            'reply' => $request->reply,
            'reply_by' => $request->reply_by,
            'remarks' => $request->remarks,
            'remarks_by' => $request->remarks_by,
            'attachment' => $attachmentPath,
            'status' => $request->status,
        ]);

        return back()->with('status', 'Finding Reply has been updated successfully.');
    }

    public function replyDelete($id)
    {
        $rampInspectionReply = RampInspectionReply::find($id);
        $rampInspectionReply->delete();

        return back()->with('status', 'Reply has been removed.');
    }

    public function printRampReplies($replyId)
    {
        $reply = RampInspectionReply::with('rampInspectionFinding.rampInspection')->findOrFail($replyId);
        $finding = $reply->rampInspectionFinding;
        $rampInspection = $finding->rampInspection;

        $pdf = Pdf::loadView('auditor.rampinspection.finding.reply.pdf', compact('rampInspection', 'finding', 'reply'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('RampInspectionReply.pdf');
    }

    public function downloadRampReplies($replyId)
    {
        $reply = RampInspectionReply::with('rampInspectionFinding.rampInspection')->findOrFail($replyId);
        $finding = $reply->rampInspectionFinding;
        $rampInspection = $finding->rampInspection;

        $pdf = Pdf::loadView('auditor.rampinspection.finding.reply.pdf', compact('rampInspection', 'finding', 'reply'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('RampInspectionReply.pdf');
    }

    public function exportRepliesOfRampFindingByDateRange(Request $request, $findingId)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Please select start and end dates.');
        }

        $finding = RampInspectionFinding::with([
            'rampInspection',
            'rampInspectionReply' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        ])->findOrFail($findingId);

        $rampInspection = $finding->rampInspection;
        $replies = $finding->rampInspectionReply;

        if ($replies->isEmpty()) {
            return redirect()->back()->with('error', 'No replies found in the selected date range.');
        }

        return Pdf::loadView('auditor.rampinspection.finding.reply.range_pdf', compact('rampInspection', 'finding', 'replies', 'startDate', 'endDate'))
            ->setPaper('a4', 'landscape')
            ->stream('RampFindingRepliesRange.pdf');
    }

    public function importRampReplies(Request $request, $findingId)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new RampReplyImport($findingId), $request->file('excel_file'));

        return back()->with('success', 'Replies imported successfully.');
    }

    public function exportRampRepliesExcelByDateRange(Request $request, $findingId)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            return back()->with('error', 'Please select start and end dates.');
        }

        return Excel::download(new RampReplyExport($findingId, $startDate, $endDate), 'RampFindingReplies.xlsx');
    }
}
