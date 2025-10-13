<?php
namespace App\Exports;

use App\Models\AuditFinding;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuditFindingExport implements FromCollection, WithHeadings
{
    protected $auditId;
    protected $start;
    protected $end;

    public function __construct($auditId, $start, $end)
    {
        $this->auditId = $auditId;
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return AuditFinding::with('audit')
            ->where('audit_id', $this->auditId)
            ->whereBetween('target_dates', [$this->start, $this->end])
            ->get()
            ->map(function ($finding) {
                return [
                    'Finding No.' => $finding->finding_number,
                    'Rule Ref'    => $finding->rule_reference,
                    'Finding'     => $finding->finding,
                    'Target Date' => $finding->target_dates,
                    'Auditor'     => $finding->auditor,
                    'Level'       => $finding->finding_level,
                    'Nature'      => $finding->nature_of_finding,
                    'Repeated'    => $finding->repeated_finding ? 'Yes' : 'No',
                    'Status'      => $finding->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Finding No.',
            'Rule Ref',
            'Finding',
            'Target Date',
            'Auditor',
            'Level',
            'Nature',
            'Repeated',
            'Status',
        ];
    }
}
