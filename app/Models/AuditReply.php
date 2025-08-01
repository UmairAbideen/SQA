<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditReply extends Model
{
    use HasFactory;


    protected $fillable = [
        'audit_finding_id', // Foreign key to AuditFinding
        'date', // Date of reply
        'time', // Time of reply
        'reply', // Reply content
        'root_cause', // Root cause analysis
        'corrective_action', // Corrective action taken
        'preventive_action', // Preventive measures
        'reply_by', // Person who replied
        'attachment', // Attachment file path
        'attachment_detail', // Details of the attachment
        'target_date_after_extension', // Target date after extension
        'qa_remarks', // QA remarks
        'closed_by', // Person who closed the issue
        'final_remarks', // Final remarks
        'status', // Status of the reply
        'closing_date', // Closing date of the reply
        'closing_remarks', // Closing remarks
    ];

    public function auditFinding()
    {
        return $this->belongsTo(AuditFinding::class);
    }
}
