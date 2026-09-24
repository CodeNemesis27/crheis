<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    public function run(): void
    {
        $establishments = MeatEstablishment::pluck('id', 'registration_number');
        $operators = MtvOperator::pluck('id', 'operator_name');
        $vehicles = MtvVehicle::pluck('id', 'plate_number');
        $offices = Office::pluck('id', 'code');
        $users = User::pluck('id', 'employee_id');

        $inspections = [
            // --- Meat establishments (20) ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0001', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-01-14', 'office' => 'NMIS-NCR-QC', 'inspector' => 'NMIS-2026-0011'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0003', 'type' => 'Pre Accreditation', 'result' => 'Passed With Findings', 'date' => '2026-02-03', 'office' => 'NMIS-NCR-QC', 'inspector' => 'NMIS-2026-0011'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0004', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2025-06-10', 'office' => 'NMIS-NCR-MNL', 'inspector' => 'NMIS-2026-0012'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0006', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-09-22', 'office' => 'NMIS-NCR-MKT', 'inspector' => 'NMIS-2026-0013'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0007', 'type' => 'Renewal', 'result' => 'Failed', 'date' => '2024-04-20', 'office' => 'NMIS-NCR-MKT', 'inspector' => 'NMIS-2026-0013'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0008', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-03-05', 'office' => 'NMIS-R3-BUL-MAL', 'inspector' => 'NMIS-2026-0014'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0009', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-08-11', 'office' => 'NMIS-R3-BUL', 'inspector' => 'NMIS-2026-0006'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0010', 'type' => 'Renewal', 'result' => 'Passed', 'date' => '2025-11-02', 'office' => 'NMIS-R3-PAM-SFC', 'inspector' => 'NMIS-2026-0015'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0011', 'type' => 'Pre Accreditation', 'result' => 'Passed', 'date' => '2026-01-19', 'office' => 'NMIS-R3-PAM', 'inspector' => 'NMIS-2026-0006'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0012', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-02-27', 'office' => 'NMIS-R4A-CAV-DAS', 'inspector' => 'NMIS-2026-0016'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0013', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2025-05-16', 'office' => 'NMIS-R4A-CAV', 'inspector' => 'NMIS-2026-0007'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0015', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-10-08', 'office' => 'NMIS-R4A-LAG', 'inspector' => 'NMIS-2026-0007'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0016', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-04-14', 'office' => 'NMIS-R7-CEB-MAN', 'inspector' => 'NMIS-2026-0017'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2024-01-30', 'office' => 'NMIS-R7-CEB-MAN', 'inspector' => 'NMIS-2026-0017'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0019', 'type' => 'Renewal', 'result' => 'Passed', 'date' => '2025-12-11', 'office' => 'NMIS-R7-BOH-LOO', 'inspector' => 'NMIS-2026-0018'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0021', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-07-03', 'office' => 'NMIS-R11-DDS-DIG', 'inspector' => 'NMIS-2026-0019'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0023', 'type' => 'Follow Up', 'result' => 'Failed', 'date' => '2025-09-29', 'office' => 'NMIS-R11-DDS', 'inspector' => 'NMIS-2026-0009'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0024', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-06-25', 'office' => 'NMIS-R11-DDN-PAN', 'inspector' => 'NMIS-2026-0025'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0026', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-11-19', 'office' => 'NMIS-R12-SCT-KOR', 'inspector' => 'NMIS-2026-0020'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0029', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2024-03-07', 'office' => 'NMIS-R12-SUK', 'inspector' => 'NMIS-2026-0010'],

            // --- MTV operators (15) ---
            ['subject' => 'MTV Operator', 'key' => 'Rogelio Mendiola', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-02-11', 'office' => 'NMIS-NCR-QC', 'inspector' => 'NMIS-2026-0011'],
            ['subject' => 'MTV Operator', 'key' => 'QC Cold Haulers Corp.', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-05-30', 'office' => 'NMIS-NCR-QC', 'inspector' => 'NMIS-2026-0011'],
            ['subject' => 'MTV Operator', 'key' => 'Manila Meat Logistics Inc.', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2025-04-22', 'office' => 'NMIS-NCR-MNL', 'inspector' => 'NMIS-2026-0012'],
            ['subject' => 'MTV Operator', 'key' => 'Bulacan Fresh Transport Corp.', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-08-06', 'office' => 'NMIS-R3-BUL-MAL', 'inspector' => 'NMIS-2026-0014'],
            ['subject' => 'MTV Operator', 'key' => 'Cirilo Manansala', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-10-15', 'office' => 'NMIS-R3-BUL', 'inspector' => 'NMIS-2026-0006'],
            ['subject' => 'MTV Operator', 'key' => 'Pampanga Livestock Movers Inc.', 'type' => 'Renewal', 'result' => 'Passed With Findings', 'date' => '2025-12-02', 'office' => 'NMIS-R3-PAM-SFC', 'inspector' => 'NMIS-2026-0015'],
            ['subject' => 'MTV Operator', 'key' => 'Cavite Meat Haulage Solutions', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2023-11-18', 'office' => 'NMIS-R4A-CAV-DAS', 'inspector' => 'NMIS-2026-0016'],
            ['subject' => 'MTV Operator', 'key' => 'Marcelino Rivas', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-06-09', 'office' => 'NMIS-R4A-CAV', 'inspector' => 'NMIS-2026-0007'],
            ['subject' => 'MTV Operator', 'key' => 'Mandaue Refrigerated Transport Co.', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-09-01', 'office' => 'NMIS-R7-CEB-MAN', 'inspector' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Operator', 'key' => 'Anastacio Gabatin', 'type' => 'Follow Up', 'result' => 'Failed', 'date' => '2025-03-27', 'office' => 'NMIS-R7-CEB-MAN', 'inspector' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Operator', 'key' => 'Cebu Provincial Livestock Carriers', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-07-21', 'office' => 'NMIS-R7-CEB', 'inspector' => 'NMIS-2026-0008'],
            ['subject' => 'MTV Operator', 'key' => 'Davao South Meat Transport Corp.', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-05-04', 'office' => 'NMIS-R11-DDS-DIG', 'inspector' => 'NMIS-2026-0019'],
            ['subject' => 'MTV Operator', 'key' => 'Davao del Sur Provincial Haulers Inc.', 'type' => 'Renewal', 'result' => 'Passed', 'date' => '2025-10-30', 'office' => 'NMIS-R11-DDS', 'inspector' => 'NMIS-2026-0009'],
            ['subject' => 'MTV Operator', 'key' => 'Koronadal Meat Logistics Corp.', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-08-19', 'office' => 'NMIS-R12-SCT-KOR', 'inspector' => 'NMIS-2026-0020'],
            ['subject' => 'MTV Operator', 'key' => 'Feliciano Undag', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2025-01-08', 'office' => 'NMIS-R12-SCT', 'inspector' => 'NMIS-2026-0010'],

            // --- MTV vehicles (15) ---
            ['subject' => 'MTV Vehicle', 'key' => 'NHK 1023', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-03-12', 'office' => 'NMIS-NCR-QC', 'inspector' => 'NMIS-2026-0011'],
            ['subject' => 'MTV Vehicle', 'key' => 'NGP 2201', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-06-17', 'office' => 'NMIS-NCR-QC', 'inspector' => 'NMIS-2026-0011'],
            ['subject' => 'MTV Vehicle', 'key' => 'WGD 3301', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2025-04-25', 'office' => 'NMIS-NCR-MNL', 'inspector' => 'NMIS-2026-0012'],
            ['subject' => 'MTV Vehicle', 'key' => 'PMK 5501', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-09-05', 'office' => 'NMIS-NCR-MKT', 'inspector' => 'NMIS-2026-0013'],
            ['subject' => 'MTV Vehicle', 'key' => 'NEA 6601', 'type' => 'Renewal', 'result' => 'Passed', 'date' => '2025-11-27', 'office' => 'NMIS-R3-BUL-MAL', 'inspector' => 'NMIS-2026-0014'],
            ['subject' => 'MTV Vehicle', 'key' => 'NFA 8101', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-07-14', 'office' => 'NMIS-R3-PAM-SFC', 'inspector' => 'NMIS-2026-0015'],
            ['subject' => 'MTV Vehicle', 'key' => 'PCV 9201', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2023-10-02', 'office' => 'NMIS-R4A-CAV-DAS', 'inspector' => 'NMIS-2026-0016'],
            ['subject' => 'MTV Vehicle', 'key' => 'NCD 0311', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-08-23', 'office' => 'NMIS-R4A-CAV', 'inspector' => 'NMIS-2026-0007'],
            ['subject' => 'MTV Vehicle', 'key' => 'MND 1501', 'type' => 'Routine', 'result' => 'Passed With Findings', 'date' => '2025-05-11', 'office' => 'NMIS-R7-CEB-MAN', 'inspector' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Vehicle', 'key' => 'CEB 1601', 'type' => 'Follow Up', 'result' => 'Failed', 'date' => '2025-04-02', 'office' => 'NMIS-R7-CEB-MAN', 'inspector' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Vehicle', 'key' => 'CEB 1701', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-10-20', 'office' => 'NMIS-R7-CEB', 'inspector' => 'NMIS-2026-0008'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVO 2001', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-06-30', 'office' => 'NMIS-R11-DDS-DIG', 'inspector' => 'NMIS-2026-0019'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVO 2101', 'type' => 'Renewal', 'result' => 'Failed', 'date' => '2024-02-06', 'office' => 'NMIS-R11-DDS-DIG', 'inspector' => 'NMIS-2026-0019'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2401', 'type' => 'Complaint Based', 'result' => 'Failed', 'date' => '2023-12-15', 'office' => 'NMIS-R11-DDN', 'inspector' => 'NMIS-2026-0009'],
            ['subject' => 'MTV Vehicle', 'key' => 'SCT 2501', 'type' => 'Routine', 'result' => 'Passed', 'date' => '2025-09-16', 'office' => 'NMIS-R12-SCT-KOR', 'inspector' => 'NMIS-2026-0020'],
        ];

        foreach ($inspections as $i => $data) {
            $subjectId = match ($data['subject']) {
                'Meat Establishment' => $establishments[$data['key']],
                'MTV Operator' => $operators[$data['key']],
                'MTV Vehicle' => $vehicles[$data['key']],
            };

            [$findings, $recommendations] = $this->narrativeFor($data['result']);

            Inspection::create([
                'subject_type' => $data['subject'],
                'subject_id' => $subjectId,
                'report_number' => sprintf('INSP-2026-%05d', $i + 1),
                'inspection_type' => $data['type'],
                'inspection_date' => $data['date'],
                'inspector_id' => $users[$data['inspector']],
                'office_id' => $offices[$data['office']],
                'result' => $data['result'],
                'findings' => $findings,
                'recommendations' => $recommendations,
                'created_by' => $users[$data['inspector']],
            ]);
        }
    }

    private function narrativeFor(string $result): array
    {
        return match ($result) {
            'Passed' => [
                'No significant deficiencies noted during the inspection.',
                null,
            ],
            'Passed With Findings' => [
                'Minor deficiencies observed; overall operations remain within acceptable standards.',
                'Corrective action requested within 15 days, subject to a follow-up inspection.',
            ],
            'Failed' => [
                'Significant deficiencies observed that pose a risk to food safety or public health.',
                'Immediate corrective action required; enforcement action to be initiated pending review.',
            ],
        };
    }
}
