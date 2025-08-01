<?php

namespace App\Imports;

use App\Models\StoreQualityInspector;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StoreQualityInspectorImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['staff_id']) || empty($row['category'])) {
            return null;
        }

        return new StoreQualityInspector([
            'staff_id' => $row['staff_id'],
            'category' => $row['category'],
            'scope'    => $row['scope'],
        ]);
    }
}
