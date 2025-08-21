<?php

namespace App\Exports;

use App\Models\Audit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuditExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($start, $end)
    {
        $this->startDate = $start;
        $this->endDate = $end;
    }

    public function collection()
    {
        return Audit::whereBetween('audit_date', [$this->startDate, $this->endDate])
            ->select('id', 'organization', 'audit_reference', 'audit_type', 'section', 'location', 'audit_date', 'status')
            ->orderBy('audit_date', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return ['Id', 'Organization', 'Audit Reference', 'Audit Type', 'Section', 'Location', 'Audit Date', 'Status'];
    }
}
