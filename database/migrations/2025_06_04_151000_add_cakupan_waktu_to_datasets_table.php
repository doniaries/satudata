<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('datasets', function (Blueprint $table) {
            $table->date('cakupan_waktu_mulai')->nullable()->after('tanggal_modifikasi_metadata');
            $table->date('cakupan_waktu_selesai')->nullable()->after('cakupan_waktu_mulai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datasets', function (Blueprint $table) {
            $table->dropColumn(['cakupan_waktu_mulai', 'cakupan_waktu_selesai']);
        });
    }
};
