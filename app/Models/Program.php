<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'nama', 'jenis', 'kejuruan', 'instruktur',
        'jp_now', 'jp_max', 'kuota_peserta', 'status',
    ];
}
