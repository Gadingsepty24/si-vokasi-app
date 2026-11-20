<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ═══════════════════════════════════════════════════════════════
//  MIGRATION: programs
// ═══════════════════════════════════════════════════════════════
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique()->comment('Kode angkatan, cth: PBK-26-041');
            $table->string('nama', 200);
            $table->enum('jenis', ['PBK', 'TMT', 'Boarding']);
            $table->string('kejuruan', 60);
            $table->string('instruktur', 150);
            $table->unsignedSmallInteger('jp_now')->default(0)->comment('JP yang sudah berjalan');
            $table->unsignedSmallInteger('jp_max')->comment('Target total JP');
            $table->unsignedTinyInteger('kuota_peserta')->default(16);
            $table->string('status', 60)->default('Aktif Berjalan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
