<?php

namespace App\Imports;

use App\Models\Audit;
use App\Models\AuditFinding;
use App\Models\AuditReply;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class AuditImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // 1. Create or fetch the Audit
            $audit = Audit::firstOrCreate(
                [
                    'audit_reference' => $row['audit_reference'], // use a unique field
                ],
                [
                    'organization'    => $row['organization'] ?? null,
                    'audit_type'      => $row['audit_type'] ?? null,
                    'section'         => $row['section'] ?? null,
                    'location'        => $row['location'] ?? null,
                    'audit_date'      => $this->parseDate($row['audit_date']),
                    'status'          => $row['audit_status'] ?? 'open',
                ]
            );

            // 2. Create or fetch the Finding under this Audit
            $finding = AuditFinding::firstOrCreate(
                [
                    'audit_id'        => $audit->id,
                    'finding_number'  => $row['finding_number'], // unique for audit
                ],
                [
                    'rule_reference'  => $row['rule_reference'] ?? null,
                    'finding'         => $row['finding'] ?? null,
                    'target_dates'    => $this->parseDate($row['target_dates']),
                    'finding_level'   => $row['finding_level'] ?? null,
                    'repeated_finding' => $row['repeated_finding'] ?? null,
                    'nature_of_finding' => $row['nature_of_finding'] ?? null,
                    'auditor'         => $row['auditor'] ?? null,
                    'status'          => $row['finding_status'] ?? 'open',
                ]
            );

            // 3. Insert a Reply for this Finding
            AuditReply::create([
                'audit_finding_id'        => $finding->id,
                'date'                    => $this->parseDate($row['reply_date']),
                'time'                    => $row['reply_time'] ?? null,
                'reply'                   => $row['reply'] ?? null,
                'root_cause'              => $row['root_cause'] ?? null,
                'corrective_action'       => $row['corrective_action'] ?? null,
                'preventive_action'       => $row['preventive_action'] ?? null,
                'reply_by'                => $row['reply_by'] ?? null,
                // 'attachment'              => $row['reply_attachment'] ?? null,
                // 'attachment_detail'       => $row['attachment_detail'] ?? null,
                'target_date_after_extension' => $this->parseDate($row['target_date_after_extension']),
                'qa_remarks'              => $row['qa_remarks'] ?? null,
                'closed_by'               => $row['closed_by'] ?? null,
                'final_remarks'           => $row['final_remarks'] ?? null,
                'status'                  => $row['reply_status'] ?? 'pending',
                'closing_date'            => $this->parseDate($row['closing_date']),
                'closing_remarks'         => $row['closing_remarks'] ?? null,
            ]);
        }
    }

    private function parseDate($value)
    {
        if (empty($value)) return null;

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
