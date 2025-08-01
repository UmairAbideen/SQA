<?php

namespace App\Imports;

use App\Models\QualifyingMechanic;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QualifyingMechanicImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['staff_id']) || empty($row['category'])) {
            return null;
        }

        return new QualifyingMechanic([
            'staff_id'  => $row['staff_id'],
            'category'  => $row['category'],
            'auth_date' => $this->parseDate($row['auth_date']),
            'scope'     => $row['scope'],
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
