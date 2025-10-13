<?php

namespace App\Exports;

use App\Models\RampInspectionFinding;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RampFindingExport implements FromCollection, WithHeadings
{
    protected $rampId;
    protected $start;
    protected $end;

    public function __construct($rampId, $start, $end)
    {
        $this->rampId = $rampId;
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return RampInspectionFinding::where('ramp_inspection_id', $this->rampId)
            ->whereBetween('created_at', [$this->start, $this->end])
            ->select('code', 'category', 'finding', 'status', 'closed_by', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Code',
            'Category',
            'Finding',
            'Status',
            'Closed By',
            'Created At',
        ];
    }
}
