<?php

namespace App\Imports;

use App\Models\ComponentCertifyingStaff;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ComponentCertifyingStaffImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip if essential fields are missing
        if (empty($row['staff_id']) || empty($row['component_rating'])) {
            return null;
        }

        return new ComponentCertifyingStaff([
            'staff_id'         => $row['staff_id'],
            'component_rating' => $row['component_rating'],
            'cma_no'           => $row['cma_no'],
            'scope'            => $row['scope'],
            'limitation'       => $row['limitation'],
        ]);
    }
}
