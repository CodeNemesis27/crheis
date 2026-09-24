<?php

namespace Database\Seeders;

use App\Models\Confiscation;
use App\Models\EnforcementCase;
use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConfiscationSeeder extends Seeder
{
    public function run(): void
    {
        $establishments = MeatEstablishment::pluck('id', 'registration_number');
        $operators = MtvOperator::pluck('id', 'operator_name');
        $vehicles = MtvVehicle::pluck('id', 'plate_number');
        $enforcementCases = EnforcementCase::pluck('id', 'case_number');
        $offices = Office::pluck('id', 'code');
        $users = User::pluck('id', 'employee_id');

        $confiscations = [
            // --- Linked to an enforcement case (12) ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0004', 'case' => 'CASE-2026-00001', 'type' => 'Seizure', 'commodity' => 'Carcass', 'date' => '2025-06-24', 'location' => 'Establishment premises, Tondo, Manila', 'desc' => 'Pork carcasses processed under unsanitary conditions, deemed unfit for sale.', 'qty' => 320, 'unit' => 'kg', 'value' => 96000, 'disposition' => 'Destroyed', 'disp_date' => '2025-06-26', 'office' => 'NMIS-NCR-MNL', 'officer' => 'NMIS-2026-0012'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0017', 'case' => 'CASE-2026-00004', 'type' => 'Confiscation', 'commodity' => 'Processed Meat', 'date' => '2024-02-13', 'location' => 'Mandaue Public Meat Market stall', 'desc' => 'Previously condemned meat found repackaged and displayed for sale.', 'qty' => 150, 'unit' => 'kg', 'value' => 45000, 'disposition' => 'Destroyed', 'disp_date' => '2024-02-16', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0017'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0029', 'case' => 'CASE-2026-00006', 'type' => 'Confiscation', 'commodity' => 'Processed Meat', 'date' => '2024-03-21', 'location' => 'Isulan Town Meat Shop', 'desc' => '"Hot meat" found with no proof of NMIS inspection or accredited source.', 'qty' => 80, 'unit' => 'kg', 'value' => 24000, 'disposition' => 'Destroyed', 'disp_date' => '2024-03-24', 'office' => 'NMIS-R12-SUK', 'officer' => 'NMIS-2026-0010'],
            ['subject' => 'MTV Operator', 'key' => 'Cavite Meat Haulage Solutions', 'case' => 'CASE-2026-00008', 'type' => 'Seizure', 'commodity' => 'Processed Meat', 'date' => '2023-12-02', 'location' => 'Provincial checkpoint, Dasmariñas, Cavite', 'desc' => 'Meat shipment seized after being transported alongside drums of automotive fluid.', 'qty' => 200, 'unit' => 'kg', 'value' => 60000, 'disposition' => 'Destroyed', 'disp_date' => '2023-12-05', 'office' => 'NMIS-R4A-CAV-DAS', 'officer' => 'NMIS-2026-0016'],
            ['subject' => 'MTV Operator', 'key' => 'Feliciano Undag', 'case' => 'CASE-2026-00010', 'type' => 'Apprehension', 'commodity' => 'Live Animal', 'date' => '2025-01-15', 'location' => 'Provincial checkpoint, Koronadal City', 'desc' => 'Hogs apprehended for transport well beyond the vehicle\'s rated capacity.', 'qty' => 45, 'unit' => 'heads', 'value' => 315000, 'disposition' => 'Released', 'disp_date' => '2025-01-18', 'office' => 'NMIS-R12-SCT', 'officer' => 'NMIS-2026-0010'],
            ['subject' => 'MTV Vehicle', 'key' => 'WGD 3301', 'case' => 'CASE-2026-00011', 'type' => 'Seizure', 'commodity' => 'Document', 'date' => '2025-04-25', 'location' => 'Roadside checkpoint, Tondo, Manila', 'desc' => 'MTV permit presented by the driver found to be falsified.', 'qty' => null, 'unit' => null, 'value' => null, 'disposition' => 'Pending', 'disp_date' => null, 'office' => 'NMIS-NCR-MNL', 'officer' => 'NMIS-2026-0012'],
            ['subject' => 'MTV Vehicle', 'key' => 'PCV 9201', 'case' => 'CASE-2026-00012', 'type' => 'Seizure', 'commodity' => 'Processed Meat', 'date' => '2023-10-02', 'location' => 'Provincial checkpoint, Dasmariñas, Cavite', 'desc' => 'Meat cargo seized due to co-mingling with non-food materials in the same compartment.', 'qty' => 175, 'unit' => 'kg', 'value' => 52500, 'disposition' => 'Destroyed', 'disp_date' => '2023-10-05', 'office' => 'NMIS-R4A-CAV-DAS', 'officer' => 'NMIS-2026-0016'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2401', 'case' => 'CASE-2026-00014', 'type' => 'Seizure', 'commodity' => 'Live Animal', 'date' => '2023-12-15', 'location' => 'Roadside checkpoint, Panabo City', 'desc' => 'Cattle seized after being found transported well past the vehicle\'s rated capacity.', 'qty' => 60, 'unit' => 'heads', 'value' => 720000, 'disposition' => 'Forfeited', 'disp_date' => '2023-12-29', 'office' => 'NMIS-R11-DDN', 'officer' => 'NMIS-2026-0009'],
            ['subject' => 'MTV Operator', 'key' => 'Davao del Norte Cold Transport Co.', 'case' => 'CASE-2026-00017', 'type' => 'Seizure', 'commodity' => 'Vehicle', 'date' => '2025-12-27', 'location' => 'Panabo City LGU checkpoint', 'desc' => 'Refrigerated van seized while operating despite an active revocation order.', 'qty' => null, 'unit' => null, 'value' => null, 'disposition' => 'Pending', 'disp_date' => null, 'office' => 'NMIS-R11-DDN', 'officer' => 'NMIS-2026-0009'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0014', 'case' => 'CASE-2026-00018', 'type' => 'Confiscation', 'commodity' => 'Equipment', 'date' => '2023-07-15', 'location' => 'Los Baños Old Town Meat Shop', 'desc' => 'Processing equipment confiscated upon the establishment\'s formal closure.', 'qty' => 4, 'unit' => 'units', 'value' => 30000, 'disposition' => 'Donated', 'disp_date' => '2023-07-25', 'office' => 'NMIS-R4A-LAG-LOS', 'officer' => 'NMIS-2026-0007'],
            ['subject' => 'MTV Operator', 'key' => 'Aurelio Panopio', 'case' => 'CASE-2026-00019', 'type' => 'Confiscation', 'commodity' => 'Vehicle', 'date' => '2022-09-05', 'location' => 'Operator premises, Los Baños, Laguna', 'desc' => 'Transport vehicle taken into custody upon the operator\'s formal closure.', 'qty' => 1, 'unit' => 'units', 'value' => 180000, 'disposition' => 'Sold', 'disp_date' => '2022-09-15', 'office' => 'NMIS-R4A-LAG-LOS', 'officer' => 'NMIS-2026-0007'],
            ['subject' => 'MTV Vehicle', 'key' => 'DVN 2301', 'case' => 'CASE-2026-00022', 'type' => 'Apprehension', 'commodity' => 'Live Animal', 'date' => '2025-11-05', 'location' => 'Panabo City LGU checkpoint', 'desc' => 'Poultry apprehended on a complaint of overcrowded transport, later found within rated capacity.', 'qty' => 30, 'unit' => 'heads', 'value' => 15000, 'disposition' => 'Released', 'disp_date' => '2025-11-20', 'office' => 'NMIS-R11-DDN-PAN', 'officer' => 'NMIS-2026-0025'],

            // --- Standalone, not tied to a formal case (18) ---
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0002', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Document', 'date' => '2025-08-19', 'location' => 'Metro Sarap Meat Processing Inc., Quezon City', 'desc' => 'Product labeling samples taken for laboratory verification of species and origin claims.', 'qty' => null, 'unit' => null, 'value' => null, 'disposition' => 'Pending', 'disp_date' => null, 'office' => 'NMIS-NCR-QC', 'officer' => 'NMIS-2026-0011'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0006', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Processed Meat', 'date' => '2025-09-22', 'location' => 'Makati Wet Market Meat Section', 'desc' => 'Surplus stock nearing expiry apprehended pending veterinary clearance.', 'qty' => 25, 'unit' => 'kg', 'value' => 7500, 'disposition' => 'Donated', 'disp_date' => '2025-09-25', 'office' => 'NMIS-NCR-MKT', 'officer' => 'NMIS-2026-0013'],
            ['subject' => 'MTV Vehicle', 'key' => 'NEA 6602', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Document', 'date' => '2025-10-30', 'location' => 'Provincial road, Malolos, Bulacan', 'desc' => 'Vehicle papers taken pending verification after unit was spotted without required NMIS markings.', 'qty' => null, 'unit' => null, 'value' => null, 'disposition' => 'Pending', 'disp_date' => null, 'office' => 'NMIS-R3-BUL-MAL', 'officer' => 'NMIS-2026-0014'],
            ['subject' => 'MTV Operator', 'key' => 'QC Cold Haulers Corp.', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Equipment', 'date' => '2025-06-06', 'location' => 'Novaliches depot, Quezon City', 'desc' => 'Unmarked insulated containers apprehended pending proper NMIS identification.', 'qty' => 3, 'unit' => 'units', 'value' => 9000, 'disposition' => 'Released', 'disp_date' => '2025-06-10', 'office' => 'NMIS-NCR-QC', 'officer' => 'NMIS-2026-0011'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0009', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Carcass', 'date' => '2025-08-11', 'location' => 'Bulacan Provincial Meat Processing Co.', 'desc' => 'Spoiled carcass found in cold storage during a pest-related inspection finding.', 'qty' => 60, 'unit' => 'kg', 'value' => 18000, 'disposition' => 'Destroyed', 'disp_date' => '2025-08-13', 'office' => 'NMIS-R3-BUL', 'officer' => 'NMIS-2026-0006'],
            ['subject' => 'MTV Vehicle', 'key' => 'NFA 8101', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Live Animal', 'date' => '2025-12-02', 'location' => 'Provincial checkpoint, San Fernando, Pampanga', 'desc' => 'Hogs apprehended for a routine capacity and documentation check; found compliant.', 'qty' => 20, 'unit' => 'heads', 'value' => 140000, 'disposition' => 'Released', 'disp_date' => '2025-12-02', 'office' => 'NMIS-R3-PAM-SFC', 'officer' => 'NMIS-2026-0015'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0011', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Other', 'date' => '2026-01-19', 'location' => 'Pampanga Cold Storage Facility', 'desc' => 'Unlabeled frozen goods held pending identification of contents and origin.', 'qty' => null, 'unit' => null, 'value' => null, 'disposition' => 'Pending', 'disp_date' => null, 'office' => 'NMIS-R3-PAM', 'officer' => 'NMIS-2026-0006'],
            ['subject' => 'MTV Vehicle', 'key' => 'NCD 0311', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Live Animal', 'date' => '2025-06-09', 'location' => 'Municipal checkpoint, Bancal, Cavite', 'desc' => 'Goats apprehended for a routine transport check; released after papers verified.', 'qty' => 12, 'unit' => 'heads', 'value' => 60000, 'disposition' => 'Released', 'disp_date' => '2025-06-09', 'office' => 'NMIS-R4A-CAV', 'officer' => 'NMIS-2026-0007'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0015', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Equipment', 'date' => '2025-10-08', 'location' => 'Laguna Lakeside Cutting Plant', 'desc' => 'Unlicensed automated cutting equipment found in use beyond the plant\'s accredited scope.', 'qty' => 2, 'unit' => 'units', 'value' => 45000, 'disposition' => 'Forfeited', 'disp_date' => '2025-10-15', 'office' => 'NMIS-R4A-LAG', 'officer' => 'NMIS-2026-0007'],
            ['subject' => 'MTV Vehicle', 'key' => 'MND 1502', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Processed Meat', 'date' => '2025-09-01', 'location' => 'City checkpoint, Mandaue City', 'desc' => 'Surplus stock apprehended for spot inspection; cleared and released to the community.', 'qty' => 55, 'unit' => 'kg', 'value' => 16500, 'disposition' => 'Donated', 'disp_date' => '2025-09-03', 'office' => 'NMIS-R7-CEB-MAN', 'officer' => 'NMIS-2026-0017'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0019', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Live Animal', 'date' => '2025-12-11', 'location' => 'Loon Poultry Dressing Station', 'desc' => 'Live poultry held pending confirmation of source farm accreditation.', 'qty' => 35, 'unit' => 'heads', 'value' => 24500, 'disposition' => 'Released', 'disp_date' => '2025-12-13', 'office' => 'NMIS-R7-BOH-LOO', 'officer' => 'NMIS-2026-0018'],
            ['subject' => 'MTV Vehicle', 'key' => 'CEB 1701', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Live Animal', 'date' => '2025-07-21', 'location' => 'Provincial checkpoint, Cebu', 'desc' => 'Cattle apprehended for a routine transport and documentation check; found compliant.', 'qty' => 18, 'unit' => 'heads', 'value' => 216000, 'disposition' => 'Released', 'disp_date' => '2025-07-21', 'office' => 'NMIS-R7-CEB', 'officer' => 'NMIS-2026-0008'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0021', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Carcass', 'date' => '2025-07-03', 'location' => 'Digos City Slaughterhouse', 'desc' => 'Carcass held pending re-inspection after questions raised on ante-mortem documentation.', 'qty' => 40, 'unit' => 'kg', 'value' => 12000, 'disposition' => 'Destroyed', 'disp_date' => '2025-07-05', 'office' => 'NMIS-R11-DDS-DIG', 'officer' => 'NMIS-2026-0019'],
            ['subject' => 'MTV Operator', 'key' => 'Davao South Meat Transport Corp.', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Processed Meat', 'date' => '2025-05-04', 'location' => 'City checkpoint, Digos City', 'desc' => 'Surplus stock apprehended for spot check; cleared and sold at the public market under supervision.', 'qty' => 90, 'unit' => 'kg', 'value' => 27000, 'disposition' => 'Sold', 'disp_date' => '2025-05-06', 'office' => 'NMIS-R11-DDS-DIG', 'officer' => 'NMIS-2026-0019'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0026', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Carcass', 'date' => '2025-11-19', 'location' => 'Koronadal Central Abattoir', 'desc' => 'Carcass condemned on-site for failing post-mortem inspection standards.', 'qty' => 70, 'unit' => 'kg', 'value' => 21000, 'disposition' => 'Destroyed', 'disp_date' => '2025-11-20', 'office' => 'NMIS-R12-SCT-KOR', 'officer' => 'NMIS-2026-0020'],
            ['subject' => 'MTV Operator', 'key' => 'Koronadal Meat Logistics Corp.', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Document', 'date' => '2025-08-05', 'location' => 'City checkpoint, Koronadal City', 'desc' => 'Trip ticket held for verification after discrepancies noted against the manifest.', 'qty' => null, 'unit' => null, 'value' => null, 'disposition' => 'Released', 'disp_date' => '2025-08-07', 'office' => 'NMIS-R12-SCT-KOR', 'officer' => 'NMIS-2026-0020'],
            ['subject' => 'Meat Establishment', 'key' => 'NMIS-EST-2026-0030', 'case' => null, 'type' => 'Confiscation', 'commodity' => 'Equipment', 'date' => '2026-01-15', 'location' => 'NCR Regional Meat By-Products Rendering Facility, Pasig City', 'desc' => 'Discharge pipe fittings taken as evidence following a report of untreated effluent release.', 'qty' => 1, 'unit' => 'units', 'value' => 5000, 'disposition' => 'Pending', 'disp_date' => null, 'office' => 'NMIS-NCR', 'officer' => 'NMIS-2026-0005'],
            ['subject' => 'MTV Vehicle', 'key' => 'SCT 2501', 'case' => null, 'type' => 'Apprehension', 'commodity' => 'Live Animal', 'date' => '2025-09-16', 'location' => 'City checkpoint, Koronadal City', 'desc' => 'Hogs apprehended for a routine transport check; found within rated capacity and released.', 'qty' => 22, 'unit' => 'heads', 'value' => 154000, 'disposition' => 'Released', 'disp_date' => '2025-09-16', 'office' => 'NMIS-R12-SCT-KOR', 'officer' => 'NMIS-2026-0020'],
        ];

        foreach ($confiscations as $i => $c) {
            $subjectId = match ($c['subject']) {
                'Meat Establishment' => $establishments[$c['key']],
                'MTV Operator' => $operators[$c['key']],
                'MTV Vehicle' => $vehicles[$c['key']],
            };

            Confiscation::create([
                'subject_type' => $c['subject'],
                'subject_id' => $subjectId,
                'enforcement_case_id' => $c['case'] ? $enforcementCases[$c['case']] : null,
                'confiscation_number' => sprintf('CONF-2026-%05d', $i + 1),
                'type' => $c['type'],
                'date_confiscated' => $c['date'],
                'location' => $c['location'],
                'item_description' => $c['desc'],
                'commodity_type' => $c['commodity'],
                'quantity' => $c['qty'],
                'unit' => $c['unit'],
                'estimated_value' => $c['value'],
                'apprehending_officer_id' => $users[$c['officer']],
                'office_id' => $offices[$c['office']],
                'disposition' => $c['disposition'],
                'disposition_date' => $c['disp_date'],
                'remarks' => null,
            ]);
        }
    }
}
