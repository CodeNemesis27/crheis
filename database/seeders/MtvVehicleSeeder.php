<?php

namespace Database\Seeders;

use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MtvVehicleSeeder extends Seeder
{
    public function run(): void
    {
        $operators = MtvOperator::pluck('id', 'operator_name');

        $vehicles = [
            ['operator' => 'Rogelio Mendiola', 'plate' => 'NHK 1023', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'Elf NHR', 'year' => '2021', 'capacity' => 2000, 'permit' => 'NMIS-MTV-PERMIT-2026-0001', 'status' => 'Active', 'issued' => '2024-02-20', 'expiry' => '2027-02-20'],

            ['operator' => 'QC Cold Haulers Corp.', 'plate' => 'NGP 2201', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'NPR', 'year' => '2022', 'capacity' => 3500, 'permit' => 'NMIS-MTV-PERMIT-2026-0002', 'status' => 'Active', 'issued' => '2023-10-05', 'expiry' => '2026-10-05'],
            ['operator' => 'QC Cold Haulers Corp.', 'plate' => 'NGP 2202', 'type' => 'Insulated Truck', 'make' => 'Fuso', 'model' => 'Canter', 'year' => '2020', 'capacity' => 3000, 'permit' => 'NMIS-MTV-PERMIT-2026-0003', 'status' => 'Active', 'issued' => '2023-10-05', 'expiry' => '2026-10-05'],

            ['operator' => 'Manila Meat Logistics Inc.', 'plate' => 'WGD 3301', 'type' => 'Insulated Truck', 'make' => 'Hino', 'model' => '300 Series', 'year' => '2019', 'capacity' => 4000, 'permit' => 'NMIS-MTV-PERMIT-2026-0004', 'status' => 'Suspended', 'issued' => '2022-05-25', 'expiry' => '2025-05-25'],

            ['operator' => 'Wilfredo Panganiban', 'plate' => 'NDL 4012', 'type' => 'Open Truck', 'make' => 'Mitsubishi', 'model' => 'Canter', 'year' => '2018', 'capacity' => 1500, 'permit' => 'NMIS-MTV-PERMIT-2026-0005', 'status' => 'Active', 'issued' => '2024-01-15', 'expiry' => '2027-01-15'],

            ['operator' => 'Makati Prime Transport Services', 'plate' => 'PMK 5501', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'NPR', 'year' => '2023', 'capacity' => 3800, 'permit' => 'NMIS-MTV-PERMIT-2026-0006', 'status' => 'Active', 'issued' => '2023-07-12', 'expiry' => '2026-07-12'],

            ['operator' => 'Bulacan Fresh Transport Corp.', 'plate' => 'NEA 6601', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'Elf', 'year' => '2021', 'capacity' => 2500, 'permit' => 'NMIS-MTV-PERMIT-2026-0007', 'status' => 'Active', 'issued' => '2024-03-28', 'expiry' => '2027-03-28'],
            ['operator' => 'Bulacan Fresh Transport Corp.', 'plate' => 'NEA 6602', 'type' => 'Open Truck', 'make' => 'Foton', 'model' => 'Aumark', 'year' => '2019', 'capacity' => 2000, 'permit' => 'NMIS-MTV-PERMIT-2026-0008', 'status' => 'Active', 'issued' => '2024-03-28', 'expiry' => '2027-03-28'],

            ['operator' => 'Cirilo Manansala', 'plate' => 'NEB 7011', 'type' => 'Insulated Truck', 'make' => 'Fuso', 'model' => 'Canter', 'year' => '2020', 'capacity' => 2200, 'permit' => 'NMIS-MTV-PERMIT-2026-0009', 'status' => 'Active', 'issued' => '2023-12-22', 'expiry' => '2026-12-22'],

            ['operator' => 'Pampanga Livestock Movers Inc.', 'plate' => 'NFA 8101', 'type' => 'Open Truck', 'make' => 'Hino', 'model' => '300 Series', 'year' => '2018', 'capacity' => 5000, 'permit' => 'NMIS-MTV-PERMIT-2026-0010', 'status' => 'Active', 'issued' => '2024-06-18', 'expiry' => '2027-06-18'],
            ['operator' => 'Pampanga Livestock Movers Inc.', 'plate' => 'NFA 8102', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'NPR', 'year' => '2022', 'capacity' => 3500, 'permit' => 'NMIS-MTV-PERMIT-2026-0011', 'status' => 'Active', 'issued' => '2024-06-18', 'expiry' => '2027-06-18'],

            ['operator' => 'Cavite Meat Haulage Solutions', 'plate' => 'PCV 9201', 'type' => 'Insulated Truck', 'make' => 'Mitsubishi', 'model' => 'Canter', 'year' => '2017', 'capacity' => 2800, 'permit' => 'NMIS-MTV-PERMIT-2026-0012', 'status' => 'Revoked', 'issued' => '2020-09-12', 'expiry' => '2023-09-12'],

            ['operator' => 'Marcelino Rivas', 'plate' => 'NCD 0311', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'Elf', 'year' => '2021', 'capacity' => 2000, 'permit' => 'NMIS-MTV-PERMIT-2026-0013', 'status' => 'Active', 'issued' => '2023-11-30', 'expiry' => '2026-11-30'],

            ['operator' => 'Laguna Meat Transport Alliance', 'plate' => 'NLG 1411', 'type' => 'Open Truck', 'make' => 'Foton', 'model' => 'Aumark', 'year' => '2019', 'capacity' => 3200, 'permit' => 'NMIS-MTV-PERMIT-2026-0014', 'status' => 'Active', 'issued' => '2024-04-08', 'expiry' => '2027-04-08'],

            ['operator' => 'Mandaue Refrigerated Transport Co.', 'plate' => 'MND 1501', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'NPR', 'year' => '2023', 'capacity' => 4000, 'permit' => 'NMIS-MTV-PERMIT-2026-0015', 'status' => 'Active', 'issued' => '2023-08-25', 'expiry' => '2026-08-25'],
            ['operator' => 'Mandaue Refrigerated Transport Co.', 'plate' => 'MND 1502', 'type' => 'Refrigerated Van', 'make' => 'Hino', 'model' => '300 Series', 'year' => '2022', 'capacity' => 3800, 'permit' => 'NMIS-MTV-PERMIT-2026-0016', 'status' => 'Active', 'issued' => '2023-08-25', 'expiry' => '2026-08-25'],

            ['operator' => 'Anastacio Gabatin', 'plate' => 'CEB 1601', 'type' => 'Insulated Truck', 'make' => 'Fuso', 'model' => 'Canter', 'year' => '2018', 'capacity' => 2200, 'permit' => 'NMIS-MTV-PERMIT-2026-0017', 'status' => 'Suspended', 'issued' => '2022-03-16', 'expiry' => '2025-03-16'],

            ['operator' => 'Cebu Provincial Livestock Carriers', 'plate' => 'CEB 1701', 'type' => 'Open Truck', 'make' => 'Hino', 'model' => '300 Series', 'year' => '2020', 'capacity' => 4500, 'permit' => 'NMIS-MTV-PERMIT-2026-0018', 'status' => 'Active', 'issued' => '2024-06-02', 'expiry' => '2027-06-02'],
            ['operator' => 'Cebu Provincial Livestock Carriers', 'plate' => 'CEB 1702', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'Elf', 'year' => '2021', 'capacity' => 2500, 'permit' => 'NMIS-MTV-PERMIT-2026-0019', 'status' => 'Active', 'issued' => '2024-06-02', 'expiry' => '2027-06-02'],

            ['operator' => 'Rufino Delantar', 'plate' => 'BOH 1801', 'type' => 'Open Truck', 'make' => 'Mitsubishi', 'model' => 'Canter', 'year' => '2017', 'capacity' => 1800, 'permit' => 'NMIS-MTV-PERMIT-2026-0020', 'status' => 'Active', 'issued' => '2023-06-20', 'expiry' => '2026-06-20'],

            ['operator' => 'Bohol Island Meat Movers Corp.', 'plate' => 'BOH 1901', 'type' => 'Insulated Truck', 'make' => 'Fuso', 'model' => 'Canter', 'year' => '2019', 'capacity' => 3000, 'permit' => null, 'status' => 'Pending', 'issued' => null, 'expiry' => null],

            ['operator' => 'Davao South Meat Transport Corp.', 'plate' => 'DVO 2001', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'NPR', 'year' => '2023', 'capacity' => 3600, 'permit' => 'NMIS-MTV-PERMIT-2026-0022', 'status' => 'Active', 'issued' => '2024-02-12', 'expiry' => '2027-02-12'],
            ['operator' => 'Davao South Meat Transport Corp.', 'plate' => 'DVO 2002', 'type' => 'Open Truck', 'make' => 'Hino', 'model' => '300 Series', 'year' => '2021', 'capacity' => 4200, 'permit' => 'NMIS-MTV-PERMIT-2026-0023', 'status' => 'Active', 'issued' => '2024-02-12', 'expiry' => '2027-02-12'],

            ['operator' => 'Hermogenes Baladjay', 'plate' => 'DVO 2101', 'type' => 'Insulated Truck', 'make' => 'Mitsubishi', 'model' => 'Canter', 'year' => '2018', 'capacity' => 2000, 'permit' => 'NMIS-MTV-PERMIT-2026-0024', 'status' => 'Expired', 'issued' => '2021-01-28', 'expiry' => '2024-01-28'],

            ['operator' => 'Davao del Sur Provincial Haulers Inc.', 'plate' => 'DVS 2201', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'Elf', 'year' => '2022', 'capacity' => 2800, 'permit' => 'NMIS-MTV-PERMIT-2026-0025', 'status' => 'Active', 'issued' => '2023-09-17', 'expiry' => '2026-09-17'],

            ['operator' => 'Anselmo Buendia', 'plate' => 'DVN 2301', 'type' => 'Open Truck', 'make' => 'Foton', 'model' => 'Aumark', 'year' => '2019', 'capacity' => 1600, 'permit' => 'NMIS-MTV-PERMIT-2026-0026', 'status' => 'Active', 'issued' => '2024-07-04', 'expiry' => '2027-07-04'],

            ['operator' => 'Davao del Norte Cold Transport Co.', 'plate' => 'DVN 2401', 'type' => 'Refrigerated Van', 'make' => 'Hino', 'model' => '300 Series', 'year' => '2020', 'capacity' => 3200, 'permit' => 'NMIS-MTV-PERMIT-2026-0027', 'status' => 'Revoked', 'issued' => '2020-12-08', 'expiry' => '2023-12-08'],

            ['operator' => 'Koronadal Meat Logistics Corp.', 'plate' => 'SCT 2501', 'type' => 'Insulated Truck', 'make' => 'Fuso', 'model' => 'Canter', 'year' => '2021', 'capacity' => 2900, 'permit' => 'NMIS-MTV-PERMIT-2026-0028', 'status' => 'Active', 'issued' => '2024-03-21', 'expiry' => '2027-03-21'],

            ['operator' => 'Sultan Kudarat Livestock Transport Inc.', 'plate' => 'SUK 2601', 'type' => 'Open Truck', 'make' => 'Mitsubishi', 'model' => 'Canter', 'year' => '2018', 'capacity' => 3400, 'permit' => null, 'status' => 'Pending', 'issued' => null, 'expiry' => null],

            ['operator' => 'National Capital Meat Freight Corp.', 'plate' => 'NCM 2701', 'type' => 'Refrigerated Van', 'make' => 'Isuzu', 'model' => 'NPR', 'year' => '2023', 'capacity' => 4000, 'permit' => 'NMIS-MTV-PERMIT-2026-0030', 'status' => 'Active', 'issued' => '2023-05-27', 'expiry' => '2026-05-27'],
        ];

        foreach ($vehicles as $v) {
            MtvVehicle::create([
                'mtv_operator_id' => $operators[$v['operator']],
                'plate_number' => $v['plate'],
                'vehicle_type' => $v['type'],
                'make' => $v['make'],
                'model' => $v['model'],
                'year_model' => $v['year'],
                'engine_number' => strtoupper(Str::random(4)) . '-' . rand(100000, 999999),
                'chassis_number' => strtoupper(Str::random(4)) . rand(1000000, 9999999),
                'capacity_kg' => $v['capacity'],
                'permit_number' => $v['permit'],
                'permit_status' => $v['status'],
                'permit_issued_at' => $v['issued'],
                'permit_expiry_at' => $v['expiry'],
            ]);
        }
    }
}
