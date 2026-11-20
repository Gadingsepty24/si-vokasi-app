import './bootstrap';
function updateCounts() {
    const setEl = (id, val) => {
        const el = document.getElementById(id);
        if (el) el.textContent = val;
    };
    setEl('navCountPrograms', state.programs.length);  // Jumlah paket (saat ini 5)
    setEl('navCountAlumni', state.alumni.length);    // Jumlah alumni (saat ini 4)
    setEl('navCountUjk', state.ujk.length);       // Jumlah UJK (saat ini 3)
    setEl('navCountDudi', state.dudi.length);      // Jumlah Mitra DUDI (saat ini 6)
    setEl('navCountWorkshop', state.workshops.length); // Jumlah Workshop (saat ini 6)
}