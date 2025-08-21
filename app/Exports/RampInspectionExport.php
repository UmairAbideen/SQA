<?php

namespace App\Exports;

use App\Models\RampInspection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RampInspectionExport implements FromCollection, WithHeadings
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return RampInspection::whereBetween('date', [$this->start, $this->end])
            ->orderBy('date', 'asc')
            ->get([
                'date',
                'inspection_time',
                'aircraft_reg',
                'aircraft_type',
                'arrival_station',
                'destination',
                'flight_no',
                'bay_no',
                'inspection_ref_no',
                'inspection_type',
                'inspector',
                'status',
            ]);
    }

    public function headings(): array
    {
        return [
            'Date',
            'Inspection Time',
            'Aircraft Reg',
            'Aircraft Type',
            'Arrival Station',
            'Destination',
            'Flight No',
            'Bay No',
            'Inspection Ref No',
            'Inspection Type',
            'Inspector',
            'Status',
        ];
    }
}
