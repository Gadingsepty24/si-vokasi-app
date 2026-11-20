<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'SI-VOKASI BBPVP') — Portal Admin & Operasional Kemnaker RI</title>

  {{-- CSS Utama --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  @stack('styles')
</head>
<body>

  {{-- ===================================================
       SIDEBAR NAVIGASI
       =================================================== --}}
  <aside class="sidebar brutal-box">
    <div class="brand">
      <div class="brand-logo">KMN</div>
      <div class="brand-text">
        <h2>SI-VOKASI</h2>
        <span class="brand-badge">BBPVP MAKASSAR</span>
      </div>
    </div>

    {{-- KELOMPOK 1: OPERASIONAL PELATIHAN --}}
    <div class="sidebar-section-label">OPERASIONAL VOKASI</div>
   <ul class="nav-list" id="navMenu">
  {{-- 1. Dashboard --}}
  <li class="nav-item active" data-tab="dashboard">
    <button><span>📊 Dashboard Utama</span> <span class="nav-count">KPI</span></button>
  </li>

  {{-- 2. Peserta & Alumni (dipindah ke atas) --}}
  <li class="nav-item" data-tab="peserta">
    <button><span>🎓 Peserta &amp; Alumni</span> <span class="nav-count" id="navCountAlumni">4</span></button>
  </li>

  {{-- 3. Program Pelatihan (dipindah ke bawah) --}}
  <li class="nav-item" data-tab="pelatihan">
    <button><span>📚 Program Pelatihan</span> <span class="nav-count" id="navCountPrograms">5</span></button>
  </li>

  {{-- 4. Sertifikasi BNSP --}}
  <li class="nav-item" data-tab="sertifikasi">
    <button><span>🏅 Sertifikasi BNSP</span> <span class="nav-count" id="navCountUjk">3</span></button>
  </li>

  {{-- 5. Mitra Industri DUDI --}}
  <li class="nav-item" data-tab="industri">
    <button><span>🏢 Mitra Industri (DUDI)</span> <span class="nav-count" id="navCountDudi">6</span></button>
  </li>

  {{-- 6. Sarpras & Workshop --}}
  <li class="nav-item" data-tab="workshop">
    <button><span>🔧 Sarpras &amp; Workshop</span> <span class="nav-count" id="navCountWorkshop">6</span></button>
  </li>
</ul>

    {{-- KELOMPOK 2: ADMINISTRASI & SISTEM (FITUR ADMIN) --}}
    <div class="sidebar-section-label" style="margin-top: 10px;">PANEL KHUSUS ADMIN</div>
    <ul class="nav-list" id="navAdminMenu">
      <li class="nav-item" data-tab="users">
        <button><span>👥 Kelola Pengguna</span> <span class="nav-count nav-count-admin" id="navCountUsers">6</span></button>
      </li>
      <li class="nav-item" data-tab="laporan">
        <button><span>📑 Rekap &amp; Laporan</span> <span class="nav-count nav-count-admin">EXPORT</span></button>
      </li>
      <li class="nav-item" data-tab="logs">
        <button><span>📝 Audit Log Aktivitas</span> <span class="nav-count nav-count-admin" id="navCountLogs">7</span></button>
      </li>
      <li class="nav-item" data-tab="pengaturan">
        <button><span>⚙️ Pengaturan Balai</span> <span class="nav-count nav-count-admin">SYS</span></button>
      </li>
    </ul>

    <div class="sidebar-footer">
      <div class="admin-profile-box brutal-box-sm">
        <div class="admin-avatar">GS</div>
        <div class="admin-info">
          <div class="admin-name">Gading Septy</div>
          <div class="admin-role">Super Administrator</div>
        </div>
      </div>
      <div><span class="sync-dot"></span> SIAPkerja API: <strong>Terhubung</strong></div>
      <div>TA {{ date('Y') }} &bull; Hak Akses: Root/Admin</div>
    </div>
  </aside>

  {{-- ===================================================
       KONTEN UTAMA
       =================================================== --}}
  <main class="main">

    {{-- Topbar --}}
    <header class="topbar brutal-box">
      <div class="page-title">
        <div style="display:flex; align-items:center; gap:8px;">
          <h1 id="headerTitle">@yield('page-title', 'Dashboard Eksekutif — BBPVP Makassar')</h1>
          <span class="tag-role">ADMIN MODE</span>
        </div>
        <p id="headerSubtitle">@yield('page-subtitle', 'Monitoring Pelatihan Vokasi, Sertifikasi BNSP &amp; Penyerapan DUDI')</p>
      </div>
      <div class="topbar-actions">
        <input type="text" id="globalSearch" class="search-input" placeholder="Cari data di seluruh modul..." />
        
        <div class="quick-admin-actions">
          <button class="btn btn-yellow" id="btnOpenExportModal">
            📥 Pusat Unduh / Ekspor
          </button>
          
          <div class="dropdown-container">
            <button class="btn btn-primary" id="btnQuickAdd">
              ⚡ + Tambah Data Cepat ▾
            </button>
            <div class="dropdown-menu brutal-box" id="quickAddMenu">
              <button onclick="openModal('modalProgram')">📚 Buka Paket Pelatihan</button>
              <button onclick="openModal('modalAlumni')">🎓 Tambah Peserta / Alumni</button>
              <button onclick="openModal('modalUjk')">🏅 Buat Jadwal UJK</button>
              <button onclick="openModal('modalDudi')">🏢 Tambah Mitra Industri</button>
              <button onclick="openModal('modalWorkshop')">🔧 Tambah Bengkel / Lab</button>
              <hr style="border: 1px dashed var(--ink); margin: 4px 0;">
              <button onclick="openModal('modalUser')">👥 Tambah Pengguna Admin</button>
            </div>
          </div>
        </div>
      </div>
    </header>

    {{-- Notifikasi Session Flash Laravel jika ada --}}
    @if(session('toast'))
      <div class="alert-box brutal-box bg-yellow" id="sessionToast">
        <span>📢 {{ session('toast') }}</span>
        <button class="btn btn-sm" onclick="this.parentElement.remove()">X</button>
      </div>
    @endif

    {{-- Konten dinamis tiap halaman --}}
    @yield('content')

  </main>

  {{-- ===================================================
       MODAL 1: TAMBAH PAKET PELATIHAN
       =================================================== --}}
  <div class="modal-overlay" id="modalProgram">
    <div class="modal-box brutal-box">
      <div class="panel-title">
        <h3>Buka Paket Pelatihan Baru (PBK / TMT / Boarding)</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalProgram')">Tutup X</button>
      </div>
      <form id="formNewProgram" class="form-grid" action="{{ route('programs.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Kode Angkatan</label>
          <input type="text" id="inKode" name="kode" value="PBK-26-049" required />
        </div>
        <div class="form-group">
          <label>Jenis Program</label>
          <select id="inJenis" name="jenis">
            <option value="PBK">PBK (Reguler)</option>
            <option value="TMT">TMT (Mitra DUDI)</option>
            <option value="Boarding">Boarding (Asrama)</option>
          </select>
        </div>
        <div class="form-group full">
          <label>Nama Program Pelatihan</label>
          <input type="text" id="inNama" name="nama" placeholder="Contoh: Teknisi Instalasi Panel Surya" required />
        </div>
        <div class="form-group">
          <label>Kejuruan</label>
          <select id="inKejuruan" name="kejuruan">
            <option value="TIK">TIK</option>
            <option value="Otomotif">Otomotif</option>
            <option value="Teknik Las">Teknik Las</option>
            <option value="HVAC">HVAC</option>
            <option value="Fashion Tech">Fashion Tech</option>
          </select>
        </div>
        <div class="form-group">
          <label>Instruktur Utama</label>
          <input type="text" id="inInstruktur" name="instruktur" placeholder="Nama Instruktur" required />
        </div>
        <div class="form-group">
          <label>Target Jam Pelajaran (JP)</label>
          <input type="number" id="inTargetJp" name="jp_max" value="240" min="40" max="600" required />
        </div>
        <div class="form-group">
          <label>Kuota Peserta</label>
          <input type="number" id="inPeserta" name="kuota_peserta" value="16" min="8" max="40" required />
        </div>
        <div class="form-group full modal-actions">
          <button type="button" class="btn" onclick="closeModal('modalProgram')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan &amp; Aktifkan Paket</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ===================================================
       MODAL 2: TAMBAH PESERTA / ALUMNI BARU
       =================================================== --}}
  <div class="modal-overlay" id="modalAlumni">
    <div class="modal-box brutal-box">
      <div class="panel-title">
        <h3>Pendaftaran Siswa / Tracer Alumni Baru</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalAlumni')">Tutup X</button>
      </div>
      <form id="formNewAlumni" class="form-grid" action="{{ route('alumni.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>NIK / Nomor Induk Siswa</label>
          <input type="text" id="inAlumniNik" name="nik" placeholder="3275-0099" required />
        </div>
        <div class="form-group">
          <label>Nama Lengkap Peserta</label>
          <input type="text" id="inAlumniNama" name="nama" placeholder="Nama lengkap..." required />
        </div>
        <div class="form-group">
          <label>Kejuruan Vokasi</label>
          <select id="inAlumniKejuruan" name="kejuruan">
            <option value="TIK">TIK</option>
            <option value="Otomotif">Otomotif</option>
            <option value="Teknik Las">Teknik Las</option>
            <option value="HVAC">HVAC</option>
            <option value="Fashion Tech">Fashion Tech</option>
          </select>
        </div>
        <div class="form-group">
          <label>Status Sertifikasi BNSP</label>
          <select id="inAlumniSertifikat" name="status_sertifikat">
            <option value="Kompeten (BNSP)">Kompeten (BNSP)</option>
            <option value="Menunggu UJK">Menunggu UJK</option>
            <option value="Belum Kompeten">Belum Kompeten</option>
          </select>
        </div>
        <div class="form-group">
          <label>Status Penempatan Kerja (Tracer)</label>
          <select id="inAlumniPenempatan" name="status_penempatan">
            <option value="Terserap Industri">Terserap Industri</option>
            <option value="Wirausaha">Wirausaha</option>
            <option value="Proses Rekrutmen">Proses Rekrutmen</option>
            <option value="Sedang Pelatihan">Sedang Pelatihan</option>
          </select>
        </div>
        <div class="form-group">
          <label>Detail Penempatan / Nama Perusahaan</label>
          <input type="text" id="inAlumniDetail" name="detail_penempatan" placeholder="Cth: PT Astra Honda Motor" />
        </div>
        <div class="form-group full modal-actions">
          <button type="button" class="btn" onclick="closeModal('modalAlumni')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Data Peserta</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ===================================================
       MODAL 3: TAMBAH JADWAL UJK
       =================================================== --}}
  <div class="modal-overlay" id="modalUjk">
    <div class="modal-box brutal-box">
      <div class="panel-title">
        <h3>Jadwalkan Uji Kompetensi (UJK) BNSP Baru</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalUjk')">Tutup X</button>
      </div>
      <form id="formNewUjk" class="form-grid" action="{{ route('ujk.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Kode Jadwal / TUK</label>
          <input type="text" id="inUjkKode" name="kode_jadwal" value="UJK-26-15" required />
        </div>
        <div class="form-group">
          <label>Skema Sertifikasi BNSP</label>
          <input type="text" id="inUjkSkema" name="skema" placeholder="Cth: Welder SMAW 3G" required />
        </div>
        <div class="form-group">
          <label>Tanggal Pelaksanaan</label>
          <input type="date" id="inUjkTanggal" name="tanggal_ujk" value="{{ date('Y-m-d') }}" required />
        </div>
        <div class="form-group">
          <label>Asesor Penguji (LSP)</label>
          <input type="text" id="inUjkAsesor" name="asesor" placeholder="Nama Asesor..." required />
        </div>
        <div class="form-group">
          <label>Jumlah Kuota Asesi (Peserta)</label>
          <input type="number" id="inUjkAsesi" name="jumlah_asesi" value="16" min="1" max="50" required />
        </div>
        <div class="form-group">
          <label>Status Pelaksanaan</label>
          <select id="inUjkStatus" name="status">
            <option value="Terjadwal">Terjadwal</option>
            <option value="Sedang Berlangsung">Sedang Berlangsung</option>
            <option value="Selesai (100% Kompeten)">Selesai (100% Kompeten)</option>
          </select>
        </div>
        <div class="form-group full modal-actions">
          <button type="button" class="btn" onclick="closeModal('modalUjk')">Batal</button>
          <button type="submit" class="btn btn-primary">Daftarkan Jadwal UJK</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ===================================================
       MODAL: UPDATE / EDIT JADWAL UJK
       =================================================== --}}
  <div class="modal-overlay" id="modalEditUjk">
    <div class="modal-box brutal-box">
      <div class="panel-title">
        <h3>Update Jadwal Uji Kompetensi (UJK)</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalEditUjk')">Tutup X</button>
      </div>
      <form id="formEditUjk" class="form-grid">
        <input type="hidden" id="editUjkIndex" />
        <div class="form-group">
          <label>ID Jadwal / TUK</label>
          <input type="text" id="editUjkKode" readonly style="background:#E2E8F0; font-family:monospace; font-weight:bold;" />
        </div>
        <div class="form-group">
          <label>Skema Sertifikasi BNSP</label>
          <input type="text" id="editUjkSkema" required />
        </div>
        <div class="form-group">
          <label>Tanggal Pelaksanaan</label>
          <input type="text" id="editUjkTanggal" placeholder="Contoh: 28 Nov 2026" required />
        </div>
        <div class="form-group">
          <label>Asesor Penguji (LSP P2)</label>
          <input type="text" id="editUjkAsesor" required />
        </div>
        <div class="form-group">
          <label>Jumlah Kuota Asesi (Peserta)</label>
          <input type="number" id="editUjkAsesi" min="1" max="50" required />
        </div>
        <div class="form-group">
          <label>Status Pelaksanaan</label>
          <select id="editUjkStatus">
            <option value="Terjadwal">Terjadwal</option>
            <option value="Sedang Berlangsung">Sedang Berlangsung</option>
            <option value="Selesai (100% Kompeten)">Selesai (100% Kompeten)</option>
          </select>
        </div>
        <div class="form-group full modal-actions">
          <button type="button" class="btn" onclick="closeModal('modalEditUjk')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan Jadwal</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ===================================================
       MODAL 4: TAMBAH MITRA INDUSTRI DUDI
       =================================================== --}}
  <div class="modal-overlay" id="modalDudi">
    <div class="modal-box brutal-box">
      <div class="panel-title">
        <h3>Tambah Kerjasama Mitra Industri (DUDI)</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalDudi')">Tutup X</button>
      </div>
      <form id="formNewDudi" class="form-grid" action="{{ route('mitra.store') }}" method="POST">
        @csrf
        <div class="form-group full">
          <label>Nama Perusahaan / Korporasi</label>
          <input type="text" id="inDudiNama" name="nama" placeholder="Cth: PT Toyota Motor Manufacturing Indonesia" required />
        </div>
        <div class="form-group">
          <label>Sektor Industri</label>
          <input type="text" id="inDudiSektor" name="sektor" placeholder="Cth: Otomotif & Manufaktur" required />
        </div>
        <div class="form-group">
          <label>Masa Berlaku MoU</label>
          <input type="text" id="inDudiMou" name="masa_mou" placeholder="Aktif s.d 2028" required />
        </div>
        <div class="form-group full">
          <label>Komitmen Kuota Rekrutmen / Pemagangan</label>
          <input type="text" id="inDudiKuota" name="kuota_rekrutmen" placeholder="Cth: 25 Teknisi / Batch" required />
        </div>
        <div class="form-group full modal-actions">
          <button type="button" class="btn" onclick="closeModal('modalDudi')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Kemitraan DUDI</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ===================================================
       MODAL 5: TAMBAH WORKSHOP / BENGKEL
       =================================================== --}}
  <div class="modal-overlay" id="modalWorkshop">
    <div class="modal-box brutal-box">
      <div class="panel-title">
        <h3>Registrasi Ruang Bengkel / Laboratorium Vokasi</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalWorkshop')">Tutup X</button>
      </div>
      <form id="formNewWorkshop" class="form-grid" action="{{ route('workshops.store') }}" method="POST">
        @csrf
        <div class="form-group full">
          <label>Nama Ruang Workshop / Lab</label>
          <input type="text" id="inWsNama" name="nama" placeholder="Cth: Workshop PLC & Otomasi Industri" required />
        </div>
        <div class="form-group">
          <label>Kejuruan Terkait</label>
          <select id="inWsKejuruan" name="kejuruan">
            <option value="TIK">TIK</option>
            <option value="Otomotif">Otomotif</option>
            <option value="Teknik Las">Teknik Las</option>
            <option value="HVAC">HVAC</option>
            <option value="Fashion Tech">Fashion Tech</option>
            <option value="Manufaktur">Manufaktur</option>
          </select>
        </div>
        <div class="form-group">
          <label>Kapasitas & Fasilitas Unit</label>
          <input type="text" id="inWsKapasitas" name="kapasitas" placeholder="Cth: 16 Trainer PLC" required />
        </div>
        <div class="form-group">
          <label>Status Kesiapan</label>
          <select id="inWsStatus" name="status">
            <option value="Tersedia">Tersedia (Ready)</option>
            <option value="Digunakan">Digunakan (Active)</option>
            <option value="Maintenance">Maintenance (Perbaikan)</option>
          </select>
        </div>
        <div class="form-group full modal-actions">
          <button type="button" class="btn" onclick="closeModal('modalWorkshop')">Batal</button>
          <button type="submit" class="btn btn-primary">Daftarkan Sarpras Bengkel</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ===================================================
       MODAL 6: TAMBAH PENGGUNA BARU (ADMIN & INSTRUKTUR)
       =================================================== --}}
  <div class="modal-overlay" id="modalUser">
    <div class="modal-box brutal-box">
      <div class="panel-title">
        <h3>Tambah Akun Pengguna / Staf Balai</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalUser')">Tutup X</button>
      </div>
      <form id="formNewUser" class="form-grid">
        <div class="form-group">
          <label>Nama Lengkap Staf / Operator</label>
          <input type="text" id="inUserNama" placeholder="Nama dan Gelar..." required />
        </div>
        <div class="form-group">
          <label>Alamat Email Resmi</label>
          <input type="email" id="inUserEmail" placeholder="nama@kemnaker.go.id" required />
        </div>
        <div class="form-group">
          <label>Peran / Hak Akses (Role)</label>
          <select id="inUserRole">
            <option value="Super Admin">Super Admin (Akses Penuh)</option>
            <option value="Operator Balai">Operator Balai (Input & Edit Data)</option>
            <option value="Instruktur">Instruktur Pelatihan (Nilai & Absen)</option>
            <option value="Asesor LSP">Asesor LSP (Verifikasi UJK)</option>
          </select>
        </div>
        <div class="form-group">
          <label>Penugasan Kejuruan</label>
          <select id="inUserKejuruan">
            <option value="Semua Kejuruan">Semua Kejuruan</option>
            <option value="TIK">TIK</option>
            <option value="Otomotif">Otomotif</option>
            <option value="Teknik Las">Teknik Las</option>
            <option value="HVAC">HVAC</option>
            <option value="Fashion Tech">Fashion Tech</option>
          </select>
        </div>
        <div class="form-group full modal-actions">
          <button type="button" class="btn" onclick="closeModal('modalUser')">Batal</button>
          <button type="submit" class="btn btn-primary">Buat Akun &amp; Beri Izin</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ===================================================
       MODAL 7: PUSAT EKSPOR LAPORAN
       =================================================== --}}
  <div class="modal-overlay" id="modalExport">
    <div class="modal-box brutal-box" style="max-width: 580px;">
      <div class="panel-title">
        <h3>Pusat Unduh &amp; Ekspor Laporan Resmi</h3>
        <button class="btn btn-sm btn-red" onclick="closeModal('modalExport')">Tutup X</button>
      </div>
      <div style="padding: 10px 0; font-size:13px; color:#334155;">
        Pilih jenis laporan resmi Kemnaker RI untuk diunduh dalam format data terstruktur:
      </div>
      <div class="report-export-options">
        <div class="report-card brutal-box-sm">
          <div>
            <strong>1. Laporan Pelaksanaan Paket PBK/TMT</strong>
            <p style="font-size:11.5px; color:#64748B;">Rekap jam pelajaran, instruktur, dan progres penyelesaian pelatihan.</p>
          </div>
          <button class="btn btn-sm btn-primary" onclick="exportData('programs')">Unduh CSV</button>
        </div>
        <div class="report-card brutal-box-sm">
          <div>
            <strong>2. Laporan Penyerapan Kerja Alumni (Tracer Study)</strong>
            <p style="font-size:11.5px; color:#64748B;">Data serapan industri, wirausaha, dan sebaran NIK alumni bersertifikat.</p>
          </div>
          <button class="btn btn-sm btn-yellow" onclick="exportData('alumni')">Unduh CSV</button>
        </div>
        <div class="report-card brutal-box-sm">
          <div>
            <strong>3. Berita Acara &amp; Rekap Uji Kompetensi BNSP</strong>
            <p style="font-size:11.5px; color:#64748B;">Daftar asesi lulus, nama asesor, skema okupasi, dan sertifikasi terbit.</p>
          </div>
          <button class="btn btn-sm btn-green" onclick="exportData('ujk')">Unduh CSV</button>
        </div>
        <div class="report-card brutal-box-sm">
          <div>
            <strong>4. Buku Profil Kemitraan DUDI &amp; Sarpras Balai</strong>
            <p style="font-size:11.5px; color:#64748B;">Daftar MoU perusahaan, kuota rekrutmen, dan kondisi bengkel kerja.</p>
          </div>
          <button class="btn btn-sm" onclick="exportData('dudi')">Unduh CSV</button>
        </div>
      </div>
      <div style="margin-top:16px; text-align:right;">
        <button class="btn" onclick="closeModal('modalExport')">Selesai</button>
      </div>
    </div>
  </div>

  {{-- Toast Notification --}}
  <div class="toast-container" id="toastContainer"></div>

  {{-- JavaScript Utama --}}
  <script src="{{ asset('js/app.js') }}"></script>

  @stack('scripts')
</body>
</html>
