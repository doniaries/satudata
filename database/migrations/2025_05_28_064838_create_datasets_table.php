<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_team')->constrained('teams')->onDelete('cascade'); // Produsen Data
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi_dataset');
            $table->string('frekuensi_pembaruan')->nullable()->index();
            $table->string('dasar_rujukan_prioritas')->nullable()->index();
            $table->string('lisensi')->nullable();
            $table->string('penulis_kontak')->nullable();
            $table->string('email_penulis_kontak')->nullable();
            $table->string('pemelihara_data')->nullable();
            $table->string('email_pemelihara_data')->nullable();
            $table->string('sumber_data')->nullable();
            $table->date('tanggal_rilis')->nullable()->index();
            $table->date('tanggal_modifikasi_metadata')->nullable()->index();
            $table->boolean('is_publik')->default(true)->index();
            $table->json('metadata_tambahan')->nullable();
            $table->string('url_kamus_data')->nullable();

            // Kolom dari resource
            $table->string('nama_resource');
            $table->text('deskripsi_resource')->nullable();
            $table->foreignId('satuan_id')->nullable()->constrained('satuans')->onDelete('set null');
            $table->foreignId('ukuran_id')->nullable()->constrained('ukurans')->onDelete('set null');
            $table->string('file_path')->nullable(); // Path lokal atau URL eksternal
            $table->string('format')->nullable(); // CSV, XLS, PDF, API, dll.
            $table->unsignedBigInteger('ukuran_file')->nullable(); // Dalam bytes
            $table->dateTime('terakhir_diubah')->nullable();
            $table->unsignedInteger('jumlah_diunduh')->default(0);
            $table->string('kepatuhan_standar_data')->nullable();
            $table->unsignedInteger('jumlah_dilihat')->default(0);

            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            // Indeks tambahan
            $table->index('judul'); // Indeks untuk pencarian berdasarkan judul
            $table->index('nama_resource'); // Indeks untuk pencarian resource
            $table->index('format');
            $table->index('satuan_id');
            $table->index('ukuran_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasets');
    }
};
