<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ═══════════════════════════════════════════════════════════════
//  MIGRATION: mitra_industri + workshops
// ═══════════════════════════════════════════════════════════════
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mitra_industri', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('sektor', 100);
            $table->string('masa_mou', 60);
            $table->string('kuota_rekrutmen', 80);
            $table->timestamps();
        });

        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('kejuruan', 60);
            $table->string('kapasitas', 80);
            $table->enum('status', ['Tersedia', 'Digunakan', 'Maintenance'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshops');
        Schema::dropIfExists('mitra_industri');
    }
};
