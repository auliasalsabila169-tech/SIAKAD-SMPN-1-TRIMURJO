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
            darkMode: 'class',
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
    <!-- Script Deteksi Awal Mode Malam / Siang (Bebas Kedipan) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        /* Custom Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        html.dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
        }

        /* Navigasi Aktif */
        .active-nav {
            background: #eff6ff !important;
            border-left: 4px solid #2563eb !important;
            color: #1d4ed8 !important;
            font-weight: 700 !important;
        }
        html.dark .active-nav {
            background: rgba(37, 99, 235, 0.2) !important;
            border-left: 4px solid #3b82f6 !important;
            color: #60a5fa !important;
        }

        /* ================= TEMA SIANG (LIGHT MODE) ================= */
        html:not(.dark) body {
            background-color: #f8fafc;
            color: #1e293b;
        }
        html:not(.dark) .glass-card, 
        html:not(.dark) .bg-slate-900, 
        html:not(.dark) .bg-slate-950, 
        html:not(.dark) .bg-slate-900\/90, 
        html:not(.dark) .bg-slate-900\/80, 
        html:not(.dark) .bg-slate-950\/80, 
        html:not(.dark) .bg-slate-950\/90, 
        html:not(.dark) .bg-slate-950\/95, 
        html:not(.dark) .bg-slate-900\/60, 
        html:not(.dark) .bg-slate-950\/70, 
        html:not(.dark) .bg-slate-950\/60 {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #1e293b !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
        }
        html:not(.dark) .glass-card h1, html:not(.dark) .glass-card h2, html:not(.dark) .glass-card h3, html:not(.dark) .glass-card h4,
        html:not(.dark) .bg-slate-900 h1, html:not(.dark) .bg-slate-900 h2, html:not(.dark) .bg-slate-900 h3, html:not(.dark) .bg-slate-900 h4,
        html:not(.dark) .bg-slate-950 h1, html:not(.dark) .bg-slate-950 h2, html:not(.dark) .bg-slate-950 h3, html:not(.dark) .bg-slate-950 h4 {
            color: #0f172a !important;
        }
        html:not(.dark) .text-slate-400, html:not(.dark) .text-slate-500 {
            color: #64748b !important;
        }
        html:not(.dark) .border-slate-800, html:not(.dark) .border-slate-700 {
            border-color: #e2e8f0 !important;
        }
        html:not(.dark) input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]),
        html:not(.dark) select, 
        html:not(.dark) textarea {
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        html:not(.dark) input:focus, html:not(.dark) select:focus, html:not(.dark) textarea:focus {
            background-color: #ffffff !important;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
        }
        html:not(.dark) table th {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) table td {
            border-bottom: 1px solid #f1f5f9 !important;
            color: #1e293b !important;
        }
        html:not(.dark) table tr:hover td {
            background-color: #f8fafc !important;
        }

        /* ================= TEMA MALAM (DARK MODE) ================= */
        html.dark body {
            background-color: #070d19;
            color: #f1f5f9;
        }
        html.dark .glass-card, 
        html.dark .bg-slate-900, 
        html.dark .bg-slate-950 {
            background-color: #0f172a !important;
            border-color: #1e293b !important;
            color: #f8fafc !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
        }
        html.dark input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]),
        html.dark select, 
        html.dark textarea {
            background-color: #070d19 !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }
        html.dark table th {
            background-color: #0f172a !important;
            color: #94a3b8 !important;
            border-bottom: 1px solid #1e293b !important;
        }
        html.dark table td {
            border-bottom: 1px solid #1e293b !important;
            color: #f1f5f9 !important;
        }
        html.dark table tr:hover td {
            background-color: #1e293b !important;
        }

        /* Banner Gradien Elegan di Dashboard */
        .from-slate-900.via-blue-950.to-slate-900,
        .hero-banner-siakad {
            background-image: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%) !important;
            color: #ffffff !important;
        }

        /* Optimasi Tampilan HP */
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
<body class="antialiased min-h-screen flex flex-col selection:bg-blue-600 selection:text-white pb-16 sm:pb-0">

    <!-- TOP NAVIGATION BAR (Cerah di Siang, Teduh di Malam, Ramah HP) -->
    <header class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-0 z-40 shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Brand & Logo Resmi Sekolah -->
                <div class="flex items-center gap-2.5 sm:gap-3.5">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 p-1 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMPN 1 Trimurjo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <span class="font-extrabold text-sm sm:text-base tracking-tight text-slate-900 dark:text-white leading-tight">SIAKAD TRIMURJO</span>
                            <span class="px-1.5 sm:px-2 py-0.5 rounded-full bg-blue-50 dark:bg-blue-900/40 border border-blue-200 dark:border-blue-700 text-blue-700 dark:text-blue-300 text-[9px] sm:text-[10px] font-black uppercase tracking-wider">RESMI</span>
                        </div>
                        <p class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 font-medium truncate">SMPN 1 Trimurjo • Lampung Tengah</p>
                    </div>
                </div>

                <!-- Action Bar: Tombol Mode Malam/Siang & Menu 3 Garis -->
                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- TOMBOL GANTI MODE MALAM / SIANG (☀️ / 🌙) -->
                    <button type="button" onclick="toggleTheme()" id="themeToggleBtn" class="p-2 sm:p-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-amber-300 border border-slate-200 dark:border-slate-700 flex items-center gap-1.5 transition shadow-sm cursor-pointer" title="Ganti Mode Siang / Malam">
                        <span id="themeIcon" class="text-base sm:text-lg">🌙</span>
                        <span id="themeText" class="text-[11px] font-bold hidden md:inline">Mode Malam</span>
                    </button>

                    @auth
                        @php
                            $user = Auth::user();
                            $roleName = $user->roles->first()?->name;
                            $roleBadgeColor = match($roleName) {
                                'Tata Usaha' => 'bg-amber-50 dark:bg-amber-950/40 border-amber-200 dark:border-amber-800 text-amber-800 dark:text-amber-300',
                                'Wali Kelas' => 'bg-indigo-50 dark:bg-indigo-950/40 border-indigo-200 dark:border-indigo-800 text-indigo-800 dark:text-indigo-300',
                                'Guru'       => 'bg-emerald-50 dark:bg-emerald-950/40 border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300',
                                'Siswa'      => 'bg-blue-50 dark:bg-blue-950/40 border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-300',
                                default      => 'bg-slate-100 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200',
                            };
                        @endphp

                        <!-- User Profile Pill (Desktop & Tablet) -->
                        <div class="hidden sm:flex items-center gap-2.5 py-1.5 px-3 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-extrabold text-xs shadow-sm">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="text-left">
                                <div class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-1.5 leading-tight">
                                    <span>{{ $user->name }}</span>
                                </div>
                                <div class="text-[10px] uppercase tracking-wider font-extrabold font-mono mt-0.5">
                                    <span class="px-2 py-0.5 rounded-full border {{ $roleBadgeColor }}">
                                        {{ $roleName ?? 'User' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL 3 GARIS (HAMBURGER MENU) -->
                        <button type="button" onclick="toggleSidebarMenu()" class="p-2 sm:p-2.5 rounded-2xl bg-blue-50 dark:bg-blue-950/50 hover:bg-blue-100 dark:hover:bg-blue-900/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 flex items-center justify-center transition shadow-sm cursor-pointer" title="Buka Menu Lengkap (3 Garis)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    @endauth
                </div>

            </div>
        </div>
    </header>

    <!-- DRAWER MENU NAVIGASI LENGKAP -->
    @auth
        <div id="drawerMenuBackdrop" onclick="toggleSidebarMenu()" class="hidden fixed inset-0 bg-slate-900/50 dark:bg-black/70 backdrop-blur-sm z-50 transition-opacity"></div>

        <aside id="drawerMenuPanel" class="fixed top-0 right-0 h-full w-80 sm:w-96 max-w-[85vw] bg-white dark:bg-slate-900 border-l border-slate-200 dark:border-slate-800 z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col shadow-2xl">
            
            <!-- Drawer Header -->
            <div class="p-5 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between bg-slate-50 dark:bg-slate-950">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 flex items-center justify-center text-lg">
                        📋
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 dark:text-white text-sm sm:text-base">Menu Navigasi</h3>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Panel Akademik Terpadu</p>
                    </div>
                </div>
                <button type="button" onclick="toggleSidebarMenu()" class="w-8 h-8 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 flex items-center justify-center text-lg font-bold transition cursor-pointer">&times;</button>
            </div>

            <!-- Identitas Pengguna di Drawer -->
            <div class="p-5 border-b border-slate-100 dark:border-slate-800 bg-blue-50/40 dark:bg-slate-900/60">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-black text-base shadow-md shrink-0">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="truncate">
                        <div class="font-extrabold text-sm text-slate-900 dark:text-white truncate">{{ $user->name }}</div>
                        <div class="text-[11px] text-slate-500 dark:text-slate-400 truncate font-mono">{{ $user->email }}</div>
                        <span class="inline-block mt-1 px-2 py-0.5 rounded-full border text-[9px] font-black uppercase tracking-wider {{ $roleBadgeColor }}">
                            {{ $roleName ?? 'User' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- List Menu Navigasi Sesuai Hak Akses -->
            <div class="flex-1 overflow-y-auto p-3 sm:p-4 space-y-1 text-xs font-bold">
                <span class="block px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                    MENU AKADEMIK:
                </span>

                @if($roleName == 'Tata Usaha' || (!$roleName && !$user->guru && !$user->siswa))
                    <a href="{{ route('tu.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('tu.dashboard') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📊</span>
                        <span>Dashboard Utama TU</span>
                    </a>
                    <a href="{{ route('tu.jadwal.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('tu.jadwal.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📅</span>
                        <span>Buat & Kelola Jadwal Pelajaran</span>
                    </a>
                    <a href="{{ route('tu.nilai.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('tu.nilai.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📑</span>
                        <span>Rekap & Pengesahan Nilai Kelas</span>
                    </a>
                    
                    <span class="block px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                        DATA POKOK PENDIDIKAN:
                    </span>
                    <a href="{{ route('tu.siswa.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('tu.siswa.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">🎓</span>
                        <span>Data Siswa Induk</span>
                    </a>
                    <a href="{{ route('tu.guru.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('tu.guru.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">👨‍🏫</span>
                        <span>Data Tenaga Pendidik</span>
                    </a>
                    <a href="{{ route('tu.kelas.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('tu.kelas.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">🏫</span>
                        <span>Data Rombel Kelas</span>
                    </a>

                @elseif($roleName == 'Wali Kelas' || ($user->guru && $user->guru->kelasWali))
                    <a href="{{ route('walas.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('walas.dashboard') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📊</span>
                        <span>Dashboard Wali Kelas</span>
                    </a>
                    <a href="{{ route('walas.jadwal.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('walas.jadwal.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📅</span>
                        <span>Cek Jadwal KBM Kelas Binaan</span>
                    </a>
                    <a href="{{ route('walas.nilai.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('walas.nilai.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📑</span>
                        <span>Rekap Semua Nilai dari Guru Mapel</span>
                    </a>
                    <a href="{{ route('walas.leger.cetak') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-3 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800 hover:bg-amber-100 transition font-bold">
                        <span class="text-base">🖨️</span>
                        <span>Cetak Leger Nilai Resmi</span>
                    </a>

                @elseif($roleName == 'Guru' || $user->guru)
                    <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('guru.dashboard') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📚</span>
                        <span>Jadwal Mengajar Saya</span>
                    </a>
                    <a href="{{ route('guru.nilai.index') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('guru.nilai.*') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">✍️</span>
                        <span>Menu Input Nilai Siswa</span>
                    </a>

                @elseif($roleName == 'Siswa' || $user->siswa)
                    <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('siswa.dashboard') ? 'active-nav' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-blue-600' }}">
                        <span class="text-base">📈</span>
                        <span>Jadwal Belajar & Rapor Siswa</span>
                    </a>
                @endif
            </div>

            <!-- Drawer Footer: Logout -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800 text-xs font-black tracking-wider uppercase transition flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                        <span>🚪</span>
                        <span>KELUAR DARI SISTEM</span>
                    </button>
                </form>
            </div>

        </aside>

        <!-- ================= BOTTOM NAVIGATION BAR KHUSUS HP (SANGAT MUDAH & GAK RIBET) ================= -->
        <nav class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-lg border-t border-slate-200 dark:border-slate-800 px-3 py-1.5 shadow-lg flex items-center justify-around no-print">
            
            @if($roleName == 'Tata Usaha' || (!$roleName && !$user->guru && !$user->siswa))
                <a href="{{ route('tu.dashboard') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('tu.dashboard') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📊</span>
                    <span class="text-[10px] mt-0.5">Beranda</span>
                </a>
                <a href="{{ route('tu.jadwal.index') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('tu.jadwal.*') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📅</span>
                    <span class="text-[10px] mt-0.5">Jadwal</span>
                </a>
                <a href="{{ route('tu.nilai.index') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('tu.nilai.*') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📑</span>
                    <span class="text-[10px] mt-0.5">Nilai</span>
                </a>
                <a href="{{ route('tu.siswa.index') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('tu.siswa.*') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">🎓</span>
                    <span class="text-[10px] mt-0.5">Siswa</span>
                </a>
            @elseif($roleName == 'Wali Kelas' || ($user->guru && $user->guru->kelasWali))
                <a href="{{ route('walas.dashboard') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('walas.dashboard') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📊</span>
                    <span class="text-[10px] mt-0.5">Beranda</span>
                </a>
                <a href="{{ route('walas.jadwal.index') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('walas.jadwal.*') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📅</span>
                    <span class="text-[10px] mt-0.5">Jadwal</span>
                </a>
                <a href="{{ route('walas.nilai.index') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('walas.nilai.*') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📑</span>
                    <span class="text-[10px] mt-0.5">Nilai</span>
                </a>
            @elseif($roleName == 'Guru' || $user->guru)
                <a href="{{ route('guru.dashboard') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('guru.dashboard') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📚</span>
                    <span class="text-[10px] mt-0.5">Jadwal</span>
                </a>
                <a href="{{ route('guru.nilai.index') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('guru.nilai.*') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">✍️</span>
                    <span class="text-[10px] mt-0.5">Input Nilai</span>
                </a>
            @elseif($roleName == 'Siswa' || $user->siswa)
                <a href="{{ route('siswa.dashboard') }}" class="flex flex-col items-center py-1 px-2.5 rounded-xl transition {{ request()->routeIs('siswa.dashboard') ? 'text-blue-600 dark:text-blue-400 font-extrabold' : 'text-slate-500 dark:text-slate-400' }}">
                    <span class="text-lg">📈</span>
                    <span class="text-[10px] mt-0.5">Rapor & Jadwal</span>
                </a>
            @endif

            <!-- Tombol Buka Menu Lebih Banyak di HP -->
            <button type="button" onclick="toggleSidebarMenu()" class="flex flex-col items-center py-1 px-2.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-blue-600 transition cursor-pointer">
                <span class="text-lg">☰</span>
                <span class="text-[10px] mt-0.5">Menu</span>
            </button>
        </nav>
    @endauth

    <!-- CONTENT WRAPPER -->
    <main class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-8 w-full flex-1">
        
        <!-- Alerts & Notification Banners -->
        @if(session('success'))
            <div class="mb-4 sm:mb-5 p-3.5 sm:p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold flex items-center justify-between shadow-sm no-print">
                <div class="flex items-center gap-3">
                    <span class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center text-xs font-bold">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 font-black text-base px-2 cursor-pointer">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 sm:mb-5 p-3.5 sm:p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-semibold flex items-center justify-between shadow-sm no-print">
                <div class="flex items-center gap-3">
                    <span class="w-6 h-6 rounded-lg bg-rose-100 dark:bg-rose-900/60 text-rose-700 dark:text-rose-300 flex items-center justify-center text-xs font-bold">⚠️</span>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800 font-black text-base px-2 cursor-pointer">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER RESMI -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-4 sm:py-5 text-center text-xs text-slate-500 dark:text-slate-400 no-print mt-auto">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span>© {{ date('Y') }} <strong class="text-slate-800 dark:text-white">SMP Negeri 1 Trimurjo</strong> • SIAKAD Terpadu</span>
            </div>
            <div class="flex items-center gap-2 text-[11px] text-slate-500 dark:text-slate-400 font-mono">
                <span class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800">Kurikulum Merdeka</span>
            </div>
        </div>
    </footer>

    <!-- Script Pengendali Mode Malam / Siang & Drawer -->
    <script>
        function updateThemeUI() {
            const isDark = document.documentElement.classList.contains('dark');
            const icon = document.getElementById('themeIcon');
            const text = document.getElementById('themeText');
            if (icon) {
                icon.innerText = isDark ? '☀️' : '🌙';
            }
            if (text) {
                text.innerText = isDark ? 'Mode Siang' : 'Mode Malam';
            }
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
            updateThemeUI();
        }

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

        document.addEventListener('DOMContentLoaded', updateThemeUI);
    </script>

</body>
</html>
