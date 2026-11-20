<?php

namespace App\Http\Controllers;

use App\Models\JadwalUjk;
use Illuminate\Http\Request;

class UjkController extends Controller
{
    /**
     * Simpan jadwal UJK baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_jadwal'  => 'required|string|max:20|unique:jadwal_ujk,kode_jadwal',
            'skema'        => 'required|string|max:150',
            'tanggal_ujk'  => 'required|date',
            'asesor'       => 'required|string|max:150',
            'jumlah_asesi' => 'required|integer|min:1|max:50',
            'status'       => 'nullable|string|max:60',
        ]);

        $data['status'] = $data['status'] ?? 'Terjadwal';

        JadwalUjk::create($data);

        return back()->with('toast', "Jadwal UJK \"{$data['kode_jadwal']}\" berhasil ditambahkan!");
    }

    /**
     * Update data jadwal UJK.
     */
    public function update(Request $request, JadwalUjk $ujk)
    {
        $data = $request->validate([
            'kode_jadwal'  => 'required|string|max:20|unique:jadwal_ujk,kode_jadwal,' . $ujk->id,
            'skema'        => 'required|string|max:150',
            'tanggal_ujk'  => 'required|date',
            'asesor'       => 'required|string|max:150',
            'jumlah_asesi' => 'required|integer|min:1|max:50',
            'status'       => 'nullable|string|max:60',
        ]);

        $ujk->update($data);

        return back()->with('toast', "Jadwal UJK \"{$ujk->kode_jadwal}\" berhasil diperbarui.");
    }

    /**
     * Hapus jadwal UJK.
     */
    public function destroy(JadwalUjk $ujk)
    {
        $kode = $ujk->kode_jadwal;
        $ujk->delete();

        return back()->with('toast', "Jadwal UJK \"{$kode}\" berhasil dihapus.");
    }

    /**
     * Tandai UJK sebagai selesai / kompeten.
     */
    public function complete(JadwalUjk $ujk)
    {
        $ujk->update(['status' => 'Selesai (100% Kompeten)']);

        return back()->with('toast', "Hasil UJK {$ujk->kode_jadwal} telah diverifikasi.");
    }
}
