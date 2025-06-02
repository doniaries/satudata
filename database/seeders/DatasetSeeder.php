<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dataset; // Pastikan namespace Model Dataset sudah benar
use Illuminate\Support\Str;
use App\Models\Organization; // Digunakan untuk mendapatkan id_organization
use App\Models\User; // Digunakan untuk mendapatkan created_by_user_id dan updated_by_user_id

class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID organisasi Dinas Komunikasi dan Informatika
        $kominfoOrg = Organization::where('slug', 'dinas-komunikasi-dan-informatika')->first();
        if (!$kominfoOrg) {
            $this->command->error('Organisasi Dinas Komunikasi dan Informatika tidak ditemukan.');
            return;
        }

        // Ambil ID organisasi Dinas Kependudukan Dan Pencatatan Sipil
        $dukcapilOrg = Organization::where('slug', 'dinas-kependudukan-dan-pencatatan-sipil')->first();
        if (!$dukcapilOrg) {
            $this->command->error('Organisasi Dinas Kependudukan Dan Pencatatan Sipil tidak ditemukan.');
            return;
        }

        // Ambil ID user pertama sebagai contoh, atau sesuaikan dengan kebutuhan Anda
        $user = User::first();
        if (!$user) {
            $this->command->error('Tidak ada User ditemukan. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $datasets = [
            [
                'id_organization' => $dukcapilOrg->id, // Produsen Data: Dinas Kependudukan Dan Pencatatan Sipil
                'judul' => 'Jumlah Penduduk Kabupaten Sijunjung 2022',
                'deskripsi_dataset' => 'Data jumlah penduduk per kecamatan di Kabupaten Sijunjung pada tahun 2022.',
                'satuan' => 'Orang',
                'frekuensi_pembaruan' => 'Tahunan',
                'dasar_rujukan_prioritas' => 'RPJMD Kabupaten Sijunjung 2021-2026',
                'lisensi' => 'Creative Commons Attribution 4.0 International (CC BY 4.0)',
                'penulis_kontak' => 'Analis Data Kependudukan',
                'email_penulis_kontak' => 'analis.kependudukan@sijunjung.go.id',
                'pemelihara_data' => 'Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sijunjung',
                'email_pemelihara_data' => 'dukcapil@sijunjung.go.id',
                'sumber_data' => 'BPS Kabupaten Sijunjung, Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sijunjung',
                'tanggal_rilis' => '2023-02-01',
                'tanggal_modifikasi_metadata' => '2023-03-15',
                'cakupan_waktu_mulai' => '2022-01-01',
                'cakupan_waktu_selesai' => '2022-12-31',
                'is_publik' => true,
                'jumlah_dilihat' => 150,
                'metadata_tambahan' => json_encode(['catatan_metodologi' => 'Pengumpulan data dilakukan melalui survei dan data administrasi.']),
                'kepatuhan_standar_data' => 'Standar Data Statistik Nasional',
                'url_kamus_data' => 'https://sijunjung.go.id/kamus_data/penduduk_2022',
                'created_by_user_id' => $user->id,
                'updated_by_user_id' => $user->id,
            ],
            [
                'id_organization' => $kominfoOrg->id, // Produsen Data: Dinas Komunikasi dan Informatika
                'judul' => 'Sijunjung Dalam Angka 2023',
                'deskripsi_dataset' => 'Dataset mengenai data statistik Kabupaten Sijunjung tahun 2023.',
                'satuan' => 'Data',
                'frekuensi_pembaruan' => 'Tahunan',
                'dasar_rujukan_prioritas' => 'Rencana Pembangunan Jangka Menengah Daerah (RPJMD)',
                'lisensi' => 'Open Government Licence',
                'penulis_kontak' => 'Tim Statistik Daerah',
                'email_penulis_kontak' => 'statistik@sijunjung.go.id',
                'pemelihara_data' => 'Dinas Komunikasi dan Informatika Kabupaten Sijunjung',
                'email_pemelihara_data' => 'diskominfo@sijunjung.go.id',
                'sumber_data' => 'Berbagai OPD di Kabupaten Sijunjung',
                'tanggal_rilis' => '2024-01-20',
                'tanggal_modifikasi_metadata' => '2024-02-01',
                'cakupan_waktu_mulai' => '2023-01-01',
                'cakupan_waktu_selesai' => '2023-12-31',
                'is_publik' => true,
                'jumlah_dilihat' => 300,
                'metadata_tambahan' => json_encode(['cakupan_geografis' => 'Kabupaten Sijunjung']),
                'kepatuhan_standar_data' => 'Standar Data Indonesia',
                'url_kamus_data' => 'https://sijunjung.go.id/kamus_data/sijunjung_dalam_angka_2023',
                'created_by_user_id' => $user->id,
                'updated_by_user_id' => $user->id,
            ],
            // Tambahkan dataset lain di sini sesuai kebutuhan
        ];

        foreach ($datasets as $datasetData) {
            $datasetData['slug'] = Str::slug($datasetData['judul']);
            Dataset::create($datasetData);
        }

        $this->command->info(count($datasets) . ' datasets berhasil ditambahkan.');
    }
}
