<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraIndustri extends Model
{
    use HasFactory;

    protected $table = 'mitra_industri';

    protected $fillable = [
        'nama', 'sektor', 'masa_mou', 'kuota_rekrutmen',
    ];
}
