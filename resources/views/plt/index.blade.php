@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/plt-plh.css') }}?v={{ time() }}">

<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center text-white">
        📄 Upload Dokumen PLT / PLH / Mutasi / Rekomendasi Tim (BKPSDM Karawang)
    </h2>

    <form method="POST" action="{{ route('plt.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
            <label class="text-gray-300">Jenis Penugasan</label>
            <select id="jenis" name="jenis" class="text-black"
                onchange="aturDokumen();aturTampilanTanggal();aturEselon();aturNamaJabatan();aturPLH();aturLabelTanggal();">
                <option value="">-- Pilih --</option>
                <option value="PLT">PLT</option>
                <option value="PLH">PLH</option>
                <option value="REKOM_TIM">Rekomendasi Tim</option>
                <option value="MUTASI">Mutasi</option>
            </select>

            <label class="text-gray-300">Alasan Penugasan</label>
            <select id="alasan" name="alasan" class="text-black" onchange="peringatanDinasLuar()">
                <option value="">-- Pilih --</option>
                <option>Penugasan Luar</option>
                <option>Mutasi/Promosi</option>
                <option>Pensiun</option>
                <option>Jabatan Kosong</option>
                <option>Meninggal Dunia</option>
                <option>Perpanjangan SK PLT</option>
            </select>

            <div id="areaNamaJabatan" style="display:none;">
                <label class="text-gray-300">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="text-black">
            </div>

            <div id="areaEselon">
                <label class="text-gray-300">Eselon</label>
                <select id="eselon" name="eselon" class="text-black" onchange="cekPenandatangan()">
                    <option value="">-- Pilih --</option>
                    <option>II B</option>
                    <option>III A</option>
                    <option>III B</option>
                    <option>IV A</option>
                    <option>IV B</option>
                </select>
            </div>

            <div id="areaTujuanPengiriman" class="mt-2">
                <label class="text-gray-300">Tujuan Pengiriman</label>
                <select name="tujuan_pengiriman" class="text-black w-full p-2 rounded">
                    <option value="">-- Pilih Tujuan --</option>
                    <option value="BKPSDM">BKPSDM</option>
                    <option value="BKPSDM-SEKDA">BKPSDM-SEKDA</option>
                    <option value="BKPSDM-SEKDA-BUPATI">BKPSDM-SEKDA-BUPATI</option>
                </select>
            </div>
            <div id="areaTanggal">
                <label id="labelMulai" class="text-gray-300">Tanggal Mulai Penugasan</label>
                <input type="date" id="tglMulai" name="tgl_mulai" class="text-black" onchange="hitungDurasi()">

                <label id="labelSelesai" class="text-gray-300">Tanggal Selesai Penugasan</label>
                <input type="date" id="tglSelesai" name="tgl_selesai" class="text-black" onchange="hitungDurasi()">

                <p class="mt-2"><b>Durasi:</b> <span id="durasi" class="text-red-500">-</span> hari</p>
            </div>

            <label class="text-gray-300">Penandatangan</label>
            <select id="penandatangan" name="penandatangan" class="text-black" onchange="tampilPenandatangan()">
                <option value="">-- Pilih --</option>
                <option>Bupati Karawang</option>
                <option>Kepala BKPSDM</option>
                <option>Sekretaris Daerah</option>
            </select>

            <p class="mt-2"><b>Penandatangan:</b> <span id="ttd" class="text-red-500">-</span></p>
        </div>

        <div class="card bg-gray-800 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4 text-white">📂 Dokumen Wajib</h3>
            <div id="dokumenArea"></div>

            <button id="kirim" disabled type="submit" class="w-full py-3 mt-4 font-bold rounded-lg transition">
                KIRIM USULAN
            </button>
        </div>
    </form>
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <strong>Ups! Ada kesalahan input:</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    </div>
    @endsection

    @push('scripts')
        <script src="{{ asset('js/plt-plh.js') }}?v={{ time() }}"></script>
        @include('components.riwayat-hari-ini')
        <script>
            window.routeToday = "{{ route('usulan.files.today') }}";
        </script>
        <script src="{{ asset('js/riwayat-hari-ini.js') }}?v={{ time() }}"></script>
    @endpush
</div>