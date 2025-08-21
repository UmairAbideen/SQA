<?php

namespace App\Imports;

use App\Models\RampInspection;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RampInspectionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new RampInspection([
            'date'              => $this->parseDate($row['date']),
            'inspection_time'   => $row['inspection_time'],
            'aircraft_reg'      => $row['aircraft_reg'],
            'aircraft_type'     => $row['aircraft_type'],
            'arrival_station'   => $row['arrival_station'],
            'destination'       => $row['destination'],
            'flight_no'         => $row['flight_no'],
            'bay_no'            => $row['bay_no'],
            'inspection_ref_no' => $row['inspection_ref_no'],
            'inspection_type'   => $row['inspection_type'],
            'inspector'         => $row['inspector'],
            'status'            => $row['status'],
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
