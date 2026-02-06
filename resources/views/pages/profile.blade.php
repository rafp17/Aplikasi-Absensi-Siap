@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8 flex justify-center">
    <div class="bg-white w-full max-w-2xl shadow-2xl rounded-3xl overflow-hidden border border-gray-200">
        
        <div class="bg-red-600 h-24 w-full flex items-center px-8">
            <a href="{{ route('rekom-katim.index') }}" class="text-white hover:text-gray-200 transition">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>

        <div class="p-10 -mt-16">
    <div class="flex flex-col items-center">
        <div class="w-32 h-32 bg-gray-300 rounded-full border-4 border-white shadow-lg overflow-hidden mb-6">
            <img src="{{ $pegawai->foto ? asset('foto/' . $pegawai->foto) : asset('foto/ysdz.jpg') }}" 
     class="w-full h-full object-cover">
        </div>
    </div>
</div>

                <div class="text-center mb-8">
                    <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Pencapaian Pegawai</h2>
                    <div class="h-px w-32 bg-gray-300 mx-auto mb-2"></div>
                    <span class="text-2xl font-black text-black">86,95 %</span>
                    <div class="h-px w-32 bg-gray-300 mx-auto mt-2"></div>
                </div>

                <div class="w-full border-2 border-black rounded-3xl py-4 px-6 text-center mb-10 shadow-sm bg-gray-50">
                    <h1 class="text-xl font-bold text-black">Rakha Bumi, S.Kom</h1>
                    <p class="text-sm font-medium text-gray-600">NIP. {{ $pegawai->nip ?? '190000000000000000' }}</p>
                </div>

                <div class="grid grid-cols-2 gap-6 w-full">
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
                        <span class="bg-green-400 text-black text-[10px] font-bold px-4 py-1 rounded-full uppercase">Absensi</span>
                        <p class="mt-4 text-xs font-bold text-gray-800">BAGUS : 76,34%</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
                        <span class="bg-red-500 text-white text-[10px] font-bold px-4 py-1 rounded-full uppercase">Kinerja</span>
                        <p class="mt-4 text-xs font-bold text-gray-800">BAGUS : 81,22%</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
                        <span class="bg-green-400 text-black text-[10px] font-bold px-4 py-1 rounded-full uppercase">Kompeten</span>
                        <p class="mt-4 text-xs font-bold text-gray-800 uppercase">Kompeten</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm text-center">
                        <span class="bg-green-400 text-black text-[10px] font-bold px-4 py-1 rounded-full uppercase">Report Cuti</span>
                        <p class="mt-4 text-xs font-bold text-gray-800">Total Cuti : 4 Kali</p>
                    </div>
                </div>

                <div class="mt-10 w-full">
                    <button class="w-full bg-red-500 text-white font-bold py-3 rounded-xl shadow-md flex items-center justify-center gap-2 hover:bg-red-600 transition">
                        <i class="fas fa-map-marker-alt"></i> BKPSDM KARAWANG
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection