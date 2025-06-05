<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatasetTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel pivot
        DB::table('dataset_tags')->truncate();

        // Ambil semua dataset dan tag
        $datasets = DB::table('datasets')->pluck('id')->toArray();
        $tags = DB::table('tags')->pluck('id')->toArray();

        // Setiap dataset diberi 1-3 tag acak
        foreach ($datasets as $datasetId) {
            $tagCount = rand(1, min(3, count($tags)));
            $randomTags = collect($tags)->random($tagCount);
            foreach ($randomTags as $tagId) {
                DB::table('dataset_tags')->insert([
                    'dataset_id' => $datasetId,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
