<?php

namespace App\Imports;

use App\Models\TrainingRecordSes;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrainingRecordSESImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['staff_id'])) {
            return null;
        }

        return new TrainingRecordSes([
            'staff_id' => $row['staff_id'],
            'hf'       => $this->parseDate($row['hf']),
            'op'       => $this->parseDate($row['op']),
            'cdccl'    => $this->parseDate($row['cdccl']),
            'tt'       => $this->parseDate($row['tt']),
            'sms'      => $this->parseDate($row['sms']),
            'ewis'     => $this->parseDate($row['ewis']),
            'al'       => $this->parseDate($row['al']),
            'at_1'     => $this->parseDate($row['at_1']),
            'at_2'     => $this->parseDate($row['at_2']),
            'at_3'     => $this->parseDate($row['at_3']),
            'at_4'     => $this->parseDate($row['at_4']),
        ]);
    }

    private function parseDate($value)
    {
        if (is_numeric($value)) {
            // Excel numeric format (e.g., 45000)
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
        }

        try {
            // Try parsing typical date string (e.g., '2024-07-25')
            return Carbon::parse($value);
        } catch (\Exception $e) {
            return null; // Skip if invalid
        }
    }
}
