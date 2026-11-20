/**
 * SI-VOKASI BBPVP — JavaScript Utama (Versi Admin Lengkap)
 * Kemnaker RI | Portal Operasional & Administrator Balai
 */

// =====================================================
// STATE APLIKASI BBPVP
// =====================================================
const state = {
  balai: 'BBPVP Makassar',
  activeTab: 'dashboard',
  chartMode: 'kelulusan',
  searchQuery: '',

  programs: [
    { id: 1, kode: 'PBK-26-041', nama: 'Junior Web Developer', jenis: 'PBK', kejuruan: 'TIK', instruktur: 'Ahmad Fauzi, S.Kom', peserta: 16, jpNow: 240, jpMax: 260, status: 'Persiapan UJK' },
    { id: 2, kode: 'PBK-26-042', nama: 'Servis Sepeda Motor Listrik', jenis: 'Boarding', kejuruan: 'Otomotif', instruktur: 'Budi Santoso, S.T.', peserta: 16, jpNow: 180, jpMax: 240, status: 'Aktif Berjalan' },
    { id: 3, kode: 'TMT-26-019', nama: 'Plate Welder 3G-4G SMAW', jenis: 'TMT', kejuruan: 'Teknik Las', instruktur: 'Rudi Hartono, S.Pd', peserta: 16, jpNow: 300, jpMax: 320, status: 'Persiapan UJK' },
    { id: 4, kode: 'PBK-26-045', nama: 'Desain Busana & Garmen', jenis: 'PBK', kejuruan: 'Fashion Tech', instruktur: 'Siti Rahmawati, M.Pd', peserta: 16, jpNow: 120, jpMax: 280, status: 'Aktif Berjalan' },
    { id: 5, kode: 'PBK-26-046', nama: 'Teknisi Tata Udara Komersial', jenis: 'Boarding', kejuruan: 'HVAC', instruktur: 'Dedi Kurniawan, S.T.', peserta: 16, jpNow: 240, jpMax: 240, status: 'Selesai' },
  ],

  alumni: [
    { id: '3275-0019', nama: 'Bagus Pratama', kejuruan: 'TIK', sertifikat: 'Kompeten (BNSP)', status: 'Terserap Industri', detail: 'PT Solusi Digital Nusantara' },
    { id: '3275-0024', nama: 'Nadia Safitri', kejuruan: 'Fashion Tech', sertifikat: 'Kompeten (BNSP)', status: 'Wirausaha', detail: 'Usaha Konveksi Mandiri' },
    { id: '3275-0031', nama: 'Rizky Ramadhan', kejuruan: 'Teknik Las', sertifikat: 'Kompeten (BNSP)', status: 'Proses Rekrutmen', detail: 'Interview PT PAL Mitra' },
    { id: '3275-0048', nama: 'Dimas Wijaya', kejuruan: 'Otomotif', sertifikat: 'Menunggu UJK', status: 'Sedang Pelatihan', detail: 'Angkatan PBK-26-042' },
  ],

  ujk: [
    { id: 'UJK-26-11', skema: 'Junior Web Developer', tanggal: '24 Nov 2026', asesor: 'Ir. Hendra Wijaya', asesi: 16, status: 'Terjadwal' },
    { id: 'UJK-26-12', skema: 'Welder SMAW 3G', tanggal: '26 Nov 2026', asesor: 'Slamet Riyadi, M.T.', asesi: 16, status: 'Terjadwal' },
    { id: 'UJK-26-09', skema: 'Teknisi AC Split & Inverter', tanggal: '15 Nov 2026', asesor: 'Agus Salim, S.T.', asesi: 16, status: 'Selesai (100% Kompeten)' },
  ],

  dudi: [
    { id: 1, nama: 'PT Hyundai Motor Manufacturing', sektor: 'Otomotif & EV', mou: 'Aktif s.d 2028', kuota: '25 Teknisi / Batch' },
    { id: 2, nama: 'PT Telkom Akses Indonesia', sektor: 'TIK & Jaringan', mou: 'Aktif s.d 2027', kuota: '30 Teknisi Fiber' },
    { id: 3, nama: 'PT Komatsu Undercarriage', sektor: 'Teknik Las & Manufaktur', mou: 'Aktif s.d 2027', kuota: '20 Welder 3G-4G' },
    { id: 4, nama: 'PT Panasonic Manufacturing', sektor: 'Refrigerasi / HVAC', mou: 'Aktif s.d 2026', kuota: '15 Teknisi HVAC' },
    { id: 5, nama: 'PT Pan Brothers Tbk', sektor: 'Fashion & Garmen', mou: 'Aktif s.d 2028', kuota: '40 Operator Jahit' },
    { id: 6, nama: 'PT Krakatau Posco', sektor: 'Manufaktur Baja', mou: 'Aktif s.d 2027', kuota: '18 Teknisi Industri' },
  ],

  workshops: [
    { id: 1, nama: 'Lab Pemrograman & Cloud A', kejuruan: 'TIK', kapasitas: '20 PC Workstation', status: 'Digunakan' },
    { id: 2, nama: 'Bengkel Sepeda Motor Listrik', kejuruan: 'Otomotif', kapasitas: '16 Unit Lift', status: 'Digunakan' },
    { id: 3, nama: 'Workshop Welding Booth 1-16', kejuruan: 'Teknik Las', kapasitas: '16 Kabin Las', status: 'Digunakan' },
    { id: 4, nama: 'Lab CNC & Bubut Presisi', kejuruan: 'Manufaktur', kapasitas: '10 Mesin CNC', status: 'Tersedia' },
    { id: 5, nama: 'Workshop Tata Udara (HVAC)', kejuruan: 'HVAC', kapasitas: '12 Unit Trainer', status: 'Tersedia' },
    { id: 6, nama: 'Studio Jahit Industri & Pola', kejuruan: 'Fashion Tech', kapasitas: '24 Mesin High-Speed', status: 'Maintenance' },
  ],

  // DATA ADMIN & USERS
  users: [
    { id: 'ADM-001', nama: 'Gading Septy', email: 'gading.admin@kemnaker.go.id', role: 'Super Admin', kejuruan: 'Semua Kejuruan', status: 'Aktif' },
    { id: 'OPR-002', nama: 'Siti Fauziah, S.AP', email: 'siti.operator@bbpvp.id', role: 'Operator Balai', kejuruan: 'Semua Kejuruan', status: 'Aktif' },
    { id: 'INS-003', nama: 'Ahmad Fauzi, S.Kom', email: 'ahmad.fauzi@instruktur.id', role: 'Instruktur', kejuruan: 'TIK', status: 'Aktif' },
    { id: 'ASR-004', nama: 'Ir. Hendra Wijaya', email: 'hendra.lsp@bnsp.id', role: 'Asesor LSP', kejuruan: 'TIK', status: 'Aktif' },
  ],

  // AUDIT LOG AKTIVITAS ADMIN
  logs: [
    { waktu: '20 Nov 2026 08:31', user: 'Gading Septy', aksi: 'Login Super Admin', modul: 'Autentikasi', detail: 'Login via IP 127.0.0.1 (Sesi Balai: Bekasi)', status: 'Sukses' },
    { waktu: '20 Nov 2026 08:15', user: 'Siti Fauziah', aksi: 'Update Progres JP', modul: 'Pelatihan', detail: 'Menambah +20 JP untuk PBK-26-041', status: 'Sukses' },
    { waktu: '20 Nov 2026 07:50', user: 'Ir. Hendra', aksi: 'Verifikasi UJK', modul: 'Sertifikasi', detail: 'UJK-26-09 dinyatakan 100% Kompeten', status: 'Sukses' },
    { waktu: '19 Nov 2026 16:30', user: 'Gading Septy', aksi: 'Update Status WS', modul: 'Sarpras', detail: 'Studio Jahit diubah ke status Maintenance', status: 'Sukses' },
    { waktu: '19 Nov 2026 14:10', user: 'Ahmad Fauzi', aksi: 'Input Tracer Siswa', modul: 'Alumni', detail: 'Bagus Pratama (3275-0019) terserap industri', status: 'Sukses' },
    { waktu: '19 Nov 2026 10:00', user: 'Sistem API', aksi: 'Sinkronisasi Data', modul: 'SIAPkerja', detail: 'Sync otomatis 80 data peserta angkatan 2026', status: 'Sukses' },
  ],

  chartData: {
    kelulusan: [
      { label: 'TIK', val: 95 }, { label: 'Otomotif', val: 91 },
      { label: 'Las', val: 94 }, { label: 'HVAC', val: 89 },
      { label: 'Fashion', val: 93 },
    ],
    penyerapan: [
      { label: 'TIK', val: 84 }, { label: 'Otomotif', val: 81 },
      { label: 'Las', val: 88 }, { label: 'HVAC', val: 74 },
      { label: 'Fashion', val: 72 },
    ],
  },
};

// =====================================================
// UTILITAS & TOAST
// =====================================================

function showToast(msg) {
  const container = document.getElementById('toastContainer');
  if (!container) return;
  const el = document.createElement('div');
  el.className = 'toast';
  el.innerHTML = `<span>📢 ${msg}</span>`;
  container.appendChild(el);
  setTimeout(() => el.remove(), 3400);
}

function addLog(aksi, modul, detail) {
  const now = new Date();
  const timeStr = `${now.getDate()} Nov 2026 ${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
  state.logs.unshift({
    waktu: timeStr,
    user: 'Gading Septy (Super Admin)',
    aksi: aksi,
    modul: modul,
    detail: detail,
    status: 'Sukses'
  });
  renderLogs();
}

function statusPillClass(status) {
  if (!status) return 'pill-blue';
  if (status.includes('Aktif') || status.includes('Selesai') ||
    status.includes('Terserap') || status.includes('Tersedia')) return 'pill-green';
  if (status.includes('Persiapan') || status.includes('Terjadwal') ||
    status.includes('Proses') || status.includes('Digunakan')) return 'pill-amber';
  if (status.includes('Maintenance') || status.includes('Nonaktif')) return 'pill-red';
  return 'pill-blue';
}

function badgeRoleClass(role) {
  if (role === 'Super Admin') return 'badge-role badge-role-admin';
  if (role === 'Operator Balai') return 'badge-role badge-role-operator';
  if (role === 'Instruktur') return 'badge-role badge-role-instruktur';
  return 'badge-role badge-role-asesor';
}

// =====================================================
// MANAJEMEN TAB & MODAL
// =====================================================

window.switchTab = function (tabName) {
  state.activeTab = tabName;
  document.querySelectorAll('.nav-item').forEach(item => {
    item.classList.toggle('active', item.dataset.tab === tabName);
  });
  document.querySelectorAll('.view-section').forEach(sec => {
    sec.classList.toggle('active', sec.id === `view-${tabName}`);
  });
};

window.openModal = function (modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('open');
    const qMenu = document.getElementById('quickAddMenu');
    if (qMenu) qMenu.classList.remove('show');
  }
};

window.closeModal = function (modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.classList.remove('open');
};

// =====================================================
// RENDER FUNCTIONS
// =====================================================

function updateCounts() {
  const setEl = (id, val) => {
    const el = document.getElementById(id);
    if (el) el.textContent = val;
  };
  setEl('navCountAlumni', 1); // Nomor urut 1 (Peserta & Alumni)
  setEl('navCountPrograms', 2); // Nomor urut 2 (Program Pelatihan)
  setEl('navCountUjk', 3); // Nomor urut 3 (Sertifikasi BNSP)
  setEl('navCountDudi', 4); // Nomor urut 4 (Mitra Industri DUDI)
  setEl('navCountWorkshop', 5); // Nomor urut 5 (Sarpras & Workshop)
  setEl('navCountUsers', 6); // Nomor urut 6 (Kelola Pengguna)
}

function renderKPIs() {
  const totalPeserta = state.programs.reduce((acc, p) => acc + p.peserta, 0);
  const paketAktif = state.programs.filter(p => p.status !== 'Selesai').length;
  const wsReady = state.workshops.filter(w => w.status !== 'Maintenance').length;

  const kpiEl = document.getElementById('kpiContainer');
  if (!kpiEl) return;
  kpiEl.innerHTML = `
    <div class="kpi-card brutal-box bg-navy">
      <div class="kpi-header"><span class="kpi-label">Peserta Terdaftar</span><span class="kpi-badge">SISWA</span></div>
      <div class="kpi-value">${totalPeserta}</div>
      <div class="kpi-sub">${paketAktif} Paket Pelatihan Aktif</div>
    </div>
    <div class="kpi-card brutal-box bg-blue">
      <div class="kpi-header"><span class="kpi-label">Tingkat Kompeten</span><span class="kpi-badge">BNSP</span></div>
      <div class="kpi-value">92,4%</div>
      <div class="kpi-sub">${state.ujk.length} Jadwal UJK Terdaftar</div>
    </div>
    <div class="kpi-card brutal-box bg-yellow">
      <div class="kpi-header"><span class="kpi-label">Mitra Industri</span><span class="kpi-badge">DUDI</span></div>
      <div class="kpi-value">${state.dudi.length}</div>
      <div class="kpi-sub">78,6% Alumni Terserap</div>
    </div>
    <div class="kpi-card brutal-box">
      <div class="kpi-header"><span class="kpi-label">Kesiapan Workshop</span><span class="kpi-badge">SARPRAS</span></div>
      <div class="kpi-value">${wsReady}/${state.workshops.length}</div>
      <div class="kpi-sub">Unit Bengkel Siap Pakai</div>
    </div>
  `;
}

function renderChart() {
  const data = state.chartData[state.chartMode];
  const container = document.getElementById('chartContainer');
  if (!container) return;

  container.innerHTML = data.map(item => `
    <div class="bar-col">
      <div class="bar-rect" style="height: ${item.val}%;" title="${item.label}: ${item.val}%">
        <span class="bar-val">${item.val}%</span>
      </div>
      <span class="bar-label">${item.label}</span>
    </div>
  `).join('');

  document.querySelectorAll('[data-chart]').forEach(btn => {
    btn.className = btn.dataset.chart === state.chartMode ? 'btn btn-sm btn-navy' : 'btn btn-sm';
  });
}

function renderMiniUjk() {
  const el = document.getElementById('miniUjkList');
  if (!el) return;
  el.innerHTML = state.ujk.map((u, idx) => `
    <div class="brutal-box-sm" style="padding:12px; display:flex; justify-content:space-between; align-items:center; gap:8px;">
      <div style="flex:1;">
        <div style="font-size:13px; font-weight:800;">${u.skema}</div>
        <div style="font-size:11.5px; color:#334155; font-weight:600; margin-top:2px;">
          📅 <strong>${u.tanggal}</strong> &bull; 👥 ${u.asesi} Asesi &bull; 👤 ${u.asesor || 'Asesor LSP'}
        </div>
      </div>
      <div style="display:flex; align-items:center; gap:6px; flex-shrink:0;">
        <span class="pill ${statusPillClass(u.status)}">${u.status.split(' ')[0]}</span>
        <button class="btn btn-sm btn-yellow" onclick="openEditUjkModal(${idx})" title="Update Jadwal UJK">✏️ Update</button>
      </div>
    </div>
  `).join('');
}

function getFilteredPrograms() {
  const q = state.searchQuery.toLowerCase();
  const elJenis = document.getElementById('filterJenis');
  const elKej = document.getElementById('filterKejuruan');
  const elStat = document.getElementById('filterStatus');
  const fJenis = elJenis ? elJenis.value : 'ALL';
  const fKejuruan = elKej ? elKej.value : 'ALL';
  const fStatus = elStat ? elStat.value : 'ALL';

  return state.programs.filter(p => {
    const matchQ = !q || p.kode.toLowerCase().includes(q) || p.nama.toLowerCase().includes(q) ||
      p.kejuruan.toLowerCase().includes(q) || p.instruktur.toLowerCase().includes(q);
    const matchJenis = fJenis === 'ALL' || p.jenis === fJenis;
    const matchKej = fKejuruan === 'ALL' || p.kejuruan === fKejuruan;
    const matchStat = fStatus === 'ALL' || p.status === fStatus;
    return matchQ && matchJenis && matchKej && matchStat;
  });
}

function renderPrograms() {
  const list = getFilteredPrograms();
  const dashRows = document.getElementById('dashboardProgramRows');
  const fullRows = document.getElementById('fullProgramRows');

  const buildProgressCell = p => {
    const pct = Math.min(100, Math.round((p.jpNow / p.jpMax) * 100));
    return `<div class="progress-mini"><div class="progress-mini-fill" style="width:${pct}%"></div></div>
            <span>${p.jpNow}/${p.jpMax} JP</span>`;
  };

  if (dashRows) {
    dashRows.innerHTML = list.slice(0, 4).map(p => `
      <tr>
        <td><span class="code-mono">${p.kode}</span></td>
        <td><strong>${p.nama}</strong></td>
        <td>${p.jenis}</td>
        <td>${buildProgressCell(p)}</td>
        <td><span class="pill ${statusPillClass(p.status)}">${p.status}</span></td>
        <td>
          <button class="btn btn-sm btn-primary" onclick="addJp(${p.id})" ${p.jpNow >= p.jpMax ? 'disabled' : ''}>+20 JP</button>
        </td>
      </tr>
    `).join('') || `<tr><td colspan="6" style="text-align:center;">Tidak ada data yang cocok.</td></tr>`;
  }

  if (fullRows) {
    fullRows.innerHTML = list.map(p => `
      <tr>
        <td><span class="code-mono">${p.kode}</span></td>
        <td><strong>${p.nama}</strong></td>
        <td>${p.jenis}</td>
        <td>${p.kejuruan}</td>
        <td>${p.instruktur}</td>
        <td>${p.peserta} Org</td>
        <td>${buildProgressCell(p)}</td>
        <td><span class="pill ${statusPillClass(p.status)}">${p.status}</span></td>
        <td style="white-space:nowrap;">
          <button class="btn btn-sm btn-primary" onclick="addJp(${p.id})" ${p.jpNow >= p.jpMax ? 'disabled' : ''} title="Tambah JP">+20 JP</button>
          <button class="btn btn-sm btn-yellow"  onclick="editProgramStatus(${p.id})" title="Ubah Status">Status</button>
          <button class="btn btn-sm btn-red"     onclick="deleteProgram(${p.id})" title="Hapus Paket">Hapus</button>
        </td>
      </tr>
    `).join('') || `<tr><td colspan="9" style="text-align:center;">Tidak ada paket pelatihan sesuai filter.</td></tr>`;
  }
}

function renderAlumni() {
  const elFStat = document.getElementById('filterAlumniStatus');
  const fStat = elFStat ? elFStat.value : 'ALL';
  const q = state.searchQuery.toLowerCase();
  const filtered = state.alumni.filter(a => {
    const mStat = fStat === 'ALL' || a.status === fStat;
    const mQ = !q || a.nama.toLowerCase().includes(q) || a.kejuruan.toLowerCase().includes(q) || a.id.toLowerCase().includes(q);
    return mStat && mQ;
  });

  const el = document.getElementById('alumniRows');
  if (!el) return;
  el.innerHTML = filtered.map((a, idx) => `
    <tr>
      <td><span class="code-mono">${a.id}</span></td>
      <td><strong>${a.nama}</strong></td>
      <td>${a.kejuruan}</td>
      <td>${a.sertifikat}</td>
      <td>
        <span class="pill ${statusPillClass(a.status)}">${a.status}</span>
        <div style="font-size:11px; color:#334155; margin-top:3px;">${a.detail}</div>
      </td>
      <td style="white-space:nowrap;">
        <button class="btn btn-sm btn-yellow" onclick="cycleAlumniStatus(${idx})">Ubah Status</button>
        <button class="btn btn-sm btn-red" onclick="deleteAlumni('${a.id}')">Hapus</button>
      </td>
    </tr>
  `).join('') || `<tr><td colspan="6" style="text-align:center;">Tidak ada siswa/alumni yang cocok.</td></tr>`;
}

function renderUjk() {
  const el = document.getElementById('ujkRows');
  if (!el) return;
  el.innerHTML = state.ujk.map((u, idx) => `
    <tr>
      <td><span class="code-mono">${u.id}</span></td>
      <td><strong>${u.skema}</strong></td>
      <td>${u.tanggal}</td>
      <td>${u.asesor}</td>
      <td>${u.asesi} Asesi</td>
      <td><span class="pill ${statusPillClass(u.status)}">${u.status}</span></td>
      <td style="white-space:nowrap;">
        <button class="btn btn-sm btn-yellow" onclick="openEditUjkModal(${idx})">✏️ Update</button>
        <button class="btn btn-sm btn-green" onclick="completeUjk(${idx})" ${u.status.includes('Selesai') ? 'disabled' : ''}>Verifikasi Lulus</button>
        <button class="btn btn-sm btn-red" onclick="deleteUjk('${u.id}')">Hapus</button>
      </td>
    </tr>
  `).join('');
}

function renderDudi() {
  const el = document.getElementById('dudiCards');
  if (!el) return;
  el.innerHTML = state.dudi.map(d => `
    <div class="workshop-card brutal-box-sm">
      <div class="workshop-card-top">
        <h4>${d.nama}</h4>
        <span class="pill pill-green">MoU Aktif</span>
      </div>
      <div class="workshop-meta">
        <div>Bidang: <strong>${d.sektor}</strong></div>
        <div>Masa Berlaku: <strong>${d.mou}</strong></div>
        <div>Kebutuhan Rekrutmen: <strong>${d.kuota}</strong></div>
      </div>
      <div style="margin-top:10px; display:flex; gap:6px;">
        <button class="btn btn-sm btn-yellow" onclick="extendMou(${d.id})">Perpanjang MoU</button>
        <button class="btn btn-sm btn-red" onclick="deleteDudi(${d.id})">Hapus</button>
      </div>
    </div>
  `).join('');
}

function renderWorkshops() {
  const el = document.getElementById('workshopCards');
  if (!el) return;
  el.innerHTML = state.workshops.map(w => `
    <div class="workshop-card brutal-box-sm">
      <div class="workshop-card-top">
        <h4>${w.nama}</h4>
        <span class="pill ${statusPillClass(w.status)}">${w.status}</span>
      </div>
      <div class="workshop-meta">
        <div>Kejuruan: <strong>${w.kejuruan}</strong></div>
        <div>Kapasitas: <strong>${w.kapasitas}</strong></div>
      </div>
      <div style="margin-top:10px; display:flex; gap:6px;">
        <button class="btn btn-sm btn-yellow" onclick="toggleWorkshop(${w.id})">Ganti Status Ruangan</button>
        <button class="btn btn-sm btn-red" onclick="deleteWorkshop(${w.id})">Hapus</button>
      </div>
    </div>
  `).join('');
}

function renderUsers() {
  const el = document.getElementById('userRows');
  if (!el) return;
  el.innerHTML = state.users.map((u, idx) => `
    <tr>
      <td><span class="code-mono">${u.id}</span></td>
      <td><strong>${u.nama}</strong></td>
      <td>${u.email}</td>
      <td><span class="${badgeRoleClass(u.role)}">${u.role}</span></td>
      <td>${u.kejuruan}</td>
      <td><span class="pill ${u.status === 'Aktif' ? 'pill-green' : 'pill-red'}">${u.status}</span></td>
      <td style="white-space:nowrap;">
        <button class="btn btn-sm btn-yellow" onclick="toggleUserStatus(${idx})">${u.status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan'}</button>
        <button class="btn btn-sm btn-red" onclick="deleteUser(${idx})">Hapus</button>
      </td>
    </tr>
  `).join('');
}

function renderLogs() {
  const el = document.getElementById('logRows');
  if (!el) return;
  el.innerHTML = state.logs.map(l => `
    <tr>
      <td style="font-size:11.5px; font-weight:700;">${l.waktu}</td>
      <td><strong>${l.user}</strong></td>
      <td><span class="code-mono">${l.aksi}</span></td>
      <td>${l.modul}</td>
      <td>${l.detail}</td>
      <td><span class="pill pill-green">${l.status}</span></td>
    </tr>
  `).join('');
}

function renderAll() {
  updateCounts();
  renderKPIs();
  renderChart();
  renderMiniUjk();
  renderPrograms();
  renderAlumni();
  renderUjk();
  renderDudi();
  renderWorkshops();
  renderUsers();
  renderLogs();
}

// =====================================================
// AKSI ADMIN INTERAKTIF
// =====================================================

window.addJp = function (id) {
  const prog = state.programs.find(p => p.id === id);
  if (!prog) return;
  prog.jpNow = Math.min(prog.jpMax, prog.jpNow + 20);
  if (prog.jpNow >= prog.jpMax) prog.status = 'Selesai';
  else if (prog.jpNow / prog.jpMax >= 0.85) prog.status = 'Persiapan UJK';
  renderAll();
  addLog('Update Progres JP', 'Pelatihan', `Menambah +20 JP untuk ${prog.kode}`);
  showToast(`Progres ${prog.kode} diperbarui menjadi ${prog.jpNow}/${prog.jpMax} JP.`);
};

window.editProgramStatus = function (id) {
  const prog = state.programs.find(p => p.id === id);
  if (!prog) return;
  const statuses = ['Aktif Berjalan', 'Persiapan UJK', 'Selesai'];
  const nextStat = statuses[(statuses.indexOf(prog.status) + 1) % statuses.length];
  prog.status = nextStat;
  renderAll();
  addLog('Ubah Status Paket', 'Pelatihan', `Status ${prog.kode} diubah ke ${nextStat}`);
  showToast(`Status paket ${prog.kode} diubah ke "${nextStat}".`);
};

window.deleteProgram = function (id) {
  const idx = state.programs.findIndex(p => p.id === id);
  if (idx === -1) return;
  if (!confirm(`Apakah Anda yakin ingin menghapus paket ${state.programs[idx].kode}?`)) return;
  const removed = state.programs.splice(idx, 1)[0];
  renderAll();
  addLog('Hapus Paket Pelatihan', 'Pelatihan', `Menghapus paket ${removed.kode} (${removed.nama})`);
  showToast(`Paket ${removed.kode} berhasil dihapus.`);
};

window.cycleAlumniStatus = function (idx) {
  const order = ['Sedang Pelatihan', 'Proses Rekrutmen', 'Terserap Industri', 'Wirausaha'];
  const a = state.alumni[idx];
  a.status = order[(order.indexOf(a.status) + 1) % order.length];
  renderAll();
  addLog('Ubah Status Tracer', 'Alumni', `${a.nama} (${a.id}) status diubah ke ${a.status}`);
  showToast(`Status tracer ${a.nama} diperbarui: ${a.status}.`);
};

window.deleteAlumni = function (nik) {
  const idx = state.alumni.findIndex(a => a.id === nik);
  if (idx === -1) return;
  if (!confirm(`Hapus data peserta/alumni ${state.alumni[idx].nama}?`)) return;
  const removed = state.alumni.splice(idx, 1)[0];
  renderAll();
  addLog('Hapus Peserta Alumni', 'Alumni', `Menghapus ${removed.nama} (${removed.id})`);
  showToast(`Data peserta ${removed.nama} berhasil dihapus.`);
};

window.openEditUjkModal = function (idx) {
  const u = state.ujk[idx];
  if (!u) return;
  document.getElementById('editUjkIndex').value = idx;
  document.getElementById('editUjkKode').value = u.id;
  document.getElementById('editUjkSkema').value = u.skema;
  document.getElementById('editUjkTanggal').value = u.tanggal;
  document.getElementById('editUjkAsesor').value = u.asesor || '';
  document.getElementById('editUjkAsesi').value = u.asesi;
  document.getElementById('editUjkStatus').value = u.status;
  openModal('modalEditUjk');
};

window.completeUjk = function (idx) {
  state.ujk[idx].status = 'Selesai (100% Kompeten)';
  renderAll();
  addLog('Verifikasi Hasil UJK', 'Sertifikasi', `Jadwal ${state.ujk[idx].id} diverifikasi 100% Kompeten`);
  showToast(`Hasil UJK ${state.ujk[idx].id} telah diverifikasi.`);
};

window.deleteUjk = function (id) {
  const idx = state.ujk.findIndex(u => u.id === id);
  if (idx === -1) return;
  if (!confirm(`Batalkan dan hapus jadwal ${state.ujk[idx].id}?`)) return;
  const removed = state.ujk.splice(idx, 1)[0];
  renderAll();
  addLog('Hapus Jadwal UJK', 'Sertifikasi', `Menghapus jadwal ${removed.id} (${removed.skema})`);
  showToast(`Jadwal UJK ${removed.id} dihapus.`);
};

window.extendMou = function (id) {
  const d = state.dudi.find(m => m.id === id);
  if (!d) return;
  d.mou = 'Aktif s.d 2029 (Diperpanjang)';
  renderAll();
  addLog('Perpanjang MoU DUDI', 'Mitra DUDI', `Perpanjang masa MoU untuk ${d.nama}`);
  showToast(`MoU kemitraan ${d.nama} berhasil diperpanjang!`);
};

window.deleteDudi = function (id) {
  const idx = state.dudi.findIndex(d => d.id === id);
  if (idx === -1) return;
  if (!confirm(`Hapus kemitraan DUDI ${state.dudi[idx].nama}?`)) return;
  const removed = state.dudi.splice(idx, 1)[0];
  renderAll();
  addLog('Hapus Kemitraan DUDI', 'Mitra DUDI', `Menghapus kemitraan ${removed.nama}`);
  showToast(`Mitra ${removed.nama} dihapus.`);
};

window.toggleWorkshop = function (id) {
  const ws = state.workshops.find(w => w.id === id);
  if (!ws) return;
  const order = ['Tersedia', 'Digunakan', 'Maintenance'];
  ws.status = order[(order.indexOf(ws.status) + 1) % order.length];
  renderAll();
  addLog('Update Status Sarpras', 'Sarpras', `Bengkel ${ws.nama} diubah ke ${ws.status}`);
  showToast(`Status ${ws.nama} diubah menjadi "${ws.status}".`);
};

window.deleteWorkshop = function (id) {
  const idx = state.workshops.findIndex(w => w.id === id);
  if (idx === -1) return;
  if (!confirm(`Hapus sarpras bengkel ${state.workshops[idx].nama}?`)) return;
  const removed = state.workshops.splice(idx, 1)[0];
  renderAll();
  addLog('Hapus Sarpras Bengkel', 'Sarpras', `Menghapus ${removed.nama}`);
  showToast(`Workshop ${removed.nama} berhasil dihapus.`);
};

window.toggleUserStatus = function (idx) {
  const u = state.users[idx];
  u.status = u.status === 'Aktif' ? 'Nonaktif' : 'Aktif';
  renderAll();
  addLog('Ubah Status User', 'Admin Users', `Status akun ${u.nama} diubah ke ${u.status}`);
  showToast(`Akun ${u.nama} sekarang status "${u.status}".`);
};

window.deleteUser = function (idx) {
  if (state.users[idx].role === 'Super Admin' && state.users.filter(u => u.role === 'Super Admin').length <= 1) {
    alert('Tidak dapat menghapus satu-satunya akun Super Admin!');
    return;
  }
  if (!confirm(`Hapus akun pengguna ${state.users[idx].nama}?`)) return;
  const removed = state.users.splice(idx, 1)[0];
  renderAll();
  addLog('Hapus Pengguna Admin', 'Admin Users', `Menghapus akun ${removed.nama} (${removed.email})`);
  showToast(`Akun pengguna ${removed.nama} dihapus.`);
};

window.clearLogs = function () {
  if (!confirm('Apakah Anda yakin ingin mengosongkan seluruh catatan log riwayat aktivitas?')) return;
  state.logs = [];
  renderLogs();
  showToast('Seluruh riwayat audit log telah dibersihkan.');
};

window.syncSiapKerja = function () {
  showToast('Menghubungkan ke SIAPkerja API Kemnaker RI...');
  setTimeout(() => {
    addLog('Sinkronisasi SIAPkerja', 'Integrasi', 'Pembaruan master data 80 peserta & 3 jadwal UJK dari SIAPkerja pusat');
    showToast('✅ Berhasil disinkronkan dengan SIAPkerja API Kemnaker!');
  }, 1200);
};

window.triggerImportDb = function () {
  const fileInput = document.getElementById('fileImportDb');
  if (fileInput) fileInput.click();
};

window.downloadBackup = function () {
  showToast('Menyiapkan file cadangan (backup) database...');
  setTimeout(() => {
    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(state, null, 2));
    const dl = document.createElement('a');
    dl.setAttribute("href", dataStr);
    dl.setAttribute("download", `backup-sivokasi-${state.balai.replace(/\s+/g, '-')}-${Date.now()}.json`);
    dl.click();
    addLog('Backup Database', 'Sistem', `Unduh berkas JSON backup data balai ${state.balai}`);
    showToast('✅ Berkas cadangan database berhasil diunduh!');
  }, 800);
};

window.printPage = function () {
  window.print();
};

window.exportData = function (type) {
  let headers = [];
  let rows = [];
  let filename = `Laporan-${type}-${state.balai.replace(/\s+/g, '-')}.csv`;

  if (type === 'programs') {
    headers = ['Kode,Program,Jenis,Kejuruan,Instruktur,Peserta,JP_Berjalan,JP_Target,Status'];
    rows = state.programs.map(p => `"${p.kode}","${p.nama}","${p.jenis}","${p.kejuruan}","${p.instruktur}",${p.peserta},${p.jpNow},${p.jpMax},"${p.status}"`);
  } else if (type === 'alumni') {
    headers = ['NIK_ID,Nama,Kejuruan,Sertifikat,Status_Tracer,Detail_Perusahaan'];
    rows = state.alumni.map(a => `"${a.id}","${a.nama}","${a.kejuruan}","${a.sertifikat}","${a.status}","${a.detail}"`);
  } else if (type === 'ujk') {
    headers = ['ID_Jadwal,Skema_Okupasi,Tanggal_UJK,Asesor_LSP,Asesi,Status'];
    rows = state.ujk.map(u => `"${u.id}","${u.skema}","${u.tanggal}","${u.asesor}",${u.asesi},"${u.status}"`);
  } else if (type === 'dudi') {
    headers = ['Perusahaan,Sektor,Masa_MoU,Kuota_Rekrutmen'];
    rows = state.dudi.map(d => `"${d.nama}","${d.sektor}","${d.mou}","${d.kuota}"`);
  }

  const blob = new Blob([headers.concat(rows).join('\n')], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  a.click();
  URL.revokeObjectURL(url);
  addLog('Ekspor Laporan CSV', 'Laporan', `Mengunduh data ${type} format CSV`);
  showToast(`Laporan ${type.toUpperCase()} berhasil diunduh.`);
};

// =====================================================
// EVENT LISTENERS
// =====================================================
document.addEventListener('DOMContentLoaded', () => {

  // Navigasi sidebar (Operasional + Admin)
  document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => switchTab(item.dataset.tab));
  });

  // Ganti balai / UPT
  const selBalai = document.getElementById('selectBalai');
  if (selBalai) {
    selBalai.addEventListener('change', e => {
      state.balai = e.target.value;
      const headerTitle = document.getElementById('headerTitle');
      if (headerTitle) headerTitle.textContent = `Dashboard Eksekutif — ${state.balai}`;
      addLog('Ganti UPT Balai', 'Navigasi', `Konteks dialihkan ke ${state.balai}`);
      showToast(`Konteks dialihkan ke ${state.balai}`);
    });
  }

  // Quick Action Dropdown di topbar
  const btnQuickAdd = document.getElementById('btnQuickAdd');
  const quickAddMenu = document.getElementById('quickAddMenu');
  if (btnQuickAdd && quickAddMenu) {
    btnQuickAdd.addEventListener('click', (e) => {
      e.stopPropagation();
      quickAddMenu.classList.toggle('show');
    });
    document.addEventListener('click', () => {
      quickAddMenu.classList.remove('show');
    });
  }

  // Tombol Buka Modal Export Laporan
  const btnOpenExport = document.getElementById('btnOpenExportModal');
  if (btnOpenExport) {
    btnOpenExport.addEventListener('click', () => openModal('modalExport'));
  }

  // Pencarian global
  const searchInput = document.getElementById('globalSearch');
  if (searchInput) {
    searchInput.addEventListener('input', e => {
      state.searchQuery = e.target.value;
      renderPrograms();
      renderAlumni();
    });
  }

  // Filter program pelatihan
  ['filterJenis', 'filterKejuruan', 'filterStatus'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('change', renderPrograms);
  });

  // Filter alumni
  const fAlumni = document.getElementById('filterAlumniStatus');
  if (fAlumni) fAlumni.addEventListener('change', renderAlumni);

  // Reset filter
  const btnReset = document.getElementById('btnResetFilter');
  if (btnReset) {
    btnReset.addEventListener('click', () => {
      const setVal = (id, val) => { const el = document.getElementById(id); if (el) el.value = val; };
      setVal('filterJenis', 'ALL');
      setVal('filterKejuruan', 'ALL');
      setVal('filterStatus', 'ALL');
      setVal('globalSearch', '');
      state.searchQuery = '';
      renderPrograms();
      showToast('Filter dikembalikan ke awal.');
    });
  }

  // Toggle chart mode
  document.querySelectorAll('[data-chart]').forEach(btn => {
    btn.addEventListener('click', () => {
      state.chartMode = btn.dataset.chart;
      renderChart();
    });
  });

  // Form: Tambah Paket Pelatihan
  const formProgram = document.getElementById('formNewProgram');
  if (formProgram) {
    formProgram.addEventListener('submit', e => {
      e.preventDefault();
      const newProg = {
        id: Date.now(),
        kode: document.getElementById('inKode').value.trim(),
        jenis: document.getElementById('inJenis').value,
        nama: document.getElementById('inNama').value.trim(),
        kejuruan: document.getElementById('inKejuruan').value,
        instruktur: document.getElementById('inInstruktur').value.trim(),
        jpNow: 0,
        jpMax: parseInt(document.getElementById('inTargetJp').value, 10),
        peserta: parseInt(document.getElementById('inPeserta').value, 10),
        status: 'Aktif Berjalan',
      };
      state.programs.unshift(newProg);
      closeModal('modalProgram');
      formProgram.reset();
      document.getElementById('inKode').value = `PBK-26-0${50 + state.programs.length}`;
      renderAll();
      addLog('Buka Paket Pelatihan', 'Pelatihan', `Membuka paket ${newProg.kode}: ${newProg.nama}`);
      showToast(`Paket baru "${newProg.nama}" berhasil dibuka!`);
    });
  }

  // Form: Tambah Siswa / Alumni
  const formAlumni = document.getElementById('formNewAlumni');
  if (formAlumni) {
    formAlumni.addEventListener('submit', e => {
      e.preventDefault();
      const newAlumni = {
        id: document.getElementById('inAlumniNik').value.trim(),
        nama: document.getElementById('inAlumniNama').value.trim(),
        kejuruan: document.getElementById('inAlumniKejuruan').value,
        sertifikat: document.getElementById('inAlumniSertifikat').value,
        status: document.getElementById('inAlumniPenempatan').value,
        detail: document.getElementById('inAlumniDetail').value.trim() || 'Mandiri / Belum Terdata',
      };
      state.alumni.unshift(newAlumni);
      closeModal('modalAlumni');
      formAlumni.reset();
      renderAll();
      addLog('Tambah Siswa/Alumni', 'Alumni', `Mendaftarkan ${newAlumni.nama} (NIK: ${newAlumni.id})`);
      showToast(`Peserta baru "${newAlumni.nama}" berhasil ditambahkan!`);
    });
  }

  // Form: Tambah Jadwal UJK
  const formUjk = document.getElementById('formNewUjk');
  if (formUjk) {
    formUjk.addEventListener('submit', e => {
      e.preventDefault();
      const d = new Date(document.getElementById('inUjkTanggal').value);
      const dateStr = `${d.getDate()} Nov ${d.getFullYear()}`;
      const newUjk = {
        id: document.getElementById('inUjkKode').value.trim(),
        skema: document.getElementById('inUjkSkema').value.trim(),
        tanggal: dateStr,
        asesor: document.getElementById('inUjkAsesor').value.trim(),
        asesi: parseInt(document.getElementById('inUjkAsesi').value, 10),
        status: document.getElementById('inUjkStatus').value,
      };
      state.ujk.unshift(newUjk);
      closeModal('modalUjk');
      formUjk.reset();
      document.getElementById('inUjkKode').value = `UJK-26-${16 + state.ujk.length}`;
      renderAll();
      addLog('Jadwal UJK Baru', 'Sertifikasi', `Mendaftarkan jadwal ${newUjk.id} (${newUjk.skema})`);
      showToast(`Jadwal UJK "${newUjk.skema}" berhasil didaftarkan!`);
    });
  }

  // Form: Update / Edit Jadwal UJK
  const formEditUjk = document.getElementById('formEditUjk');
  if (formEditUjk) {
    formEditUjk.addEventListener('submit', e => {
      e.preventDefault();
      const idx = parseInt(document.getElementById('editUjkIndex').value, 10);
      if (isNaN(idx) || !state.ujk[idx]) return;

      const u = state.ujk[idx];
      u.skema   = document.getElementById('editUjkSkema').value.trim();
      u.tanggal = document.getElementById('editUjkTanggal').value.trim();
      u.asesor  = document.getElementById('editUjkAsesor').value.trim();
      u.asesi   = parseInt(document.getElementById('editUjkAsesi').value, 10);
      u.status  = document.getElementById('editUjkStatus').value;

      closeModal('modalEditUjk');
      renderAll();
      addLog('Update Jadwal UJK', 'Sertifikasi', `Memperbarui jadwal ${u.id}: ${u.skema} (${u.tanggal})`);
      showToast(`Jadwal UJK ${u.id} berhasil diperbarui!`);
    });
  }

  // Form: Tambah Mitra DUDI
  const formDudi = document.getElementById('formNewDudi');
  if (formDudi) {
    formDudi.addEventListener('submit', e => {
      e.preventDefault();
      const newDudi = {
        id: Date.now(),
        nama: document.getElementById('inDudiNama').value.trim(),
        sektor: document.getElementById('inDudiSektor').value.trim(),
        mou: document.getElementById('inDudiMou').value.trim(),
        kuota: document.getElementById('inDudiKuota').value.trim(),
      };
      state.dudi.unshift(newDudi);
      closeModal('modalDudi');
      formDudi.reset();
      renderAll();
      addLog('Tambah Mitra DUDI', 'Mitra Industri', `Mendaftarkan mitra industri baru ${newDudi.nama}`);
      showToast(`Mitra DUDI "${newDudi.nama}" berhasil ditambahkan!`);
    });
  }

  // Form: Tambah Workshop
  const formWs = document.getElementById('formNewWorkshop');
  if (formWs) {
    formWs.addEventListener('submit', e => {
      e.preventDefault();
      const newWs = {
        id: Date.now(),
        nama: document.getElementById('inWsNama').value.trim(),
        kejuruan: document.getElementById('inWsKejuruan').value,
        kapasitas: document.getElementById('inWsKapasitas').value.trim(),
        status: document.getElementById('inWsStatus').value,
      };
      state.workshops.unshift(newWs);
      closeModal('modalWorkshop');
      formWs.reset();
      renderAll();
      addLog('Tambah Bengkel Sarpras', 'Sarpras', `Mendaftarkan sarpras bengkel ${newWs.nama}`);
      showToast(`Workshop "${newWs.nama}" berhasil didaftarkan!`);
    });
  }

  // Form: Tambah User Admin
  const formUser = document.getElementById('formNewUser');
  if (formUser) {
    formUser.addEventListener('submit', e => {
      e.preventDefault();
      const newUser = {
        id: `USR-00${state.users.length + 1}`,
        nama: document.getElementById('inUserNama').value.trim(),
        email: document.getElementById('inUserEmail').value.trim(),
        role: document.getElementById('inUserRole').value,
        kejuruan: document.getElementById('inUserKejuruan').value,
        status: 'Aktif',
      };
      state.users.push(newUser);
      closeModal('modalUser');
      formUser.reset();
      renderAll();
      addLog('Tambah Akun Staf', 'Admin Users', `Membuat akun staf baru ${newUser.nama} (${newUser.role})`);
      showToast(`Akun staf "${newUser.nama}" berhasil dibuat!`);
    });
  }

  // Handler Input File Impor Database JSON
  const fileImportDb = document.getElementById('fileImportDb');
  if (fileImportDb) {
    fileImportDb.addEventListener('change', e => {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = evt => {
        try {
          const imported = JSON.parse(evt.target.result);
          if (imported.programs) state.programs = imported.programs;
          if (imported.alumni) state.alumni = imported.alumni;
          if (imported.ujk) state.ujk = imported.ujk;
          if (imported.dudi) state.dudi = imported.dudi;
          if (imported.workshops) state.workshops = imported.workshops;
          if (imported.users) state.users = imported.users;
          renderAll();
          addLog('Impor Database', 'Sistem', `Berhasil mengimpor database dari file: ${file.name}`);
          showToast(`✅ Database berhasil diimpor dari "${file.name}"!`);
        } catch (err) {
          alert('Format file JSON database tidak valid atau rusak!');
        }
      };
      reader.readAsText(file);
      fileImportDb.value = '';
    });
  }

  // Inisialisasi render pertama kali
  renderAll();
});
