<?php

namespace App\Exports;


use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return User::select([
            'id',
            'username',
            'email',
            'org',
            'ses_no',
            'role',
            'department',
            'designation',
            'approval',
            'status',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'username',
            'email',
            'org',
            'ses_no',
            'role',
            'department',
            'designation',
            'approval',
            'status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Row 1 (headings) will be bold
        ];
    }
}
