<?php

namespace Database\Seeders;

use App\Models\MeatEstablishment;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;

class MeatEstablishmentSeeder extends Seeder
{
    public function run(): void
    {
        $offices = Office::pluck('id', 'code');
        $users = User::pluck('id', 'employee_id');

        $establishments = [
            ['reg' => 'NMIS-EST-2026-0001', 'acc' => 'NMIS-ACC-2026-0001', 'name' => 'Golden Harvest Meat Shop', 'trade' => null, 'type' => 'Meat Shop', 'owner' => 'Rodolfo Cabrera', 'brgy' => 'Barangay Commonwealth', 'city' => 'Quezon City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-QC', 'creator' => 'NMIS-2026-0011', 'status' => 'active', 'issued' => '2024-03-10', 'expiry' => '2027-03-10'],
            ['reg' => 'NMIS-EST-2026-0002', 'acc' => 'NMIS-ACC-2026-0002', 'name' => 'Metro Sarap Meat Processing Inc.', 'trade' => 'Metro Sarap', 'type' => 'Meat Processing Plant', 'owner' => 'Elena Bautista', 'brgy' => 'Barangay Batasan Hills', 'city' => 'Quezon City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-QC', 'creator' => 'NMIS-2026-0011', 'status' => 'active', 'issued' => '2023-11-05', 'expiry' => '2026-11-05'],
            ['reg' => 'NMIS-EST-2026-0003', 'acc' => null, 'name' => 'QC Cold Chain Storage Corp.', 'trade' => null, 'type' => 'Cold Storage', 'owner' => 'Fernando Uy', 'brgy' => 'Barangay Fairview', 'city' => 'Quezon City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-QC', 'creator' => 'NMIS-2026-0011', 'status' => 'pending', 'issued' => null, 'expiry' => null],

            ['reg' => 'NMIS-EST-2026-0004', 'acc' => 'NMIS-ACC-2026-0004', 'name' => 'Manila Central Abattoir', 'trade' => null, 'type' => 'Slaughterhouse', 'owner' => 'Ricardo Domingo', 'brgy' => 'Barangay Tondo', 'city' => 'Manila', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MNL', 'creator' => 'NMIS-2026-0012', 'status' => 'suspended', 'issued' => '2022-06-14', 'expiry' => '2025-06-14'],
            ['reg' => 'NMIS-EST-2026-0005', 'acc' => 'NMIS-ACC-2026-0005', 'name' => 'Divisoria Fresh Meat Shop', 'trade' => null, 'type' => 'Meat Shop', 'owner' => 'Amelia Reyes', 'brgy' => 'Barangay 296', 'city' => 'Manila', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MNL', 'creator' => 'NMIS-2026-0012', 'status' => 'active', 'issued' => '2024-01-20', 'expiry' => '2027-01-20'],

            ['reg' => 'NMIS-EST-2026-0006', 'acc' => 'NMIS-ACC-2026-0006', 'name' => 'Makati Wet Market Meat Section', 'trade' => 'Poblacion Meat Market', 'type' => 'Supermarket', 'owner' => 'Wilfredo Santos', 'brgy' => 'Barangay Poblacion', 'city' => 'Makati', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MKT', 'creator' => 'NMIS-2026-0013', 'status' => 'active', 'issued' => '2023-08-01', 'expiry' => '2026-08-01'],
            ['reg' => 'NMIS-EST-2026-0007', 'acc' => 'NMIS-ACC-2026-0007', 'name' => 'Makati Prime Cutting Plant', 'trade' => 'Prime Cuts Makati', 'type' => 'Meat Cutting Plant', 'owner' => 'Jocelyn Ferrer', 'brgy' => 'Barangay Bel-Air', 'city' => 'Makati', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR-MKT', 'creator' => 'NMIS-2026-0013', 'status' => 'expired', 'issued' => '2021-05-15', 'expiry' => '2024-05-15'],

            ['reg' => 'NMIS-EST-2026-0008', 'acc' => 'NMIS-ACC-2026-0008', 'name' => 'Malolos Poultry Dressing Center', 'trade' => null, 'type' => 'Poultry Dressing Plant', 'owner' => 'Nestor Lim', 'brgy' => 'Barangay Guinhawa', 'city' => 'City of Malolos', 'province' => 'Bulacan', 'region' => 'III', 'office' => 'NMIS-R3-BUL-MAL', 'creator' => 'NMIS-2026-0014', 'status' => 'active', 'issued' => '2024-02-19', 'expiry' => '2027-02-19'],
            ['reg' => 'NMIS-EST-2026-0009', 'acc' => 'NMIS-ACC-2026-0009', 'name' => 'Bulacan Provincial Meat Processing Co.', 'trade' => null, 'type' => 'Meat Processing Plant', 'owner' => 'Corazon Delos Santos', 'brgy' => 'Barangay Longos', 'city' => null, 'province' => 'Bulacan', 'region' => 'III', 'office' => 'NMIS-R3-BUL', 'creator' => 'NMIS-2026-0006', 'status' => 'active', 'issued' => '2023-09-30', 'expiry' => '2026-09-30'],

            ['reg' => 'NMIS-EST-2026-0010', 'acc' => 'NMIS-ACC-2026-0010', 'name' => 'San Fernando Municipal Slaughterhouse', 'trade' => null, 'type' => 'Slaughterhouse', 'owner' => 'Ariel Manalo', 'brgy' => 'Barangay Dolores', 'city' => 'City of San Fernando', 'province' => 'Pampanga', 'region' => 'III', 'office' => 'NMIS-R3-PAM-SFC', 'creator' => 'NMIS-2026-0015', 'status' => 'active', 'issued' => '2024-04-11', 'expiry' => '2027-04-11'],
            ['reg' => 'NMIS-EST-2026-0011', 'acc' => null, 'name' => 'Pampanga Cold Storage Facility', 'trade' => null, 'type' => 'Cold Storage', 'owner' => 'Beatriz Ocampo', 'brgy' => 'Barangay San Jose', 'city' => null, 'province' => 'Pampanga', 'region' => 'III', 'office' => 'NMIS-R3-PAM', 'creator' => 'NMIS-2026-0006', 'status' => 'pending', 'issued' => null, 'expiry' => null],

            ['reg' => 'NMIS-EST-2026-0012', 'acc' => 'NMIS-ACC-2026-0012', 'name' => 'Dasmariñas Family Meat Shop', 'trade' => null, 'type' => 'Meat Shop', 'owner' => 'Leonardo Pineda', 'brgy' => 'Barangay Zone III', 'city' => 'City of Dasmariñas', 'province' => 'Cavite', 'region' => 'IV-A', 'office' => 'NMIS-R4A-CAV-DAS', 'creator' => 'NMIS-2026-0016', 'status' => 'active', 'issued' => '2023-12-01', 'expiry' => '2026-12-01'],
            ['reg' => 'NMIS-EST-2026-0013', 'acc' => 'NMIS-ACC-2026-0013', 'name' => 'Cavite Poultry Dressing Plant', 'trade' => null, 'type' => 'Poultry Dressing Plant', 'owner' => 'Gregoria Aquino', 'brgy' => 'Barangay Salawag', 'city' => null, 'province' => 'Cavite', 'region' => 'IV-A', 'office' => 'NMIS-R4A-CAV', 'creator' => 'NMIS-2026-0007', 'status' => 'suspended', 'issued' => '2022-10-22', 'expiry' => '2025-10-22'],

            ['reg' => 'NMIS-EST-2026-0014', 'acc' => 'NMIS-ACC-2026-0014', 'name' => 'Los Baños Old Town Meat Shop', 'trade' => null, 'type' => 'Meat Shop', 'owner' => 'Simplicio Herrera', 'brgy' => 'Barangay Batong Malake', 'city' => 'Los Baños', 'province' => 'Laguna', 'region' => 'IV-A', 'office' => 'NMIS-R4A-LAG-LOS', 'creator' => 'NMIS-2026-0007', 'status' => 'closed', 'issued' => '2020-07-08', 'expiry' => '2023-07-08'],
            ['reg' => 'NMIS-EST-2026-0015', 'acc' => 'NMIS-ACC-2026-0015', 'name' => 'Laguna Lakeside Cutting Plant', 'trade' => null, 'type' => 'Meat Cutting Plant', 'owner' => 'Purificacion Javier', 'brgy' => 'Barangay Bubukal', 'city' => null, 'province' => 'Laguna', 'region' => 'IV-A', 'office' => 'NMIS-R4A-LAG', 'creator' => 'NMIS-2026-0007', 'status' => 'active', 'issued' => '2024-05-27', 'expiry' => '2027-05-27'],

            ['reg' => 'NMIS-EST-2026-0016', 'acc' => 'NMIS-ACC-2026-0016', 'name' => 'Mandaue Bay Abattoir', 'trade' => null, 'type' => 'Slaughterhouse', 'owner' => 'Restituto Abellana', 'brgy' => 'Barangay Subangdaku', 'city' => 'City of Mandaue', 'province' => 'Cebu', 'region' => 'VII', 'office' => 'NMIS-R7-CEB-MAN', 'creator' => 'NMIS-2026-0017', 'status' => 'active', 'issued' => '2023-06-19', 'expiry' => '2026-06-19'],
            ['reg' => 'NMIS-EST-2026-0017', 'acc' => 'NMIS-ACC-2026-0017', 'name' => 'Mandaue Public Meat Market', 'trade' => null, 'type' => 'Supermarket', 'owner' => 'Felisa Cortes', 'brgy' => 'Barangay Centro', 'city' => 'City of Mandaue', 'province' => 'Cebu', 'region' => 'VII', 'office' => 'NMIS-R7-CEB-MAN', 'creator' => 'NMIS-2026-0017', 'status' => 'revoked', 'issued' => '2021-02-14', 'expiry' => '2024-02-14'],
            ['reg' => 'NMIS-EST-2026-0018', 'acc' => 'NMIS-ACC-2026-0018', 'name' => 'Cebu Provincial Meat Processing Corp.', 'trade' => null, 'type' => 'Meat Processing Plant', 'owner' => 'Domingo Ybañez', 'brgy' => 'Barangay Guadalupe', 'city' => null, 'province' => 'Cebu', 'region' => 'VII', 'office' => 'NMIS-R7-CEB', 'creator' => 'NMIS-2026-0008', 'status' => 'active', 'issued' => '2023-04-03', 'expiry' => '2026-04-03'],

            ['reg' => 'NMIS-EST-2026-0019', 'acc' => 'NMIS-ACC-2026-0019', 'name' => 'Loon Poultry Dressing Station', 'trade' => null, 'type' => 'Poultry Dressing Plant', 'owner' => 'Adoracion Pilapil', 'brgy' => 'Barangay Cabacnitan', 'city' => 'Loon', 'province' => 'Bohol', 'region' => 'VII', 'office' => 'NMIS-R7-BOH-LOO', 'creator' => 'NMIS-2026-0018', 'status' => 'active', 'issued' => '2024-07-16', 'expiry' => '2027-07-16'],
            ['reg' => 'NMIS-EST-2026-0020', 'acc' => null, 'name' => 'Bohol Island Cold Storage', 'trade' => null, 'type' => 'Cold Storage', 'owner' => 'Bonifacio Torralba', 'brgy' => 'Barangay Cogon', 'city' => null, 'province' => 'Bohol', 'region' => 'VII', 'office' => 'NMIS-R7-BOH', 'creator' => 'NMIS-2026-0008', 'status' => 'pending', 'issued' => null, 'expiry' => null],

            ['reg' => 'NMIS-EST-2026-0021', 'acc' => 'NMIS-ACC-2026-0021', 'name' => 'Digos City Slaughterhouse', 'trade' => null, 'type' => 'Slaughterhouse', 'owner' => 'Salvador Quimson', 'brgy' => 'Barangay Zone 1', 'city' => 'Digos City', 'province' => 'Davao del Sur', 'region' => 'XI', 'office' => 'NMIS-R11-DDS-DIG', 'creator' => 'NMIS-2026-0019', 'status' => 'active', 'issued' => '2024-01-08', 'expiry' => '2027-01-08'],
            ['reg' => 'NMIS-EST-2026-0022', 'acc' => 'NMIS-ACC-2026-0022', 'name' => 'Digos Fresh Meat Shop', 'trade' => null, 'type' => 'Meat Shop', 'owner' => 'Perlita Ambas', 'brgy' => 'Barangay Aplaya', 'city' => 'Digos City', 'province' => 'Davao del Sur', 'region' => 'XI', 'office' => 'NMIS-R11-DDS-DIG', 'creator' => 'NMIS-2026-0019', 'status' => 'active', 'issued' => '2023-10-12', 'expiry' => '2026-10-12'],
            ['reg' => 'NMIS-EST-2026-0023', 'acc' => 'NMIS-ACC-2026-0023', 'name' => 'Davao del Sur Meat Processing Corp.', 'trade' => null, 'type' => 'Meat Processing Plant', 'owner' => 'Reynaldo Casumpang', 'brgy' => 'Barangay Kiagot', 'city' => null, 'province' => 'Davao del Sur', 'region' => 'XI', 'office' => 'NMIS-R11-DDS', 'creator' => 'NMIS-2026-0009', 'status' => 'suspended', 'issued' => '2022-08-25', 'expiry' => '2025-08-25'],

            ['reg' => 'NMIS-EST-2026-0024', 'acc' => 'NMIS-ACC-2026-0024', 'name' => 'Panabo City Meat Market', 'trade' => null, 'type' => 'Supermarket', 'owner' => 'Lolita Baldos', 'brgy' => 'Barangay San Francisco', 'city' => 'Panabo City', 'province' => 'Davao del Norte', 'region' => 'XI', 'office' => 'NMIS-R11-DDN-PAN', 'creator' => 'NMIS-2026-0025', 'status' => 'active', 'issued' => '2024-06-02', 'expiry' => '2027-06-02'],
            ['reg' => 'NMIS-EST-2026-0025', 'acc' => 'NMIS-ACC-2026-0025', 'name' => 'Davao del Norte Poultry Dressing Plant', 'trade' => null, 'type' => 'Poultry Dressing Plant', 'owner' => 'Efren Malinao', 'brgy' => 'Barangay Mankilam', 'city' => null, 'province' => 'Davao del Norte', 'region' => 'XI', 'office' => 'NMIS-R11-DDN', 'creator' => 'NMIS-2026-0009', 'status' => 'active', 'issued' => '2023-07-19', 'expiry' => '2026-07-19'],

            ['reg' => 'NMIS-EST-2026-0026', 'acc' => 'NMIS-ACC-2026-0026', 'name' => 'Koronadal Central Abattoir', 'trade' => null, 'type' => 'Slaughterhouse', 'owner' => 'Genaro Villaruel', 'brgy' => 'Barangay Zone II', 'city' => 'Koronadal City', 'province' => 'South Cotabato', 'region' => 'XII', 'office' => 'NMIS-R12-SCT-KOR', 'creator' => 'NMIS-2026-0020', 'status' => 'active', 'issued' => '2024-02-28', 'expiry' => '2027-02-28'],
            ['reg' => 'NMIS-EST-2026-0027', 'acc' => 'NMIS-ACC-2026-0027', 'name' => 'South Cotabato Cold Storage Inc.', 'trade' => null, 'type' => 'Cold Storage', 'owner' => 'Marissa Dagpin', 'brgy' => 'Barangay General Paulino Santos', 'city' => null, 'province' => 'South Cotabato', 'region' => 'XII', 'office' => 'NMIS-R12-SCT', 'creator' => 'NMIS-2026-0010', 'status' => 'expired', 'issued' => '2021-03-17', 'expiry' => '2024-03-17'],

            ['reg' => 'NMIS-EST-2026-0028', 'acc' => 'NMIS-ACC-2026-0028', 'name' => 'Isulan Town Meat Shop', 'trade' => null, 'type' => 'Meat Shop', 'owner' => 'Alberto Sinsuat', 'brgy' => 'Barangay Kalawag III', 'city' => 'Isulan', 'province' => 'Sultan Kudarat', 'region' => 'XII', 'office' => 'NMIS-R12-SUK-ISU', 'creator' => 'NMIS-2026-0027', 'status' => 'active', 'issued' => '2023-09-09', 'expiry' => '2026-09-09'],
            ['reg' => 'NMIS-EST-2026-0029', 'acc' => 'NMIS-ACC-2026-0029', 'name' => 'Sultan Kudarat Meat Cutting Plant', 'trade' => null, 'type' => 'Meat Cutting Plant', 'owner' => 'Norhata Mangelen', 'brgy' => 'Barangay Kalawag I', 'city' => null, 'province' => 'Sultan Kudarat', 'region' => 'XII', 'office' => 'NMIS-R12-SUK', 'creator' => 'NMIS-2026-0010', 'status' => 'revoked', 'issued' => '2020-11-30', 'expiry' => '2023-11-30'],

            ['reg' => 'NMIS-EST-2026-0030', 'acc' => 'NMIS-ACC-2026-0030', 'name' => 'NCR Regional Meat By-Products Rendering Facility', 'trade' => null, 'type' => 'MTV', 'owner' => 'Herminigildo Tuazon', 'brgy' => 'Barangay Ugong', 'city' => 'Pasig City', 'province' => null, 'region' => 'NCR', 'office' => 'NMIS-NCR', 'creator' => 'NMIS-2026-0005', 'status' => 'active', 'issued' => '2023-05-05', 'expiry' => '2026-05-05'],
        ];

        foreach ($establishments as $e) {
            MeatEstablishment::create([
                'registration_number' => $e['reg'],
                'accreditation_number' => $e['acc'],
                'business_name' => $e['name'],
                'trade_name' => $e['trade'],
                'establishment_type' => $e['type'],
                'owner_name' => $e['owner'],
                'owner_contact_number' => '+63 9' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(1000, 9999),
                'owner_email' => strtolower(str_replace(' ', '.', $e['owner'])) . '@example.com',
                'tin' => rand(100, 999) . '-' . rand(100, 999) . '-' . rand(100, 999) . '-000',
                'address_line' => $e['brgy'],
                'barangay' => $e['brgy'],
                'city_municipality' => $e['city'],
                'province' => $e['province'],
                'region' => $e['region'],
                'accreditation_status' => $e['status'],
                'accreditation_issued_at' => $e['issued'],
                'accreditation_expiry_at' => $e['expiry'],
                'registering_office_id' => $offices[$e['office']],
                'created_by' => $users[$e['creator']] ?? null,
                'remarks' => null,
            ]);
        }
    }
}
