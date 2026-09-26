<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $offices = Office::pluck('id', 'code');

        $users = [
            // System Admin
            ['name' => 'Richard Sombrio', 'email' => 'richard.sombrio27@gmail.com', 'employee_id' => 'NMIS-2026-0001', 'office_code' => 'NMIS-CO', 'role' => 'System Admin', 'position' => 'IT Systems Administrator'],

            // NMIS Central (3)
            ['name' => 'Corazon Bautista', 'email' => 'corazon.bautista@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0002', 'office_code' => 'NMIS-CO', 'role' => 'NMIS Central', 'position' => 'Chief, Enforcement and Food Defense Division'],
            ['name' => 'Eduardo Santos', 'email' => 'eduardo.santos@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0003', 'office_code' => 'NMIS-CO', 'role' => 'NMIS Central', 'position' => 'Chief, Accreditation and Registration Division'],
            ['name' => 'Liza Fernandez', 'email' => 'liza.fernandez@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0004', 'office_code' => 'NMIS-CO', 'role' => 'NMIS Central', 'position' => 'Records Management Officer'],

            // NMIS Regional — one per regional office (6)
            ['name' => 'Manuel Reyes', 'email' => 'manuel.reyes@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0005', 'office_code' => 'NMIS-NCR', 'role' => 'NMIS Regional', 'position' => 'Regional Director, NCR'],
            ['name' => 'Teresa Cruz', 'email' => 'teresa.cruz@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0006', 'office_code' => 'NMIS-R3', 'role' => 'NMIS Regional', 'position' => 'Regional Director, Region III'],
            ['name' => 'Arnel Garcia', 'email' => 'arnel.garcia@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0007', 'office_code' => 'NMIS-R4A', 'role' => 'NMIS Regional', 'position' => 'Regional Director, Region IV-A'],
            ['name' => 'Josefina Torres', 'email' => 'josefina.torres@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0008', 'office_code' => 'NMIS-R7', 'role' => 'NMIS Regional', 'position' => 'Regional Director, Region VII'],
            ['name' => 'Danilo Ramos', 'email' => 'danilo.ramos@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0009', 'office_code' => 'NMIS-R11', 'role' => 'NMIS Regional', 'position' => 'Regional Director, Region XI'],
            ['name' => 'Cristina Mendoza', 'email' => 'cristina.mendoza@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0010', 'office_code' => 'NMIS-R12', 'role' => 'NMIS Regional', 'position' => 'Regional Director, Region XII'],

            // Inspectors — spread across city/provincial offices (10)
            ['name' => 'Ferdinand Aquino', 'email' => 'ferdinand.aquino@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0011', 'office_code' => 'NMIS-NCR-QC', 'role' => 'Inspector', 'position' => 'Meat Inspector II'],
            ['name' => 'Grace Domingo', 'email' => 'grace.domingo@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0012', 'office_code' => 'NMIS-NCR-MNL', 'role' => 'Inspector', 'position' => 'Meat Inspector I'],
            ['name' => 'Roberto Pascual', 'email' => 'roberto.pascual@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0013', 'office_code' => 'NMIS-NCR-MKT', 'role' => 'Inspector', 'position' => 'Meat Inspector II'],
            ['name' => 'Angelica Del Rosario', 'email' => 'angelica.delrosario@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0014', 'office_code' => 'NMIS-R3-BUL-MAL', 'role' => 'Inspector', 'position' => 'Meat Inspector I'],
            ['name' => 'Vicente Navarro', 'email' => 'vicente.navarro@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0015', 'office_code' => 'NMIS-R3-PAM-SFC', 'role' => 'Inspector', 'position' => 'Meat Inspector II'],
            ['name' => 'Melinda Castro', 'email' => 'melinda.castro@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0016', 'office_code' => 'NMIS-R4A-CAV-DAS', 'role' => 'Inspector', 'position' => 'Meat Inspector I'],
            ['name' => 'Alfredo Gonzales', 'email' => 'alfredo.gonzales@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0017', 'office_code' => 'NMIS-R7-CEB-MAN', 'role' => 'Inspector', 'position' => 'Meat Inspector II'],
            ['name' => 'Rosario Villamor', 'email' => 'rosario.villamor@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0018', 'office_code' => 'NMIS-R7-BOH-LOO', 'role' => 'Inspector', 'position' => 'Meat Inspector I'],
            ['name' => 'Bienvenido Salazar', 'email' => 'bienvenido.salazar@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0019', 'office_code' => 'NMIS-R11-DDS-DIG', 'role' => 'Inspector', 'position' => 'Meat Inspector II'],
            ['name' => 'Marilou Espinosa', 'email' => 'marilou.espinosa@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0020', 'office_code' => 'NMIS-R12-SCT-KOR', 'role' => 'Inspector', 'position' => 'Meat Inspector I'],

            // Legal officers (4)
            ['name' => 'Antonio Marquez', 'email' => 'antonio.marquez@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0021', 'office_code' => 'NMIS-CO', 'role' => 'Legal Officer', 'position' => 'Legal Officer IV'],
            ['name' => 'Patricia Uy', 'email' => 'patricia.uy@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0022', 'office_code' => 'NMIS-NCR', 'role' => 'Legal Officer', 'position' => 'Legal Officer III'],
            ['name' => 'Ronaldo Bautista', 'email' => 'ronaldo.bautista@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0023', 'office_code' => 'NMIS-R11', 'role' => 'Legal Officer', 'position' => 'Legal Officer III'],
            ['name' => 'Cecilia Roxas', 'email' => 'cecilia.roxas@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0024', 'office_code' => 'NMIS-R7', 'role' => 'Legal Officer', 'position' => 'Legal Officer II'],

            // LGU staff — across the two LGU-type offices (3)
            ['name' => 'Herminia Ocampo', 'email' => 'herminia.ocampo@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0025', 'office_code' => 'NMIS-R11-DDN-PAN', 'role' => 'LGU Staff', 'position' => 'LGU Meat Inspection Aide'],
            ['name' => 'Jaime Lopez', 'email' => 'jaime.lopez@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0026', 'office_code' => 'NMIS-R11-DDN-PAN', 'role' => 'LGU Staff', 'position' => 'LGU Veterinary Aide'],
            ['name' => 'Susana Pineda', 'email' => 'susana.pineda@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0027', 'office_code' => 'NMIS-R12-SUK-ISU', 'role' => 'LGU Staff', 'position' => 'LGU Meat Inspection Aide'],

            // Viewers (3)
            ['name' => 'Ernesto Villaflor', 'email' => 'ernesto.villaflor@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0028', 'office_code' => 'NMIS-CO', 'role' => 'Viewer', 'position' => 'Data Analyst (Read-only)'],
            ['name' => 'Belinda Tan', 'email' => 'belinda.tan@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0029', 'office_code' => 'NMIS-R4A-LAG-LOS', 'role' => 'Viewer', 'position' => 'LGU Coordinator (Read-only)', 'is_active' => false],
            ['name' => 'Ramil Corpuz', 'email' => 'ramil.corpuz@nmis.gov.ph', 'employee_id' => 'NMIS-2026-0030', 'office_code' => 'NMIS-R12', 'role' => 'Viewer', 'position' => 'Auditor (Read-only)'],
        ];

        foreach ($users as $row) {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => 'password',
                'employee_id' => $row['employee_id'],
                'office_id' => $offices[$row['office_code']] ?? null,
                'role' => $row['role'],
                'position' => $row['position'],
                'is_active' => $row['is_active'] ?? true,
                'email_verified_at' => now(),
            ]);
        }
    }
}
