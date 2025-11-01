<?php

namespace App\Imports;

use App\Models\Staff;
use App\Models\AircraftCertifyingStaff;
use App\Models\ComponentCertifyingStaff;
use App\Models\QualityAuditor;
use App\Models\QualifyingMechanic;
use App\Models\StoreQualityInspector;
use App\Models\AuthorizedStandardLabPersonnel;
use App\Models\TrainingRecordSes;
use App\Models\AuthorizedAuditor;
use App\Models\TrainingRecordSa;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class StaffImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 2; // ✅ This skips the first row and takes row 2 as column headings
    }


    public function model(array $row)
    {
        unset($row['name'], $row['org.'], $row['ses#']);

        $baseData = [
            'user_id'        => $row['user_id'],
            'auth_type'      => $row['auth_type'],
            'auth_no'        => $row['auth_no'],
            'function'       => $row['function'],
            'ini_issue_date' => $this->parseDate($row['ini_issue_date']),
        ];

        $staff = null;

        // ✅ Base logic (unchanged)
        if (
            !empty($row['user_id']) &&
            (!empty($row['auth_type']) || !empty($row['auth_no']) || !empty($row['function']) || !empty($row['ini_issue_date']))
        ) {
            $staff = Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
        }

        // 🔹 1) Aircraft Certifying Staff
        if (!empty($row['aml_no']) || !empty($row['aircraft'])) {
            $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
            AircraftCertifyingStaff::create([
                'staff_id'   => $staff->id,
                'aml_no'     => $row['aml_no'],
                'aircraft'   => $row['aircraft'],
                'cat'        => $row['cat'],
                'scope'      => $row['ac_scope'],
                'privileges' => $row['privileges'],
                'aml_expiry' => $this->parseDate($row['aml_expiry']),
            ]);
        }

        // 🔹 2) Component Certifying Staff
        if (!empty($row['component_rating']) || !empty($row['cma_no'])) {
            $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
            ComponentCertifyingStaff::create([
                'staff_id'         => $staff->id,
                'component_rating' => $row['component_rating'],
                'cma_no'           => $row['cma_no'],
                'scope'            => $row['comp_scope'],
                'limitation'       => $row['limitation'],
            ]);
        }

        // 🔹 3) Quality Auditor
        if (!empty($row['qa_scope'])) {
            $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
            QualityAuditor::create([
                'staff_id' => $staff->id,
                'scope'    => $row['qa_scope'],
            ]);
        }

        // 🔹 4) Qualifying Mechanic
        if (!empty($row['qm_category']) || !empty($row['qm_scope'])) {
            $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
            QualifyingMechanic::create([
                'staff_id'  => $staff->id,
                'category'  => $row['qm_category'],
                'auth_date' => $this->parseDate($row['qm_auth_date']),
                'scope'     => $row['qm_scope'],
            ]);
        }

        // 🔹 5) Store Quality Inspector
        if (!empty($row['sqi_category']) || !empty($row['sqi_scope'])) {
            $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
            StoreQualityInspector::create([
                'staff_id' => $staff->id,
                'category' => $row['sqi_category'],
                'scope'    => $row['sqi_scope'],
            ]);
        }

        // 🔹 6) Authorized Standard Lab Personnel
        if (!empty($row['lab_scope'])) {
            $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
            AuthorizedStandardLabPersonnel::create([
                'staff_id' => $staff->id,
                'scope'    => $row['lab_scope'],
            ]);
        }

        // 🔹 7) Training Record SES
        if (!empty($row['ses_hf']) || !empty($row['ses_sms'])) {
            // ✅ Modified: Always create a *new* staff record for each SES training
            $sesStaff = Staff::create(array_merge($baseData, [
                'user_id' => $row['user_id'],
            ]));

            TrainingRecordSes::create([
                'staff_id' => $sesStaff->id,
                'hf'       => $this->parseDate($row['ses_hf']),
                'op'       => $this->parseDate($row['ses_op']),
                'cdccl'    => $this->parseDate($row['ses_cdccl']),
                'tt'       => $this->parseDate($row['ses_tt']),
                'sms'      => $this->parseDate($row['ses_sms']),
                'ewis'     => $this->parseDate($row['ses_ewis']),
                'al'       => $this->parseDate($row['ses_al']),
                'at_1'     => $this->parseDate($row['ses_at_1']),
                'at_2'     => $this->parseDate($row['ses_at_2']),
                'at_3'     => $this->parseDate($row['ses_at_3']),
                'at_4'     => $this->parseDate($row['ses_at_4']),
            ]);
        }

        // 🔹 8) Authorized Auditor
        if (!empty($row['auditor_scope'])) {
            $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
            AuthorizedAuditor::create([
                'staff_id' => $staff->id,
                'scope'    => $row['auditor_scope'],
            ]);
        }

        // 🔹 9) Training Record SA
        if (!empty($row['sa_pcca_regulation']) || !empty($row['sa_sms'])) {
            // ✅ Modified: Always create a *new* staff record for each SA training
            $saStaff = Staff::create(array_merge($baseData, [
                'user_id' => $row['user_id'],
            ]));

            TrainingRecordSa::create([
                'staff_id'           => $saStaff->id,
                'pcca_regulation'    => $this->parseDate($row['sa_pcca_regulation']),
                'mcm'                => $this->parseDate($row['sa_mcm']),
                'amp'                => $this->parseDate($row['sa_amp']),
                'reliability'        => $this->parseDate($row['sa_reliability']),
                'ad_sb'              => $this->parseDate($row['sa_ad_sb']),
                'maintenance'        => $this->parseDate($row['sa_maintenance']),
                'record_keeping'     => $this->parseDate($row['sa_record_keeping']),
                'quality_monitoring' => $this->parseDate($row['sa_quality_monitoring']),
                'level1_training'    => $this->parseDate($row['sa_level1_training']),
                'fuel_tank'          => $this->parseDate($row['sa_fuel_tank']),
                'quality_auditor'    => $this->parseDate($row['sa_quality_auditor']),
                'ramp_insp'          => $this->parseDate($row['sa_ramp_insp']),
                'engine_health'      => $this->parseDate($row['sa_engine_health']),
                'hf'                 => $this->parseDate($row['sa_hf']),
                'sms'                => $this->parseDate($row['sa_sms']),
                'ewis'               => $this->parseDate($row['sa_ewis']),
            ]);
        }

        return $staff ?? null;
    }



    private function parseDate($value)
    {
        if (empty($value)) {
            return null;
        }

        // Excel serial number (e.g. 45321)
        if (is_numeric($value)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
        }

        // If it looks like dd/mm/yyyy or d/m/yyyy
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', trim($value))) {
            try {
                return Carbon::createFromFormat('d/m/Y', $value);
            } catch (\Exception $e) {
                // fallback
            }
        }

        // Fallback to Carbon's normal parser
        try {
            return Carbon::parse($value);
        } catch (\Exception $e) {
            return null;
        }
    }
}






























































































// class StaffImport implements ToModel, WithHeadingRow
// {
//     public function headingRow(): int
//     {
//         return 2; // ✅ This skips the first row and takes row 2 as column headings
//     }


//     public function model(array $row)
//     {
//         // ✅ Ignore unwanted columns (2,3,4)
//         unset($row['name'], $row['org.'], $row['ses#']);

//         // Base data for each staff record
//         $baseData = [
//             'user_id'        => $row['user_id'],
//             'auth_type'      => $row['auth_type'],
//             'auth_no'        => $row['auth_no'],
//             'function'       => $row['function'],
//             'ini_issue_date' => $this->parseDate($row['ini_issue_date']),
//         ];

//         $staff = null;

//         // ✅ NEW LOGIC: Ensure a Staff record exists if user_id + basic staff fields are present
//         if (
//             !empty($row['user_id']) &&
//             (!empty($row['auth_type']) || !empty($row['auth_no']) || !empty($row['function']) || !empty($row['ini_issue_date']))
//         ) {

//             // Check if a Staff record already exists for this user
//             $staff = Staff::firstOrCreate(
//                 ['user_id' => $row['user_id']],
//                 $baseData
//             );
//         }

//         // 🔹 1) Aircraft Certifying Staff
//         if (!empty($row['aml_no']) || !empty($row['aircraft'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             AircraftCertifyingStaff::create([
//                 'staff_id'   => $staff->id,
//                 'aml_no'     => $row['aml_no'],
//                 'aircraft'   => $row['aircraft'],
//                 'cat'        => $row['cat'],
//                 'scope'      => $row['ac_scope'],
//                 'privileges' => $row['privileges'],
//                 'aml_expiry' => $this->parseDate($row['aml_expiry']),
//             ]);
//         }

//         // 🔹 2) Component Certifying Staff
//         if (!empty($row['component_rating']) || !empty($row['cma_no'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             ComponentCertifyingStaff::create([
//                 'staff_id'         => $staff->id,
//                 'component_rating' => $row['component_rating'],
//                 'cma_no'           => $row['cma_no'],
//                 'scope'            => $row['comp_scope'],
//                 'limitation'       => $row['limitation'],
//             ]);
//         }

//         // 🔹 3) Quality Auditor
//         if (!empty($row['qa_scope'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             QualityAuditor::create([
//                 'staff_id' => $staff->id,
//                 'scope'    => $row['qa_scope'],
//             ]);
//         }

//         // 🔹 4) Qualifying Mechanic
//         if (!empty($row['qm_category']) || !empty($row['qm_scope'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             QualifyingMechanic::create([
//                 'staff_id'  => $staff->id,
//                 'category'  => $row['qm_category'],
//                 'auth_date' => $this->parseDate($row['qm_auth_date']),
//                 'scope'     => $row['qm_scope'],
//             ]);
//         }

//         // 🔹 5) Store Quality Inspector
//         if (!empty($row['sqi_category']) || !empty($row['sqi_scope'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             StoreQualityInspector::create([
//                 'staff_id' => $staff->id,
//                 'category' => $row['sqi_category'],
//                 'scope'    => $row['sqi_scope'],
//             ]);
//         }

//         // 🔹 6) Authorized Standard Lab Personnel
//         if (!empty($row['lab_scope'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             AuthorizedStandardLabPersonnel::create([
//                 'staff_id' => $staff->id,
//                 'scope'    => $row['lab_scope'],
//             ]);
//         }

//         // 🔹 7) Training Record SES
//         if (!empty($row['ses_hf']) || !empty($row['ses_sms'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             TrainingRecordSes::create([
//                 'staff_id' => $staff->id,
//                 'hf'       => $this->parseDate($row['ses_hf']),
//                 'op'       => $this->parseDate($row['ses_op']),
//                 'cdccl'    => $this->parseDate($row['ses_cdccl']),
//                 'tt'       => $this->parseDate($row['ses_tt']),
//                 'sms'      => $this->parseDate($row['ses_sms']),
//                 'ewis'     => $this->parseDate($row['ses_ewis']),
//                 'al'       => $this->parseDate($row['ses_al']),
//                 'at_1'     => $this->parseDate($row['ses_at_1']),
//                 'at_2'     => $this->parseDate($row['ses_at_2']),
//                 'at_3'     => $this->parseDate($row['ses_at_3']),
//                 'at_4'     => $this->parseDate($row['ses_at_4']),
//             ]);
//         }

//         // 🔹 8) Authorized Auditor
//         if (!empty($row['auditor_scope'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             AuthorizedAuditor::create([
//                 'staff_id' => $staff->id,
//                 'scope'    => $row['auditor_scope'],
//             ]);
//         }

//         // 🔹 9) Training Record SA
//         if (!empty($row['sa_pcca_regulation']) || !empty($row['sa_sms'])) {
//             $staff ??= Staff::firstOrCreate(['user_id' => $row['user_id']], $baseData);
//             TrainingRecordSa::create([
//                 'staff_id'           => $staff->id,
//                 'pcca_regulation'    => $this->parseDate($row['sa_pcca_regulation']),
//                 'mcm'                => $this->parseDate($row['sa_mcm']),
//                 'amp'                => $this->parseDate($row['sa_amp']),
//                 'reliability'        => $this->parseDate($row['sa_reliability']),
//                 'ad_sb'              => $this->parseDate($row['sa_ad_sb']),
//                 'maintenance'        => $this->parseDate($row['sa_maintenance']),
//                 'record_keeping'     => $this->parseDate($row['sa_record_keeping']),
//                 'quality_monitoring' => $this->parseDate($row['sa_quality_monitoring']),
//                 'level1_training'    => $this->parseDate($row['sa_level1_training']),
//                 'fuel_tank'          => $this->parseDate($row['sa_fuel_tank']),
//                 'quality_auditor'    => $this->parseDate($row['sa_quality_auditor']),
//                 'ramp_insp'          => $this->parseDate($row['sa_ramp_insp']),
//                 'engine_health'      => $this->parseDate($row['sa_engine_health']),
//                 'hf'                 => $this->parseDate($row['sa_hf']),
//                 'sms'                => $this->parseDate($row['sa_sms']),
//                 'ewis'               => $this->parseDate($row['sa_ewis']),
//             ]);
//         }

//         return $staff ?? null;
//     }


//     private function parseDate($value)
//     {
//         if (empty($value)) {
//             return null;
//         }

//         // Excel serial number (e.g. 45321)
//         if (is_numeric($value)) {
//             return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
//         }

//         // If it looks like dd/mm/yyyy or d/m/yyyy
//         if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', trim($value))) {
//             try {
//                 return Carbon::createFromFormat('d/m/Y', $value);
//             } catch (\Exception $e) {
//                 // fallback
//             }
//         }

//         // Fallback to Carbon's normal parser
//         try {
//             return Carbon::parse($value);
//         } catch (\Exception $e) {
//             return null;
//         }
//     }
// }
