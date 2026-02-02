// 1. Hitung Durasi Otomatis
function hitungDurasi() {
    const tglMulai = document.getElementById('tglMulai').value;
    const tglSelesai = document.getElementById('tglSelesai').value;
    const display = document.getElementById('durasi');

    if (tglMulai && tglSelesai) {
        const start = new Date(tglMulai);
        const end = new Date(tglSelesai);
        const diffTime = end - start;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

        display.innerText = diffDays > 0 ? diffDays : 0;
    }
}

// 2. Tampilkan Nama Penandatangan Otomatis
function tampilPenandatangan() {
    const pnd = document.getElementById('penandatangan').value;
    document.getElementById('ttd').innerText = pnd ? pnd : "-";
}

// 3. Atur Label Tanggal Secara Dinamis
function aturLabelTanggal() {
    const jenis = document.getElementById('jenis').value;
    const labelMulai = document.getElementById('labelMulai');
    const labelSelesai = document.getElementById('labelSelesai');

    if (jenis === 'MUTASI') {
        labelMulai.innerText = "Tanggal TMT Mutasi";
        labelSelesai.innerText = "Tanggal Selesai (Opsional)";
    } else {
        labelMulai.innerText = "Tanggal Mulai Penugasan";
        labelSelesai.innerText = "Tanggal Selesai Penugasan";
    }
}

// 4. Logika Area Nama Jabatan
function aturNamaJabatan() {
    const jenis = document.getElementById('jenis').value;
    const area = document.getElementById('areaNamaJabatan');
    area.style.display = (jenis === 'PLT' || jenis === 'PLH') ? 'block' : 'none';
}

// 5. Atur Dokumen Wajib Berdasarkan Jenis
function aturDokumen() {
    const jenis = document.getElementById('jenis').value;
    const area = document.getElementById('dokumenArea');
    const btnKirim = document.getElementById('kirim');
    
    let html = "";
    if (jenis === "") {
        area.innerHTML = "<p style='color:red'>Silahkan pilih jenis penugasan terlebih dahulu.</p>";
        btnKirim.disabled = true;
        return;
    }

    const docs = {
        'PLT': ['Nota Dinas Usulan', 'SK Pangkat Terakhir', 'Riwayat Jabatan'],
        'PLH': ['Nota Dinas Usulan', 'Surat Izin Cuti/Sakit'],
        'MUTASI': ['SK Mutasi', 'Surat Lepas'],
        'REKOM_TIM': ['Berita Acara', 'Daftar Hadir']
    };

    const daftar = docs[jenis] || [];
    daftar.forEach(doc => {
        html += `
            <div class="dokumen-item">
                <label>${doc}</label>
                <input type="file" name="dokumen[]" required>
            </div>
        `;
    });

    area.innerHTML = html;
    btnKirim.disabled = false;
}

// Fungsi Dummy agar tidak error saat dipanggil
function aturTampilanTanggal() {}
function aturEselon() {}
function aturPLH() {}
function peringatanDinasLuar() {}
function cekPenandatangan() {}