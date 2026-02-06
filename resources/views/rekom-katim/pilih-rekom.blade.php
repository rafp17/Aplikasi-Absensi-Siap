@php
    $pegawai = $pegawai ?? []; 
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian Pegawai - SIAP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-4xl mx-auto my-10 bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-200">
        <div class="bg-red-600 h-8"></div>

       <div class="flex flex-col items-center justify-center py-6">
    <div class="relative">
        <div class="w-32 h-32 md:w-40 md:h-40 bg-gray-300 rounded-full border-4 border-gray-800 shadow-xl overflow-hidden">
            <img 
                src="{{ $User->foto ? asset('foto/' . $User->foto) : asset('foto/ysdz.jpg') }}" 
                alt="Foto Profil" 
                class="w-full h-full object-cover"
            >
        </div>
        
        <div class="absolute -top-2 -right-2 bg-red-600 w-6 h-6 rounded-full border-2 border-white shadow-sm"></div>
    </div>

    <div class="mt-4 text-center">
        <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wide">
            {{ $User->name ?? 'Nama Pegawai' }}
        </h2>
    </div>
</div>
                
                <div class="text-center md:text-left">
                    <h2 class="text-xl font-bold text-gray-800 tracking-widest uppercase mb-1">Pencapaian Pegawai</h2>
                    <div class="border-t-2 border-black w-full mb-2"></div>
                    <p class="text-4xl font-extrabold text-gray-900">86,95 %</p>
                    <div class="border-t-2 border-black w-full mt-2"></div>
                </div>
            </div>

            <div class="max-w-md mx-auto border-2 border-black rounded-full py-3 px-6 text-center mb-10 shadow-sm">
                <h3 class="text-xl font-bold text-gray-800">Rakha Bumi, S.Kom</h3>
                <p class="text-gray-600 font-semibold">NIP. 190000000000000000</p>
            </div>

            <div class="flex justify-center gap-4 mb-8">
                <button class="border-2 border-black text-black font-bold py-2 px-6 rounded-full hover:bg-gray-100 transition">
                    REKOMENDASI KETUA TIM
                </button>
                <a href="{{ url('pilih-rekom') }}" class="bg-red-500 text-white font-bold py-2 px-8 rounded-full shadow-md hover:bg-red-600 transition transform hover:scale-105">
                    PILIH REKOMENDASI
                </a>
            </div>

            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-300 shadow-inner">
                <div class="overflow-x-auto mb-6">
                    <table class="w-full border-collapse border border-gray-800 bg-white">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-800 p-2 w-10"></th>
                                <th class="border border-gray-800 p-2 text-sm">REKOMENDASI DIVISI</th>
                                <th class="border border-gray-800 p-2 text-sm">TEMPAT</th>
                            </tr>
                        </thead>
                        <tbody class="text-center text-sm font-semibold">
                            <tr>
                                <td class="border border-gray-800 p-2">1</td>
                                <td class="border border-gray-800 p-2">KETUA TIM CYBER</td>
                                <td class="border border-gray-800 p-2">BKPSDM KARAWANG</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-800 p-2">2</td>
                                <td class="border border-gray-800 p-2">KETUA ADMINISTRASI</td>
                                <td class="border border-gray-800 p-2">BPPN KARAWANG</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-800 p-2">3</td>
                                <td class="border border-gray-800 p-2">KETUA AKUNTAN</td>
                                <td class="border border-gray-800 p-2">BKPSDM CIBUBUR</td>
                            </tr>
                            @for ($i = 4; $i <= 8; $i++)
                            <tr>
                                <td class="border border-gray-800 p-2">{{ $i }}</td>
                                <td class="border border-gray-800 p-2">Rakha Bumi S.Kom</td>
                                <td class="border border-gray-800 p-2">Sekretaris</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="space-y-4">
                    <div class="border-2 border-black rounded-full px-4 py-2 bg-white flex items-center">
                        <label class="text-sm font-bold mr-2 uppercase">Divisi :</label>
                        <input type="text" class="flex-1 outline-none bg-transparent">
                    </div>
                    
                    <div class="border-2 border-black rounded-full px-4 py-2 bg-white flex items-center">
                        <label class="text-sm font-bold mr-2 uppercase">Tempat :</label>
                        <input type="text" class="flex-1 outline-none bg-transparent">
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex-1 border-2 border-black rounded-xl p-3 bg-white shadow-md">
                            <p class="text-xs font-bold uppercase mb-1">Pilih Tanggal Penetapan</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-500 uppercase">Tanggal :</span>
                                <input type="date" class="outline-none text-sm">
                            </div>
                        </div>
                        <div class="bg-white border-2 border-black p-4 rounded-xl shadow-md cursor-pointer hover:bg-gray-50">
                            <i class="fas fa-calendar-alt text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>