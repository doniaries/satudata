<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TentangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('tentangs')->truncate();
        \DB::table('tentangs')->insert([
            [
                'judul' => 'Apa itu Wali Data?',
                'deskripsi' => 'Wali Data adalah instansi pemerintah yang bertanggung jawab dalam penyelenggaraan, pembinaan, dan pengawasan statistik di lingkungan instansinya sesuai dengan ketentuan peraturan perundang-undangan.'
            ],
            [
                'judul' => 'Standar Data Statistik',
                'deskripsi' => 'Standar Data Statistik adalah pedoman atau acuan yang digunakan dalam penyusunan, pengelolaan, dan pemanfaatan data statistik agar data yang dihasilkan memiliki kualitas, konsistensi, dan interoperabilitas.'
            ],
            [
                'judul' => 'Metadata Statistik',
                'deskripsi' => 'Metadata Statistik adalah data/informasi yang menjelaskan suatu data statistik, meliputi definisi, konsep, metodologi, sumber data, cakupan, satuan, dan aspek penting lain yang mendukung pemahaman dan penggunaan data.'
            ],
            [
                'judul' => 'Pranata Data',
                'deskripsi' => 'Pranata Data adalah kebijakan, standar, prosedur, dan kelembagaan yang mengatur pengelolaan data di lingkungan instansi pemerintah.'
            ],
            [
                'judul' => 'Manfaat Standar Data',
                'deskripsi' => 'Standar data statistik bermanfaat untuk meningkatkan kualitas, konsistensi, interoperabilitas, serta memudahkan pertukaran dan pemanfaatan data antar instansi.'
            ],
        ]);
    }
}
