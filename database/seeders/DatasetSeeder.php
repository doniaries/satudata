<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Dataset;
use App\Models\Tag;
use App\Models\Team;
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
        DB::table('datasets')->delete();

        // Ambil semua teams dengan proper model loading
        $teams = Team::all();
        $allTags = Tag::pluck('id')->toArray();
        $allSatuan = Satuan::pluck('id')->toArray();
        $allUkuran = Ukuran::pluck('id')->toArray();

        foreach ($teams as $team) {
            $judul = 'Data ' . $team->name . ' Tahun ' . now()->year;

            // Ambil user anggota team
            $userId = $team->users()->inRandomOrder()->value('id');
            if (!$userId) {
                // fallback jika tidak ada user di team
                $userId = User::inRandomOrder()->value('id');
            }

            $dataset = Dataset::create([
                'id_team' => $team->id, // Sesuaikan dengan kolom di migration
                'judul' => $judul,
                'slug' => Str::slug($judul . '-' . uniqid()),
                'deskripsi_dataset' => 'Data ini berisi informasi dari organisasi ' . $team->name . '.',
                'frekuensi_pembaruan' => 'Tahunan',
                'dasar_rujukan_prioritas' => 'RPJMD Kabupaten Sijunjung 2020-2025',
                'lisensi' => 'Open Data',
                'penulis_kontak' => 'Admin ' . $team->name,
                'email_penulis_kontak' => 'admin@' . ($team->slug ?? Str::slug($team->name)) . '.go.id',
                'pemelihara_data' => $team->name,
                'email_pemelihara_data' => 'admin@' . ($team->slug ?? Str::slug($team->name)) . '.go.id',
                'sumber_data' => $team->name,
                'tanggal_rilis' => now()->subYears(rand(1, 5)),
                'tanggal_modifikasi_metadata' => now(),
                'is_publik' => true,
                'metadata_tambahan' => json_encode(['catatan' => 'Contoh dataset organisasi ' . $team->name]),
                'url_kamus_data' => 'https://sijunjung.go.id/kamus_data/' . Str::slug($judul),
                'created_by_user_id' => $userId,
                'updated_by_user_id' => $userId,
                // Kolom resource
                'nama_resource' => 'Resource ' . $team->name,
                'deskripsi_resource' => 'File utama data ' . $team->name,
                'file_path' => 'storage/data/' . Str::slug($judul) . '.csv',
                'format' => 'CSV',
                'ukuran_file' => rand(10000, 500000),
                'terakhir_diubah' => now()->subDays(rand(0, 30)),
                'jumlah_diunduh' => rand(0, 100),
                'satuan_id' => !empty($allSatuan) ? collect($allSatuan)->random() : null,
                'ukuran_id' => !empty($allUkuran) ? collect($allUkuran)->random() : null,
            ]);

            // Assign tags jika ada
            if (!empty($allTags) && method_exists($dataset, 'tags')) {
                $randomTags = collect($allTags)->random(rand(1, min(3, count($allTags))))->all();
                $dataset->tags()->sync($randomTags);
            }
        }
    }
}
