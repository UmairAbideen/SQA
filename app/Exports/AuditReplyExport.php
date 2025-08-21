<?php

namespace App\Exports;

use App\Models\AuditReply;
use Maatwebsite\Excel\Concerns\FromCollection;

namespace App\Exports;

use App\Models\AuditReply;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuditReplyExport implements FromCollection, WithHeadings
{
    protected $findingId;
    protected $startDate;
    protected $endDate;

    public function __construct($findingId, $startDate, $endDate)
    {
        $this->findingId = $findingId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return AuditReply::where('audit_finding_id', $this->findingId)
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->get([
                'date',
                'time',
                'reply',
                'root_cause',
                'corrective_action',
                'preventive_action',
                'reply_by',
                // 'attachment',
                // 'attachment_detail',
                'target_date_after_extension',
                'qa_remarks',
                'closed_by',
                'final_remarks',
                'status',
                'closing_date',
                'closing_remarks'
            ]);
    }

    public function headings(): array
    {
        return [
            'Date',
            'Time',
            'Reply',
            'Root Cause',
            'Corrective Action',
            'Preventive Action',
            'Reply By',
            // 'Attachment',
            // 'Attachment Detail',
            'Target Date After Extension',
            'QA Remarks',
            'Closed By',
            'Final Remarks',
            'Status',
            'Closing Date',
            'Closing Remarks',
        ];
    }
}
