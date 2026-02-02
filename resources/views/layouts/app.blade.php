<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Transisi halus untuk semua elemen sidebar */
        #sidebar, .nav-text, #sidebar-header-text {
            transition: all 0.3s ease-in-out;
        }

        /* Mode Desktop: Sidebar Mengecil */
        @media (min-width: 1024px) {
            .sidebar-mini {
                width: 80px !important; /* Lebar saat mengecil */
            }
            .sidebar-mini .nav-text, 
            .sidebar-mini #sidebar-header-text {
                display: none; /* Sembunyikan teks */
            }
            .sidebar-mini .nav-item {
                justify-content: center; /* Ikon di tengah */
                padding-left: 0;
                padding-right: 0;
            }
            .sidebar-mini .nav-item i {
                margin-right: 0;
                font-size: 1.25rem;
            }
        }

        /* Overlay hanya untuk Mobile */
        #sidebarOverlay.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans">

    <div class="flex h-screen overflow-hidden relative">
        
        <div id="sidebarOverlay" 
             onclick="toggleSidebar()" 
             class="hidden fixed inset-0 bg-black/60 z-40 lg:hidden">
        </div>

        <aside id="sidebar" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-black border-r border-gray-800 flex flex-col transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0">
            
           <div class="flex items-center justify-center h-20 border-b border-gray-800 overflow-hidden px-4">
                <div class="siap-logo-wrapper">
                    <svg viewBox="0 0 450 150" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                        <text x="0" y="125" font-family="Arial Black, sans-serif" font-size="140" font-weight="900" fill="#e31e24">SI</text>
                        
                        <g transform="translate(185, 10)">
                            <path d="M10,110 Q40,70 70,110 L70,125 L10,125 Z" fill="#b1b3b6" />
                            <path d="M10,110 Q25,85 40,110 L25,125 L10,125 Z" fill="#008a44" />
                            <path d="M30,95 L50,125 L40,125 L25,105 Z" fill="#f9d949" />
                            <path d="M40,0 A28,28 0 1,0 40,56 L40,75 L40,56 A28,28 0 0,0 40,0" fill="#e31e24" />
                            <circle cx="40" cy="28" r="20" fill="white" />
                            <circle cx="33" cy="24" r="2.5" fill="#e31e24" />
                            <circle cx="47" cy="24" r="2.5" fill="#e31e24" />
                            <path d="M30,34 Q40,45 50,34" fill="none" stroke="#e31e24" stroke-width="3" stroke-linecap="round" />
                        </g>

                        <text x="300" y="125" font-family="Arial Black, sans-serif" font-size="140" font-weight="900" fill="#e31e24">P</text>
                    </svg>
                </div>
                <span id="sidebar-header-text" class="ml-2 text-red-600 font-bold whitespace-nowrap">APP</span>
            </div>
            
            <nav class="flex-1 mt-5 px-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 {{ request()->is('dashboard') || request()->is('/') ? 'bg-gray-800 border-l-4 border-red-600' : '' }}">
                    <i class="fas fa-home w-6 text-center"></i>
                    <span class="ml-3 nav-text">Dashboard</span>
                </a>

                <a href="{{ route('plt-plh.index') }}" class="nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 {{ request()->is('plt-plh*') ? 'bg-gray-800 border-l-4 border-red-600' : '' }}">
                    <i class="fas fa-user-tie w-6 text-center"></i>
                    <span class="ml-3 nav-text">PLT/PLH</span>
                </a>

                <a href="{{ route('mutasi.index') }}" class="nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 {{ request()->is('mutasi*') ? 'bg-gray-800 border-l-4 border-red-600' : '' }}">
                    <i class="fas fa-exchange-alt w-6 text-center"></i>
                    <span class="ml-3 nav-text">Mutasi</span>
                </a>

                <a href="{{ route('usulan.files') }}" class="nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 {{ request()->is('rekom-katim*') ? 'bg-gray-800 border-l-4 border-red-600' : '' }}">
                    <i class="fas fa-file-signature w-6 text-center"></i>
                    <span class="ml-3 nav-text">Rekom Katim</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-y-auto bg-black">
            
            <header class="flex items-center p-4 border-b border-gray-800 bg-black sticky top-0 z-30 h-20">
                <button onclick="toggleSidebar()" class="text-white focus:outline-none p-2 hover:bg-gray-800 rounded-lg">
                    <i class="fas fa-bars text-xl"></i> 
                </button>
                <div class="ml-4">
                    <span class="text-red-600 font-bold tracking-wider">SIAP APP</span>
                </div>
            </header>

            <main class="p-4 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const isDesktop = window.innerWidth >= 1024;

            if (isDesktop) {
                // Mode Desktop: Tambah/Hapus class mini (mengecilkan sidebar)
                sidebar.classList.toggle('sidebar-mini');
            } else {
                // Mode Mobile: Slide masuk/keluar sepenuhnya
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }
    </script>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    @stack('scripts')
</body>
</html>