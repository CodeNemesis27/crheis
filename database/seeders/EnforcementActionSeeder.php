<?php

namespace Database\Seeders;

use App\Models\EnforcementAction;
use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use App\Models\Office;
use App\Models\User;
use App\Models\Violation;
use Illuminate\Database\Seeder;

class EnforcementActionSeeder extends Seeder
{
    public function run(): void
    {
        $establishments = MeatEstablishment::pluck('id', 'registration_number');
        $operators = MtvOperator::pluck('id', 'operator_name');
        $vehicles = MtvVehicle::pluck('id', 'plate_number');
        $violations = Violation::pluck('id', 'violation_number');
        $offices = Office::pluck('id', 'code');
        $users = User::pluck('id', 'employee_id');

        $actions = [
            // --- Linked to a Resolved violation (18) ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0004', 'violation' => 'VIO-2026-00002', 'type' => 'Suspension', 'desc' => 'Establishment ordered suspended pending correction of the sanitation deficiencies noted during inspection.', 'office' => 'NMIS-NCR-MNL', 'issued_at' => '2025-06-24', 'effectivity' => '2025-06-24', 'expiry' => '2025-09-22', 'status' => 'issued', 'issuer' => 'NMIS-2026-0022'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0006', 'violation' => 'VIO-2026-00003', 'type' => 'Warning', 'desc' => 'Written warning issued regarding the malfunctioning handwashing station; repair confirmed on follow-up.', 'office' => 'NMIS-NCR-MKT', 'issued_at' => '2025-09-29', 'status' => 'complied', 'issuer' => 'NMIS-2026-0013'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0007', 'violation' => 'VIO-2026-00004', 'type' => 'Notice Of Violation', 'desc' => 'Notice issued for operating on an expired accreditation at the time of the renewal inspection.', 'office' => 'NMIS-NCR-MKT', 'issued_at' => '2024-05-01', 'status' => 'acknowledged', 'issuer' => 'NMIS-2026-0013'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0009', 'violation' => 'VIO-2026-00005', 'type' => 'Warning', 'desc' => 'Written warning issued regarding rodent activity near cold storage; pest control confirmed engaged.', 'office' => 'NMIS-R3-BUL', 'issued_at' => '2025-08-18', 'status' => 'complied', 'issuer' => 'NMIS-2026-0006'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0013', 'violation' => 'VIO-2026-00006', 'type' => 'Suspension', 'desc' => 'Establishment ordered suspended for discharging untreated wastewater into a public drainage canal.', 'office' => 'NMIS-R4A-CAV', 'issued_at' => '2025-05-30', 'effectivity' => '2025-05-30', 'expiry' => '2025-08-28', 'status' => 'issued', 'issuer' => 'NMIS-2026-0021'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'violation' => 'VIO-2026-00008', 'type' => 'Revocation', 'desc' => 'Accreditation revoked after previously condemned stock was found being offered for sale.', 'office' => 'NMIS-R7-CEB-MAN', 'issued_at' => '2024-02-13', 'status' => 'issued', 'issuer' => 'NMIS-2026-0024'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0023', 'violation' => 'VIO-2026-00009', 'type' => 'Suspension', 'desc' => 'Establishment ordered suspended for failing to implement corrective actions from a prior finding within the required period.', 'office' => 'NMIS-R11-DDS', 'issued_at' => '2025-10-13', 'effectivity' => '2025-10-13', 'expiry' => '2026-01-11', 'status' => 'issued', 'issuer' => 'NMIS-2026-0023'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0029', 'violation' => 'VIO-2026-00011', 'type' => 'Revocation', 'desc' => 'Accreditation revoked after meat with no proof of NMIS inspection was found on the premises.', 'office' => 'NMIS-R12-SUK', 'issued_at' => '2024-03-21', 'status' => 'issued', 'issuer' => 'NMIS-2026-0021'],
            ['subject' => 'MTV Operator', 'key' => 'QC Cold Haulers Corp.', 'violation' => 'VIO-2026-00012', 'type' => 'Warning', 'desc' => 'Written warning issued for one fleet unit operating without required NMIS identification markings; markings since applied.', 'office' => 'NMIS-NCR-QC', 'issued_at' => '2025-06-06', 'status' => 'complied', 'issuer' => 'NMIS-2026-0011'],
            ['subject' => 'MTV Operator', 'key' => 'Manila Meat Logistics Inc.', 'violation' => 'VIO-2026-00013', 'type' => 'Suspension', 'desc' => 'Accreditation suspended after a unit in active use was found without any valid MTV permit.', 'office' => 'NMIS-NCR-MNL', 'issued_at' => '2025-05-06', 'effectivity' => '2025-05-06', 'expiry' => '2025-08-04', 'status' => 'issued', 'issuer' => 'NMIS-2026-0022'],
            ['subject' => 'MTV Operator', 'key' => 'Cavite Meat Haulage Solutions', 'violation' => 'VIO-2026-00015', 'type' => 'Revocation', 'desc' => 'Accreditation revoked after meat was found transported alongside automotive fluid in the same compartment.', 'office' => 'NMIS-R4A-CAV-DAS', 'issued_at' => '2023-12-02', 'status' => 'issued', 'issuer' => 'NMIS-2026-0021'],
            ['subject' => 'MTV Operator', 'key' => 'Anastacio Gabatin', 'violation' => 'VIO-2026-00016', 'type' => 'Suspension', 'desc' => 'Accreditation suspended after a prior refrigeration defect was confirmed unrepaired on follow-up.', 'office' => 'NMIS-R7-CEB-MAN', 'issued_at' => '2025-04-10', 'effectivity' => '2025-04-10', 'expiry' => '2025-07-09', 'status' => 'issued', 'issuer' => 'NMIS-2026-0024'],
            ['subject' => 'MTV Operator', 'key' => 'Feliciano Undag', 'violation' => 'VIO-2026-00018', 'type' => 'Suspension', 'desc' => 'Accreditation suspended following a complaint of livestock transported well beyond safe vehicle capacity.', 'office' => 'NMIS-R12-SCT', 'issued_at' => '2025-01-15', 'effectivity' => '2025-01-15', 'expiry' => '2025-04-15', 'status' => 'issued', 'issuer' => 'NMIS-2026-0021'],
            ['subject' => 'MTV Vehicle', 'key' => 'WGD 3301', 'violation' => 'VIO-2026-00019', 'type' => 'Suspension', 'desc' => 'Vehicle permit suspended after being flagged operating on an MTV permit that had never been issued.', 'office' => 'NMIS-NCR-MNL', 'issued_at' => '2025-05-06', 'effectivity' => '2025-05-06', 'expiry' => '2025-08-04', 'status' => 'issued', 'issuer' => 'NMIS-2026-0022'],
            ['subject' => 'MTV Vehicle', 'key' => 'PCV 9201', 'violation' => 'VIO-2026-00021', 'type' => 'Revocation', 'desc' => 'Vehicle permit revoked after meat was found hauled alongside construction materials in the same open bed.', 'office' => 'NMIS-R4A-CAV-DAS', 'issued_at' => '2023-12-02', 'status' => 'issued', 'issuer' => 'NMIS-2026-0021'],
            ['subject' => 'MTV Vehicle', 'key' => 'CEB 1601', 'violation' => 'VIO-2026-00023', 'type' => 'Suspension', 'desc' => 'Vehicle permit suspended after the refrigeration unit remained non-functional past the required repair deadline.', 'office' => 'NMIS-R7-CEB-MAN', 'issued_at' => '2025-04-10', 'effectivity' => '2025-04-10', 'expiry' => '2025-07-09', 'status' => 'issued', 'issuer' => 'NMIS-2026-0024'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVO 2101', 'violation' => 'VIO-2026-00024', 'type' => 'Notice Of Violation', 'desc' => 'Notice issued for continued operation on an MTV permit past its expiry date.', 'office' => 'NMIS-R11-DDS-DIG', 'issued_at' => '2024-02-13', 'status' => 'acknowledged', 'issuer' => 'NMIS-2026-0019'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2401', 'violation' => 'VIO-2026-00025', 'type' => 'Revocation', 'desc' => 'Vehicle permit revoked after being found carrying livestock well past its rated capacity.', 'office' => 'NMIS-R11-DDN', 'issued_at' => '2023-12-29', 'status' => 'issued', 'issuer' => 'NMIS-2026-0023'],

            // --- Linked to an Under Investigation violation (7) ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0016', 'violation' => 'VIO-2026-00007', 'type' => 'Notice Of Violation', 'desc' => 'Notice issued regarding inconsistent use of protective gear by dressing-line personnel; investigation ongoing.', 'office' => 'NMIS-R7-CEB-MAN', 'issued_at' => '2025-04-21', 'status' => 'issued', 'issuer' => 'NMIS-2026-0017'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0024', 'violation' => 'VIO-2026-00010', 'type' => 'Notice Of Violation', 'desc' => 'Notice issued regarding a display chiller operating above required cold-chain temperature; investigation ongoing.', 'office' => 'NMIS-R11-DDN-PAN', 'issued_at' => '2025-07-02', 'status' => 'issued', 'issuer' => 'NMIS-2026-0025'],
            ['subject' => 'MTV Operator', 'key' => 'Pampanga Livestock Movers Inc.', 'violation' => 'VIO-2026-00014', 'type' => 'Show Cause Order', 'desc' => 'Operator directed to show cause why its accreditation should not be suspended following a failed refrigeration test.', 'office' => 'NMIS-R3-PAM-SFC', 'issued_at' => '2025-12-09', 'status' => 'issued', 'issuer' => 'NMIS-2026-0015'],
            ['subject' => 'MTV Operator', 'key' => 'Cebu Provincial Livestock Carriers', 'violation' => 'VIO-2026-00017', 'type' => 'Notice Of Violation', 'desc' => 'Notice issued for a shipment found in transit without an accompanying veterinary health certificate.', 'office' => 'NMIS-R7-CEB', 'issued_at' => '2025-07-28', 'status' => 'contested', 'issuer' => 'NMIS-2026-0008'],
            ['subject' => 'MTV Vehicle', 'key' => 'PMK 5501', 'violation' => 'VIO-2026-00020', 'type' => 'Notice Of Violation', 'desc' => 'Notice issued regarding recorded temperature excursions during transit; investigation ongoing.', 'office' => 'NMIS-NCR-MKT', 'issued_at' => '2025-09-12', 'status' => 'issued', 'issuer' => 'NMIS-2026-0013'],
            ['subject' => 'MTV Vehicle', 'key' => 'MND 1501', 'violation' => 'VIO-2026-00022', 'type' => 'Notice Of Violation', 'desc' => 'Notice issued after the driver could not present a health certificate for the shipment on board.', 'office' => 'NMIS-R7-CEB-MAN', 'issued_at' => '2025-05-18', 'status' => 'acknowledged', 'issuer' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Operator', 'key' => 'Davao del Norte Cold Transport Co.', 'violation' => 'VIO-2026-00028', 'type' => 'Show Cause Order', 'desc' => 'Operator directed to show cause why further sanctions should not apply for continuing operations despite an active revocation order.', 'office' => 'NMIS-R11-DDN', 'issued_at' => '2025-12-27', 'status' => 'issued', 'issuer' => 'NMIS-2026-0009'],

            // --- Standalone, not tied to a specific logged violation (5) ---
            ['subject' => 'MTV Operator', 'key' => 'Manila Meat Logistics Inc.', 'violation' => null, 'type' => 'Fine', 'desc' => 'Monetary fine imposed in addition to the Suspension for continued operation of an unpermitted vehicle.', 'penalty' => 75000.00, 'office' => 'NMIS-NCR-MNL', 'issued_at' => '2025-05-20', 'status' => 'complied', 'issuer' => 'NMIS-2026-0022'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0014', 'violation' => null, 'type' => 'Closure Order', 'desc' => 'Establishment ordered permanently closed following repeated non-compliance and the owner\'s cessation of operations.', 'office' => 'NMIS-R4A-LAG-LOS', 'issued_at' => '2023-07-20', 'status' => 'complied', 'issuer' => 'NMIS-2026-0021'],
            ['subject' => 'MTV Operator', 'key' => 'Aurelio Panopio', 'violation' => null, 'type' => 'Closure Order', 'desc' => 'Operator\'s accreditation formally closed following voluntary cessation of transport operations.', 'office' => 'NMIS-R4A-LAG-LOS', 'issued_at' => '2022-09-10', 'status' => 'complied', 'issuer' => 'NMIS-2026-0021'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'violation' => null, 'type' => 'Fine', 'desc' => 'Monetary fine imposed in addition to the revocation for the sale of previously condemned stock.', 'penalty' => 100000.00, 'office' => 'NMIS-R7-CEB-MAN', 'issued_at' => '2024-02-20', 'status' => 'contested', 'issuer' => 'NMIS-2026-0024'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0001', 'violation' => null, 'type' => 'Warning', 'desc' => 'Proactive advisory issued reminding the establishment of its upcoming accreditation renewal requirements.', 'office' => 'NMIS-NCR-QC', 'issued_at' => '2026-02-01', 'status' => 'acknowledged', 'issuer' => 'NMIS-2026-0011'],
        ];

        foreach ($actions as $i => $a) {
            $subjectId = match ($a['subject']) {
                'Meat Establishment' => $establishments[$a['key']],
                'MTV Operator' => $operators[$a['key']],
                'MTV Vehicle' => $vehicles[$a['key']],
            };

            EnforcementAction::create([
                'subject_type' => $a['subject'],
                'subject_id' => $subjectId,
                'violation_id' => $a['violation'] ? $violations[$a['violation']] : null,
                'action_number' => sprintf('EA-2026-%05d', $i + 1),
                'action_type' => $a['type'],
                'description' => $a['desc'],
                'penalty_amount' => $a['penalty'] ?? null,
                'issued_by' => $users[$a['issuer']],
                'office_id' => $offices[$a['office']],
                'issued_at' => $a['issued_at'],
                'effectivity_date' => $a['effectivity'] ?? null,
                'expiry_date' => $a['expiry'] ?? null,
                'status' => $a['status'],
            ]);
        }
    }
}
