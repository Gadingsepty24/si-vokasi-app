<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    private array $statusOrder = [
        'Sedang Pelatihan',
        'Proses Rekrutmen',
        'Terserap Industri',
        'Wirausaha',
    ];

    /**
     * Simpan alumni baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nik'               => 'required|string|max:20|unique:alumni,nik',
            'nama'              => 'required|string|max:150',
            'kejuruan'          => 'required|string|max:60',
            'status_sertifikat' => 'required|string|max:80',
            'status_penempatan' => 'required|string|max:80',
            'detail_penempatan' => 'nullable|string|max:200',
        ]);

        Alumni::create($data);

        return back()->with('toast', "Alumni \"{$data['nama']}\" berhasil ditambahkan!");
    }

    /**
     * Update data alumni.
     */
    public function update(Request $request, Alumni $alumni)
    {
        $data = $request->validate([
            'nik'               => 'required|string|max:20|unique:alumni,nik,' . $alumni->id,
            'nama'              => 'required|string|max:150',
            'kejuruan'          => 'required|string|max:60',
            'status_sertifikat' => 'required|string|max:80',
            'status_penempatan' => 'required|string|max:80',
            'detail_penempatan' => 'nullable|string|max:200',
        ]);

        $alumni->update($data);

        return back()->with('toast', "Data alumni \"{$alumni->nama}\" berhasil diperbarui.");
    }

    /**
     * Hapus alumni.
     */
    public function destroy(Alumni $alumni)
    {
        $nama = $alumni->nama;
        $alumni->delete();

        return back()->with('toast', "Alumni \"{$nama}\" berhasil dihapus.");
    }

    /**
     * Putar siklus status penempatan alumni.
     */
    public function cycleStatus(Alumni $alumni)
    {
        $current = $alumni->status_penempatan;
        $idx     = array_search($current, $this->statusOrder);
        $next    = $this->statusOrder[($idx + 1) % count($this->statusOrder)];

        $alumni->update(['status_penempatan' => $next]);

        return back()->with('toast', "Status tracer {$alumni->nama} diperbarui: {$next}.");
    }
}
