@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* CSS Khusus untuk memaksa posisi ke Tengah */
    .force-center-container {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        width: 100% !important;
    }

    .photo-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .achievement-box {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    .line-black {
        border-top: 2px solid black;
        width: 100%;
        margin: 5px 0;
    }
</style>

<div class="min-h-screen bg-gray-100 flex justify-center items-start p-8 font-sans">
    <div class="bg-white w-full max-w-4xl shadow-2xl rounded-3xl overflow-hidden border border-gray-200">
        <div class="bg-red-600 h-8"></div>

        <div class="p-8">
            <div class="force-center-container mb-10">
                <div class="photo-circle">
                    @php
                        $displayFoto = (isset($pegawai->foto) && $pegawai->foto) 
                                       ? asset('storage/foto/' . $pegawai->foto) 
                                       : asset('foto/ysdz.jpg');
                    @endphp
                    <img src="{{ $displayFoto }}" class="w-full h-full object-cover">
                </div>
                
                <div class="achievement-box">
                    <h2 class="text-xl font-bold text-gray-800 tracking-widest uppercase">Pencapaian Pegawai</h2>
                    <div class="line-black"></div>
                    <p class="text-5xl font-extrabold text-gray-900 py-2">86,95 %</p>
                    <div class="line-black"></div>
                </div>
            </div>

            <div class="max-w-md mx-auto border-2 border-black rounded-full py-4 px-8 text-center mb-10 shadow-sm bg-white">
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">
                    {{ $pegawai->nama ?? 'Rakha Bumi, S.Kom' }}
                </h3>
                <p class="text-gray-600 font-semibold uppercase text-xs mt-1">
                    NIP. {{ $pegawai->nip ?? '190000000000000000' }}
                </p>
            </div>

            <div class="flex justify-center gap-4 mb-10">
                <button class="border-2 border-black text-black font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition uppercase text-xs">
                    REKOMENDASI KETUA TIM
                </button>
                <button class="bg-red-500 text-white font-bold py-3 px-10 rounded-full shadow-lg hover:bg-red-700 transition uppercase text-xs transform hover:scale-105">
                    PILIH REKOMENDASI
                </button>
            </div>

            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-300 shadow-inner">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-800 bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-800">
                                <th class="border border-gray-800 p-2 w-12 text-xs font-bold">NO</th>
                                <th class="border border-gray-800 p-2 text-xs font-bold uppercase text-center">REKOMENDASI DIVISI</th>
                                <th class="border border-gray-800 p-2 text-xs font-bold uppercase text-center">TEMPAT</th>
                            </tr>
                        </thead>
                        <tbody class="text-center text-sm font-bold">
                            <tr><td class="border border-gray-800 p-3">1</td><td class="border border-gray-800 p-3 text-left px-6">KETUA TIM CYBER</td><td class="border border-gray-800 p-3">BKPSDM KARAWANG</td></tr>
                            <tr><td class="border border-gray-800 p-3">2</td><td class="border border-gray-800 p-3 text-left px-6">KETUA ADMINISTRASI</td><td class="border border-gray-800 p-3">BPPN KARAWANG</td></tr>
                            <tr><td class="border border-gray-800 p-3">3</td><td class="border border-gray-800 p-3 text-left px-6">KETUA AKUNTAN</td><td class="border border-gray-800 p-3">BKPSDM CIBUBUR</td></tr>
                            @for($i = 4; $i <= 8; $i++)
                            <tr class="text-gray-400"><td class="border border-gray-800 p-3">{{ $i }}</td><td class="border border-gray-800 p-3 text-left px-6">Rakha Bumi S.Kom</td><td class="border border-gray-800 p-3">Sekretaris</td></tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 space-y-4 max-w-2xl mx-auto">
                    <div class="border-2 border-black rounded-full px-6 py-2 bg-white flex items-center shadow-sm">
                        <label class="text-xs font-black mr-3 text-black">DIVISI :</label>
                        <input type="text" class="flex-1 outline-none bg-transparent font-bold text-sm">
                    </div>
                    <div class="border-2 border-black rounded-full px-6 py-2 bg-white flex items-center shadow-sm">
                        <label class="text-xs font-black mr-3 text-black">TEMPAT :</label>
                        <input type="text" class="flex-1 outline-none bg-transparent font-bold text-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection