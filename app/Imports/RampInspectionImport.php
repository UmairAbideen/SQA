<?php

namespace App\Imports;

use App\Models\RampInspection;
use App\Models\RampInspectionFinding;
use App\Models\RampInspectionReply;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RampInspectionImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        // 1️⃣ Find or create RampInspection
        $inspection = RampInspection::firstOrCreate(
            ['inspection_ref_no' => $row['inspection_ref_no']],
            [
                'date'              => $this->parseDate($row['date']),
                'inspection_time'   => $row['inspection_time'] ?? null,
                'aircraft_reg'      => $row['aircraft_reg'] ?? null,
                'aircraft_type'     => $row['aircraft_type'] ?? null,
                'arrival_station'   => $row['arrival_station'] ?? null,
                'destination'       => $row['destination'] ?? null,
                'flight_no'         => $row['flight_no'] ?? null,
                'bay_no'            => $row['bay_no'] ?? null,
                'inspection_type'   => $row['inspection_type'] ?? null,
                'inspector'         => $row['inspector'] ?? null,
                'status'            => $row['status'] ?? 'Open',
            ]
        );

        // 2️⃣ Find or create Finding
        $finding = RampInspectionFinding::firstOrCreate(
            [
                'ramp_inspection_id' => $inspection->id,
                'code' => $row['finding_code'],
            ],
            [
                'category'  => $row['category'] ?? null,
                'finding'   => $row['finding'] ?? null,
                // 'attachment' => $row['finding_attachment'] ?? null,
                'status'    => $row['finding_status'] ?? 'Open',
                'closed_by' => $row['closed_by'] ?? null,
            ]
        );

        // 3️⃣ Create Reply (always create new)
        if (!empty($row['reply'])) {
            RampInspectionReply::create([
                'ramp_inspection_finding_id' => $finding->id,
                'reply'        => $row['reply'],
                'reply_by'     => $row['reply_by'] ?? null,
                'remarks'      => $row['remarks'] ?? null,
                'remarks_by'   => $row['remarks_by'] ?? null,
                // 'attachment'   => $row['reply_attachment'] ?? null,
                'status'       => $row['reply_status'] ?? 'Pending',
            ]);
        }
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
