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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // Untuk URL dan pencarian cepat
            $table->string('url_logo')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('email_organisasi')->nullable()->index(); // Indeks untuk pencarian email
            $table->string('website_organisasi')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps(); // created_at dan updated_at
            $table->softDeletes(); // Untuk fitur soft delete (menambah kolom deleted_at)

            // Indeks tambahan
            $table->index('name'); // Indeks untuk pencarian berdasarkan nama
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasis');
    }
};
