<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrganizationsSeeder::class,
            RoleSeeder::class,
            ShieldSeeder::class,
            UserSeeder::class,
            SatuanSeeder::class,
            TagSeeder::class,
            UkuranSeeder::class,
            DatasetSeeder::class,
            DatasetTagSeeder::class,
        ]);
    }
}
