<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Simpan paket pelatihan baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode'          => 'required|string|unique:programs,kode',
            'jenis'         => 'required|in:PBK,TMT,Boarding',
            'nama'          => 'required|string|max:200',
            'kejuruan'      => 'required|string',
            'instruktur'    => 'required|string|max:150',
            'jp_max'        => 'required|integer|min:40|max:600',
            'kuota_peserta' => 'required|integer|min:8|max:40',
        ]);

        $data['jp_now'] = 0;
        $data['status'] = 'Aktif Berjalan';

        Program::create($data);

        return redirect()->route('dashboard')->with('toast', "Paket baru \"{$data['nama']}\" berhasil dibuka!");
    }

    /**
     * Update data paket pelatihan.
     */
    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'kode'          => 'required|string|unique:programs,kode,' . $program->id,
            'jenis'         => 'required|in:PBK,TMT,Boarding',
            'nama'          => 'required|string|max:200',
            'kejuruan'      => 'required|string',
            'instruktur'    => 'required|string|max:150',
            'jp_now'        => 'required|integer|min:0',
            'jp_max'        => 'required|integer|min:40|max:600',
            'kuota_peserta' => 'required|integer|min:8|max:40',
            'status'        => 'required|string|max:60',
        ]);

        $program->update($data);

        return back()->with('toast', "Paket \"{$program->kode}\" berhasil diperbarui.");
    }

    /**
     * Tambah 20 JP ke program tertentu.
     */
    public function addJp(Program $program)
    {
        $program->jp_now = min($program->jp_max, $program->jp_now + 20);

        if ($program->jp_now >= $program->jp_max) {
            $program->status = 'Selesai';
        } elseif ($program->jp_now / $program->jp_max >= 0.85) {
            $program->status = 'Persiapan UJK';
        }

        $program->save();

        return back()->with('toast', "Progres {$program->kode} diperbarui menjadi {$program->jp_now}/{$program->jp_max} JP.");
    }

    /**
     * Hapus program pelatihan.
     */
    public function destroy(Program $program)
    {
        $kode = $program->kode;
        $program->delete();

        return back()->with('toast', "Paket {$kode} dihapus dari daftar.");
    }
}
