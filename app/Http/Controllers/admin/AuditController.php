<?php

namespace App\Http\Controllers\admin;

use App\Models\Audit;
use App\Models\AuditReply;
use App\Models\AuditFinding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AuditController extends Controller
{

    // ================================ Audit Findings ======================================

    public function view()
    {
        $audits = Audit::get(); // Fetch all audits
        return view('admin.audit.view', ['audits' => $audits]);
    }


    public function form()
    {
        return view('admin.audit.add'); // Return form view for adding audits
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
            'created_at' => now(),
        ]);

        return back()->with('status', 'Audit record has been created.');
    }


    public function edit($id)
    {
        $audit = Audit::find($id);
        return view('admin.audit.update', ['audit' => $audit]);
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
        ]);

        $audit = Audit::findOrFail($id);

        $audit->update([
            'organization' => $request->organization,
            'audit_reference' => $request->audit_reference,
            'audit_type' => $request->audit_type,
            'section' => $request->section,
            'location' => $request->location,
            'audit_date' => $request->audit_date,
            'updated_at' => now(),
        ]);

        return back()->with('status', 'Audit record has been updated successfully.');
    }


    public function delete($id)
    {
        $audit = Audit::find($id);
        $audit->delete();
        return back()->with('status', 'Audit record has been removed.');
    }






    // ================================ Findings for Audit ======================================

    public function findingView($id)
    {
        $audit = Audit::with('finding')->find($id);
        return view('admin.audit.finding.view', ['audits' => $audit]);
    }


    public function findingForm($id)
    {
        $audit = Audit::find($id);
        return view('admin.audit.finding.add', ['audit' => $audit]);
    }

    public function findingCreate(Request $request)
    {
        // Validate the request input and file attachment
        $request->validate([
            'rule_reference' => 'nullable|string|max:255',
            'finding' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate file type and size
            'target_dates' => 'nullable|date',
            'finding_number' => 'nullable|string|max:255',
            'finding_level' => 'nullable|string|max:255',
            'repeated_finding' => 'required',
            'nature_of_finding' => 'nullable|string|max:255',
            'validity_date' => 'nullable|date',
            'auditor' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // File validation
        ]);

        // Find the associated audit record
        $audit = Audit::findOrFail($request->audit_id);

        // Initialize a variable to store the file path
        $attachmentPath = null;

        // Check if an attachment file was uploaded
        if ($request->hasFile('attachment')) {
            // Store the file in a custom directory with a unique name
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/finding/attachments', // Directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Custom filename
                'public' // Save to the 'public' disk
            );
        }

        // Create a new finding record with the validated data and file path
        $audit->finding()->create([
            'rule_reference' => $request->rule_reference,
            'finding' => $request->finding,
            'attachment' => $attachmentPath, // Save the custom file path in the database
            'target_dates' => $request->target_dates,
            'finding_number' => $request->finding_number,
            'finding_level' => $request->finding_level,
            'repeated_finding' => $request->repeated_finding,
            'nature_of_finding' => $request->nature_of_finding,
            'validity_date' => $request->validity_date,
            'auditor' => $request->auditor,
            'status' => $request->status,
            'attachment' => $attachmentPath, // Save file path in the database
            'created_at' => now(),
        ]);

        // Redirect back with a success message
        return back()->with('status', 'Audit Finding has been created successfully.');
    }


    public function findingEdit($id)
    {
        $finding = AuditFinding::findOrFail($id); // Find the finding by ID
        $audit = Audit::findOrFail($finding->audit_id); // Load related audit
        return view('admin.audit.finding.update', ['finding' => $finding, 'audit' => $audit]);
    }


    public function findingUpdate(Request $request, $id)
    {
        $request->validate([
            'rule_reference' => 'nullable|string|max:255',
            'finding' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate new file upload
            'target_dates' => 'nullable|date',
            'finding_number' => 'nullable|string|max:255',
            'finding_level' => 'nullable|string|max:255',
            'repeated_finding' => 'required',
            'nature_of_finding' => 'nullable|string|max:255',
            'validity_date' => 'nullable|date',
            'auditor' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $auditFinding = AuditFinding::findOrFail($id);

        // Initialize the file path with the existing attachment (retain old file if no new upload)
        $attachmentPath = $auditFinding->attachment;

        if ($request->hasFile('attachment')) {
            // Delete the old attachment if it exists
            if ($auditFinding->attachment && Storage::disk('public')->exists($auditFinding->attachment)) {
                Storage::disk('public')->delete($auditFinding->attachment);
            }

            // Store the new attachment
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/finding/attachments', // Custom directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Unique file name
                'public' // Save to the 'public' disk
            );
        }

        // Update the record with validated data and new attachment path
        $auditFinding->update([
            'rule_reference' => $request->rule_reference,
            'finding' => $request->finding,
            'target_dates' => $request->target_dates,
            'finding_number' => $request->finding_number,
            'finding_level' => $request->finding_level,
            'repeated_finding' => $request->repeated_finding,
            'nature_of_finding' => $request->nature_of_finding,
            'validity_date' => $request->validity_date,
            'auditor' => $request->auditor,
            'status' => $request->status,
            'attachment' => $attachmentPath, // Save the updated attachment path
            'updated_at' => now(),
        ]);

        return back()->with('status', 'Audit Finding has been updated successfully.');
    }


    public function findingDelete($id)
    {
        $finding = AuditFinding::findOrFail($id);
        $finding->delete();

        return back()->with('status', 'Audit Finding has been deleted successfully.');
    }






    //=============================== Reply ===============================

    public function replyView($id)
    {
        $auditFinding = AuditFinding::with('reply')->with('audit')
            ->where('id', $id)
            ->first();
        return view('admin.audit.finding.reply.view', [
            'auditFindings' => $auditFinding,
        ]);
    }


    public function replyForm($id)
    {
        $auditFinding = AuditFinding::find($id);

        return view('admin.audit.finding.reply.add', [
            'auditFinding' => $auditFinding,
        ]);
    }



    public function replyCreate(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date', // Date of reply
            'time' => 'nullable', // Time of reply
            'reply' => 'nullable|string', // Reply content
            'root_cause' => 'nullable|string', // Root cause analysis
            'corrective_action' => 'nullable|string', // Corrective action taken
            'preventive_action' => 'nullable|string', // Preventive measures
            'reply_by' => 'nullable|string|max:255', // Person who replied
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Attachment file
            'attachment_detail' => 'nullable|string', // Attachment details
            'target_date_after_extension' => 'nullable|date', // Target date after extension
            'qa_remarks' => 'nullable|string', // QA remarks
            'closed_by' => 'nullable|string|max:255', // Closed by
            'final_remarks' => 'nullable|string', // Final remarks
            'status' => 'nullable|string|max:255', // Status
            'closing_date' => 'nullable|date', // Closing date
            'closing_remarks' => 'nullable|string', // Closing remarks
        ]);

        $auditFinding = AuditFinding::find($request->finding_id);

        // Check if a reply already exists
        if ($auditFinding->reply) {
            return back()->with('status', 'A Reply for this finding already exists.');
        }

        // Initialize a variable to store the file path
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            // Store the uploaded file in the custom directory
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/reply/attachment', // Custom directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Custom file name
                'public' // Save to the 'public' disk
            );
        }

        $auditFinding->reply()->create([
            'date' => $request->date,
            'time' => $request->time,
            'reply' => $request->reply,
            'root_cause' => $request->root_cause,
            'corrective_action' => $request->corrective_action,
            'preventive_action' => $request->preventive_action,
            'reply_by' => $request->reply_by,
            'attachment' => $attachmentPath,
            'attachment_detail' => $request->attachment_detail,
            'target_date_after_extension' => $request->target_date_after_extension,
            'qa_remarks' => $request->qa_remarks,
            'closed_by' => $request->closed_by,
            'final_remarks' => $request->final_remarks,
            'status' => $request->status,
            'closing_date' => $request->closing_date,
            'closing_remarks' => $request->closing_remarks,
            'created_at' => now(),
        ]);

        return back()->with('status', 'Finding Reply has been Created.');
    }

    public function replyEdit($id)
    {
        $auditReply = AuditReply::with('auditFinding')
            ->where('id', $id)
            ->first();

        return view('admin.audit.finding.reply.update', ['auditReply' => $auditReply]);
    }

    public function replyUpdate(Request $request, $id)
    {
        $request->validate([
            'date' => 'nullable|date', // Date of reply
            'time' => 'nullable', // Time of reply
            'reply' => 'nullable|string', // Reply content
            'root_cause' => 'nullable|string', // Root cause analysis
            'corrective_action' => 'nullable|string', // Corrective action taken
            'preventive_action' => 'nullable|string', // Preventive measures
            'reply_by' => 'nullable|string|max:255', // Person who replied
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Attachment file
            'attachment_detail' => 'nullable|string', // Attachment details
            'target_date_after_extension' => 'nullable|date', // Target date after extension
            'qa_remarks' => 'nullable|string', // QA remarks
            'closed_by' => 'nullable|string|max:255', // Closed by
            'final_remarks' => 'nullable|string', // Final remarks
            'status' => 'nullable|string|max:255', // Status
            'closing_date' => 'nullable|date', // Closing date
            'closing_remarks' => 'nullable|string', // Closing remarks
        ]);

        $reply = AuditReply::find($id);

        // Initialize a variable to store the file path
        $attachmentPath = $reply->attachment;

        if ($request->hasFile('attachment')) {
            // Delete the old attachment if it exists
            if ($reply->attachment && Storage::disk('public')->exists($reply->attachment)) {
                Storage::disk('public')->delete($reply->attachment);
            }

            // Store the new attachment
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/audit/reply/attachment', // Custom directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Custom file name
                'public' // Save to the 'public' disk
            );
        }

        $reply->update([
            'date' => $request->date,
            'time' => $request->time,
            'reply' => $request->reply,
            'root_cause' => $request->root_cause,
            'corrective_action' => $request->corrective_action,
            'preventive_action' => $request->preventive_action,
            'reply_by' => $request->reply_by,
            'attachment' => $attachmentPath,
            'attachment_detail' => $request->attachment_detail,
            'target_date_after_extension' => $request->target_date_after_extension,
            'qa_remarks' => $request->qa_remarks,
            'closed_by' => $request->closed_by,
            'final_remarks' => $request->final_remarks,
            'status' => $request->status,
            'closing_date' => $request->closing_date,
            'closing_remarks' => $request->closing_remarks,
        ]);

        return back()->with('status', 'Finding Reply has been updated successfully.');
    }

    public function replyDelete($id)
    {
        $auditReply = AuditReply::find($id);

        if ($auditReply->attachment && Storage::disk('public')->exists($auditReply->attachment)) {
            Storage::disk('public')->delete($auditReply->attachment);
        }

        $auditReply->delete();

        return back()->with('status', 'Reply has been removed.');
    }
}
