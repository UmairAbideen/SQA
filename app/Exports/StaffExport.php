<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StaffExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return User::with([
            'staff.aircraftCert',
            'staff.componentCert',
            'staff.qualityAuditor',
            'staff.qualifyingMechanic',
            'staff.storeInspector',
            'staff.labPersonnel',
            'staff.trainingSes',
            'staff.auditor',
            'staff.trainingSa',
        ])->get();
    }

    public function headings(): array
    {
        $grouped = [
            'User',
            'User',
            'User',
            'User',
            'Staff',
            'Staff',
            'Staff',
            'Staff',
            'Aircraft Certifying Staff',
            'Aircraft Certifying Staff',
            'Aircraft Certifying Staff',
            'Aircraft Certifying Staff',
            'Aircraft Certifying Staff',
            'Aircraft Certifying Staff',
            'Component Certifying Staff',
            'Component Certifying Staff',
            'Component Certifying Staff',
            'Component Certifying Staff',
            'Quality Auditor',
            'Qualifying Mechanic',
            'Qualifying Mechanic',
            'Qualifying Mechanic',
            'Store Quality Inspector',
            'Store Quality Inspector',
            'Authorized Standard Lab Personnel',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Training Record SES',
            'Authorized Auditor',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
            'Training Record SA',
        ];

        $fields = [
            'user_id',
            'Name',
            'Org.',
            'Ses#',
            'auth_type',
            'auth_no',
            'function',
            'ini_issue_date',
            'aml_no',
            'aircraft',
            'cat',
            'ac_scope',
            'privileges',
            'aml_expiry',
            'component_rating',
            'cma_no',
            'comp_scope',
            'limitation',
            'qa_scope',
            'qm_category',
            'qm_auth_date',
            'qm_scope',
            'sqi_category',
            'sqi_scope',
            'lab_scope',
            'ses_hf',
            'ses_op',
            'ses_cdccl',
            'ses_tt',
            'ses_sms',
            'ses_ewis',
            'ses_al',
            'ses_at_1',
            'ses_at_2',
            'ses_at_3',
            'ses_at_4',
            'auditor_scope',
            'sa_pcca_regulation',
            'sa_mcm',
            'sa_amp',
            'sa_reliability',
            'sa_ad_sb',
            'sa_maintenance',
            'sa_record_keeping',
            'sa_quality_monitoring',
            'sa_level1_training',
            'sa_fuel_tank',
            'sa_quality_auditor',
            'sa_ramp_insp',
            'sa_engine_health',
            'sa_hf',
            'sa_sms',
            'sa_ewis'
        ];

        return [$grouped, $fields];
    }

    public function map($user): array
    {
        $staff = $user->staff;

        return [
            // --- User info (always present) ---
            $user->id,
            $user->username,
            $user->org,
            $user->ses_no,

            // --- Staff info (nullable) ---
            optional($staff)->auth_type,
            optional($staff)->auth_no,
            optional($staff)->function,
            $this->formatDate(optional($staff)->ini_issue_date),

            optional($staff?->aircraftCert)->aml_no,
            optional($staff?->aircraftCert)->aircraft,
            optional($staff?->aircraftCert)->cat,
            optional($staff?->aircraftCert)->scope,
            optional($staff?->aircraftCert)->privileges,
            $this->formatDate(optional($staff?->aircraftCert)->aml_expiry),

            optional($staff?->componentCert)->component_rating,
            optional($staff?->componentCert)->cma_no,
            optional($staff?->componentCert)->scope,
            optional($staff?->componentCert)->limitation,

            optional($staff?->qualityAuditor)->scope,

            optional($staff?->qualifyingMechanic)->category,
            $this->formatDate(optional($staff?->qualifyingMechanic)->auth_date),
            optional($staff?->qualifyingMechanic)->scope,

            optional($staff?->storeInspector)->category,
            optional($staff?->storeInspector)->scope,
            optional($staff?->labPersonnel)->scope,

            $this->formatDate(optional($staff?->trainingSes)->hf),
            $this->formatDate(optional($staff?->trainingSes)->op),
            $this->formatDate(optional($staff?->trainingSes)->cdccl),
            $this->formatDate(optional($staff?->trainingSes)->tt),
            $this->formatDate(optional($staff?->trainingSes)->sms),
            $this->formatDate(optional($staff?->trainingSes)->ewis),
            $this->formatDate(optional($staff?->trainingSes)->al),
            $this->formatDate(optional($staff?->trainingSes)->at_1),
            $this->formatDate(optional($staff?->trainingSes)->at_2),
            $this->formatDate(optional($staff?->trainingSes)->at_3),
            $this->formatDate(optional($staff?->trainingSes)->at_4),

            optional($staff?->auditor)->scope,

            $this->formatDate(optional($staff?->trainingSa)->pcca_regulation),
            $this->formatDate(optional($staff?->trainingSa)->mcm),
            $this->formatDate(optional($staff?->trainingSa)->amp),
            $this->formatDate(optional($staff?->trainingSa)->reliability),
            $this->formatDate(optional($staff?->trainingSa)->ad_sb),
            $this->formatDate(optional($staff?->trainingSa)->maintenance),
            $this->formatDate(optional($staff?->trainingSa)->record_keeping),
            $this->formatDate(optional($staff?->trainingSa)->quality_monitoring),
            $this->formatDate(optional($staff?->trainingSa)->level1_training),
            $this->formatDate(optional($staff?->trainingSa)->fuel_tank),
            $this->formatDate(optional($staff?->trainingSa)->quality_auditor),
            $this->formatDate(optional($staff?->trainingSa)->ramp_insp),
            $this->formatDate(optional($staff?->trainingSa)->engine_health),
            $this->formatDate(optional($staff?->trainingSa)->hf),
            $this->formatDate(optional($staff?->trainingSa)->sms),
            $this->formatDate(optional($staff?->trainingSa)->ewis),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');
        $sheet->mergeCells('E1:H1');
        $sheet->mergeCells('I1:N1');
        $sheet->mergeCells('O1:R1');
        $sheet->mergeCells('S1:S1');
        $sheet->mergeCells('T1:V1');
        $sheet->mergeCells('W1:X1');
        $sheet->mergeCells('Y1:Y1');
        $sheet->mergeCells('Z1:AI1');
        $sheet->mergeCells('AJ1:AJ1');
        $sheet->mergeCells('AK1:AZ1');

        $sheet->getStyle('1:2')->getFont()->setBold(true);
        $sheet->getStyle('1:1')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('2:2')->getAlignment()->setHorizontal('center')->setVertical('center');
        return [];
    }

    private function formatDate($value)
    {
        if (empty($value)) return null;
        if ($value instanceof \DateTimeInterface) return $value->format('d/m/Y');
        try {
            return \Carbon\Carbon::parse($value)->format('d/m/Y');
        } catch (\Exception $e) {
            return $value;
        }
    }
}
