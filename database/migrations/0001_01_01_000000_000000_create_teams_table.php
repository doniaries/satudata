<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
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

        Schema::create('team_user', function (Blueprint $table) {
            // $table->id();
            $table->foreignIdFor(Team::class)->index();
            $table->foreignIdFor(User::class)->index();
            $table->timestamps();

            $table->unique(['team_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
        Schema::dropIfExists('team_user');
    }
};
