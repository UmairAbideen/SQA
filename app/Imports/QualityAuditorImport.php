<?php

namespace App\Imports;

use App\Models\QualityAuditor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QualityAuditorImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip if required field is missing
        if (empty($row['staff_id']) || empty($row['scope'])) {
            return null;
        }

        return new QualityAuditor([
            'staff_id' => $row['staff_id'],
            'scope'    => $row['scope'],
        ]);
    }
}
