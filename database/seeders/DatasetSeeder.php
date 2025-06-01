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
        // Ambil ID organisasi pertama sebagai contoh, atau sesuaikan dengan kebutuhan Anda
        $organization = Organization::first();
        if (!$organization) {
            $this->command->error('Tidak ada Organisasi ditemukan. Jalankan OrganizationsSeeder terlebih dahulu.');
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
                'id_organization' => $organization->id, // Produsen Data
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
                'id_organization' => $organization->id,
                'judul' => 'Angka Partisipasi Sekolah di Kota Bukittinggi 2023',
                'deskripsi_dataset' => 'Dataset mengenai Angka Partisipasi Sekolah (APS) berdasarkan jenjang pendidikan di Kota Bukittinggi untuk tahun 2023.',
                'satuan' => 'Persen',
                'frekuensi_pembaruan' => 'Tahunan',
                'dasar_rujukan_prioritas' => 'Indikator Kinerja Utama (IKU) Pendidikan Kota Bukittinggi',
                'lisensi' => 'Data Terbuka Pemerintah Kota Bukittinggi',
                'penulis_kontak' => 'Seksi Data Pendidikan',
                'email_penulis_kontak' => 'data.pendidikan@bukittinggikota.go.id',
                'pemelihara_data' => 'Dinas Pendidikan dan Kebudayaan Kota Bukittinggi',
                'email_pemelihara_data' => 'disdikbud@bukittinggikota.go.id',
                'sumber_data' => 'Survei Sosial Ekonomi Nasional (Susenas) - Modul Pendidikan',
                'tanggal_rilis' => '2024-04-10',
                'tanggal_modifikasi_metadata' => '2024-04-20',
                'cakupan_waktu_mulai' => '2023-01-01',
                'cakupan_waktu_selesai' => '2023-12-31',
                'is_publik' => true,
                'jumlah_dilihat' => 250,
                'metadata_tambahan' => json_encode(['tingkat_akurasi' => 'Estimasi sampel dengan margin of error 5%']),
                'kepatuhan_standar_data' => 'Standar Data Sektoral Pendidikan',
                'url_kamus_data' => 'https://bukittinggikota.go.id/kamus_data/aps_2023',
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
