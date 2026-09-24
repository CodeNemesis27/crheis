<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use App\Models\Office;
use App\Models\User;
use App\Models\Violation;
use App\Models\ViolationType;
use Illuminate\Database\Seeder;

class ViolationSeeder extends Seeder
{
    public function run(): void
    {
        $establishments = MeatEstablishment::pluck('id', 'registration_number');
        $operators = MtvOperator::pluck('id', 'operator_name');
        $vehicles = MtvVehicle::pluck('id', 'plate_number');
        $violationTypes = ViolationType::pluck('id', 'code');
        $inspections = Inspection::pluck('id', 'report_number');
        $offices = Office::pluck('id', 'code');
        $users = User::pluck('id', 'employee_id');

        $violations = [
            // --- Linked to a Failed / Passed With Findings inspection (25) ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0003', 'inspection' => 'INSP-2026-00002', 'type' => 'VC-007', 'date' => '2026-02-03', 'severity' => 'Minor', 'status' => 'Open', 'desc' => 'Pre-accreditation review found the establishment\'s movement logbook incomplete for the past quarter.', 'office' => 'NMIS-NCR-QC', 'reporter' => 'NMIS-2026-0011'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0004', 'inspection' => 'INSP-2026-00003', 'type' => 'VC-001', 'date' => '2025-06-10', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Complaint-based inspection found slaughter area failing minimum hygiene standards; establishment was subsequently suspended.', 'office' => 'NMIS-NCR-MNL', 'reporter' => 'NMIS-2026-0012'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0006', 'inspection' => 'INSP-2026-00004', 'type' => 'VC-004', 'date' => '2025-09-22', 'severity' => 'Minor', 'status' => 'Resolved', 'desc' => 'Handwashing station at the meat market section was found broken during routine inspection; since repaired.', 'office' => 'NMIS-NCR-MKT', 'reporter' => 'NMIS-2026-0013'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0007', 'inspection' => 'INSP-2026-00005', 'type' => 'VC-009', 'date' => '2024-04-20', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Establishment continued cutting operations on an accreditation that had already lapsed at the time of renewal inspection.', 'office' => 'NMIS-NCR-MKT', 'reporter' => 'NMIS-2026-0013'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0009', 'inspection' => 'INSP-2026-00007', 'type' => 'VC-003', 'date' => '2025-08-11', 'severity' => 'Minor', 'status' => 'Resolved', 'desc' => 'Evidence of rodent activity noted near the cold storage entrance; pest control since engaged.', 'office' => 'NMIS-R3-BUL', 'reporter' => 'NMIS-2026-0006'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0013', 'inspection' => 'INSP-2026-00011', 'type' => 'VC-002', 'date' => '2025-05-16', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Untreated wastewater found discharging directly into an adjacent drainage canal; establishment subsequently suspended.', 'office' => 'NMIS-R4A-CAV', 'reporter' => 'NMIS-2026-0007'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0016', 'inspection' => 'INSP-2026-00013', 'type' => 'VC-004', 'date' => '2025-04-14', 'severity' => 'Minor', 'status' => 'Under Investigation', 'desc' => 'Inconsistent use of protective gear observed among dressing-line personnel during routine inspection.', 'office' => 'NMIS-R7-CEB-MAN', 'reporter' => 'NMIS-2026-0017'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'inspection' => 'INSP-2026-00014', 'type' => 'VC-023', 'date' => '2024-01-30', 'severity' => 'Critical', 'status' => 'Resolved', 'desc' => 'Previously condemned stock was found being displayed for sale at the meat market; accreditation was subsequently revoked.', 'office' => 'NMIS-R7-CEB-MAN', 'reporter' => 'NMIS-2026-0017'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0023', 'inspection' => 'INSP-2026-00017', 'type' => 'VC-029', 'date' => '2025-09-29', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Follow-up inspection confirmed corrective actions from an earlier finding were never implemented; establishment suspended as a result.', 'office' => 'NMIS-R11-DDS', 'reporter' => 'NMIS-2026-0009'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0024', 'inspection' => 'INSP-2026-00018', 'type' => 'VC-025', 'date' => '2025-06-25', 'severity' => 'Major', 'status' => 'Under Investigation', 'desc' => 'Display chiller at the meat market was found running above required cold-chain temperature.', 'office' => 'NMIS-R11-DDN-PAN', 'reporter' => 'NMIS-2026-0025'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0029', 'inspection' => 'INSP-2026-00020', 'type' => 'VC-024', 'date' => '2024-03-07', 'severity' => 'Critical', 'status' => 'Resolved', 'desc' => 'Meat found on premises with no proof of NMIS inspection or accredited source; accreditation subsequently revoked.', 'office' => 'NMIS-R12-SUK', 'reporter' => 'NMIS-2026-0010'],

            ['subject' => 'MTV Operator', 'key' => 'QC Cold Haulers Corp.', 'inspection' => 'INSP-2026-00022', 'type' => 'VC-022', 'date' => '2025-05-30', 'severity' => 'Minor', 'status' => 'Resolved', 'desc' => 'One unit in the fleet was found operating without the required NMIS identification markings; since corrected.', 'office' => 'NMIS-NCR-QC', 'reporter' => 'NMIS-2026-0011'],
            ['subject' => 'MTV Operator', 'key' => 'Manila Meat Logistics Inc.', 'inspection' => 'INSP-2026-00023', 'type' => 'VC-018', 'date' => '2025-04-22', 'severity' => 'Critical', 'status' => 'Resolved', 'desc' => 'A vehicle in active use was found without any valid MTV permit; operator accreditation was subsequently suspended.', 'office' => 'NMIS-NCR-MNL', 'reporter' => 'NMIS-2026-0012'],
            ['subject' => 'MTV Operator', 'key' => 'Pampanga Livestock Movers Inc.', 'inspection' => 'INSP-2026-00026', 'type' => 'VC-019', 'date' => '2025-12-02', 'severity' => 'Major', 'status' => 'Under Investigation', 'desc' => 'Renewal inspection found refrigeration unit failing to hold required temperature over a two-hour test period.', 'office' => 'NMIS-R3-PAM-SFC', 'reporter' => 'NMIS-2026-0015'],
            ['subject' => 'MTV Operator', 'key' => 'Cavite Meat Haulage Solutions', 'inspection' => 'INSP-2026-00027', 'type' => 'VC-020', 'date' => '2023-11-18', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Meat products found transported alongside drums of automotive fluid in the same compartment; accreditation subsequently revoked.', 'office' => 'NMIS-R4A-CAV-DAS', 'reporter' => 'NMIS-2026-0016'],
            ['subject' => 'MTV Operator', 'key' => 'Anastacio Gabatin', 'inspection' => 'INSP-2026-00030', 'type' => 'VC-029', 'date' => '2025-03-27', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Follow-up inspection confirmed prior refrigeration defect was never repaired; operator subsequently suspended.', 'office' => 'NMIS-R7-CEB-MAN', 'reporter' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Operator', 'key' => 'Cebu Provincial Livestock Carriers', 'inspection' => 'INSP-2026-00031', 'type' => 'VC-021', 'date' => '2025-07-21', 'severity' => 'Major', 'status' => 'Under Investigation', 'desc' => 'One shipment in transit was found without an accompanying veterinary health certificate.', 'office' => 'NMIS-R7-CEB', 'reporter' => 'NMIS-2026-0008'],
            ['subject' => 'MTV Operator', 'key' => 'Feliciano Undag', 'inspection' => 'INSP-2026-00035', 'type' => 'VC-017', 'date' => '2025-01-08', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Complaint alleged livestock transported well beyond safe vehicle capacity; operator accreditation subsequently suspended.', 'office' => 'NMIS-R12-SCT', 'reporter' => 'NMIS-2026-0010'],

            ['subject' => 'MTV Vehicle', 'key' => 'WGD 3301', 'inspection' => 'INSP-2026-00038', 'type' => 'VC-018', 'date' => '2025-04-25', 'severity' => 'Critical', 'status' => 'Resolved', 'desc' => 'Vehicle was flagged at a checkpoint operating on an MTV permit that had never been issued.', 'office' => 'NMIS-NCR-MNL', 'reporter' => 'NMIS-2026-0012'],
            ['subject' => 'MTV Vehicle', 'key' => 'PMK 5501', 'inspection' => 'INSP-2026-00039', 'type' => 'VC-019', 'date' => '2025-09-05', 'severity' => 'Major', 'status' => 'Under Investigation', 'desc' => 'Onboard temperature log showed several excursions above the required threshold during transit.', 'office' => 'NMIS-NCR-MKT', 'reporter' => 'NMIS-2026-0013'],
            ['subject' => 'MTV Vehicle', 'key' => 'PCV 9201', 'inspection' => 'INSP-2026-00042', 'type' => 'VC-020', 'date' => '2023-10-02', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Vehicle found hauling meat alongside construction materials in the same open bed; permit subsequently revoked.', 'office' => 'NMIS-R4A-CAV-DAS', 'reporter' => 'NMIS-2026-0016'],
            ['subject' => 'MTV Vehicle', 'key' => 'MND 1501', 'inspection' => 'INSP-2026-00044', 'type' => 'VC-021', 'date' => '2025-05-11', 'severity' => 'Major', 'status' => 'Under Investigation', 'desc' => 'Driver could not present a health certificate for the shipment currently on board.', 'office' => 'NMIS-R7-CEB-MAN', 'reporter' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Vehicle', 'key' => 'CEB 1601', 'inspection' => 'INSP-2026-00045', 'type' => 'VC-029', 'date' => '2025-04-02', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Follow-up inspection found the refrigeration unit still non-functional weeks after the required repair deadline; permit subsequently suspended.', 'office' => 'NMIS-R7-CEB-MAN', 'reporter' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVO 2101', 'inspection' => 'INSP-2026-00048', 'type' => 'VC-009', 'date' => '2024-02-06', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Vehicle continued operating on an MTV permit past its expiry at the time of renewal inspection.', 'office' => 'NMIS-R11-DDS-DIG', 'reporter' => 'NMIS-2026-0019'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2401', 'inspection' => 'INSP-2026-00049', 'type' => 'VC-017', 'date' => '2023-12-15', 'severity' => 'Major', 'status' => 'Resolved', 'desc' => 'Vehicle stopped at a checkpoint was found carrying livestock well past its rated capacity; permit subsequently revoked.', 'office' => 'NMIS-R11-DDN', 'reporter' => 'NMIS-2026-0009'],

            // --- Standalone, reported independently of a logged inspection (5) ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0002', 'inspection' => null, 'type' => 'VC-026', 'date' => '2025-08-19', 'severity' => 'Major', 'status' => 'Open', 'desc' => 'Consumer complaint alleged processed meat products were labeled as beef despite lab findings suggesting otherwise; under verification.', 'office' => 'NMIS-NCR-QC', 'reporter' => 'NMIS-2026-0011'],
            ['subject' => 'MTV Vehicle', 'key' => 'NEA 6602', 'inspection' => null, 'type' => 'VC-022', 'date' => '2025-10-30', 'severity' => 'Minor', 'status' => 'Open', 'desc' => 'Vehicle spotted on route without visible NMIS transport markings; formal inspection has not yet been scheduled.', 'office' => 'NMIS-R3-BUL-MAL', 'reporter' => 'NMIS-2026-0014'],
            ['subject' => 'MTV Operator', 'key' => 'Davao del Norte Cold Transport Co.', 'inspection' => null, 'type' => 'VC-013', 'date' => '2025-12-20', 'severity' => 'Critical', 'status' => 'Under Investigation', 'desc' => 'Reports indicate the operator continued hauling shipments despite an active revocation order.', 'office' => 'NMIS-R11-DDN', 'reporter' => 'NMIS-2026-0009'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0030', 'inspection' => null, 'type' => 'VC-002', 'date' => '2026-01-15', 'severity' => 'Major', 'status' => 'Open', 'desc' => 'Nearby residents reported untreated rendering by-products being discharged into a storm drain.', 'office' => 'NMIS-NCR', 'reporter' => 'NMIS-2026-0005'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2301', 'inspection' => null, 'type' => 'VC-017', 'date' => '2025-11-02', 'severity' => 'Minor', 'status' => 'Dismissed', 'desc' => 'Initial report alleged overcrowded transport of live poultry; review found the load was within rated capacity.', 'office' => 'NMIS-R11-DDN-PAN', 'reporter' => 'NMIS-2026-0025'],

            // --- Repeat offenders (3) — same entities cited a second time ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'inspection' => null, 'type' => 'VC-024', 'date' => '2025-11-10', 'severity' => 'Critical', 'status' => 'Open', 'desc' => 'A subsequent spot check found meat products still being sold from the premises despite the standing revocation order.', 'office' => 'NMIS-R7-CEB-MAN', 'reporter' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Operator', 'key' => 'Anastacio Gabatin', 'inspection' => null, 'type' => 'VC-009', 'date' => '2025-08-02', 'severity' => 'Major', 'status' => 'Open', 'desc' => 'Operator found continuing pickups on an MTV permit that had already lapsed.', 'office' => 'NMIS-R7-CEB-MAN', 'reporter' => 'NMIS-2026-0017'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2401', 'inspection' => null, 'type' => 'VC-022', 'date' => '2023-09-10', 'severity' => 'Minor', 'status' => 'Resolved', 'desc' => 'Vehicle previously cited for operating without visible NMIS transport markings, corrected at the time.', 'office' => 'NMIS-R11-DDN', 'reporter' => 'NMIS-2026-0009'],
        ];

        foreach ($violations as $i => $v) {
            $subjectId = match ($v['subject']) {
                'Meat Establishment' => $establishments[$v['key']],
                'MTV Operator' => $operators[$v['key']],
                'MTV Vehicle' => $vehicles[$v['key']],
            };

            Violation::create([
                'subject_type' => $v['subject'],
                'subject_id' => $subjectId,
                'inspection_id' => $v['inspection'] ? $inspections[$v['inspection']] : null,
                'violation_type_id' => $violationTypes[$v['type']],
                'violation_number' => sprintf('VIO-2026-%05d', $i + 1),
                'date_committed' => $v['date'],
                'date_reported' => $v['date'],
                'severity' => $v['severity'],
                'description' => $v['desc'],
                'status' => $v['status'],
                'reported_by' => $users[$v['reporter']],
                'office_id' => $offices[$v['office']],
            ]);
        }
    }
}
