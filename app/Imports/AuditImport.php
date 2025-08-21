<?php

namespace App\Imports;

use App\Models\Audit;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuditImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Audit([
            'organization'     => $row['organization'],
            'audit_reference'  => $row['audit_reference'],
            'audit_type'       => $row['audit_type'],
            'section'          => $row['section'],
            'location'         => $row['location'],
            'audit_date'       => $this->parseDate($row['audit_date']),
            'status'           => $row['status'],
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
