<?php

namespace App\Imports;

use App\Models\AuditFinding;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuditFindingImport implements ToModel, WithHeadingRow
{
    protected $auditId;

    public function __construct($auditId)
    {
        $this->auditId = $auditId;
    }

    public function model(array $row)
    {
        return new AuditFinding([
            'audit_id'           => $this->auditId,
            'finding_number'     => $row['finding_no'],
            'rule_reference'     => $row['rule_ref'],
            'finding'            => $row['finding'],
            'target_dates'       => $this->parseDate($row['target_date']),
            'auditor'            => $row['auditor'],
            'finding_level'      => $row['level'],
            'nature_of_finding'  => $row['nature'],
            'repeated_finding'   => $row['repeated'],
            'status'             => $row['status'],
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
