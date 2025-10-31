<?php

namespace App\Imports;

use App\Models\RampInspectionReply;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RampReplyImport implements ToCollection, WithHeadingRow
{
    protected $findingId;

    public function __construct($findingId)
    {
        $this->findingId = $findingId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            RampInspectionReply::create([
                'ramp_inspection_finding_id' => $this->findingId,
                'reply' => $row['reply'],
                'reply_by' => $row['reply_by'],
                'remarks' => $row['remarks'],
                'remarks_by' => $row['remarks_by'],
                'draft' => $row['draft'],
                'status' => $row['status'],
            ]);
        }
    }
}
