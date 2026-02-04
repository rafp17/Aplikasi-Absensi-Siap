@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Dashboard</h2>
        
        <div class="relative min-w-[200px]">
            <label for="dashboardDate" class="flex items-center justify-between bg-gray-800 text-white px-4 py-2 rounded-lg border border-gray-700 cursor-pointer hover:bg-gray-700 transition-all active:scale-95">
                <div class="flex items-center">
                    <i class="far fa-calendar-alt mr-3 text-red-500"></i>
                    <span class="text-sm font-medium">{{ $selectedDate->translatedFormat('d F Y') }}</span>
                </div>
                <i class="fas fa-chevron-down ml-3 text-xs text-gray-500"></i>
                
                <input type="date" 
                       id="dashboardDate" 
                       value="{{ $selectedDate->format('Y-m-d') }}"
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </label>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 relative overflow-hidden h-40 flex flex-col justify-center app-card">
            <div class="relative z-10">
                <p class="text-gray-400 text-sm font-medium mb-1">Aktivitas ({{ $selectedDate->translatedFormat('d M') }})</p>
                <h1 class="text-5xl font-bold text-white">{{ $aktivitasHariIni }}</h1>
                <p class="text-xs text-gray-500 mt-2">Dokumen dikirim</p>
            </div>
            <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-blue-900/20 to-transparent"></div>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 relative overflow-hidden h-40 flex flex-col justify-center app-card">
            <div class="relative z-10">
                <p class="text-gray-400 text-sm font-medium mb-1">Total Usulan</p>
                <h1 class="text-5xl font-bold text-red-500">{{ $totalUsulan }}</h1>
                <p class="text-xs text-gray-500 mt-2">Total seluruh dokumen masuk</p>
            </div>
            <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-red-900/20 to-transparent"></div>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 h-40 flex flex-col app-card">
            <p class="text-gray-400 text-sm font-medium mb-3">Riwayat {{ $selectedDate->translatedFormat('d M Y') }}</p>
            
            <div class="overflow-y-auto custom-scrollbar flex-1">
                @forelse($riwayatHariIni as $item)
                    <div class="mb-2 p-2 bg-gray-700/30 rounded border border-gray-600 flex justify-between items-center group">
                        <div class="truncate mr-2 flex flex-col">
                            {{-- Link history asli tetap ada --}}
                            <a href="{{ url('/history/'.$item->id) }}" class="text-white font-bold text-[11px] truncate hover:text-blue-400 transition-colors flex items-center">
                                <i class="far fa-file-alt mr-1 text-blue-400"></i> {{ $item->keterangan }}
                            </a>
                            <span class="text-[9px] text-green-400">Berhasil Dikirim</span>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            {{-- BAGIAN YANG DIKONSENTRASIKAN: Ikon Lacak Posisi --}}
                            {{-- Membuka di halaman yang sama dengan ID dinamis --}}
                            <a href="{{ url('/tracking/' . $item->id) }}" title="Lacak Posisi Dokumen" class="text-yellow-500 hover:text-yellow-400 transition-transform active:scale-90">
                                <i class="fas fa-exclamation-circle text-sm"></i>
                            </a>
                            <span class="text-[10px] text-gray-400 whitespace-nowrap">
                                {{ $item->created_at->format('H:i') }}
                            </span>
                        </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dashboardDate');
    if(dateInput) {
        dateInput.addEventListener('change', function() {
            const date = this.value;
            if(date) {
                document.body.style.opacity = '0.5';
                window.location.href = '/dashboard/' + date;
            }
        });
    }
});
</script>

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
    input[type="date"]::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        width: auto; height: auto;
        color: transparent;
        background: transparent;
    }
</style>
@endsection