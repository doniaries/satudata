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
            $table->foreignId('id_organization')->constrained('organizations')->onDelete('cascade'); // Produsen Data
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi_dataset');
            $table->string('satuan')->nullable()->index();
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
            $table->string('cakupan_waktu_mulai')->nullable();
            $table->string('cakupan_waktu_selesai')->nullable();
            $table->boolean('is_publik')->default(true)->index();
            $table->unsignedInteger('jumlah_dilihat')->default(0);
            $table->json('metadata_tambahan')->nullable();
            $table->string('kepatuhan_standar_data')->nullable();
            $table->string('url_kamus_data')->nullable();
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            // Indeks tambahan
            $table->index('judul'); // Indeks untuk pencarian berdasarkan judul
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sets');
    }
};
