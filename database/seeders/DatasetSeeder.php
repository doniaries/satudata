<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dataset;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Satuan;
use App\Models\Ukuran;

class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data terkait agar seed ulang tidak error FK
        \DB::table('datasets')->delete();

        // Ambil semua organisasi
        $organizations = \App\Models\Organization::all();
        $allTags = \App\Models\Tag::pluck('id')->toArray();
        $allSatuan = \App\Models\Satuan::pluck('id')->toArray();
        $allUkuran = \App\Models\Ukuran::pluck('id')->toArray();
        $userId = \App\Models\User::inRandomOrder()->value('id');

        foreach ($organizations as $org) {
            $judul = 'Data ' . $org->name . ' Tahun ' . now()->year;
            $dataset = \App\Models\Dataset::create([
                'id_organization' => $org->id,
                'judul' => $judul,
                'slug' => \Str::slug($judul . '-' . uniqid()),
                'deskripsi_dataset' => 'Data ini berisi informasi dari organisasi ' . $org->name . '.',
                'frekuensi_pembaruan' => 'Tahunan',
                'dasar_rujukan_prioritas' => 'RPJMD Kabupaten Sijunjung 2020-2025',
                'lisensi' => 'Open Data',
                'penulis_kontak' => 'Admin ' . $org->name,
                'email_penulis_kontak' => $org->email_organisasi ?? 'admin@' . ($org->slug ?? \Str::slug($org->name)) . '.go.id',
                'pemelihara_data' => $org->name,
                'email_pemelihara_data' => $org->email_organisasi ?? 'admin@' . ($org->slug ?? \Str::slug($org->name)) . '.go.id',
                'sumber_data' => $org->name,
                'tanggal_rilis' => now()->subYears(rand(1, 5)),
                'tanggal_modifikasi_metadata' => now(),
                'is_publik' => true,
                'metadata_tambahan' => json_encode(['catatan' => 'Contoh dataset organisasi ' . $org->name]),
                'url_kamus_data' => 'https://sijunjung.go.id/kamus_data/' . \Str::slug($judul),
                'created_by_user_id' => $userId,
                'updated_by_user_id' => $userId,
                // Kolom resource
                'nama_resource' => 'Resource ' . $org->name,
                'deskripsi_resource' => 'File utama data ' . $org->name,
                'file_path' => 'storage/data/' . \Str::slug($judul) . '.csv',
                'format' => 'CSV',
                'ukuran_file' => rand(10000, 500000),
                'terakhir_diubah' => now()->subDays(rand(0, 30)),
                'jumlah_diunduh' => rand(0, 100),
                'satuan_id' => $allSatuan ? collect($allSatuan)->random() : null,
                'ukuran_id' => $allUkuran ? collect($allUkuran)->random() : null,
            ]);
            // Jika ingin tetap assign tags, bisa gunakan relasi tags jika masih ada
            if ($allTags && method_exists($dataset, 'tags')) {
                $dataset->tags()->sync(collect($allTags)->random(rand(1, min(3, count($allTags))))->all());
            }
        }
    }
}
