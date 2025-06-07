<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            'Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia',
            'Badan Keuangan Dan Aset Daerah',
            'Badan Penanggulangan Bencana Daerah',
            'Badan Perencanaan, Penelitian Dan Pengembangan Daerah',
            'Dinas Kependudukan Dan Pencatatan Sipil',
            'Dinas Kesehatan',
            'Dinas Pendidikan Dan Kebudayaan',
            'Dinas Pekerjaan Umum Dan Penataan Ruang',
            'Dinas Perhubungan',
            'Dinas Komunikasi Dan Informatika',
            'Dinas Lingkungan Hidup',
            'Dinas Sosial',
            'Dinas Tenaga Kerja Dan Transmigrasi',
            'Dinas Koperasi, Usaha Kecil Dan Menengah',
            'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'Dinas Pariwisata',
            'Dinas Perindustrian Dan Perdagangan',
            'Dinas Pertanian',
            'Dinas Perikanan Dan Kelautan',
            'Dinas Peternakan Dan Kesehatan Hewan',
            'Dinas Perpustakaan Dan Kearsipan',
            'Inspektorat Daerah',
            'Sekretariat Daerah',
            'Sekretariat DPRD',
            'Satuan Polisi Pamong Praja',
            'Badan Kesatuan Bangsa Dan Politik',
            'Dinas Pemuda Dan Olahraga',
            'Badan Pengelolaan Keuangan Dan Pendapatan Daerah',
            'Badan Riset Dan Inovasi Daerah',
            'Dinas Ketahanan Pangan',
        ];

        foreach ($teams as $nama) {
            $slug = Str::slug($nama);
            Team::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $nama,
                    'slug' => $slug,
                    'url_logo' => null,
                    'alamat' => 'Jl. Contoh Alamat',
                    'nomor_telepon' => '021-000000',
                    'email_organisasi' => "info@{$slug}.go.id",
                    'website_organisasi' => "https://{$slug}.go.id",
                ]
            );
        }
    }
}
