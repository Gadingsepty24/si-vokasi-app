<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    /**
     * Simpan workshop baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:150',
            'kejuruan'  => 'required|string|max:60',
            'kapasitas' => 'required|string|max:80',
            'status'    => 'nullable|in:Tersedia,Digunakan,Maintenance',
        ]);

        $data['status'] = $data['status'] ?? 'Tersedia';

        Workshop::create($data);

        return back()->with('toast', "Workshop \"{$data['nama']}\" berhasil ditambahkan!");
    }

    /**
     * Update data workshop.
     */
    public function update(Request $request, Workshop $workshop)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:150',
            'kejuruan'  => 'required|string|max:60',
            'kapasitas' => 'required|string|max:80',
            'status'    => 'required|in:Tersedia,Digunakan,Maintenance',
        ]);

        $workshop->update($data);

        return back()->with('toast', "Workshop \"{$workshop->nama}\" berhasil diperbarui.");
    }

    /**
     * Hapus workshop.
     */
    public function destroy(Workshop $workshop)
    {
        $nama = $workshop->nama;
        $workshop->delete();

        return back()->with('toast', "Workshop \"{$nama}\" berhasil dihapus.");
    }

    /**
     * Toggle status workshop: Tersedia → Digunakan → Maintenance → Tersedia
     */
    public function toggleStatus(Workshop $workshop)
    {
        $order  = ['Tersedia', 'Digunakan', 'Maintenance'];
        $idx    = array_search($workshop->status, $order);
        $next   = $order[($idx + 1) % count($order)];

        $workshop->update(['status' => $next]);

        return back()->with('toast', "Status {$workshop->nama} diubah menjadi \"{$next}\".");
    }
}
