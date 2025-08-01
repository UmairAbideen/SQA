<?php

namespace App\Imports;

use App\Models\AuthorizedStandardLabPersonnel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuthorizedStandardLabPersonnelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['staff_id']) || empty($row['scope'])) {
            return null; // Skip incomplete rows
        }

        return new AuthorizedStandardLabPersonnel([
            'staff_id' => $row['staff_id'],
            'scope'    => $row['scope'],
        ]);
    }
}
