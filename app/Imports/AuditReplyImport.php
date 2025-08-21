<?php

namespace App\Imports;

use App\Models\AuditReply;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AuditReplyImport implements ToModel, WithHeadingRow
{
    protected $findingId;

    public function __construct($findingId)
    {
        $this->findingId = $findingId;
    }

    public function model(array $row)
    {
        return new AuditReply([
            'audit_finding_id'          => $this->findingId,
            'date'                      => $this->parseDate($row['date']),
            'time'                      => $row['time'],
            'reply'                     => $row['reply'],
            'root_cause'                => $row['root_cause'],
            'corrective_action'         => $row['corrective_action'],
            'preventive_action'         => $row['preventive_action'],
            'reply_by'                  => $row['reply_by'],
            // 'attachment'                => $row['attachment'],
            // 'attachment_detail'         => $row['attachment_detail'],
            'target_date_after_extension' => $this->parseDate($row['target_date_after_extension']),
            'qa_remarks'                => $row['qa_remarks'],
            'closed_by'                 => $row['closed_by'],
            'final_remarks'             => $row['final_remarks'],
            'status'                    => $row['status'],
            'closing_date'              => $this->parseDate($row['closing_date']),
            'closing_remarks'           => $row['closing_remarks'],
        ]);
    }


    private function parseDate($value)
    {
        if (is_numeric($value)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
        }

        try {
            return Carbon::parse($value);
        } catch (\Exception $e) {
            return null;
        }
    }
}
