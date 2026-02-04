@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="min-h-screen bg-gray-100 flex justify-center items-start p-8 font-sans">
    <div class="bg-white w-full max-w-4xl shadow-2xl rounded-xl overflow-hidden border border-gray-300">
        
        <div class="bg-red-600 h-20 w-full flex items-center justify-between px-8">
            <h1 class="text-white font-bold text-xl uppercase tracking-widest">Sistem Informasi Kepegawaian</h1>
            <div class="flex space-x-2">
                <div class="w-3 h-3 bg-white opacity-30 rounded-full"></div>
                <div class="w-3 h-3 bg-white rounded-full"></div>
            </div>
        </div>

        <div class="p-10">
            <div class="w-full bg-red-500 text-black font-black text-center py-5 rounded-2xl shadow-md text-2xl mb-10 uppercase border-b-4 border-red-700">
                Rekomendasi Ketua Tim
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div class="space-x-4">
                    <button class="bg-gray-300 text-black text-sm font-bold py-3 px-6 rounded-full shadow hover:bg-gray-400 transition">
                        <i class="fas fa-users mr-2"></i> DAFTAR NAMA PEGAWAI
                    </button>
                </div>
                <button class="bg-red-600 text-white text-sm font-bold py-3 px-10 rounded-full shadow-lg hover:bg-red-700 transition transform hover:scale-105">
                    PILIH REKOM <i class="fas fa-check-circle ml-2"></i>
                </button>
            </div>

            <div class="w-full overflow-hidden border-2 border-black rounded-lg shadow-sm mb-10">
                <table class="w-full text-center border-collapse" id="tabelPegawai">
                    <thead>
                        <tr class="bg-gray-300 text-black font-bold">
                            <th class="border-b border-r border-black p-4 w-16">NO</th>
                            <th class="border-b border-r border-black p-4">NAMA PEGAWAI</th>
                            <th class="border-b border-r border-black p-4">JABATAN</th>
                            <th class="border-b border-black p-4 w-24">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @php
                            // Data dummy dengan ID untuk link profil
                            $pegawai = [
                                ['id' => 1, 'nama' => 'Rakha Bumi, S.Kom', 'jabatan' => 'Sekretaris'],
                                ['id' => 2, 'nama' => 'Emilio Nata, S.Kom', 'jabatan' => 'Pranata Komputer'],
                                ['id' => 3, 'nama' => 'Lalu Adrian, S.Sos', 'jabatan' => 'Ahli Sosiologi'],
                            ];
                        @endphp

                        @foreach($pegawai as $index => $p)
                        <tr class="hover:bg-gray-300 transition cursor-pointer border-b border-black last:border-0">
                            <td class="border-r border-black p-4 font-bold text-black">{{ $index + 1 }}</td>
                            <td class="border-r border-black p-4 text-left px-8 nama-val text-black font-medium">{{ $p['nama'] }}</td>
                            <td class="border-r border-black p-4 jabatan-val text-black">{{ $p['jabatan'] }}</td>
                            <td class="p-4">
                                <a href="{{ url('/profile/'.$p['id']) }}" class="text-red-600 hover:text-red-800 transition text-xl" title="Lihat Profil">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border-2 border-black rounded-full px-6 py-3 flex items-center bg-white shadow-inner">
                    <span class="text-xs font-black text-black text-nowrap mr-3">NAMA :</span>
                    <input type="text" id="inputNama" class="flex-1 bg-transparent border-none focus:ring-0 text-sm font-bold text-red-600 outline-none" placeholder="..." readonly>
                </div>
                <div class="border-2 border-black rounded-full px-6 py-3 flex items-center bg-white shadow-inner">
                    <span class="text-xs font-black text-black text-nowrap mr-3">JABATAN :</span>
                    <input type="text" id="inputJabatan" class="flex-1 bg-transparent border-none focus:ring-0 text-sm font-bold text-red-600 outline-none" placeholder="..." readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('#tabelPegawai tbody tr');
        const inputNama = document.getElementById('inputNama');
        const inputJabatan = document.getElementById('inputJabatan');

        rows.forEach(row => {
            row.addEventListener('click', function(e) {
                // Jangan jalankan input jika yang diklik adalah link profil (ikon mata)
                if (e.target.closest('a')) return;

                const nama = this.querySelector('.nama-val').innerText;
                const jabatan = this.querySelector('.jabatan-val').innerText;

                inputNama.value = nama;
                inputJabatan.value = jabatan;

                rows.forEach(r => {
                    r.classList.remove('bg-gray-400');
                    r.classList.add('bg-gray-200');
                });
                this.classList.remove('bg-gray-200');
                this.classList.add('bg-gray-400');
            });
        });
    });
</script>
@endsection