<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->index('name', 'slug'); // Indeks untuk pencarian cepat berdasarkan nama tag
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
