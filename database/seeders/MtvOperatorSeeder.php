<?php

namespace Database\Seeders;

use App\Models\MtvOperator;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;

class MtvOperatorSeeder extends Seeder
{
    public function run(): void
    {
        $offices = Office::pluck('id', 'code');
        $users = User::pluck('id', 'employee_id');

        $operators = [
            ['type' => 'individual', 'name' => 'Rogelio Mendiola', 'owner' => 'Rogelio Mendiola', 'permit' => 'BP-2026-00101', 'brgy' => 'Barangay Payatas', 'city' => 'Quezon City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-QC', 'creator' => 'NMIS-2026-0011', 'acc' => 'NMIS-MTV-2026-0001', 'status' => 'active', 'issued' => '2024-02-15', 'expiry' => '2027-02-15'],
            ['type' => 'company', 'name' => 'QC Cold Haulers Corp.', 'owner' => 'Marlon Vidal', 'permit' => 'BP-2026-00102', 'brgy' => 'Barangay Novaliches', 'city' => 'Quezon City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-QC', 'creator' => 'NMIS-2026-0011', 'acc' => 'NMIS-MTV-2026-0002', 'status' => 'active', 'issued' => '2023-10-01', 'expiry' => '2026-10-01'],
            ['type' => 'individual', 'name' => 'Servillano Buenaflor', 'owner' => 'Servillano Buenaflor', 'permit' => null, 'brgy' => 'Barangay Holy Spirit', 'city' => 'Quezon City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-QC', 'creator' => 'NMIS-2026-0011', 'acc' => null, 'status' => 'pending', 'issued' => null, 'expiry' => null],

            ['type' => 'company', 'name' => 'Manila Meat Logistics Inc.', 'owner' => 'Isagani Cordero', 'permit' => 'BP-2026-00103', 'brgy' => 'Barangay Sta. Cruz', 'city' => 'Manila', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MNL', 'creator' => 'NMIS-2026-0012', 'acc' => 'NMIS-MTV-2026-0004', 'status' => 'suspended', 'issued' => '2022-05-20', 'expiry' => '2025-05-20'],
            ['type' => 'individual', 'name' => 'Wilfredo Panganiban', 'owner' => 'Wilfredo Panganiban', 'permit' => null, 'brgy' => 'Barangay Tondo', 'city' => 'Manila', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MNL', 'creator' => 'NMIS-2026-0012', 'acc' => 'NMIS-MTV-2026-0005', 'status' => 'active', 'issued' => '2024-01-11', 'expiry' => '2027-01-11'],

            ['type' => 'company', 'name' => 'Makati Prime Transport Services', 'owner' => 'Leticia Aranda', 'permit' => 'BP-2026-00106', 'brgy' => 'Barangay San Lorenzo', 'city' => 'Makati', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MKT', 'creator' => 'NMIS-2026-0013', 'acc' => 'NMIS-MTV-2026-0006', 'status' => 'active', 'issued' => '2023-07-08', 'expiry' => '2026-07-08'],
            ['type' => 'individual', 'name' => 'Domingo Salcedo', 'owner' => 'Domingo Salcedo', 'permit' => null, 'brgy' => 'Barangay Guadalupe Viejo', 'city' => 'Makati', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MKT', 'creator' => 'NMIS-2026-0013', 'acc' => 'NMIS-MTV-2026-0007', 'status' => 'expired', 'issued' => '2021-04-02', 'expiry' => '2024-04-02'],

            ['type' => 'company', 'name' => 'Bulacan Fresh Transport Corp.', 'owner' => 'Andres Villareal', 'permit' => 'BP-2026-00108', 'brgy' => 'Barangay Sumapang Matanda', 'city' => 'City of Malolos', 'province' => 'Bulacan', 'region' => 'III', 'office' => 'NMIS-R3-BUL-MAL', 'creator' => 'NMIS-2026-0014', 'acc' => 'NMIS-MTV-2026-0008', 'status' => 'active', 'issued' => '2024-03-25', 'expiry' => '2027-03-25'],
            ['type' => 'individual', 'name' => 'Cirilo Manansala', 'owner' => 'Cirilo Manansala', 'permit' => null, 'brgy' => 'Barangay Caniogan', 'city' => null, 'province' => 'Bulacan', 'region' => 'III', 'office' => 'NMIS-R3-BUL', 'creator' => 'NMIS-2026-0006', 'acc' => 'NMIS-MTV-2026-0009', 'status' => 'active', 'issued' => '2023-12-19', 'expiry' => '2026-12-19'],

            ['type' => 'company', 'name' => 'Pampanga Livestock Movers Inc.', 'owner' => 'Teodoro Sicat', 'permit' => 'BP-2026-00110', 'brgy' => 'Barangay Del Pilar', 'city' => 'City of San Fernando', 'province' => 'Pampanga', 'region' => 'III', 'office' => 'NMIS-R3-PAM-SFC', 'creator' => 'NMIS-2026-0015', 'acc' => 'NMIS-MTV-2026-0010', 'status' => 'active', 'issued' => '2024-06-14', 'expiry' => '2027-06-14'],
            ['type' => 'individual', 'name' => 'Bernardo Yambao', 'owner' => 'Bernardo Yambao', 'permit' => null, 'brgy' => 'Barangay Sindalan', 'city' => null, 'province' => 'Pampanga', 'region' => 'III', 'office' => 'NMIS-R3-PAM', 'creator' => 'NMIS-2026-0006', 'acc' => null, 'status' => 'pending', 'issued' => null, 'expiry' => null],

            ['type' => 'company', 'name' => 'Cavite Meat Haulage Solutions', 'owner' => 'Rustico Lontoc', 'permit' => 'BP-2026-00112', 'brgy' => 'Barangay Zone IV', 'city' => 'City of Dasmariñas', 'province' => 'Cavite', 'region' => 'IV-A', 'office' => 'NMIS-R4A-CAV-DAS', 'creator' => 'NMIS-2026-0016', 'acc' => 'NMIS-MTV-2026-0012', 'status' => 'revoked', 'issued' => '2020-09-09', 'expiry' => '2023-09-09'],
            ['type' => 'individual', 'name' => 'Marcelino Rivas', 'owner' => 'Marcelino Rivas', 'permit' => null, 'brgy' => 'Barangay Bancal', 'city' => null, 'province' => 'Cavite', 'region' => 'IV-A', 'office' => 'NMIS-R4A-CAV', 'creator' => 'NMIS-2026-0007', 'acc' => 'NMIS-MTV-2026-0013', 'status' => 'active', 'issued' => '2023-11-27', 'expiry' => '2026-11-27'],

            ['type' => 'individual', 'name' => 'Aurelio Panopio', 'owner' => 'Aurelio Panopio', 'permit' => null, 'brgy' => 'Barangay Batong Malake', 'city' => 'Los Baños', 'province' => 'Laguna', 'region' => 'IV-A', 'office' => 'NMIS-R4A-LAG-LOS', 'creator' => 'NMIS-2026-0007', 'acc' => 'NMIS-MTV-2026-0014', 'status' => 'closed', 'issued' => '2019-08-30', 'expiry' => '2022-08-30'],
            ['type' => 'company', 'name' => 'Laguna Meat Transport Alliance', 'owner' => 'Priscila Nazareno', 'permit' => 'BP-2026-00115', 'brgy' => 'Barangay Bubukal', 'city' => null, 'province' => 'Laguna', 'region' => 'IV-A', 'office' => 'NMIS-R4A-LAG', 'creator' => 'NMIS-2026-0007', 'acc' => 'NMIS-MTV-2026-0015', 'status' => 'active', 'issued' => '2024-04-05', 'expiry' => '2027-04-05'],

            ['type' => 'company', 'name' => 'Mandaue Refrigerated Transport Co.', 'owner' => 'Honesto Sarmiento', 'permit' => 'BP-2026-00116', 'brgy' => 'Barangay Tipolo', 'city' => 'City of Mandaue', 'province' => 'Cebu', 'region' => 'VII', 'office' => 'NMIS-R7-CEB-MAN', 'creator' => 'NMIS-2026-0017', 'acc' => 'NMIS-MTV-2026-0016', 'status' => 'active', 'issued' => '2023-08-22', 'expiry' => '2026-08-22'],
            ['type' => 'individual', 'name' => 'Anastacio Gabatin', 'owner' => 'Anastacio Gabatin', 'permit' => null, 'brgy' => 'Barangay Basak', 'city' => 'City of Mandaue', 'province' => 'Cebu', 'region' => 'VII', 'office' => 'NMIS-R7-CEB-MAN', 'creator' => 'NMIS-2026-0017', 'acc' => 'NMIS-MTV-2026-0017', 'status' => 'suspended', 'issued' => '2022-03-13', 'expiry' => '2025-03-13'],
            ['type' => 'company', 'name' => 'Cebu Provincial Livestock Carriers', 'owner' => 'Encarnacion Ybiernas', 'permit' => 'BP-2026-00118', 'brgy' => 'Barangay Lahug', 'city' => null, 'province' => 'Cebu', 'region' => 'VII', 'office' => 'NMIS-R7-CEB', 'creator' => 'NMIS-2026-0008', 'acc' => 'NMIS-MTV-2026-0018', 'status' => 'active', 'issued' => '2024-05-30', 'expiry' => '2027-05-30'],

            ['type' => 'individual', 'name' => 'Rufino Delantar', 'owner' => 'Rufino Delantar', 'permit' => null, 'brgy' => 'Barangay Cabacnitan', 'city' => 'Loon', 'province' => 'Bohol', 'region' => 'VII', 'office' => 'NMIS-R7-BOH-LOO', 'creator' => 'NMIS-2026-0018', 'acc' => 'NMIS-MTV-2026-0019', 'status' => 'active', 'issued' => '2023-06-17', 'expiry' => '2026-06-17'],
            ['type' => 'company', 'name' => 'Bohol Island Meat Movers Corp.', 'owner' => 'Feliciano Bagcal', 'permit' => 'BP-2026-00120', 'brgy' => 'Barangay Cogon', 'city' => null, 'province' => 'Bohol', 'region' => 'VII', 'office' => 'NMIS-R7-BOH', 'creator' => 'NMIS-2026-0008', 'acc' => null, 'status' => 'pending', 'issued' => null, 'expiry' => null],

            ['type' => 'company', 'name' => 'Davao South Meat Transport Corp.', 'owner' => 'Eusebio Calamba', 'permit' => 'BP-2026-00121', 'brgy' => 'Barangay Zone 2', 'city' => 'Digos City', 'province' => 'Davao del Sur', 'region' => 'XI', 'office' => 'NMIS-R11-DDS-DIG', 'creator' => 'NMIS-2026-0019', 'acc' => 'NMIS-MTV-2026-0021', 'status' => 'active', 'issued' => '2024-02-09', 'expiry' => '2027-02-09'],
            ['type' => 'individual', 'name' => 'Hermogenes Baladjay', 'owner' => 'Hermogenes Baladjay', 'permit' => null, 'brgy' => 'Barangay Aplaya', 'city' => 'Digos City', 'province' => 'Davao del Sur', 'region' => 'XI', 'office' => 'NMIS-R11-DDS-DIG', 'creator' => 'NMIS-2026-0019', 'acc' => 'NMIS-MTV-2026-0022', 'status' => 'expired', 'issued' => '2021-01-25', 'expiry' => '2024-01-25'],
            ['type' => 'company', 'name' => 'Davao del Sur Provincial Haulers Inc.', 'owner' => 'Zosima Katipunan', 'permit' => 'BP-2026-00123', 'brgy' => 'Barangay Kiagot', 'city' => null, 'province' => 'Davao del Sur', 'region' => 'XI', 'office' => 'NMIS-R11-DDS', 'creator' => 'NMIS-2026-0009', 'acc' => 'NMIS-MTV-2026-0023', 'status' => 'active', 'issued' => '2023-09-14', 'expiry' => '2026-09-14'],

            ['type' => 'individual', 'name' => 'Anselmo Buendia', 'owner' => 'Anselmo Buendia', 'permit' => null, 'brgy' => 'Barangay San Francisco', 'city' => 'Panabo City', 'province' => 'Davao del Norte', 'region' => 'XI', 'office' => 'NMIS-R11-DDN-PAN', 'creator' => 'NMIS-2026-0025', 'acc' => 'NMIS-MTV-2026-0024', 'status' => 'active', 'issued' => '2024-07-01', 'expiry' => '2027-07-01'],
            ['type' => 'company', 'name' => 'Davao del Norte Cold Transport Co.', 'owner' => 'Loreto Ababon', 'permit' => 'BP-2026-00125', 'brgy' => 'Barangay Mankilam', 'city' => null, 'province' => 'Davao del Norte', 'region' => 'XI', 'office' => 'NMIS-R11-DDN', 'creator' => 'NMIS-2026-0009', 'acc' => 'NMIS-MTV-2026-0025', 'status' => 'revoked', 'issued' => '2020-12-05', 'expiry' => '2023-12-05'],

            ['type' => 'company', 'name' => 'Koronadal Meat Logistics Corp.', 'owner' => 'Cresencia Dumaguit', 'permit' => 'BP-2026-00126', 'brgy' => 'Barangay Zone III', 'city' => 'Koronadal City', 'province' => 'South Cotabato', 'region' => 'XII', 'office' => 'NMIS-R12-SCT-KOR', 'creator' => 'NMIS-2026-0020', 'acc' => 'NMIS-MTV-2026-0026', 'status' => 'active', 'issued' => '2024-03-18', 'expiry' => '2027-03-18'],
            ['type' => 'individual', 'name' => 'Feliciano Undag', 'owner' => 'Feliciano Undag', 'permit' => null, 'brgy' => 'Barangay General Paulino Santos', 'city' => null, 'province' => 'South Cotabato', 'region' => 'XII', 'office' => 'NMIS-R12-SCT', 'creator' => 'NMIS-2026-0010', 'acc' => 'NMIS-MTV-2026-0027', 'status' => 'suspended', 'issued' => '2022-07-27', 'expiry' => '2025-07-27'],

            ['type' => 'individual', 'name' => 'Datu Renato Sinsuat', 'owner' => 'Datu Renato Sinsuat', 'permit' => null, 'brgy' => 'Barangay Kalawag III', 'city' => 'Isulan', 'province' => 'Sultan Kudarat', 'region' => 'XII', 'office' => 'NMIS-R12-SUK-ISU', 'creator' => 'NMIS-2026-0027', 'acc' => 'NMIS-MTV-2026-0028', 'status' => 'active', 'issued' => '2023-10-30', 'expiry' => '2026-10-30'],
            ['type' => 'company', 'name' => 'Sultan Kudarat Livestock Transport Inc.', 'owner' => 'Bai Amina Mangelen', 'permit' => 'BP-2026-00129', 'brgy' => 'Barangay Kalawag I', 'city' => null, 'province' => 'Sultan Kudarat', 'region' => 'XII', 'office' => 'NMIS-R12-SUK', 'creator' => 'NMIS-2026-0010', 'acc' => null, 'status' => 'pending', 'issued' => null, 'expiry' => null],

            ['type' => 'company', 'name' => 'National Capital Meat Freight Corp.', 'owner' => 'Estanislao Mercurio', 'permit' => 'BP-2026-00130', 'brgy' => 'Barangay Kapitolyo', 'city' => 'Pasig City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR', 'creator' => 'NMIS-2026-0005', 'acc' => 'NMIS-MTV-2026-0030', 'status' => 'active', 'issued' => '2023-05-22', 'expiry' => '2026-05-22'],
        ];

        foreach ($operators as $o) {
            MtvOperator::create([
                'operator_type' => $o['type'],
                'operator_name' => $o['name'],
                'owner_name' => $o['owner'],
                'contact_number' => '+63 9' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(1000, 9999),
                'email' => strtolower(str_replace(' ', '.', $o['owner'])) . '@example.com',
                'tin' => rand(100, 999) . '-' . rand(100, 999) . '-' . rand(100, 999) . '-000',
                'business_permit_number' => $o['permit'],
                'address_line' => $o['brgy'],
                'barangay' => $o['brgy'],
                'city_municipality' => $o['city'],
                'province' => $o['province'],
                'region' => $o['region'],
                'accreditation_number' => $o['acc'],
                'accreditation_status' => $o['status'],
                'accreditation_issued_at' => $o['issued'],
                'accreditation_expiry_at' => $o['expiry'],
                'registering_office_id' => $offices[$o['office']],
                'created_by' => $users[$o['creator']] ?? null,
                'remarks' => null,
            ]);
        }
    }
}
