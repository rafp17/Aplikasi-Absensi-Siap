@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Dashboard</h2>
        <div class="bg-gray-800 text-white px-4 py-2 rounded-lg border border-gray-700">
            <i class="far fa-calendar-alt mr-2"></i> {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 relative overflow-hidden h-40 flex flex-col justify-center">
            <div class="relative z-10">
                <p class="text-gray-400 text-sm font-medium mb-1">Aktivitas Hari Ini</p>
                <h1 class="text-5xl font-bold text-white">{{ $aktivitasHariIni }}</h1>
                <p class="text-xs text-gray-500 mt-2">Dokumen dikirim hari ini</p>
            </div>
            <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-blue-900/20 to-transparent"></div>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 relative overflow-hidden h-40 flex flex-col justify-center">
            <div class="relative z-10">
                <p class="text-gray-400 text-sm font-medium mb-1">Total Usulan</p>
                <h1 class="text-5xl font-bold text-red-500">{{ $totalUsulan }}</h1>
                <p class="text-xs text-gray-500 mt-2">Total seluruh dokumen masuk</p>
            </div>
            <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-red-900/20 to-transparent"></div>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 h-40 flex flex-col">
            <p class="text-gray-400 text-sm font-medium mb-3">Riwayat Hari Ini</p>
            
            <div class="overflow-y-auto custom-scrollbar flex-1">
                @forelse($riwayatHariIni as $item)
                    <div class="mb-2 p-2 bg-gray-700/30 rounded border border-gray-600 flex justify-between items-center">
                        <div class="truncate mr-2">
                            <h4 class="text-white font-bold text-[11px] truncate">{{ $item->keterangan }}</h4>
                            <span class="text-[9px] text-green-400">Berhasil</span>
                        </div>
                        <span class="text-[10px] text-gray-400 whitespace-nowrap">
                            {{ $item->created_at->format('H:i') }}
                        </span>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center h-full text-gray-500 opacity-50">
                        <i class="far fa-folder-open text-xl mb-1"></i>
                        <p class="text-[10px]">Tidak ada aktivitas</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <div class="bg-gray-800/50 p-6 rounded-lg border border-dashed border-gray-700 text-center">
        <p class="text-gray-500 text-sm">Selamat datang di sistem manajemen personel SIAP.</p>
    </div>

</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #4b5563;
        border-radius: 10px;
    }
</style>
@endsection