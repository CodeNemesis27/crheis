<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            'code' => 'NMIS-CO',
            'name' => 'NMIS Central Office',
            'type' => 'National',
            'contact_number' => '+63 2 8921 3451',
            'email' => 'central@nmis.gov.ph',
            'children' => [
                [
                    'code' => 'NMIS-NCR',
                    'name' => 'NMIS-NCR Field Office',
                    'type' => 'Regional',
                    'region' => 'NCR',
                    'contact_number' => '+63 2 8921 3480',
                    'email' => 'ncr@nmis.gov.ph',
                    'children' => [
                        [
                            'code' => 'NMIS-NCR-QC',
                            'name' => 'NMIS Quezon City Office',
                            'type' => 'City',
                            'region' => 'NCR',
                            'city_municipality' => 'Quezon City',
                            'contact_number' => '+63 2 8921 3481',
                            'email' => 'quezoncity@nmis.gov.ph'
                        ],
                        [
                            'code' => 'NMIS-NCR-MNL',
                            'name' => 'NMIS Manila Office',
                            'type' => 'City',
                            'region' => 'NCR',
                            'city_municipality' => 'Manila',
                            'contact_number' => '+63 2 8921 3482',
                            'email' => 'manila@nmis.gov.ph'
                        ],
                        [
                            'code' => 'NMIS-NCR-MKT',
                            'name' => 'NMIS Makati Office',
                            'type' => 'City',
                            'region' => 'NCR',
                            'city_municipality' => 'Makati',
                            'contact_number' => '+63 2 8921 3483',
                            'email' => 'makati@nmis.gov.ph'
                        ],
                    ],
                ],
                [
                    'code' => 'NMIS-R3',
                    'name' => 'NMIS Region III Field Office',
                    'type' => 'Regional',
                    'region' => 'III',
                    'contact_number' => '+63 45 961 1023',
                    'email' => 'region3@nmis.gov.ph',
                    'children' => [
                        [
                            'code' => 'NMIS-R3-BUL',
                            'name' => 'NMIS Bulacan Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'III',
                            'province' => 'Bulacan',
                            'contact_number' => '+63 44 791 2201',
                            'email' => 'bulacan@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R3-BUL-MAL',
                                    'name' => 'NMIS City of Malolos Office',
                                    'type' => 'City',
                                    'region' => 'III',
                                    'province' => 'Bulacan',
                                    'city_municipality' => 'City of Malolos',
                                    'contact_number' => '+63 44 791 2210',
                                    'email' => 'malolos@nmis.gov.ph'
                                ],
                            ],
                        ],
                        [
                            'code' => 'NMIS-R3-PAM',
                            'name' => 'NMIS Pampanga Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'III',
                            'province' => 'Pampanga',
                            'contact_number' => '+63 45 961 4402',
                            'email' => 'pampanga@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R3-PAM-SFC',
                                    'name' => 'NMIS City of San Fernando Office',
                                    'type' => 'City',
                                    'region' => 'III',
                                    'province' => 'Pampanga',
                                    'city_municipality' => 'City of San Fernando',
                                    'contact_number' => '+63 45 961 4410',
                                    'email' => 'sanfernando@nmis.gov.ph'
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'code' => 'NMIS-R4A',
                    'name' => 'NMIS Region IV-A Field Office',
                    'type' => 'Regional',
                    'region' => 'IV-A',
                    'contact_number' => '+63 49 502 3301',
                    'email' => 'region4a@nmis.gov.ph',
                    'children' => [
                        [
                            'code' => 'NMIS-R4A-CAV',
                            'name' => 'NMIS Cavite Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'IV-A',
                            'province' => 'Cavite',
                            'contact_number' => '+63 46 419 5501',
                            'email' => 'cavite@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R4A-CAV-DAS',
                                    'name' => 'NMIS City of Dasmariñas Office',
                                    'type' => 'City',
                                    'region' => 'IV-A',
                                    'province' => 'Cavite',
                                    'city_municipality' => 'City of Dasmariñas',
                                    'contact_number' => '+63 46 419 5510',
                                    'email' => 'dasmarinas@nmis.gov.ph'
                                ],
                            ],
                        ],
                        [
                            'code' => 'NMIS-R4A-LAG',
                            'name' => 'NMIS Laguna Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'IV-A',
                            'province' => 'Laguna',
                            'contact_number' => '+63 49 502 6601',
                            'email' => 'laguna@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R4A-LAG-LOS',
                                    'name' => 'NMIS Los Baños Office',
                                    'type' => 'Municipal',
                                    'region' => 'IV-A',
                                    'province' => 'Laguna',
                                    'city_municipality' => 'Los Baños',
                                    'is_active' => false,
                                    'contact_number' => '+63 49 502 6610',
                                    'email' => 'losbanos@nmis.gov.ph'
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'code' => 'NMIS-R7',
                    'name' => 'NMIS Region VII Field Office',
                    'type' => 'Regional',
                    'region' => 'VII',
                    'contact_number' => '+63 32 255 7701',
                    'email' => 'region7@nmis.gov.ph',
                    'children' => [
                        [
                            'code' => 'NMIS-R7-CEB',
                            'name' => 'NMIS Cebu Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'VII',
                            'province' => 'Cebu',
                            'contact_number' => '+63 32 255 8801',
                            'email' => 'cebu@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R7-CEB-MAN',
                                    'name' => 'NMIS City of Mandaue Office',
                                    'type' => 'City',
                                    'region' => 'VII',
                                    'province' => 'Cebu',
                                    'city_municipality' => 'City of Mandaue',
                                    'contact_number' => '+63 32 255 8810',
                                    'email' => 'mandaue@nmis.gov.ph'
                                ],
                            ],
                        ],
                        [
                            'code' => 'NMIS-R7-BOH',
                            'name' => 'NMIS Bohol Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'VII',
                            'province' => 'Bohol',
                            'contact_number' => '+63 38 411 9901',
                            'email' => 'bohol@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R7-BOH-LOO',
                                    'name' => 'NMIS Loon Office',
                                    'type' => 'Municipal',
                                    'region' => 'VII',
                                    'province' => 'Bohol',
                                    'city_municipality' => 'Loon',
                                    'contact_number' => '+63 38 411 9910',
                                    'email' => 'loon@nmis.gov.ph'
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'code' => 'NMIS-R11',
                    'name' => 'NMIS Region XI Field Office',
                    'type' => 'Regional',
                    'region' => 'XI',
                    'contact_number' => '+63 82 224 1101',
                    'email' => 'region11@nmis.gov.ph',
                    'children' => [
                        [
                            'code' => 'NMIS-R11-DDS',
                            'name' => 'NMIS Davao del Sur Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'XI',
                            'province' => 'Davao del Sur',
                            'contact_number' => '+63 82 224 1201',
                            'email' => 'davaodelsur@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R11-DDS-DIG',
                                    'name' => 'NMIS Digos City Office',
                                    'type' => 'City',
                                    'region' => 'XI',
                                    'province' => 'Davao del Sur',
                                    'city_municipality' => 'Digos City',
                                    'contact_number' => '+63 82 224 1210',
                                    'email' => 'digos@nmis.gov.ph'
                                ],
                            ],
                        ],
                        [
                            'code' => 'NMIS-R11-DDN',
                            'name' => 'NMIS Davao del Norte Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'XI',
                            'province' => 'Davao del Norte',
                            'contact_number' => '+63 84 655 1301',
                            'email' => 'davaodelnorte@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R11-DDN-PAN',
                                    'name' => 'NMIS Panabo City LGU Desk',
                                    'type' => 'LGU',
                                    'region' => 'XI',
                                    'province' => 'Davao del Norte',
                                    'city_municipality' => 'Panabo City',
                                    'contact_number' => '+63 84 655 1310',
                                    'email' => 'panabo@nmis.gov.ph'
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'code' => 'NMIS-R12',
                    'name' => 'NMIS Region XII Field Office',
                    'type' => 'Regional',
                    'region' => 'XII',
                    'contact_number' => '+63 83 228 1401',
                    'email' => 'region12@nmis.gov.ph',
                    'children' => [
                        [
                            'code' => 'NMIS-R12-SCT',
                            'name' => 'NMIS South Cotabato Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'XII',
                            'province' => 'South Cotabato',
                            'contact_number' => '+63 83 228 1501',
                            'email' => 'southcotabato@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R12-SCT-KOR',
                                    'name' => 'NMIS Koronadal City Office',
                                    'type' => 'City',
                                    'region' => 'XII',
                                    'province' => 'South Cotabato',
                                    'city_municipality' => 'Koronadal City',
                                    'contact_number' => '+63 83 228 1510',
                                    'email' => 'koronadal@nmis.gov.ph'
                                ],
                            ],
                        ],
                        [
                            'code' => 'NMIS-R12-SUK',
                            'name' => 'NMIS Sultan Kudarat Provincial Office',
                            'type' => 'Provincial',
                            'region' => 'XII',
                            'province' => 'Sultan Kudarat',
                            'contact_number' => '+63 64 200 1601',
                            'email' => 'sultankudarat@nmis.gov.ph',
                            'children' => [
                                [
                                    'code' => 'NMIS-R12-SUK-ISU',
                                    'name' => 'NMIS Isulan LGU Desk',
                                    'type' => 'LGU',
                                    'region' => 'XII',
                                    'province' => 'Sultan Kudarat',
                                    'city_municipality' => 'Isulan',
                                    'contact_number' => '+63 64 200 1610',
                                    'email' => 'isulan@nmis.gov.ph'
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->createOffice($tree);
    }

    private function createOffice(array $data, ?int $parentId = null): void
    {
        $children = $data['children'] ?? [];
        unset($data['children']);

        $data['parent_office_id'] = $parentId;
        $data['is_active'] = $data['is_active'] ?? true;

        $office = Office::create($data);

        foreach ($children as $child) {
            $this->createOffice($child, $office->id);
        }
    }
}
