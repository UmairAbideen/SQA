<?php

namespace App\Imports;

use App\Models\TrainingRecordSa;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrainingRecordSaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['staff_id'])) {
            return null;
        }

        return new TrainingRecordSa([
            'staff_id'           => $row['staff_id'],
            'pcca_regulation'    => $this->parseDate($row['pcca_regulation']),
            'mcm'                => $this->parseDate($row['mcm']),
            'amp'                => $this->parseDate($row['amp']),
            'reliability'        => $this->parseDate($row['reliability']),
            'ad_sb'              => $this->parseDate($row['ad_sb']),
            'maintenance'        => $this->parseDate($row['maintenance']),
            'record_keeping'     => $this->parseDate($row['record_keeping']),
            'quality_monitoring' => $this->parseDate($row['quality_monitoring']),
            'level1_training'    => $this->parseDate($row['level1_training']),
            'fuel_tank'          => $this->parseDate($row['fuel_tank']),
            'quality_auditor'    => $this->parseDate($row['quality_auditor']),
            'ramp_insp'          => $this->parseDate($row['ramp_insp']),
            'engine_health'      => $this->parseDate($row['engine_health']),
            'hf'                 => $this->parseDate($row['hf']),
            'sms'                => $this->parseDate($row['sms']),
            'ewis'               => $this->parseDate($row['ewis']),
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
