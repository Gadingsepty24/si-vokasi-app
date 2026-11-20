<?php

namespace App\Helpers;

class StatusHelper
{
    /**
     * Kembalikan kelas CSS pill berdasarkan teks status.
     */
    public static function pillClass(string $status): string
    {
        if (str_contains($status, 'Aktif')      ||
            str_contains($status, 'Selesai')    ||
            str_contains($status, 'Terserap')   ||
            str_contains($status, 'Tersedia'))   return 'pill-green';

        if (str_contains($status, 'Persiapan') ||
            str_contains($status, 'Terjadwal') ||
            str_contains($status, 'Proses')    ||
            str_contains($status, 'Digunakan')) return 'pill-amber';

        if (str_contains($status, 'Maintenance')) return 'pill-red';

        return 'pill-blue';
    }
}
