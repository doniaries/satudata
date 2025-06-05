<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Untuk membuat slug
use App\Models\Tag; // Pastikan model Topik Anda ada di App\Models\Topik

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel pivot dulu agar tidak error FK
        \DB::table('dataset_tags')->truncate();
        \DB::table('tags')->delete();

        $tags = [
            'Koperasi dan UMKM',
            'Kependudukan & Ketenagakerjaan',
            'Geografis',
            'Perairan',
            'Pelayanan Publik',
            'Ekonomi Industri',
            'Teknologi dan Komunikasi',
            'Sosial dan Kesejahteraan Rakyat',
            'Pariwisata',
            'Jalan & Tata Ruang',
            'Pertanian, Peternakan dan Perikanan',
            'Penanggulangan Bencana',
            'Kebakaran & Penyelamatan', // Disesuaikan dari "Kebakaran & penyelamatan"
            'Pendidikan', // Disesuaikan dari "pendidikan"
            'Perpustakaan', // Disesuaikan dari "Pespustakaan"
            'Kesehatan',
            'Pemerintahan',
        ];

        foreach ($tags as $namaTag) {
            Tag::firstOrCreate(
                ['slug' => Str::slug($namaTag)],
                [
                    'name' => $namaTag,
                    'slug' => Str::slug($namaTag),
                ]
            );
        }
    }
}
