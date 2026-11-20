<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ═══════════════════════════════════════════════════════════════
//  MIGRATION: jadwal_ujk
// ═══════════════════════════════════════════════════════════════
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ujk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwal', 20)->unique();
            $table->string('skema', 150)->comment('Skema okupasi BNSP');
            $table->date('tanggal_ujk');
            $table->string('asesor', 150);
            $table->unsignedTinyInteger('jumlah_asesi');
            $table->string('status', 60)->default('Terjadwal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujk');
    }
};
