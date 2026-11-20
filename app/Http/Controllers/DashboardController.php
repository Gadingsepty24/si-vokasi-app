<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Alumni;
use App\Models\JadwalUjk;
use App\Models\MitraIndustri;
use App\Models\Workshop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Daftar UPT / Balai yang tersedia.
     */
    private array $balaiList = [
        'BBPVP Makassar',
    ];

    /**
     * Tampilkan dashboard utama.
     */
    public function index(Request $request)
    {
        $activeBalai = $request->session()->get('active_balai', 'BBPVP Makassar');

        // ─── KPI ────────────────────────────────────────────────
        $totalPeserta  = Program::sum('kuota_peserta');
        $paketAktif    = Program::where('status', '!=', 'Selesai')->count();
        $wsReady       = Workshop::where('status', '!=', 'Maintenance')->count();
        $wsTotal       = Workshop::count();
        $totalUjk      = JadwalUjk::count();
        $totalDudi     = MitraIndustri::count();

        // Persen kompeten: alumni dengan sertifikat "Kompeten (BNSP)" / total alumni
        $totalAlumni   = Alumni::count();
        $alumniKompeten = Alumni::where('status_sertifikat', 'like', 'Kompeten%')->count();
        $pctKompeten   = $totalAlumni > 0 ? round($alumniKompeten / $totalAlumni * 100, 1) : 0;

        // Persen terserap
        $alumniTerserap = Alumni::where('status_penempatan', 'Terserap Industri')->count();
        $pctTerserap   = $totalAlumni > 0 ? round($alumniTerserap / $totalAlumni * 100, 1) : 0;

        // ─── Data per seksi ─────────────────────────────────────
        $programs     = Program::latest()->get();
        $programAktif = Program::where('status', '!=', 'Selesai')->latest()->get();
        $alumni       = Alumni::latest()->get();
        $ujkList      = JadwalUjk::orderBy('tanggal_ujk')->get();
        $ujkTerdekat  = JadwalUjk::where('status', '!=', 'Selesai (100% Kompeten)')
                          ->orderBy('tanggal_ujk')
                          ->take(3)
                          ->get();
        $dudiList     = MitraIndustri::all();
        $workshops    = Workshop::all();

        // ─── Chart data ─────────────────────────────────────────
        $chartData = [
            'kelulusan'  => [
                ['label' => 'TIK',     'val' => 95],
                ['label' => 'Otomotif','val' => 91],
                ['label' => 'Las',     'val' => 94],
                ['label' => 'HVAC',    'val' => 89],
                ['label' => 'Fashion', 'val' => 93],
            ],
            'penyerapan' => [
                ['label' => 'TIK',     'val' => 84],
                ['label' => 'Otomotif','val' => 81],
                ['label' => 'Las',     'val' => 88],
                ['label' => 'HVAC',    'val' => 74],
                ['label' => 'Fashion', 'val' => 72],
            ],
        ];

        return view('dashboard.index', [
            'activeBalai'    => $activeBalai,
            'balaiList'      => $this->balaiList,
            'kpi'            => [
                'total_peserta' => $totalPeserta,
                'paket_aktif'   => $paketAktif,
                'pct_kompeten'  => $pctKompeten,
                'total_ujk'     => $totalUjk,
                'total_dudi'    => $totalDudi,
                'pct_terserap'  => $pctTerserap,
                'ws_ready'      => $wsReady,
                'ws_total'      => $wsTotal,
            ],
            'programs'       => $programs,
            'programAktif'   => $programAktif,
            'alumni'         => $alumni,
            'ujkList'        => $ujkList,
            'ujkTerdekat'    => $ujkTerdekat,
            'dudiList'       => $dudiList,
            'workshops'      => $workshops,
            'chartData'      => $chartData,
            'kejuruanList'   => ['TIK', 'Otomotif', 'Teknik Las', 'HVAC', 'Fashion Tech'],
            'totalPrograms'  => $programs->count(),
            'totalAlumni'    => $totalAlumni,
            'totalUjk'       => $totalUjk,
            'totalDudi'      => $totalDudi,
            'totalWorkshop'  => $wsTotal,
        ]);
    }

    /**
     * Simpan sesi balai yang dipilih.
     */
    public function switchBalai(Request $request)
    {
        $request->validate(['balai' => 'required|string']);
        $request->session()->put('active_balai', $request->balai);
        return back()->with('toast', "Konteks dialihkan ke {$request->balai}");
    }
}
