<?php

namespace Database\Seeders;

use App\Models\ViolationType;
use Illuminate\Database\Seeder;

class ViolationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            // Sanitation
            ['code' => 'VC-001', 'title' => 'Unsanitary slaughtering conditions', 'category' => 'Sanitation', 'legal_basis' => 'RA 9296, Sec. 12', 'severity' => 'Major', 'description' => 'Slaughter area, equipment, or personnel fail to meet minimum hygiene standards during dressing or processing.'],
            ['code' => 'VC-002', 'title' => 'Improper waste and effluent disposal', 'category' => 'Sanitation', 'legal_basis' => 'RA 9296, IRR Sec. 8', 'severity' => 'Major', 'description' => 'Blood, offal, or wastewater discharged without proper treatment or disposal facilities.'],
            ['code' => 'VC-003', 'title' => 'Presence of pests or vermin in processing area', 'category' => 'Sanitation', 'legal_basis' => 'RA 9296, IRR Sec. 8', 'severity' => 'Minor', 'description' => 'Evidence of rodents, insects, or other pests within the establishment\'s processing or storage areas.'],
            ['code' => 'VC-004', 'title' => 'Inadequate handwashing and sanitation facilities', 'category' => 'Sanitation', 'legal_basis' => 'RA 9296, IRR Sec. 8', 'severity' => 'Minor', 'description' => 'Handwashing stations, sanitizers, or protective gear are missing, broken, or unused by personnel.'],
            ['code' => 'VC-005', 'title' => 'Contaminated equipment or work surfaces', 'category' => 'Sanitation', 'legal_basis' => 'RA 9296, IRR Sec. 8', 'severity' => 'Critical', 'description' => 'Cutting tools, tables, or containers show visible contamination posing immediate food safety risk.'],

            // Documentation
            ['code' => 'VC-006', 'title' => 'Failure to present valid accreditation certificate', 'category' => 'Documentation', 'legal_basis' => 'RA 9296, Sec. 9', 'severity' => 'Major', 'description' => 'Establishment or operator cannot produce a valid, current accreditation certificate upon inspection.'],
            ['code' => 'VC-007', 'title' => 'Incomplete inspection or movement records', 'category' => 'Documentation', 'legal_basis' => 'RA 9296, IRR Sec. 10', 'severity' => 'Minor', 'description' => 'Required logbooks, movement permits, or inspection records are missing entries or not properly maintained.'],
            ['code' => 'VC-008', 'title' => 'Falsified or altered official documents', 'category' => 'Documentation', 'legal_basis' => 'RA 9296, Sec. 15', 'severity' => 'Critical', 'description' => 'Health certificates, permits, or shipping documents show signs of tampering or falsification.'],
            ['code' => 'VC-009', 'title' => 'Expired permit still in use', 'category' => 'Documentation', 'legal_basis' => 'RA 9296, IRR Sec. 10', 'severity' => 'Major', 'description' => 'Establishment, operator, or vehicle continues operating on a permit past its expiry date.'],

            // Unauthorized Operation
            ['code' => 'VC-010', 'title' => 'Operating without NMIS accreditation', 'category' => 'Unauthorized Operation', 'legal_basis' => 'RA 9296, Sec. 9', 'severity' => 'Critical', 'description' => 'Establishment conducts slaughter, processing, or transport activities without any NMIS accreditation on file.'],
            ['code' => 'VC-011', 'title' => 'Operating beyond accredited scope', 'category' => 'Unauthorized Operation', 'legal_basis' => 'RA 9296, IRR Sec. 9', 'severity' => 'Major', 'description' => 'Establishment performs activities (e.g. processing) beyond what its accreditation type covers (e.g. slaughter only).'],
            ['code' => 'VC-012', 'title' => 'Unauthorized use of NMIS seal or mark', 'category' => 'Unauthorized Operation', 'legal_basis' => 'RA 9296, Sec. 15', 'severity' => 'Critical', 'description' => 'NMIS inspection mark or seal is used on products not actually inspected or approved.'],
            ['code' => 'VC-013', 'title' => 'Operating a suspended or revoked establishment', 'category' => 'Unauthorized Operation', 'legal_basis' => 'RA 9296, IRR Sec. 9', 'severity' => 'Critical', 'description' => 'Establishment continues operations despite an active suspension or revocation order.'],

            // Animal Welfare
            ['code' => 'VC-014', 'title' => 'Inhumane handling of animals prior to slaughter', 'category' => 'Animal Welfare', 'legal_basis' => 'RA 9296, IRR Sec. 11', 'severity' => 'Major', 'description' => 'Animals subjected to excessive force, overcrowding, or stress during holding or handling.'],
            ['code' => 'VC-015', 'title' => 'Slaughter of animals without stunning', 'category' => 'Animal Welfare', 'legal_basis' => 'RA 9296, IRR Sec. 11', 'severity' => 'Major', 'description' => 'Animals slaughtered without proper stunning procedure required for humane dispatch.'],
            ['code' => 'VC-016', 'title' => 'Denial of adequate rest, water, or feed before slaughter', 'category' => 'Animal Welfare', 'legal_basis' => 'RA 9296, IRR Sec. 11', 'severity' => 'Minor', 'description' => 'Animals not given the required rest period, water, or feed prior to slaughter.'],
            ['code' => 'VC-017', 'title' => 'Transport of animals in overcrowded conditions', 'category' => 'Animal Welfare', 'legal_basis' => 'RA 9296, IRR Sec. 11', 'severity' => 'Major', 'description' => 'Live animals transported in numbers or configurations that exceed safe and humane capacity.'],

            // Transport Violation
            ['code' => 'VC-018', 'title' => 'Transport vehicle without valid MTV permit', 'category' => 'Transport Violation', 'legal_basis' => 'RA 9296, IRR Sec. 13', 'severity' => 'Critical', 'description' => 'Vehicle used to transport meat or live animals lacks a valid meat transport vehicle permit.'],
            ['code' => 'VC-019', 'title' => 'Improper refrigeration during transport', 'category' => 'Transport Violation', 'legal_basis' => 'RA 9296, IRR Sec. 13', 'severity' => 'Major', 'description' => 'Refrigerated or insulated vehicle fails to maintain required temperature for meat products in transit.'],
            ['code' => 'VC-020', 'title' => 'Co-mingling of meat with non-food cargo', 'category' => 'Transport Violation', 'legal_basis' => 'RA 9296, IRR Sec. 13', 'severity' => 'Major', 'description' => 'Meat products transported alongside chemicals, fuel, or other contaminating cargo in the same compartment.'],
            ['code' => 'VC-021', 'title' => 'Transport of meat without accompanying health certificate', 'category' => 'Transport Violation', 'legal_basis' => 'RA 9296, IRR Sec. 13', 'severity' => 'Major', 'description' => 'Meat shipment in transit is not accompanied by the required veterinary health certificate.'],
            ['code' => 'VC-022', 'title' => 'Use of unregistered or unmarked transport vehicle', 'category' => 'Transport Violation', 'legal_basis' => 'RA 9296, IRR Sec. 13', 'severity' => 'Minor', 'description' => 'Vehicle used for meat transport is not registered with NMIS or lacks required identification markings.'],

            // Food Safety
            ['code' => 'VC-023', 'title' => 'Sale or distribution of condemned meat', 'category' => 'Food Safety', 'legal_basis' => 'RA 9296, Sec. 15', 'severity' => 'Critical', 'description' => 'Meat previously condemned during inspection is found being sold, transported, or offered for distribution.'],
            ['code' => 'VC-024', 'title' => 'Presence of "hot meat" (unregistered, uninspected)', 'category' => 'Food Safety', 'legal_basis' => 'RA 9296, Sec. 15', 'severity' => 'Critical', 'description' => 'Meat product found without proof of NMIS inspection or origin from an accredited establishment.'],
            ['code' => 'VC-025', 'title' => 'Improper storage temperature at point of sale', 'category' => 'Food Safety', 'legal_basis' => 'RA 9296, IRR Sec. 8', 'severity' => 'Major', 'description' => 'Meat displayed or stored at a retail point without maintaining required cold chain temperature.'],
            ['code' => 'VC-026', 'title' => 'Mislabeling of meat product origin or type', 'category' => 'Food Safety', 'legal_basis' => 'RA 9296, Sec. 15', 'severity' => 'Major', 'description' => 'Product labeled with false or misleading information regarding species, origin, or inspection status.'],
            ['code' => 'VC-027', 'title' => 'Use of unauthorized additives or preservatives', 'category' => 'Food Safety', 'legal_basis' => 'RA 9296, IRR Sec. 8', 'severity' => 'Critical', 'description' => 'Meat product found to contain substances not approved for use in meat preservation or processing.'],

            // Other
            ['code' => 'VC-028', 'title' => 'Obstruction of an NMIS inspector', 'category' => 'Other', 'legal_basis' => 'RA 9296, Sec. 15', 'severity' => 'Critical', 'description' => 'Establishment personnel or operator prevents, delays, or interferes with a lawful inspection.'],
            ['code' => 'VC-029', 'title' => 'Failure to comply with a prior corrective action', 'category' => 'Other', 'legal_basis' => 'RA 9296, IRR Sec. 14', 'severity' => 'Major', 'description' => 'Entity fails to implement corrective measures required by a previous inspection or enforcement action within the given period.'],
            ['code' => 'VC-030', 'title' => 'Miscellaneous non-compliance', 'category' => 'Other', 'legal_basis' => 'RA 9296, IRR (general)', 'severity' => 'Minor', 'description' => 'Any other minor non-compliance not falling under a specific category above; use sparingly and prefer a specific type when one applies.'],
        ];

        foreach ($types as $t) {
            ViolationType::create([
                'code' => $t['code'],
                'title' => $t['title'],
                'category' => $t['category'],
                'legal_basis' => $t['legal_basis'],
                'default_severity' => $t['severity'],
                'description' => $t['description'],
                'is_active' => true,
            ]);
        }
    }
}
