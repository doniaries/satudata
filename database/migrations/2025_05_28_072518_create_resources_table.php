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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dataset_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('deskripsi_resource')->nullable();
            $table->string('file_path')->nullable(); // Bisa path lokal atau URL eksternal
            $table->string('format')->index(); // CSV, XLS, PDF, API, dll.
            $table->unsignedBigInteger('ukuran')->nullable(); // Dalam bytes
            $table->dateTime('terakhir_diubah')->nullable();
            $table->unsignedInteger('jumlah_diunduh')->default(0);
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            $table->index('name'); // Indeks untuk pencarian berdasarkan nama berkas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
