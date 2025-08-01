<?php

namespace App\Imports;

use App\Models\AuthorizedAuditor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuthorizedAuditorImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip if required data is missing
        if (empty($row['staff_id']) || empty($row['scope'])) {
            return null;
        }

        return new AuthorizedAuditor([
            'staff_id' => $row['staff_id'],
            'scope'    => $row['scope'],
        ]);
    }
}
