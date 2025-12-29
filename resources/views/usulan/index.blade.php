<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dokumen PLT / PLH - BKPSDM</title>

    <!-- CSS DIPISAH -->
    <link rel="stylesheet" href="{{ asset('css/usulan.css') }}?v={{ time() }}">
</head>
<body>

<h2>📄 Upload Dokumen PLT / PLH / Mutasi / Rekomendasi Tim  
(BKPSDM Karawang)</h2>

<form method="POST" action="{{ route('usulan.store') }}" enctype="multipart/form-data">
    @csrf

<div class="card">

    <label>Jenis Penugasan</label>
    <select id="jenis" name="jenis"
    onchange="aturDokumen();aturTampilanTanggal();aturEselon();aturNamaJabatan();aturPLH();aturLabelTanggal();">
        <option value="">-- Pilih --</option>
        <option value="PLT">PLT</option>
        <option value="PLH">PLH</option>
        <option value="REKOM_TIM">Rekomendasi Tim</option>
        <option value="MUTASI">Mutasi</option>
    </select>

    <label>Alasan Penugasan</label>
    <select id="alasan" name="alasan" onchange="peringatanDinasLuar()">
        <option value="">-- Pilih --</option>
        <option>Penugasan Luar</option>
        <option>Mutasi/Promosi</option>
        <option>Pensiun</option>
        <option>Jabatan Kosong</option>
        <option>Meninggal Dunia</option>
        <option>Perpanjangan SK PLT</option>
    </select>

    <div id="areaNamaJabatan" style="display:none;">
        <label>Nama Jabatan</label>
        <input type="text" name="nama_jabatan">
    </div>

    <div id="areaEselon">
        <label>Eselon</label>
        <select id="eselon" name="eselon" onchange="cekPenandatangan()">
            <option value="">-- Pilih --</option>
            <option>II B</option>
            <option>III A</option>
            <option>III B</option>
            <option>IV A</option>
            <option>IV B</option>
        </select>
    </div>

    <div id="areaTanggal">
        <label id="labelMulai">Tanggal Mulai Penugasan</label>
        <input type="date" id="tglMulai" name="tgl_mulai" onchange="hitungDurasi()">

        <label id="labelSelesai">Tanggal Selesai Penugasan</label>
        <input type="date" id="tglSelesai" name="tgl_selesai" onchange="hitungDurasi()">

        <p><b>Durasi:</b> <span id="durasi">-</span> hari</p>
    </div>

    <label>Penandatangan</label>
    <select id="penandatangan" name="penandatangan" onchange="tampilPenandatangan()">
        <option value="">-- Pilih --</option>
        <option>Bupati Karawang</option>
        <option>Kepala BKPSDM</option>
        <option>Sekretaris Daerah</option>
    </select>

    <p><b>Penandatangan:</b> <span id="ttd">-</span></p>

</div>

<div class="card">
    <h3>📂 Dokumen Wajib</h3>
    <div id="dokumenArea"></div>

    <button id="kirim" disabled type="submit">KIRIM USULAN</button>
</div>

</form>

<!-- JS DIPISAH -->
<script src="{{ asset('js/usulan.js') }}?v={{ time() }}"></script>

</body>
</html>
