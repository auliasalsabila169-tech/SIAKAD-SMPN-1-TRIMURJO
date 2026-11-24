<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Dashboard') - SIAKAD SMPN 1 Trimurjo</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sekolah.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        /* Custom Modern Light Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
        }
        .active-nav {
            background: #eff6ff !important;
            border-left: 4px solid #2563eb !important;
            color: #1d4ed8 !important;
            font-weight: 700 !important;
        }
        
        /* TRANSFORMASI GLOBAL TEMA TERANG & NYAMAN DI MATA */
        .glass-card, 
        .bg-slate-900, 
        .bg-slate-950, 
        .bg-slate-900\/90, 
        .bg-slate-900\/80, 
        .bg-slate-950\/80, 
        .bg-slate-950\/90, 
        .bg-slate-950\/95, 
        .bg-slate-900\/60, 
        .bg-slate-950\/70, 
        .bg-slate-950\/60 {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #1e293b !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05) !important;
        }

        /* Headings di dalam kartu */
        .glass-card h1, .glass-card h2, .glass-card h3, .glass-card h4,
        .bg-slate-900 h1, .bg-slate-900 h2, .bg-slate-900 h3, .bg-slate-900 h4,
        .bg-slate-950 h1, .bg-slate-950 h2, .bg-slate-950 h3, .bg-slate-950 h4 {
            color: #0f172a !important;
        }

        /* Muted text agar kontras dan mudah dibaca */
        .text-slate-400, .text-slate-500 {
            color: #64748b !important;
        }

        /* Border yang bersih dan rapi */
        .border-slate-800, .border-slate-800\/80, .border-slate-700, .border-slate-700\/80 {
            border-color: #e2e8f0 !important;
        }

        /* Hero banner di dashboard tetap menggunakan gradien biru royal elegan */
        .from-slate-900.via-blue-950.to-slate-900,
        .from-blue-950,
        .to-slate-900 {
            background-image: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%) !important;
            color: #ffffff !important;
        }
        .from-slate-900.via-blue-950.to-slate-900 h1,
        .from-slate-900.via-blue-950.to-slate-900 h2,
        .from-slate-900.via-blue-950.to-slate-900 p,
        .from-slate-900.via-blue-950.to-slate-900 span {
            color: #ffffff !important;
        }

        /* Input form terang */
        input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]),
        select, 
        textarea {
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        input:focus, select:focus, textarea:focus {
            background-color: #ffffff !important;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
        }

        /* Tabel yang ramah di mata & HP */
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        table th {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
            border-bottom: 1px solid #e2e8f0 !important;
            font-weight: 700 !important;
        }
        table td {
            border-bottom: 1px solid #f1f5f9 !important;
            color: #1e293b !important;
        }
        table tr:hover td {
            background-color: #f8fafc !important;
        }

        /* Optimasi Tampilan HP (Mobile Responsiveness) */
        @media (max-width: 640px) {
            .max-w-7xl {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col selection:bg-blue-600 selection:text-white bg-slate-50">

    <!-- TOP NAVIGATION BAR (Cerah, Bersih, Modern) -->
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40 shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Brand & Logo Resmi Sekolah -->
                <div class="flex items-center gap-2.5 sm:gap-3.5">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 p-1 bg-white rounded-2xl border border-slate-200 shadow-sm flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMPN 1 Trimurjo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <span class="font-extrabold text-sm sm:text-base tracking-tight text-slate-900 leading-tight">SIAKAD TRIMURJO</span>
                            <span class="px-1.5 sm:px-2 py-0.5 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-[9px] sm:text-[10px] font-black uppercase tracking-wider">RESMI</span>
                        </div>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 font-medium">SMP Negeri 1 Trimurjo • Lampung Tengah</p>
                    </div>
                </div>

                <!-- User Profile & Action Menu 3 Garis di Pojok -->
                <div class="flex items-center gap-2 sm:gap-3.5">
                    @auth
                        @php
                            $user = Auth::user();
                            $roleName = $user->roles->first()?->name;
                            $roleBadgeColor = match($roleName) {
                                'Tata Usaha' => 'bg-amber-50 border-amber-200 text-amber-800',
                                'Wali Kelas' => 'bg-indigo-50 border-indigo-200 text-indigo-800',
                                'Guru'       => 'bg-emerald-50 border-emerald-200 text-emerald-800',
                                'Siswa'      => 'bg-blue-50 border-blue-200 text-blue-800',
                                default      => 'bg-slate-100 border-slate-200 text-slate-800',
                            };
                            $roleDotColor = match($roleName) {
                                'Tata Usaha' => 'bg-amber-500',
                                'Wali Kelas' => 'bg-indigo-500',
                                'Guru'       => 'bg-emerald-500',
                                'Siswa'      => 'bg-blue-500',
                                default      => 'bg-slate-500',
                            };
                        @endphp

                        <!-- User Profile Pill (Desktop & Tablet) -->
                        <div class="hidden sm:flex items-center gap-2.5 py-1.5 px-3 rounded-2xl bg-slate-50 border border-slate-200 shadow-sm">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-extrabold text-xs shadow-sm">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="text-left">
                                <div class="font-bold text-xs text-slate-900 flex items-center gap-1.5 leading-tight">
                                    <span class="w-2 h-2 rounded-full {{ $roleDotColor }} animate-pulse"></span>
                                    <span>{{ $user->name }}</span>
                                </div>
                                <div class="text-[10px] uppercase tracking-wider font-extrabold font-mono mt-0.5">
                                    <span class="px-2 py-0.5 rounded-full border {{ $roleBadgeColor }}">
                                        @if($roleName)
                                            {{ $roleName }}
                                        @elseif($user->guru?->kelasWali)
                                            Wali Kelas {{ $user->guru->kelasWali->nama_kelas }}
                                        @elseif($user->guru)
                                            Guru Pengajar
                                        @elseif($user->siswa)
                                            Siswa Kelas {{ $user->siswa->kelas?->nama_kelas ?? 'VII' }}
                                        @else
                                            Pengguna
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL 3 GARIS (HAMBURGER MENU) - MUDAH DITEKAN DI HP -->
                        <button type="button" onclick="toggleSidebarMenu()" class="p-2.5 sm:p-3 rounded-2xl bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 border border-slate-200 flex items-center justify-center transition shadow-sm cursor-pointer" title="Buka Menu Navigasi (3 Garis)">
                            <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    @endauth
                </div>

            </div>
        </div>
    </header>

    <!-- DRAWER / SLIDE-OVER MENU DARI TOMBOL 3 GARIS (Tema Terang & Ramah Layar HP) -->
    @auth
        <div id="drawerMenuBackdrop" onclick="toggleSidebarMenu()" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 transition-opacity"></div>

        <aside id="drawerMenuPanel" class="fixed top-0 right-0 h-full w-80 sm:w-96 max-w-[85vw] bg-white border-l border-slate-200 z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col shadow-2xl">
            
            <!-- Drawer Header -->
            <div class="p-5 sm:p-6 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 border border-blue-200 flex items-center justify-center text-lg">
                        📋
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">Menu Navigasi</h3>
                        <p class="text-[11px] text-slate-500">Panel Kendali Pengguna</p>
                    </div>
                </div>
                <button type="button" onclick="toggleSidebarMenu()" class="w-8 h-8 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 flex items-center justify-center text-lg font-bold transition cursor-pointer">&times;</button>
            </div>

            <!-- Identitas Pengguna di Drawer -->
            <div class="p-5 border-b border-slate-100 bg-blue-50/40">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-black text-base shadow-md">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="truncate">
                        <div class="font-extrabold text-sm text-slate-900 truncate">{{ $user->name }}</div>
                        <div class="text-[11px] text-slate-500 truncate font-mono">{{ $user->email }}</div>
                        <span class="inline-block mt-1 px-2 py-0.5 rounded-full border text-[9px] font-black uppercase tracking-wider {{ $roleBadgeColor }}">
                            {{ $roleName ?? 'User' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- List Menu Navigasi Sesuai Hak Akses & Tugas Resmi -->
            <div class="flex-1 overflow-y-auto p-3 sm:p-4 space-y-1 text-xs font-bold">
                <span class="block px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                    MENU AKADEMIK:
                </span>

                @if($roleName == 'Tata Usaha' || (!$roleName && !$user->guru && !$user->siswa))
                    <a href="{{ route('tu.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('tu.dashboard') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📊</span>
                        <span>Dashboard Utama TU</span>
                    </a>
                    <a href="{{ route('tu.jadwal.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('tu.jadwal.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📅</span>
                        <span>Buat & Kelola Jadwal Pelajaran</span>
                    </a>
                    <a href="{{ route('tu.nilai.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('tu.nilai.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📑</span>
                        <span>Rekap & Pengesahan Nilai Kelas</span>
                    </a>
                    
                    <span class="block px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                        DATA POKOK PENDIDIKAN:
                    </span>
                    <a href="{{ route('tu.siswa.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('tu.siswa.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">🎓</span>
                        <span>Data Siswa Induk</span>
                    </a>
                    <a href="{{ route('tu.guru.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('tu.guru.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">👨‍🏫</span>
                        <span>Data Tenaga Pendidik</span>
                    </a>
                    <a href="{{ route('tu.kelas.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('tu.kelas.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">🏫</span>
                        <span>Data Rombel Kelas</span>
                    </a>

                @elseif($roleName == 'Wali Kelas' || ($user->guru && $user->guru->kelasWali))
                    <a href="{{ route('walas.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('walas.dashboard') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📊</span>
                        <span>Dashboard Wali Kelas</span>
                    </a>
                    <a href="{{ route('walas.jadwal.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('walas.jadwal.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📅</span>
                        <span>Cek Jadwal KBM Kelas Binaan</span>
                    </a>
                    <a href="{{ route('walas.nilai.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('walas.nilai.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📑</span>
                        <span>Rekap Semua Nilai dari Guru Mapel</span>
                    </a>
                    <a href="{{ route('walas.leger.cetak') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-3 rounded-xl bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100 transition font-bold">
                        <span class="text-base">🖨️</span>
                        <span>Cetak Leger Nilai Resmi</span>
                    </a>

                @elseif($roleName == 'Guru' || $user->guru)
                    <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('guru.dashboard') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📚</span>
                        <span>Jadwal Mengajar Saya</span>
                    </a>
                    <a href="{{ route('guru.nilai.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('guru.nilai.*') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">✍️</span>
                        <span>Menu Input Nilai Siswa</span>
                    </a>

                @elseif($roleName == 'Siswa' || $user->siswa)
                    <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('siswa.dashboard') ? 'active-nav' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-600' }}">
                        <span class="text-base">📈</span>
                        <span>Jadwal Belajar & Rapor Siswa</span>
                    </a>
                @endif
            </div>

            <!-- Drawer Footer: Logout -->
            <div class="p-4 border-t border-slate-200 bg-slate-50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-black tracking-wider uppercase transition flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                        <span>🚪</span>
                        <span>KELUAR DARI SISTEM</span>
                    </button>
                </form>
            </div>

        </aside>

        <script>
            function toggleSidebarMenu() {
                const backdrop = document.getElementById('drawerMenuBackdrop');
                const panel = document.getElementById('drawerMenuPanel');
                if (panel.classList.contains('translate-x-full')) {
                    panel.classList.remove('translate-x-full');
                    backdrop.classList.remove('hidden');
                } else {
                    panel.classList.add('translate-x-full');
                    backdrop.classList.add('hidden');
                }
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const panel = document.getElementById('drawerMenuPanel');
                    if (panel && !panel.classList.contains('translate-x-full')) {
                        toggleSidebarMenu();
                    }
                }
            });
        </script>
    @endauth

    <!-- CONTENT WRAPPER -->
    <main class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-5 sm:py-8 w-full flex-1">
        
        <!-- Alerts & Notification Banners -->
        @if(session('success'))
            <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-sm no-print">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 font-black text-base px-2 cursor-pointer">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center justify-between shadow-sm no-print">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-sm font-bold">⚠️</span>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800 font-black text-base px-2 cursor-pointer">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER RESMI (Bersih, Minimalis & Elegan) -->
    <footer class="bg-white border-t border-slate-200 py-5 text-center text-xs text-slate-500 no-print mt-auto">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2.5">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span>© {{ date('Y') }} <strong class="text-slate-800">SMP Negeri 1 Trimurjo</strong> • Sistem Informasi Akademik</span>
            </div>
            <div class="flex items-center gap-2.5 text-[11px] text-slate-500 font-mono">
                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600">Terpadu</span>
                <span>•</span>
                <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 border border-blue-200">Kurikulum Merdeka</span>
            </div>
        </div>
    </footer>

</body>
</html>
