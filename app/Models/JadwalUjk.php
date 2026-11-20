<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjk extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ujk';

    protected $fillable = [
        'kode_jadwal', 'skema', 'tanggal_ujk', 'asesor', 'jumlah_asesi', 'status',
    ];

    protected $casts = [
        'tanggal_ujk' => 'date',
    ];
}
