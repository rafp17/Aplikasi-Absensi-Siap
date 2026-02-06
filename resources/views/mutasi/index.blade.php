@extends('layouts.app')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/mutasi.js') }}"></script>
@endpush

@section('content')
    <link rel="stylesheet" href="{{ asset('css/mutasi.css') }}">

    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-white">Data Mutasi Pegawai</h1>
            
            <div class="flex gap-2 w-full md:w-auto">
                <form action="{{ route('mutasi.index') }}" method="GET" class="flex w-full md:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari Nama / No SK / Instansi..." 
                           class="w-full px-4 py-2 rounded-l-lg bg-gray-800 border border-gray-700 text-white focus:outline-none focus:border-red-600">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-r-lg hover:bg-red-700 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <button id="btnTambah" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-600 text-white p-4 rounded-lg mb-4 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-600 text-white p-4 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="table-responsive overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-700 text-gray-200 uppercase text-sm font-bold">
                        <tr>
                            <th class="p-4 border-b border-gray-600">No</th>
                            <th class="p-4 border-b border-gray-600">Nama Pegawai / NIP</th>
                            <th class="p-4 border-b border-gray-600">Jenis Mutasi</th>
                            <th class="p-4 border-b border-gray-600">Tgl & Tujuan</th>
                            <th class="p-4 border-b border-gray-600">No. SK</th>
                            <th class="p-4 border-b border-gray-600 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @forelse($mutasi as $index => $item)
                        <tr class="hover:bg-gray-750 border-b border-gray-700 transition">
                            <td class="p-4">{{ $mutasi->firstItem() + $index }}</td>
                            <td class="p-4">
                                {{-- Menghapus referensi $item->pegawai karena modelnya tidak ada --}}
                                <div class="font-semibold text-white">{{ $item->nama_pegawai ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $item->nip ?? '-' }}</div>
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs rounded bg-blue-900 text-blue-300 border border-blue-700">
                                    {{ $item->jenis_mutasi }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="text-sm">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $item->instansi_tujuan ?? '-' }}</div>
                            </td>
                            <td class="p-4">{{ $item->no_sk }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    @if($item->file_sk)
                                        <a href="{{ route('mutasi.download', $item->id) }}" class="p-2 bg-gray-600 rounded text-white hover:bg-gray-500" title="Download SK">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route('mutasi.edit', $item->id) }}" class="p-2 bg-yellow-600 rounded text-white hover:bg-yellow-500" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('mutasi.destroy', $item->id) }}" method="POST" class="form-delete inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-600 rounded text-white hover:bg-red-500" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 italic">
                                Belum ada data mutasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-gray-700">
                {{ $mutasi->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70 modal">
        <div class="bg-gray-800 w-full max-w-lg rounded-lg shadow-2xl overflow-hidden modal-content border border-gray-700">
            <div class="flex justify-between items-center p-4 border-b border-gray-700 bg-gray-900">
                <h3 class="text-lg font-bold text-white">Tambah Data Mutasi</h3>
                <button class="close-modal text-gray-400 hover:text-white text-xl">&times;</button>
            </div>
            
            <form action="{{ route('mutasi.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 mb-1 text-sm">Nama Pegawai <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pegawai" placeholder="Nama Lengkap" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-1 text-sm">NIP <span class="text-red-500">*</span></label>
                        <input type="text" name="nip" placeholder="Masukkan NIP" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600" required>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-400 mb-1 text-sm">Jenis Mutasi <span class="text-red-500">*</span></label>
                    <select name="jenis_mutasi" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600" required>
                        <option value="Kenaikan Pangkat">Kenaikan Pangkat</option>
                        <option value="Masuk">Masuk</option>
                        <option value="Pindah Antar Instansi">Pindah Antar Instansi</option>
                        <option value="Keluar">Keluar</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 mb-1 text-sm">Tanggal SK <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-1 text-sm">No. SK <span class="text-red-500">*</span></label>
                        <input type="text" name="no_sk" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600" required>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-400 mb-1 text-sm">Instansi Tujuan / Keterangan</label>
                    <input type="text" name="instansi_tujuan" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white focus:border-red-600">
                </div>

                <div>
                    <label class="block text-gray-400 mb-1 text-sm">File SK (PDF/DOC)</label>
                    <input type="file" name="file_sk" class="w-full p-2 text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 cursor-pointer">
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-700">
                    <button type="button" class="close-modal px-4 py-2 bg-gray-600 text-white rounded mr-2 hover:bg-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection