<?php

namespace App\Http\Controllers;

use App\Models\MitraIndustri;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Simpan mitra industri baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'            => 'required|string|max:150',
            'sektor'          => 'required|string|max:100',
            'masa_mou'        => 'required|string|max:60',
            'kuota_rekrutmen' => 'required|string|max:80',
        ]);

        MitraIndustri::create($data);

        return back()->with('toast', "Mitra \"{$data['nama']}\" berhasil ditambahkan!");
    }

    /**
     * Update data mitra industri.
     */
    public function update(Request $request, MitraIndustri $mitra)
    {
        $data = $request->validate([
            'nama'            => 'required|string|max:150',
            'sektor'          => 'required|string|max:100',
            'masa_mou'        => 'required|string|max:60',
            'kuota_rekrutmen' => 'required|string|max:80',
        ]);

        $mitra->update($data);

        return back()->with('toast', "Mitra \"{$mitra->nama}\" berhasil diperbarui.");
    }

    /**
     * Hapus mitra industri.
     */
    public function destroy(MitraIndustri $mitra)
    {
        $nama = $mitra->nama;
        $mitra->delete();

        return back()->with('toast', "Mitra \"{$nama}\" berhasil dihapus.");
    }
}
