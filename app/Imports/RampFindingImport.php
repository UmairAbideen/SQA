<?php

namespace App\Imports;

use App\Models\RampInspectionFinding;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RampFindingImport implements ToModel, WithHeadingRow
{
    protected $rampId;

    public function __construct($rampId)
    {
        $this->rampId = $rampId;
    }

    public function model(array $row)
    {
        return new RampInspectionFinding([
            'ramp_inspection_id' => $this->rampId,  // Injected instead of Excel
            'code' => $row['code'] ?? null,
            'category' => $row['category'] ?? null,
            'finding' => $row['finding'] ?? null,
            // 'attachment' => $row['attachment'] ?? null,
            'status' => $row['status'] ?? null,
            'closed_by' => $row['closed_by'] ?? null,
        ]);
    }
}

