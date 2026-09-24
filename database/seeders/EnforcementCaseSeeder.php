<?php

namespace Database\Seeders;

use App\Models\EnforcementAction;
use App\Models\EnforcementCase;
use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use App\Models\Office;
use App\Models\User;
use App\Models\Violation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EnforcementCaseSeeder extends Seeder
{
    public function run(): void
    {
        $establishments = MeatEstablishment::pluck('id', 'registration_number');
        $operators = MtvOperator::pluck('id', 'operator_name');
        $vehicles = MtvVehicle::pluck('id', 'plate_number');
        $violations = Violation::pluck('id', 'violation_number');
        $enforcementActions = EnforcementAction::pluck('id', 'action_number');
        $offices = Office::pluck('id', 'code');
        $users = User::pluck('id', 'employee_id');

        $cases = [
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0004', 'violation' => 'VIO-2026-00002', 'action' => 'EA-2026-00001', 'filed' => '2025-06-25', 'status' => 'Resolved', 'office' => 'NMIS-NCR-MNL', 'officer' => 'NMIS-2026-0022', 'filer' => 'NMIS-2026-0012', 'resolution' => 'Establishment suspended for 90 days pending compliance verification.', 'resolved' => '2025-06-30', 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0007', 'violation' => 'VIO-2026-00004', 'action' => 'EA-2026-00003', 'filed' => '2024-04-25', 'status' => 'Completed', 'office' => 'NMIS-NCR-MKT', 'officer' => 'NMIS-2026-0013', 'filer' => 'NMIS-2026-0013', 'resolution' => 'Establishment complied with notice; case closed.', 'resolved' => '2024-06-01', 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0013', 'violation' => 'VIO-2026-00006', 'action' => 'EA-2026-00005', 'filed' => '2025-06-02', 'status' => 'Resolved', 'office' => 'NMIS-R4A-CAV', 'officer' => 'NMIS-2026-0021', 'filer' => 'NMIS-2026-0007', 'resolution' => 'Establishment suspended for 90 days for untreated wastewater discharge.', 'resolved' => '2025-06-10', 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'violation' => 'VIO-2026-00008', 'action' => 'EA-2026-00006', 'filed' => '2024-02-15', 'status' => 'Under Appeal', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0024', 'filer' => 'NMIS-2026-0017', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0023', 'violation' => 'VIO-2026-00009', 'action' => 'EA-2026-00007', 'filed' => '2025-10-15', 'status' => 'Resolved', 'office' => 'NMIS-R11-DDS', 'officer' => 'NMIS-2026-0023', 'filer' => 'NMIS-2026-0009', 'resolution' => 'Establishment suspended for 90 days for failure to implement prior corrective actions.', 'resolved' => '2025-10-20', 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0029', 'violation' => 'VIO-2026-00011', 'action' => 'EA-2026-00008', 'filed' => '2024-03-25', 'status' => 'Completed', 'office' => 'NMIS-R12-SUK', 'officer' => 'NMIS-2026-0021', 'filer' => 'NMIS-2026-0010', 'resolution' => 'Accreditation permanently revoked; case closed.', 'resolved' => '2024-04-10', 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Manila Meat Logistics Inc.', 'violation' => 'VIO-2026-00013', 'action' => 'EA-2026-00010', 'filed' => '2025-05-10', 'status' => 'Resolved', 'office' => 'NMIS-NCR-MNL', 'officer' => 'NMIS-2026-0022', 'filer' => 'NMIS-2026-0012', 'resolution' => 'Operator suspended for 90 days; additional fine imposed under a separate action.', 'resolved' => '2025-05-25', 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Cavite Meat Haulage Solutions', 'violation' => 'VIO-2026-00015', 'action' => 'EA-2026-00011', 'filed' => '2023-12-05', 'status' => 'Completed', 'office' => 'NMIS-R4A-CAV-DAS', 'officer' => 'NMIS-2026-0021', 'filer' => 'NMIS-2026-0016', 'resolution' => 'Accreditation permanently revoked.', 'resolved' => '2024-01-05', 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Anastacio Gabatin', 'violation' => 'VIO-2026-00016', 'action' => 'EA-2026-00012', 'filed' => '2025-04-14', 'status' => 'Resolved', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0024', 'filer' => 'NMIS-2026-0017', 'resolution' => 'Accreditation suspended for 90 days pending repair verification.', 'resolved' => '2025-04-20', 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Feliciano Undag', 'violation' => 'VIO-2026-00018', 'action' => 'EA-2026-00013', 'filed' => '2025-01-20', 'status' => 'Resolved', 'office' => 'NMIS-R12-SCT', 'officer' => 'NMIS-2026-0021', 'filer' => 'NMIS-2026-0010', 'resolution' => 'Accreditation suspended for 90 days for overcapacity transport.', 'resolved' => '2025-01-28', 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'WGD 3301', 'violation' => 'VIO-2026-00019', 'action' => 'EA-2026-00014', 'filed' => '2025-05-10', 'status' => 'Resolved', 'office' => 'NMIS-NCR-MNL', 'officer' => 'NMIS-2026-0022', 'filer' => 'NMIS-2026-0012', 'resolution' => 'Vehicle permit suspended for 90 days.', 'resolved' => '2025-05-25', 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'PCV 9201', 'violation' => 'VIO-2026-00021', 'action' => 'EA-2026-00015', 'filed' => '2023-12-05', 'status' => 'Completed', 'office' => 'NMIS-R4A-CAV-DAS', 'officer' => 'NMIS-2026-0021', 'filer' => 'NMIS-2026-0016', 'resolution' => 'Vehicle permit permanently revoked.', 'resolved' => '2024-01-05', 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'CEB 1601', 'violation' => 'VIO-2026-00023', 'action' => 'EA-2026-00016', 'filed' => '2025-04-14', 'status' => 'Resolved', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0024', 'filer' => 'NMIS-2026-0017', 'resolution' => 'Vehicle permit suspended for 90 days.', 'resolved' => '2025-04-20', 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2401', 'violation' => 'VIO-2026-00025', 'action' => 'EA-2026-00018', 'filed' => '2023-12-29', 'status' => 'Completed', 'office' => 'NMIS-R11-DDN', 'officer' => 'NMIS-2026-0023', 'filer' => 'NMIS-2026-0009', 'resolution' => 'Vehicle permit permanently revoked.', 'resolved' => '2024-01-15', 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Pampanga Livestock Movers Inc.', 'violation' => 'VIO-2026-00014', 'action' => 'EA-2026-00021', 'filed' => '2025-12-10', 'status' => 'Under Review', 'office' => 'NMIS-R3-PAM-SFC', 'officer' => 'NMIS-2026-0015', 'filer' => 'NMIS-2026-0015', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Cebu Provincial Livestock Carriers', 'violation' => 'VIO-2026-00017', 'action' => 'EA-2026-00022', 'filed' => '2025-08-01', 'status' => 'Under Appeal', 'office' => 'NMIS-R7-CEB', 'officer' => 'NMIS-2026-0024', 'filer' => 'NMIS-2026-0008', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Davao del Norte Cold Transport Co.', 'violation' => 'VIO-2026-00028', 'action' => 'EA-2026-00025', 'filed' => '2025-12-28', 'status' => 'Pending', 'office' => 'NMIS-R11-DDN', 'officer' => 'NMIS-2026-0023', 'filer' => 'NMIS-2026-0009', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0014', 'violation' => null, 'action' => 'EA-2026-00027', 'filed' => '2023-07-15', 'status' => 'Completed', 'office' => 'NMIS-R4A-LAG-LOS', 'officer' => 'NMIS-2026-0021', 'filer' => 'NMIS-2026-0007', 'resolution' => 'Establishment formally closed; case concluded.', 'resolved' => '2023-07-25', 'confidential' => false],
            ['subject' => 'MTV Operator', 'key' => 'Aurelio Panopio', 'violation' => null, 'action' => 'EA-2026-00028', 'filed' => '2022-09-05', 'status' => 'Completed', 'office' => 'NMIS-R4A-LAG-LOS', 'officer' => 'NMIS-2026-0021', 'filer' => 'NMIS-2026-0007', 'resolution' => 'Operator accreditation formally closed.', 'resolved' => '2022-09-15', 'confidential' => false],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'violation' => null, 'action' => 'EA-2026-00029', 'filed' => '2024-02-25', 'status' => 'Under Appeal', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0024', 'filer' => 'NMIS-2026-0017', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'MTV Operator', 'key' => 'Manila Meat Logistics Inc.', 'violation' => null, 'action' => 'EA-2026-00026', 'filed' => '2025-05-25', 'status' => 'Completed', 'office' => 'NMIS-NCR-MNL', 'officer' => 'NMIS-2026-0022', 'filer' => 'NMIS-2026-0012', 'resolution' => 'Fine paid in full; case closed.', 'resolved' => '2025-06-15', 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2301', 'violation' => 'VIO-2026-00030', 'action' => null, 'filed' => '2025-11-05', 'status' => 'Dismissed', 'office' => 'NMIS-R11-DDN-PAN', 'officer' => 'NMIS-2026-0025', 'filer' => 'NMIS-2026-0025', 'resolution' => 'Complaint found unsubstantiated on review; case dismissed.', 'resolved' => '2025-11-20', 'confidential' => false],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0002', 'violation' => 'VIO-2026-00026', 'action' => null, 'filed' => '2025-08-25', 'status' => 'Pending', 'office' => 'NMIS-NCR-QC', 'officer' => null, 'filer' => 'NMIS-2026-0011', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'NEA 6602', 'violation' => 'VIO-2026-00027', 'action' => null, 'filed' => '2025-11-05', 'status' => 'Pending', 'office' => 'NMIS-R3-BUL-MAL', 'officer' => null, 'filer' => 'NMIS-2026-0014', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0030', 'violation' => 'VIO-2026-00029', 'action' => null, 'filed' => '2026-01-20', 'status' => 'Pending', 'office' => 'NMIS-NCR', 'officer' => null, 'filer' => 'NMIS-2026-0005', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0016', 'violation' => 'VIO-2026-00007', 'action' => 'EA-2026-00019', 'filed' => '2025-04-25', 'status' => 'Under Review', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0017', 'filer' => 'NMIS-2026-0017', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0024', 'violation' => 'VIO-2026-00010', 'action' => 'EA-2026-00020', 'filed' => '2025-07-05', 'status' => 'Under Review', 'office' => 'NMIS-R11-DDN-PAN', 'officer' => 'NMIS-2026-0025', 'filer' => 'NMIS-2026-0025', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'PMK 5501', 'violation' => 'VIO-2026-00020', 'action' => 'EA-2026-00023', 'filed' => '2025-09-15', 'status' => 'Under Review', 'office' => 'NMIS-NCR-MKT', 'officer' => 'NMIS-2026-0013', 'filer' => 'NMIS-2026-0013', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'MTV Vehicle', 'key' => 'MND 1501', 'violation' => 'VIO-2026-00022', 'action' => 'EA-2026-00024', 'filed' => '2025-05-20', 'status' => 'Under Review', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0017', 'filer' => 'NMIS-2026-0017', 'resolution' => null, 'resolved' => null, 'confidential' => true],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0001', 'violation' => null, 'action' => 'EA-2026-00030', 'filed' => '2026-02-05', 'status' => 'Pending', 'office' => 'NMIS-NCR-QC', 'officer' => 'NMIS-2026-0011', 'filer' => 'NMIS-2026-0011', 'resolution' => null, 'resolved' => null, 'confidential' => false],
        ];

        foreach ($cases as $i => $c) {
            $subjectId = match ($c['subject']) {
                'Meat Establishment' => $establishments[$c['key']],
                'MTV Operator' => $operators[$c['key']],
                'MTV Vehicle' => $vehicles[$c['key']],
            };

            $case = EnforcementCase::create([
                'subject_type' => $c['subject'],
                'subject_id' => $subjectId,
                'violation_id' => $c['violation'] ? $violations[$c['violation']] : null,
                'enforcement_action_id' => $c['action'] ? $enforcementActions[$c['action']] : null,
                'case_number' => sprintf('CASE-2026-%05d', $i + 1),
                'filed_at' => $c['filed'],
                'current_status' => $c['status'],
                'assigned_office_id' => $offices[$c['office']],
                'assigned_officer_id' => $c['officer'] ? $users[$c['officer']] : null,
                'resolution' => $c['resolution'],
                'resolved_at' => $c['resolved'],
                'is_confidential' => $c['confidential'],
            ]);

            $this->seedStatusHistory($case, $c, $users);
        }
    }

    private function statusPath(string $status): array
    {
        return match ($status) {
            'Pending' => ['Pending'],
            'Under Review' => ['Pending', 'Under Review'],
            'Resolved' => ['Pending', 'Under Review', 'Resolved'],
            'Under Appeal' => ['Pending', 'Under Review', 'Resolved', 'Under Appeal'],
            'Completed' => ['Pending', 'Under Review', 'Resolved', 'Completed'],
            'Dismissed' => ['Pending', 'Under Review', 'Dismissed'],
        };
    }

    private function defaultRemark(string $status): string
    {
        return match ($status) {
            'Pending' => 'Case filed and awaiting initial review.',
            'Under Review' => 'Case assigned for review by the responsible office.',
            'Resolved' => 'Investigation concluded; resolution reached.',
            'Under Appeal' => 'Respondent filed an appeal contesting the resolution.',
            'Dismissed' => 'Case dismissed after review found insufficient basis to proceed.',
            'Completed' => 'All case requirements fulfilled; case formally closed.',
        };
    }

    private function seedStatusHistory(EnforcementCase $case, array $c, $users): void
    {
        $path = $this->statusPath($c['status']);
        $steps = count($path);

        $start = Carbon::parse($c['filed']);
        $end = $c['resolved']
            ? Carbon::parse($c['resolved'])
            : $start->copy()->addDays(max(5, $steps * 5));

        $filerId = $users[$c['filer']];
        $officerId = $c['officer'] ? $users[$c['officer']] : $filerId;

        foreach ($path as $index => $status) {
            $changedAt = $steps === 1
                ? $start->copy()
                : $start->copy()->addDays((int) round($index * $start->diffInDays($end) / ($steps - 1)));

            $isLast = $index === $steps - 1;
            $remarks = ($isLast && $c['resolution']) ? $c['resolution'] : $this->defaultRemark($status);

            $case->statusHistory()->create([
                'status' => $status,
                'remarks' => $remarks,
                'changed_by' => $index === 0 ? $filerId : $officerId,
                'changed_at' => $changedAt,
            ]);
        }
    }
}
