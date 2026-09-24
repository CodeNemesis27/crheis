<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ConfiscationSeeder;
use Database\Seeders\EnforcementActionSeeder;
use Database\Seeders\EnforcementCaseSeeder;
use Database\Seeders\InspectionSeeder;
use Database\Seeders\MeatEstablishmentSeeder;
use Database\Seeders\MtvOperatorSeeder;
use Database\Seeders\MtvVehicleSeeder;
use Database\Seeders\OfficeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ViolationSeeder;
use Database\Seeders\ViolationTypeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Richard Sombrio',
            'email' => 'richard.sombrio27@gmail.com',
            'password' => Hash::make('password')
        ]);

        $this->call([
            OfficeSeeder::class,
            UserSeeder::class,
            MeatEstablishmentSeeder::class,
            MtvOperatorSeeder::class,
            MtvVehicleSeeder::class,
            ViolationTypeSeeder::class,
            InspectionSeeder::class,
            ViolationSeeder::class,
            EnforcementActionSeeder::class,
            EnforcementCaseSeeder::class,
            ConfiscationSeeder::class
        ]);
    }
}
