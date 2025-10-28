<?php

namespace App\Http\Controllers\Director;

use App\Models\Audit;
use App\Models\AuditReply;
use App\Exports\AuditExport;
use App\Imports\AuditImport;
use App\Models\AuditFinding;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AuditReplyExport;
use App\Imports\AuditReplyImport;
use App\Exports\AuditFindingExport;
use App\Imports\AuditFindingImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\AuditFindingReminderMail;
use Illuminate\Support\Facades\Storage;

class DirectorAuditController extends Controller
{
    // ================================ Director Audit  ======================================

    public function view()
    {
        $audits = Audit::with('finding')->get();
        return view('director.audit.view', compact('audits'));
    }

    public function form()
    {
        return view('director.audit.add'); // Return form view for adding audits
    }

    public function create(Request $request)
    {
        $request->validate([
            'organization' => 'nullable|string|max:255', // Organization name
            'audit_reference' => 'nullable|string|max:255', // Audit reference
            'audit_type' => 'nullable|string|max:255', // Type of audit
            'section' => 'nullable|string|max:255', // Section involved
            'location' => 'nullable|string|max:255', // Audit location
            'audit_date' => 'required|date', // Date of audit
        ]);

        Audit::create([
            'organization' => $request->organization,
            'audit_reference' => $request->audit_reference,
            'audit_type' => $request->audit_type,
            'section' => $request->section,
            'location' => $request->location,
            'audit_date' => $request->audit_date,
            'status' => 'Open',
            'created_at' => now(),
        ]);

        return redirect()
            ->route('director.audit.view')
            ->with('status', 'New audit record has been created successfully.');
    }

    public function edit($id)
    {
        $audit = Audit::find($id);
        return view('director.audit.update', ['audit' => $audit]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'organization' => 'nullable|string|max:255', // Organization name
            'audit_reference' => 'nullable|string|max:255', // Audit reference
            'audit_type' => 'nullable|string|max:255', // Type of audit
            'section' => 'nullable|string|max:255', // Section involved
            'location' => 'nullable|string|max:255', // Audit location
            'audit_date' => 'required|date', // Date of audit
            'status' => 'nullable|string|max:255',
        ]);

        $audit = Audit::findOrFail($id);

        $audit->update([
            'organization' => $request->organization,
            'audit_reference' => $request->audit_reference,
            'audit_type' => $request->audit_type,
            'section' => $request->section,
            'location' => $request->location,
            'audit_date' => $request->audit_date,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('director.audit.view')
            ->with('status', 'Audit record has been updated successfully.');
    }

    public function delete($id)
    {
        $audit = Audit::find($id);
        $audit->delete();
        return back()->with('status', 'Audit record has been removed.');
    }

    public function generatePdf($id)
    {
        $audit = Audit::findOrFail($id);

        return Pdf::loadView('director.audit.pdf', compact('audit'))
            ->setPaper('a4', 'landscape')
            ->stream('Audit.pdf');
    }

    public function downloadPdf($id)
    {
        $audit = Audit::findOrFail($id);

        return Pdf::loadView('director.audit.pdf', compact('audit'))
            ->setPaper('a4', 'landscape')
            ->download('Audit.pdf');
    }

    public function exportAuditsByDate(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        $audits = Audit::whereBetween('audit_date', [$start, $end])
            ->orderBy('audit_date', 'asc')
            ->get();

        if ($audits->isEmpty()) {
            return redirect()->back()->with('error', 'No audits found in the selected date range.');
        }

        return Pdf::loadView('director.audit.range_pdf', compact('audits', 'start', 'end'))
            ->setPaper('a4', 'landscape')
            ->stream('Audits_' . $start . '_to_' . $end . '.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new AuditImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'Audit records imported successfully.');
    }

    public function exportExcelByDate(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        return Excel::download(new AuditExport($start, $end), 'Audits_' . $start . '_to_' . $end . '.xlsx');
    }











































    // ================================ Findings for Audit (Director) ======================================

    public function findingView($id)
    {
        $audit = Audit::with('finding')->find($id);
        return view('director.audit.finding.view', ['audits' => $audit]);
    }

    // Show only Open findings for an audit
    public function findingViewOpen($id)
    {
        $audit = Audit::with(['finding' => function ($query) {
            $query->where('status', 'Open');
        }])->findOrFail($id);

        return view('director.audit.finding.view', ['audits' => $audit]);
    }

    // Show only Closed findings for an audit
    public function findingViewClose($id)
    {
        $audit = Audit::with(['finding' => function ($query) {
            $query->where('status', 'Close');
        }])->findOrFail($id);

        return view('director.audit.finding.view', ['audits' => $audit]);
    }

    public function findingForm($id)
    {
        $audit = Audit::find($id);
        return view('director.audit.finding.add', ['audit' => $audit]);
    }

    public function findingCreate(Request $request)
    {
        // Validate input and file
        $request->validate([
            'rule_reference' => 'nullable|string|max:255',
            'finding' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'target_dates' => 'nullable|date',
            'finding_number' => 'nullable|string|max:255',
            'finding_level' => 'nullable|string|max:255',
            'repeated_finding' => 'required',
            'nature_of_finding' => 'nullable|string|max:255',
            'auditor' => 'nullable|string|max:255',
        ]);

        // Find related audit
        $audit = Audit::findOrFail($request->audit_id);

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/finding/attachments',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        // Get authenticated username
        $currentUserName = auth()->user()->username ?? 'System';

        // Auto-fill auditor name if nature_of_finding is provided
        $auditorName = !empty($request->nature_of_finding) ? $currentUserName : $request->auditor;

        // Create finding
        $audit->finding()->create([
            'rule_reference' => $request->rule_reference,
            'finding' => $request->finding,
            'attachment' => $attachmentPath,
            'target_dates' => $request->target_dates,
            'finding_number' => $request->finding_number,
            'finding_level' => $request->finding_level,
            'repeated_finding' => $request->repeated_finding,
            'nature_of_finding' => $request->nature_of_finding,
            'auditor' => $auditorName,
            'status' => 'Open',
            'created_at' => now(),
        ]);

        // Redirect back to finding view of the same audit
        return redirect()
            ->route('director.audit.finding.view', $audit->id)
            ->with('status', 'Audit Finding has been created successfully.');
    }

    public function findingEdit($id)
    {
        $finding = AuditFinding::findOrFail($id);
        $audit = Audit::findOrFail($finding->audit_id);
        return view('director.audit.finding.update', ['finding' => $finding, 'audit' => $audit]);
    }

    public function findingUpdate(Request $request, $id)
    {
        $request->validate([
            'rule_reference' => 'nullable|string|max:255',
            'finding' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'target_dates' => 'nullable|date',
            'finding_number' => 'nullable|string|max:255',
            'finding_level' => 'nullable|string|max:255',
            'repeated_finding' => 'required',
            'nature_of_finding' => 'nullable|string|max:255',
            'auditor' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $auditFinding = AuditFinding::findOrFail($id);

        // Keep existing attachment by default
        $attachmentPath = $auditFinding->attachment;

        // Replace with new one if uploaded
        if ($request->hasFile('attachment')) {
            if ($auditFinding->attachment && Storage::disk('public')->exists($auditFinding->attachment)) {
                Storage::disk('public')->delete($auditFinding->attachment);
            }

            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/finding/attachments',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        // Get authenticated username
        $currentUserName = auth()->user()->username ?? 'System';

        // Auto-fill auditor name if nature_of_finding is provided
        $auditorName = !empty($request->nature_of_finding) ? $currentUserName : $request->auditor;

        // Update finding record
        $auditFinding->update([
            'rule_reference' => $request->rule_reference,
            'finding' => $request->finding,
            'target_dates' => $request->target_dates,
            'finding_number' => $request->finding_number,
            'finding_level' => $request->finding_level,
            'repeated_finding' => $request->repeated_finding,
            'nature_of_finding' => $request->nature_of_finding,
            'auditor' => $auditorName,
            'status' => $request->status,
            'attachment' => $attachmentPath,
            'updated_at' => now(),
        ]);

        $audit = $auditFinding->audit; // use relation to get parent audit

        // Redirect back to the same audit’s finding list
        return redirect()
            ->route('director.audit.finding.view', $audit->id)
            ->with('status', 'Audit Finding has been updated successfully.');
    }

    public function findingDelete($id)
    {
        $finding = AuditFinding::findOrFail($id);
        $finding->delete();

        return back()->with('status', 'Audit Finding has been deleted successfully (Director).');
    }

    public function printAuditFindings($findingId)
    {
        $finding = AuditFinding::with('audit')->findOrFail($findingId);
        $audit = $finding->audit;

        $pdf = Pdf::loadView('director.audit.finding.pdf', compact('audit', 'finding'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('AuditFindings.pdf');
    }

    public function downloadAuditFindings($findingId)
    {
        $finding = AuditFinding::with('audit')->findOrFail($findingId);
        $audit = $finding->audit;

        $pdf = Pdf::loadView('director.audit.finding.pdf', compact('audit', 'finding'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('AuditFindings.pdf');
    }

    public function exportAuditFindingsByDateRange(Request $request, $auditId)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        $audit = Audit::with('finding')->findOrFail($auditId);

        $findings = $audit->finding()
            ->whereBetween('target_dates', [$startDate, $endDate])
            ->get();

        if ($findings->isEmpty()) {
            return redirect()->back()->with('error', 'No findings found for this audit in the selected date range.');
        }

        $pdf = Pdf::loadView('director.audit.finding.range_pdf', compact('findings', 'startDate', 'endDate', 'audit'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('AuditFindingsRange.pdf');
    }

    public function importAuditFindings(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
            'audit_id'   => 'required|exists:audits,id',
        ]);

        Excel::import(new AuditFindingImport($request->audit_id), $request->file('excel_file'));

        return redirect()->back()->with('success', 'Findings imported successfully (Director).');
    }

    public function exportFindingsByDate(Request $request, $auditId)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return redirect()->back()->with('error', 'Please select both start and end dates.');
        }

        return Excel::download(
            new AuditFindingExport($auditId, $start, $end),
            "AuditFindings_{$auditId}_{$start}_to_{$end}.xlsx"
        );
    }

    public function sendFindingEmail(Request $request, $id)
    {
        $finding = AuditFinding::with('audit')->findOrFail($id);

        $request->validate([
            'to' => 'required|email',
            'cc' => 'nullable|string',
            'bcc' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $cc = $request->cc ? array_map('trim', explode(',', $request->cc)) : [];
        $bcc = $request->bcc ? array_map('trim', explode(',', $request->bcc)) : [];

        Mail::to($request->to)
            ->cc($cc)
            ->bcc($bcc)
            ->send(new AuditFindingReminderMail($finding, $request->subject, $request->body));

        return back()->with('status', 'Email sent successfully (Director).');
    }






































    //=============================== Director Reply ===============================

    public function replyView($id)
    {
        $auditFinding = AuditFinding::with(['reply' => function ($query) {
            $query->where('draft', 'no')
            ->orWhereNull('draft'); // Only include non-draft replies
        }])
            ->with('audit')
            ->where('id', $id)
            ->firstOrFail();

        return view('director.audit.finding.reply.view', [
            'auditFindings' => $auditFinding,
        ]);
    }

    public function ReplyForm($id)
    {
        $auditFinding = AuditFinding::find($id);

        return view('director.audit.finding.reply.add', [
            'auditFinding' => $auditFinding,
        ]);
    }


    public function replyCreate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'nullable',
            'reply' => 'required|string',
            'root_cause' => 'required|string',
            'corrective_action' => 'required|string',
            'preventive_action' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'attachment_detail' => 'nullable|string',
            'target_date_after_extension' => 'nullable|date',
            'qa_remarks' => 'nullable|string',
            'final_remarks' => 'nullable|string',
            'finding_id' => 'required|exists:audit_findings,id',
        ]);

        $auditFinding = AuditFinding::findOrFail($request->finding_id);

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/reply/attachment',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        // Automatically set reply_by if preventive_action is filled
        $currentUserName = auth()->user()->username ?? 'System';
        $replyBy = !empty($request->preventive_action) ? $currentUserName : $request->reply_by;

        // Create the reply
        $auditFinding->reply()->create([
            'date' => $request->date,
            'time' => $request->time,
            'reply' => $request->reply,
            'root_cause' => $request->root_cause,
            'corrective_action' => $request->corrective_action,
            'preventive_action' => $request->preventive_action,
            'reply_by' => $replyBy,
            'attachment' => $attachmentPath,
            'attachment_detail' => $request->attachment_detail,
            'target_date_after_extension' => $request->target_date_after_extension,
            'qa_remarks' => $request->qa_remarks,
            'final_remarks' => $request->final_remarks,
            'status' => 'Open',
            'created_at' => now(),
        ]);

        return redirect()
            ->route('director.audit.finding.reply.view', $auditFinding->id)
            ->with('status', 'Finding Reply has been created successfully.');
    }


    public function ReplyEdit($id)
    {
        $auditReply = AuditReply::with('auditFinding')
            ->where('id', $id)
            ->first();

        return view('director.audit.finding.reply.update', ['auditReply' => $auditReply]);
    }

    public function replyUpdate(Request $request, $id)
    {
        $request->validate([
            'date' => 'nullable|date',
            'time' => 'nullable',
            'reply' => 'nullable|string',
            'root_cause' => 'nullable|string',
            'corrective_action' => 'nullable|string',
            'preventive_action' => 'nullable|string',
            'reply_by' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'attachment_detail' => 'nullable|string',
            'target_date_after_extension' => 'nullable|date',
            'qa_remarks' => 'nullable|string',
            'final_remarks' => 'nullable|string',
            'closing_date' => 'nullable|date',
            'closing_remarks' => 'nullable|string',
            'closed_by' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $reply = AuditReply::findOrFail($id);
        $auditFinding = $reply->auditFinding; // Assuming relation is defined in model

        // Handle file attachment update
        $attachmentPath = $reply->attachment;
        if ($request->hasFile('attachment')) {
            if ($reply->attachment && Storage::disk('public')->exists($reply->attachment)) {
                Storage::disk('public')->delete($reply->attachment);
            }

            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/reply/attachment',
                time() . '_' . $request->file('attachment')->getClientOriginalName(),
                'public'
            );
        }

        // Get current authenticated username
        $currentUserName = auth()->user()->username ?? 'System';

        // Automatically fill reply_by if preventive_action is filled
        $replyBy = !empty($request->preventive_action)
            ? $currentUserName
            : $request->reply_by;

        // Automatically fill closed_by and closing_date if status is "Close"
        $isClosed = strtolower($request->status) === 'close';
        $closedBy = $isClosed ? $currentUserName : $request->closed_by;
        $closingDate = $isClosed ? now()->toDateString() : $request->closing_date;

        // Update the record
        $reply->update([
            'date' => $request->date,
            'time' => $request->time,
            'reply' => $request->reply,
            'root_cause' => $request->root_cause,
            'corrective_action' => $request->corrective_action,
            'preventive_action' => $request->preventive_action,
            'reply_by' => $replyBy,
            'attachment' => $attachmentPath,
            'attachment_detail' => $request->attachment_detail,
            'target_date_after_extension' => $request->target_date_after_extension,
            'qa_remarks' => $request->qa_remarks,
            'final_remarks' => $request->final_remarks,
            'closing_date' => $closingDate,
            'closing_remarks' => $request->closing_remarks,
            'closed_by' => $closedBy,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('director.audit.finding.reply.view', $auditFinding->id)
            ->with('status', 'Finding Reply has been updated successfully.');
    }

    public function ReplyDelete($id)
    {
        $auditReply = AuditReply::find($id);

        if ($auditReply->attachment && Storage::disk('public')->exists($auditReply->attachment)) {
            Storage::disk('public')->delete($auditReply->attachment);
        }

        $auditReply->delete();

        return back()->with('status', 'Reply has been removed.');
    }

    public function PrintAuditReplies($replyId)
    {
        $reply = AuditReply::with('auditFinding.audit')->findOrFail($replyId);
        $finding = $reply->auditFinding;
        $audit = $finding->audit;

        $pdf = Pdf::loadView('director.audit.finding.reply.pdf', compact('audit', 'finding', 'reply'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('AuditFindingReply.pdf');
    }

    public function DownloadAuditReplies($replyId)
    {
        $reply = AuditReply::with('auditFinding.audit')->findOrFail($replyId);
        $finding = $reply->auditFinding;
        $audit = $finding->audit;

        $pdf = Pdf::loadView('director.audit.finding.reply.pdf', compact('audit', 'finding', 'reply'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('AuditFindingReply.pdf');
    }

    public function ExportRepliesOfFindingByDateRange(Request $request, $findingId)
    {
        $startDate = $request->query('start_date');
        $endDate   = $request->query('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Please select start and end dates.');
        }

        $finding = AuditFinding::with(['audit', 'reply' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }])->findOrFail($findingId);

        $replies = $finding->reply;

        if ($replies->isEmpty()) {
            return redirect()->back()->with('error', 'No replies found in the selected date range.');
        }

        $audit = $finding->audit;

        return Pdf::loadView('director.audit.finding.reply.range_pdf', compact('audit', 'finding', 'replies', 'startDate', 'endDate'))
            ->setPaper('a4', 'landscape')
            ->stream('FindingRepliesRange.pdf');
    }

    public function ImportAuditReplies(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
            'finding_id' => 'required|exists:audit_findings,id',
        ]);

        Excel::import(new AuditReplyImport($request->finding_id), $request->file('excel_file'));

        return redirect()->back()->with('success', 'Replies imported successfully.');
    }

    public function ExportRepliesExcel(Request $request, $findingId)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'Please select start and end dates.');
        }

        return Excel::download(new AuditReplyExport($findingId, $startDate, $endDate), 'AuditReplies.xlsx');
    }
}
