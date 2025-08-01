<?php

namespace App\Imports;

use App\Models\AircraftCertifyingStaff;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AircraftCertifyingStaffImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip row if staff_id or aml_no is missing
        if (empty($row['staff_id']) || empty($row['aml_no'])) {
            return null;
        }

        return new AircraftCertifyingStaff([
            'staff_id'    => $row['staff_id'],
            'aml_no'      => $row['aml_no'],
            'aircraft'    => $row['aircraft'],
            'cat'         => $row['cat'],
            'scope'       => $row['scope'],
            'privileges'  => $row['privileges'],
            'aml_expiry'  => $this->parseDate($row['aml_expiry']),
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
