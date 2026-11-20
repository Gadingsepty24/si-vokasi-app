@extends('layouts.app')

@section('title', 'Dashboard Utama')
@section('page-title', 'Dashboard Eksekutif — ' . $activeBalai)
@section('page-subtitle', 'Monitoring Pelatihan Vokasi, Sertifikasi BNSP & Penyerapan DUDI')

@section('content')

  {{-- ===================================================
       TAB 1: DASHBOARD UTAMA (KPI + Chart + Table)
       =================================================== --}}
  <section id="view-dashboard" class="view-section active">

    {{-- KPI Cards --}}
    <div class="kpi-grid" id="kpiContainer">
      <div class="kpi-card brutal-box bg-navy">
        <div class="kpi-header">
          <span class="kpi-label">Peserta Terdaftar</span>
          <span class="kpi-badge">SISWA</span>
        </div>
        <div class="kpi-value">{{ $kpi['total_peserta'] }}</div>
        <div class="kpi-sub">{{ $kpi['paket_aktif'] }} Paket Pelatihan Aktif</div>
      </div>
      <div class="kpi-card brutal-box bg-blue">
        <div class="kpi-header">
          <span class="kpi-label">Tingkat Kompeten</span>
          <span class="kpi-badge">BNSP</span>
        </div>
        <div class="kpi-value">{{ $kpi['pct_kompeten'] }}%</div>
        <div class="kpi-sub">{{ $kpi['total_ujk'] }} Jadwal UJK Terdaftar</div>
      </div>
      <div class="kpi-card brutal-box bg-yellow">
        <div class="kpi-header">
          <span class="kpi-label">Mitra Industri</span>
          <span class="kpi-badge">DUDI</span>
        </div>
        <div class="kpi-value">{{ $kpi['total_dudi'] }}</div>
        <div class="kpi-sub">{{ $kpi['pct_terserap'] }}% Alumni Terserap</div>
      </div>
      <div class="kpi-card brutal-box">
        <div class="kpi-header">
          <span class="kpi-label">Kesiapan Workshop</span>
          <span class="kpi-badge">SARPRAS</span>
        </div>
        <div class="kpi-value">{{ $kpi['ws_ready'] }}/{{ $kpi['ws_total'] }}</div>
        <div class="kpi-sub">Unit Bengkel Siap Pakai</div>
      </div>
    </div>

    <div class="mid-grid">
      {{-- Grafik Interaktif --}}
      <div class="panel brutal-box">
        <div class="panel-title">
          <h3>Statistik Kejuruan (%)</h3>
          <div class="chart-controls">
            <button class="btn btn-sm btn-navy" data-chart="kelulusan">Kelulusan BNSP</button>
            <button class="btn btn-sm"           data-chart="penyerapan">Serapan Industri</button>
          </div>
        </div>
        <div class="chart-bars" id="chartContainer"></div>
      </div>

      {{-- Jadwal UJK Terdekat --}}
      <div class="panel brutal-box">
        <div class="panel-title">
          <div>
            <h3>Jadwal UJK Terdekat</h3>
            <span style="font-size:11px; color:#64748B;">LSP P2 Kemnaker RI</span>
          </div>
          <div style="display:flex; gap:6px;">
            <button class="btn btn-sm btn-yellow" onclick="openModal('modalUjk')">+ Jadwal Baru</button>
            <button class="btn btn-sm" onclick="switchTab('sertifikasi')">Lihat Semua &rarr;</button>
          </div>
        </div>
        <div id="miniUjkList" style="display:flex; flex-direction:column; gap:10px;">
          @foreach($ujkTerdekat as $idx => $u)
            <div class="brutal-box-sm" style="padding:12px; display:flex; justify-content:space-between; align-items:center; gap:8px;">
              <div>
                <div style="font-size:13px; font-weight:800;">{{ $u->skema }}</div>
                <div style="font-size:11.5px; color:#334155; font-weight:600;">
                  📅 {{ $u->tanggal_ujk->format('d M Y') }} &bull; 👥 {{ $u->jumlah_asesi }} Asesi
                </div>
              </div>
              <div style="display:flex; align-items:center; gap:6px;">
                <span class="pill {{ \App\Helpers\StatusHelper::pillClass($u->status) }}">
                  {{ Str::words($u->status, 1, '') }}
                </span>
                <button class="btn btn-sm btn-yellow" onclick="openEditUjkModal({{ $idx }})">✏️ Update</button>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Tabel Pantauan Progres Pelatihan Aktif --}}
    <div class="panel brutal-box">
      <div class="panel-title">
        <h3>Pantauan Progres Pelatihan Aktif</h3>
        <button class="btn btn-sm btn-yellow" onclick="switchTab('pelatihan')">Kelola Semua Paket &rarr;</button>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Kode</th>
              <th>Program Pelatihan</th>
              <th>Jenis</th>
              <th>Progres JP</th>
              <th>Status</th>
              <th>Aksi Cepat</th>
            </tr>
          </thead>
          <tbody id="dashboardProgramRows">
            @foreach($programAktif->take(4) as $p)
              @php $pct = min(100, round(($p->jp_now / $p->jp_max) * 100)); @endphp
              <tr>
                <td><span class="code-mono">{{ $p->kode }}</span></td>
                <td><strong>{{ $p->nama }}</strong></td>
                <td>{{ $p->jenis }}</td>
                <td>
                  <div class="progress-mini">
                    <div class="progress-mini-fill" style="width:{{ $pct }}%"></div>
                  </div>
                  <span>{{ $p->jp_now }}/{{ $p->jp_max }} JP</span>
                </td>
                <td><span class="pill {{ \App\Helpers\StatusHelper::pillClass($p->status) }}">{{ $p->status }}</span></td>
                <td>
                  <form action="{{ route('programs.addJp', $p->id) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm btn-primary" {{ $p->jp_now >= $p->jp_max ? 'disabled' : '' }}>+20 JP</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 2: PROGRAM PELATIHAN
       =================================================== --}}
  <section id="view-pelatihan" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Manajemen Paket Pelatihan (PBK / TMT / Boarding)</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Atur kuota, progres jam pelajaran (JP), instruktur pengampu, dan status kurikulum.</p>
        </div>
        <div style="display:flex; gap:8px;">
          <button class="btn btn-sm btn-primary" onclick="openModal('modalProgram')">+ Buka Paket Baru</button>
          <button class="btn btn-sm btn-yellow" onclick="exportData('programs')">Ekspor Data</button>
        </div>
      </div>

      <div class="filter-bar">
        <select id="filterJenis">
          <option value="ALL">Semua Jenis Program</option>
          <option value="PBK">PBK (Reguler)</option>
          <option value="TMT">TMT (Tailor Made)</option>
          <option value="Boarding">Boarding (Asrama)</option>
        </select>
        <select id="filterKejuruan">
          <option value="ALL">Semua Kejuruan</option>
          @foreach($kejuruanList as $k)
            <option value="{{ $k }}">{{ $k }}</option>
          @endforeach
        </select>
        <select id="filterStatus">
          <option value="ALL">Semua Status</option>
          <option value="Aktif Berjalan">Aktif Berjalan</option>
          <option value="Persiapan UJK">Persiapan UJK</option>
          <option value="Selesai">Selesai</option>
        </select>
        <button class="btn btn-sm" id="btnResetFilter">Reset Filter</button>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Kode</th><th>Program Pelatihan</th><th>Jenis</th><th>Kejuruan</th>
              <th>Instruktur</th><th>Peserta</th><th>Progres JP</th><th>Status</th><th>Aksi Admin</th>
            </tr>
          </thead>
          <tbody id="fullProgramRows">
            {{-- Dimuat via Blade & disinkronkan via JS --}}
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 3: PESERTA & TRACER ALUMNI
       =================================================== --}}
  <section id="view-peserta" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Direktori Peserta &amp; Tracer Study Alumni</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Verifikasi serapan lulusan ke DUDI, wirausaha, serta validasi sertifikat BNSP.</p>
        </div>
        <div style="display:flex; gap:8px;">
          <button class="btn btn-sm btn-primary" onclick="openModal('modalAlumni')">+ Tambah Peserta Baru</button>
          <button class="btn btn-sm btn-yellow" onclick="exportData('alumni')">Ekspor Tracer</button>
        </div>
      </div>
      <div class="filter-bar">
        <select id="filterAlumniStatus">
          <option value="ALL">Semua Status Penempatan</option>
          <option value="Terserap Industri">Terserap Industri</option>
          <option value="Wirausaha">Wirausaha Mandiri</option>
          <option value="Proses Rekrutmen">Proses Rekrutmen</option>
          <option value="Sedang Pelatihan">Sedang Pelatihan</option>
        </select>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>NIK / ID</th><th>Nama Peserta</th><th>Kejuruan</th>
              <th>Status Sertifikat</th><th>Penempatan Kerja / Tracer</th><th>Aksi Admin</th>
            </tr>
          </thead>
          <tbody id="alumniRows">
            {{-- Diisi secara dinamis --}}
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 4: SERTIFIKASI BNSP
       =================================================== --}}
  <section id="view-sertifikasi" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Jadwal Uji Kompetensi (UJK) &amp; Asesmen BNSP</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Manajemen Tempat Uji Kompetensi (TUK), asesor LSP P2 Kemnaker, dan sertifikasi.</p>
        </div>
        <div style="display:flex; gap:8px;">
          <button class="btn btn-sm btn-primary" onclick="openModal('modalUjk')">+ Buat Jadwal UJK</button>
          <button class="btn btn-sm btn-yellow" onclick="exportData('ujk')">Ekspor Berita Acara</button>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>ID Jadwal</th><th>Skema Okupasi</th><th>Tanggal UJK</th>
              <th>Asesor LSP</th><th>Asesi</th><th>Status</th><th>Aksi Admin</th>
            </tr>
          </thead>
          <tbody id="ujkRows">
            {{-- Diisi secara dinamis --}}
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 5: MITRA INDUSTRI DUDI
       =================================================== --}}
  <section id="view-industri" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Mitra Dunia Usaha &amp; Dunia Industri (DUDI)</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Link &amp; Match vokasi, perjanjian MoU, program OJT/magang, dan kuota rekrutmen kerja.</p>
        </div>
        <button class="btn btn-sm btn-primary" onclick="openModal('modalDudi')">+ Tambah Mitra Industri</button>
      </div>
      <div class="cards-grid-3" id="dudiCards">
        {{-- Diisi secara dinamis --}}
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 6: SARPRAS & WORKSHOP
       =================================================== --}}
  <section id="view-workshop" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Manajemen Kesiapan Bengkel &amp; Workshop</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Status kesiapan ruangan, perawatan mesin trainer, kapasitas kabin, dan jadwal perawatan.</p>
        </div>
        <button class="btn btn-sm btn-primary" onclick="openModal('modalWorkshop')">+ Tambah Bengkel / Lab</button>
      </div>
      <div class="cards-grid-3" id="workshopCards">
        {{-- Diisi secara dinamis --}}
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 7 (BARU): KELOLA PENGGUNA & HAK AKSES ADMIN
       =================================================== --}}
  <section id="view-users" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Manajemen Akun Pengguna &amp; Hak Akses Balai</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Atur akun Administrator, Operator Balai, Instruktur Pengampu, dan Asesor LSP P2.</p>
        </div>
        <button class="btn btn-sm btn-primary" onclick="openModal('modalUser')">+ Tambah Akun Baru</button>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>ID Akun</th><th>Nama Pengguna</th><th>Email Resmi</th><th>Peran (Role)</th>
              <th>Penugasan Kejuruan</th><th>Status</th><th>Aksi Admin</th>
            </tr>
          </thead>
          <tbody id="userRows">
            {{-- Diisi secara dinamis oleh JS --}}
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 8 (BARU): REKAP & PUSAT LAPORAN RESMI
       =================================================== --}}
  <section id="view-laporan" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Pusat Rekapitulasi &amp; Cetak Laporan Eksekutif</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Ekspor data resmi untuk pelaporan berkala Direktorat Jenderal Binalavotas Kemnaker RI.</p>
        </div>
        <button class="btn btn-sm btn-navy" onclick="printPage()">🖨️ Cetak Tampilan Laporan</button>
      </div>

      <div class="kpi-grid" style="margin-bottom:20px;">
        <div class="kpi-card brutal-box bg-blue">
          <div class="kpi-header"><span class="kpi-label">Target Kelulusan BNSP</span><span class="kpi-badge">DIPA 2026</span></div>
          <div class="kpi-value">95.0%</div>
          <div class="kpi-sub">Realisasi saat ini: 92.4%</div>
        </div>
        <div class="kpi-card brutal-box bg-yellow">
          <div class="kpi-header"><span class="kpi-label">Target Serapan DUDI</span><span class="kpi-badge">IKU 3</span></div>
          <div class="kpi-value">80.0%</div>
          <div class="kpi-sub">Realisasi saat ini: 78.6%</div>
        </div>
        <div class="kpi-card brutal-box bg-navy">
          <div class="kpi-header"><span class="kpi-label">Alokasi Anggaran PBK</span><span class="kpi-badge">KEUANGAN</span></div>
          <div class="kpi-value">Rp 4.2 M</div>
          <div class="kpi-sub">Penyerapan Anggaran: 68.4%</div>
        </div>
        <div class="kpi-card brutal-box">
          <div class="kpi-header"><span class="kpi-label">Sertifikat Terbit</span><span class="kpi-badge">BLANKO</span></div>
          <div class="kpi-value">64 Lembar</div>
          <div class="kpi-sub">Semua blanko tercatat di SIAPkerja</div>
        </div>
      </div>

      <div class="cards-grid-3">
        <div class="workshop-card brutal-box-sm">
          <h4>📊 Laporan Kinerja Pelatihan Vokasi</h4>
          <p style="font-size:12px; color:#475569; margin:8px 0;">Rekapitulasi seluruh paket pelatihan PBK, TMT, dan Boarding yang terlaksana tahun ini.</p>
          <div style="display:flex; gap:6px;">
            <button class="btn btn-sm btn-primary" onclick="exportData('programs')">Download CSV</button>
            <button class="btn btn-sm" onclick="showToast('Mengunduh format PDF Kemnaker...')">Format PDF</button>
          </div>
        </div>

        <div class="workshop-card brutal-box-sm">
          <h4>🎯 Laporan Tracer Study &amp; Serapan Kerja</h4>
          <p style="font-size:12px; color:#475569; margin:8px 0;">Daftar lulusan yang telah bekerja, berwirausaha mandiri, maupun masih proses rekrutmen.</p>
          <div style="display:flex; gap:6px;">
            <button class="btn btn-sm btn-yellow" onclick="exportData('alumni')">Download CSV</button>
            <button class="btn btn-sm" onclick="showToast('Mengunduh format PDF Kemnaker...')">Format PDF</button>
          </div>
        </div>

        <div class="workshop-card brutal-box-sm">
          <h4>🏅 Laporan Uji Kompetensi (LSP P2)</h4>
          <p style="font-size:12px; color:#475569; margin:8px 0;">Berita acara uji kompetensi BNSP beserta daftar asesi yang dinyatakan Kompeten.</p>
          <div style="display:flex; gap:6px;">
            <button class="btn btn-sm btn-green" onclick="exportData('ujk')">Download CSV</button>
            <button class="btn btn-sm" onclick="showToast('Mengunduh format PDF Kemnaker...')">Format PDF</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 9 (BARU): AUDIT LOG AKTIVITAS ADMIN
       =================================================== --}}
  <section id="view-logs" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Audit Trail &amp; Rekam Jejak Aktivitas Admin</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Mencatat seluruh aksi penambahan, perubahan status, dan penghapusan data secara kronologis.</p>
        </div>
        <button class="btn btn-sm btn-red" onclick="clearLogs()">Hapus Log Riwayat</button>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Waktu</th><th>Pelaksana (User)</th><th>Tindakan / Aksi</th>
              <th>Modul Terkait</th><th>Rincian Data</th><th>Status</th>
            </tr>
          </thead>
          <tbody id="logRows">
            {{-- Diisi secara dinamis oleh JS --}}
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- ===================================================
       TAB 10 (BARU): PENGATURAN BALAI & SIAPKERJA
       =================================================== --}}
  <section id="view-pengaturan" class="view-section">
    <div class="panel brutal-box">
      <div class="panel-title">
        <div>
          <h3>Konfigurasi Sistem SI-VOKASI &amp; Integrasi SIAPkerja</h3>
          <p style="font-size:12px; color:#475569; margin-top:2px;">Pengaturan koneksi API pusat, sinkronisasi master data, dan preferensi balai.</p>
        </div>
        <span class="tag-solid">Sistem V2.4</span>
      </div>

      <div class="cards-grid-3">
        <div class="workshop-card brutal-box-sm">
          <div class="workshop-card-top">
            <h4>Integrasi SIAPkerja API</h4>
            <span class="pill pill-green">Online</span>
          </div>
          <div class="workshop-meta" style="margin: 10px 0;">
            <div>Endpoint: <code>https://api.siapkerja.kemnaker.go.id/v2</code></div>
            <div>Sinkronisasi Terakhir: <strong>Hari ini, 08:30 WIB</strong></div>
            <div>Status Token: <strong>Valid (29 Hari Tersisa)</strong></div>
          </div>
          <button class="btn btn-sm btn-primary" onclick="syncSiapKerja()">🔄 Sinkronisasi Sekarang</button>
        </div>

        <div class="workshop-card brutal-box-sm">
          <div class="workshop-card-top">
            <h4>Basis Data &amp; Cadangan (Backup)</h4>
            <span class="pill pill-blue">SQLite / MySQL</span>
          </div>
          <div class="workshop-meta" style="margin: 10px 0;">
            <div>Ukuran Database: <strong>14.2 MB</strong></div>
            <div>Penyimpanan Media: <strong>Lokal / Storage</strong></div>
            <div>Jadwal Auto-Backup: <strong>Harian (23:00)</strong></div>
          </div>
          <div style="display:flex; gap:6px; flex-wrap:wrap;">
            <button class="btn btn-sm btn-yellow" onclick="downloadBackup()">💾 Buat Cadangan (Backup)</button>
            <button class="btn btn-sm btn-primary" onclick="triggerImportDb()">📥 Impor Cadangan (JSON)</button>
            <input type="file" id="fileImportDb" accept=".json" style="display:none;" />
          </div>
        </div>

        <div class="workshop-card brutal-box-sm">
          <div class="workshop-card-top">
            <h4>Identitas Unit Pelaksana Teknis</h4>
            <span class="pill pill-green">Terverifikasi</span>
          </div>
          <div class="workshop-meta" style="margin: 10px 0;">
            <div>Nama Balai: <strong>BBPVP Makassar</strong></div>
            <div>Kode Satker: <strong>524109</strong></div>
            <div>Tahun Anggaran: <strong>2026</strong></div>
          </div>
          <button class="btn btn-sm" onclick="showToast('Pengaturan Satker berhasil diperbarui.')">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </section>

@endsection

@push('scripts')
<script>
  // Data chart dari server → diteruskan ke JS
  window.SIVOKASI_CHART_DATA = @json($chartData);
</script>
@endpush
