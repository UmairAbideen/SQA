<?php

namespace App\Imports;

use App\Models\Staff;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StaffImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Staff([
            'user_id'        => $row['user_id'],
            'auth_type'      => $row['auth_type'],
            'auth_no'        => $row['auth_no'],
            'function'       => $row['function'],
            'ini_issue_date' => $this->parseDate($row['ini_issue_date']),
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
