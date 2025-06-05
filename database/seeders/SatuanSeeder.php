<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Satuan::insert([
            ['nama_satuan' => 'Orang'],
            ['nama_satuan' => 'Ton'],
            ['nama_satuan' => 'Meter'],
            ['nama_satuan' => 'Hektar'],
            ['nama_satuan' => 'Rupiah'],
            ['nama_satuan' => 'Persen'],
            ['nama_satuan' => 'Unit'],
            ['nama_satuan' => 'Sekolah'],
            ['nama_satuan' => 'Rumah Sakit'],
            ['nama_satuan' => 'UMKM'],
            ['nama_satuan' => 'Liter'],
            ['nama_satuan' => 'Kilogram'],
            ['nama_satuan' => 'Jiwa'],
            ['nama_satuan' => 'Kelurahan'],
            ['nama_satuan' => 'Desa'],
        ]);

    }
}
