@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl">
    <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700">
        <div class="p-6 border-b border-gray-700 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Edit Data Mutasi</h2>
            <a href="{{ route('mutasi.index') }}" class="text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </a>
        </div>

        <form action="{{ route('mutasi.update', $mutasi->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Input Nama Pegawai Manual --}}
                <div>
                    <label class="block text-gray-400 mb-2 font-medium">Nama Pegawai <span class="text-red-500">*</span></label>
                    {{-- Kita hanya menggunakan kolom nama_pegawai dari tabel mutasi sendiri --}}
                    <input type="text" name="nama_pegawai" 
                           value="{{ old('nama_pegawai', $mutasi->nama_pegawai) }}" 
                           placeholder="Masukkan Nama Lengkap"
                           class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none transition" required>
                    @error('nama_pegawai')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input NIP Manual --}}
                <div>
                    <label class="block text-gray-400 mb-2 font-medium">NIP <span class="text-red-500">*</span></label>
                    <input type="text" name="nip" 
                           value="{{ old('nip', $mutasi->nip) }}" 
                           placeholder="Masukkan NIP"
                           class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none transition" required>
                    @error('nip')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-400 mb-2 font-medium">Jenis Mutasi</label>
                <select name="jenis_mutasi" class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none">
                    @foreach(['Kenaikan Pangkat', 'Masuk', 'Pindah Antar Instansi', 'Keluar'] as $jenis)
                        <option value="{{ $jenis }}" {{ (old('jenis_mutasi', $mutasi->jenis_mutasi) == $jenis) ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-400 mb-2 font-medium">Tanggal SK</label>
                    <input type="date" name="tanggal" 
                           value="{{ old('tanggal', \Carbon\Carbon::parse($mutasi->tanggal)->format('Y-m-d')) }}"
                           class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none">
                </div>
                
                <div>
                    <label class="block text-gray-400 mb-2 font-medium">Nomor SK</label>
                    <input type="text" name="no_sk" value="{{ old('no_sk', $mutasi->no_sk) }}"
                           class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-gray-400 mb-2 font-medium">Instansi Tujuan / Keterangan</label>
                <input type="text" name="instansi_tujuan" value="{{ old('instansi_tujuan', $mutasi->instansi_tujuan) }}"
                       class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-400 mb-2 font-medium">Eselon</label>
                    <input type="text" name="eselon" 
                           value="{{ old('eselon', $mutasi->eselon) }}"
                           placeholder="Contoh: II.a"
                           class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none">
                </div>

                <div>
                    <label class="block text-gray-400 mb-2 font-medium">Tujuan Pengiriman</label>
                    <select name="tujuan_pengiriman" class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600 outline-none">
                        <option value="">-- Pilih Tujuan --</option>
                        <option value="BKPSDM" {{ (old('tujuan_pengiriman', $mutasi->tujuan_pengiriman) == 'BKPSDM') ? 'selected' : '' }}>BKPSDM</option>
                        <option value="BKPSDM-SEKDA" {{ (old('tujuan_pengiriman', $mutasi->tujuan_pengiriman) == 'BKPSDM-SEKDA') ? 'selected' : '' }}>BKPSDM-SEKDA</option>
                        <option value="BKPSDM-SEKDA-BUPATI" {{ (old('tujuan_pengiriman', $mutasi->tujuan_pengiriman) == 'BKPSDM-SEKDA-BUPATI') ? 'selected' : '' }}>BKPSDM-SEKDA-BUPATI</option>
                    </select>
                </div>
            </div>

            <div class="p-4 bg-gray-900 rounded border border-gray-700">
                <label class="block text-gray-400 mb-2 font-medium">File SK (Biarkan kosong jika tidak diubah)</label>
                <input type="file" name="file_sk" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 cursor-pointer">
                
                @if($mutasi->file_sk)
                    <div class="mt-2 text-sm text-blue-400 flex items-center gap-2">
                        <i class="fas fa-file-alt"></i> 
                        <span>File saat ini: <a href="{{ route('mutasi.download', $mutasi->id) }}" class="underline italic hover:text-blue-300">Tersedia (Klik untuk melihat)</a></span>
                    </div>
                @endif
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('mutasi.index') }}" class="px-6 py-2 rounded bg-gray-600 text-white hover:bg-gray-500 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition shadow-lg shadow-red-900/50">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection