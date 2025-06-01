<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataSet;
use Illuminate\Support\Str;

class DatasetSeeder extends Seeder
{
    public function run(): void
    {
        $datasets = [
            [
                'judul' => 'Jumlah Penduduk Kabupaten Sijunjung 2022',
                'slug' => Str::slug('Jumlah Penduduk Kabupaten Sijunjung 2022'),
                'ringkasan' => 'Data jumlah penduduk per kecamatan di Kabupaten Sijunjung pada tahun 2022.',
                'status' => 'publish',
                'user_id' => 1, // sesuaikan dengan user_id yang ada
                'organisasi_id' => 1, // sesuaikan
                'dibuat_oleh' => 'BPS Kabupaten Sijunjung',
                'diperbarui_oleh' => 'BPS Kabupaten Sijunjung',
                'frekuensi_pembaruan' => 'Tahunan',
                'tanggal_terbit' => '2023-02-01',
                'waktu_mulai' => '2022-01-01',
                'waktu_selesai' => '2022-12-31',
                'cakupan_wilayah' => 'Kabupaten Sijunjung',
                'format' => 'CSV',
                'sumber' => 'Kabupaten Sijunjung Dalam Angka 2023',
                'bahasa' => 'ID',
                'lisensi' => 'CC-BY-4.0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambah data lainnya jika diperlukan
        ];

        foreach ($datasets as $dataset) {
            DataSet::create($dataset);
        }
    }
}
