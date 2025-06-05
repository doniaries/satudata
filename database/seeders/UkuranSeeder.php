<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ukuran::insert([
            ['nama_ukuran' => 'Kecil'],
            ['nama_ukuran' => 'Sedang'],
            ['nama_ukuran' => 'Besar'],
            ['nama_ukuran' => 'Mikro'],
            ['nama_ukuran' => 'Menengah'],
            ['nama_ukuran' => 'Sangat Besar'],
            ['nama_ukuran' => '< 1000 Orang'],
            ['nama_ukuran' => '1000-5000 Orang'],
            ['nama_ukuran' => '> 5000 Orang'],
            ['nama_ukuran' => '< 10 Ha'],
            ['nama_ukuran' => '10-100 Ha'],
            ['nama_ukuran' => '> 100 Ha'],
            ['nama_ukuran' => 'Persen'],
        ]);

    }
}
