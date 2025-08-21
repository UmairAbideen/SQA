<?php

namespace App\Exports;

use App\Models\RampInspectionReply;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RampReplyExport implements FromCollection, WithHeadings
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
        return RampInspectionReply::where('ramp_inspection_finding_id', $this->findingId)
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->select('reply', 'reply_by', 'remarks', 'remarks_by', 'status', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return ['Reply', 'Reply By', 'Remarks', 'Remarks By', 'Status', 'Created At'];
    }
}
