<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni'; // ← tambahkan baris ini

    protected $fillable = [
        'nik', 'nama', 'kejuruan', 'status_sertifikat',
        'status_penempatan', 'detail_penempatan',
    ];
}