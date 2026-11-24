<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Masuk Sistem - SIAKAD SMP Negeri 1 Trimurjo</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .hero-pattern-light {
            background-image: 
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.18) 0%, transparent 50%),
                radial-gradient(circle at bottom left, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%),
                url('{{ asset('images/gedung-sekolah.jpg') }}');
            background-size: cover;
            background-position: center;
        }
        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.18), 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-100 dark:bg-slate-950 flex flex-col items-center justify-center p-3 sm:p-6 lg:p-8 selection:bg-blue-600 selection:text-white relative overflow-x-hidden text-slate-800 dark:text-slate-100 transition-colors">

    <!-- Ambient Glows -->
    <div class="fixed top-0 left-1/4 w-[450px] h-[450px] bg-blue-400/20 dark:bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-0 right-1/4 w-[450px] h-[450px] bg-indigo-400/15 dark:bg-indigo-600/10 rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Tombol Mode Malam / Siang (Mengambang / Akses Cepat di HP & Desktop) -->
    <div class="fixed top-3 right-3 sm:top-5 sm:right-5 z-50">
        <button type="button" onclick="toggleTheme()" class="px-3 py-2 rounded-2xl bg-white/90 dark:bg-slate-800/90 hover:bg-white dark:hover:bg-slate-800 backdrop-blur-md text-slate-700 dark:text-amber-300 border border-slate-200 dark:border-slate-700 shadow-md flex items-center gap-1.5 transition active:scale-95 cursor-pointer text-xs font-bold">
            <span id="loginThemeIcon">🌙</span>
            <span id="loginThemeText" class="hidden sm:inline">Mode Malam</span>
        </button>
    </div>

    <!-- Container Utama Card Login -->
    <div class="max-w-5xl w-full bg-white dark:bg-slate-900 rounded-3xl sm:rounded-[32px] shadow-xl dark:shadow-2xl shadow-slate-200/80 dark:shadow-black/50 border border-slate-200/90 dark:border-slate-800 overflow-hidden grid grid-cols-1 lg:grid-cols-12 relative z-10 my-2 sm:my-6">
        
        <!-- ==================== KOLOM KIRI (Hero & Quick Demo di Desktop / Header Ringkas di HP) ==================== -->
        <div class="lg:col-span-7 hero-pattern-light p-5 sm:p-8 lg:p-12 flex flex-col justify-between relative overflow-hidden text-white border-b lg:border-b-0 lg:border-r border-blue-400/20">
            
            <!-- Header Sekolah & Brand -->
            <div class="relative z-10">
                <div class="flex items-center gap-3.5 mb-4 sm:mb-8">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 p-2 bg-white/95 dark:bg-slate-900 rounded-2xl border border-white/40 shadow-lg flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMPN 1 Trimurjo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 mb-1">
                            <span class="px-2 py-0.5 rounded-full bg-white/20 text-white text-[9px] sm:text-[10px] font-black uppercase tracking-wider backdrop-blur-sm border border-white/30">
                                SISTEM RESMI
                            </span>
                            <span class="px-2 py-0.5 rounded-full bg-amber-400 text-slate-900 text-[9px] sm:text-[10px] font-extrabold flex items-center gap-1 shadow-sm">
                                <span>⭐</span> TERAKREDITASI A
                            </span>
                        </div>
                        <h2 class="font-black text-sm sm:text-lg text-white tracking-tight leading-snug">
                            SMP NEGERI 1 TRIMURJO
                        </h2>
                        <p class="text-[10px] sm:text-[11px] text-blue-100 font-medium">Kabupaten Lampung Tengah</p>
                    </div>
                </div>

                <div class="space-y-2 sm:space-y-4 max-w-lg">
                    <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-white/15 text-white text-[11px] font-bold rounded-xl border border-white/25 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                        <span class="font-mono text-[10px] sm:text-[11px] tracking-wide">NPSN: 10802082 &bull; SIAKAD TERPADU</span>
                    </div>
                    <h1 class="text-xl sm:text-3xl lg:text-4xl font-black text-white leading-tight tracking-tight">
                        Sistem Informasi Akademik Sekolah
                    </h1>
                    <p class="text-blue-100 text-xs sm:text-sm leading-relaxed font-normal hidden sm:block">
                        Layanan digital terintegrasi untuk pengelolaan kurikulum, jadwal KBM, penilaian capaian kompetensi peserta didik, serta penerbitan Leger Nilai resmi.
                    </p>
                </div>
            </div>

            <!-- Akun Pengujian Cepat (Klik Otomatis Mengisi) -->
            <div class="relative z-10 mt-6 sm:mt-10 pt-4 sm:pt-6 border-t border-white/20">
                <div class="flex items-center justify-between mb-2.5">
                    <span class="text-[10px] sm:text-[11px] font-extrabold text-blue-100 uppercase tracking-wider flex items-center gap-1">
                        <span>⚡</span> Akun Demo Pengujian Cepat:
                    </span>
                    <span class="text-[9px] sm:text-[10px] bg-emerald-400/20 text-emerald-100 px-2 py-0.5 rounded-full font-bold font-mono border border-emerald-300/30 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-pulse"></span>
                        AKTIF
                    </span>
                </div>

                <!-- Grid 4 Tombol Cepat (Ramah Layar HP) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
                    <!-- TU -->
                    <button type="button" onclick="fillDemo('tu@smpn1trimurjo.sch.id', 'password')" class="p-2.5 sm:p-3 rounded-2xl bg-white/95 dark:bg-slate-900/90 hover:bg-white text-slate-800 dark:text-slate-100 text-left transition duration-150 active:scale-95 shadow-sm border border-white/40 dark:border-slate-800 cursor-pointer">
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="text-[9px] sm:text-[10px] text-amber-600 dark:text-amber-400 font-black">TATA USAHA</span>
                            <span class="text-xs">💼</span>
                        </div>
                        <span class="font-mono text-[11px] font-bold truncate block">Staf TU</span>
                        <span class="text-[9px] text-slate-500 dark:text-slate-400 block truncate">Jadwal & ACC</span>
                    </button>

                    <!-- Walas -->
                    <button type="button" onclick="fillDemo('sugiyatmi@smpn1trimurjo.sch.id', 'password')" class="p-2.5 sm:p-3 rounded-2xl bg-white/95 dark:bg-slate-900/90 hover:bg-white text-slate-800 dark:text-slate-100 text-left transition duration-150 active:scale-95 shadow-sm border border-white/40 dark:border-slate-800 cursor-pointer" title="Akun Wali Kelas">
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="text-[9px] sm:text-[10px] text-indigo-600 dark:text-indigo-400 font-black">WALI KELAS</span>
                            <span class="text-xs">📋</span>
                        </div>
                        <span class="font-mono text-[11px] font-bold truncate block">Bu Sugiyatmi</span>
                        <span class="text-[9px] text-slate-500 dark:text-slate-400 block truncate">Leger Kelas VII A</span>
                    </button>

                    <!-- Guru -->
                    <button type="button" onclick="fillDemo('budi@smpn1trimurjo.sch.id', 'password')" class="p-2.5 sm:p-3 rounded-2xl bg-white/95 dark:bg-slate-900/90 hover:bg-white text-slate-800 dark:text-slate-100 text-left transition duration-150 active:scale-95 shadow-sm border border-white/40 dark:border-slate-800 cursor-pointer">
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="text-[9px] sm:text-[10px] text-emerald-600 dark:text-emerald-400 font-black">GURU</span>
                            <span class="text-xs">✍️</span>
                        </div>
                        <span class="font-mono text-[11px] font-bold truncate block">Bpk. Budi</span>
                        <span class="text-[9px] text-slate-500 dark:text-slate-400 block truncate">Input Nilai Mapel</span>
                    </button>

                    <!-- Siswa -->
                    <button type="button" onclick="fillDemo('0091234567', 'password')" class="p-2.5 sm:p-3 rounded-2xl bg-white/95 dark:bg-slate-900/90 hover:bg-white text-slate-800 dark:text-slate-100 text-left transition duration-150 active:scale-95 shadow-sm border border-white/40 dark:border-slate-800 cursor-pointer">
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="text-[9px] sm:text-[10px] text-blue-600 dark:text-blue-400 font-black">SISWA</span>
                            <span class="text-xs">🎓</span>
                        </div>
                        <span class="font-mono text-[11px] font-bold truncate block">Ahmad (NISN)</span>
                        <span class="text-[9px] text-slate-500 dark:text-slate-400 block truncate">Rapor & Jadwal</span>
                    </button>
                </div>

                <div class="text-[10px] text-blue-100 mt-2.5 flex items-center justify-between">
                    <span>Password: <strong class="text-slate-900 font-mono bg-white/90 px-1.5 py-0.5 rounded">password</strong></span>
                    <span class="text-blue-200 font-mono hidden sm:inline">Klik kartu di atas untuk mengisi</span>
                </div>
            </div>
        </div>

        <!-- ==================== KOLOM KANAN (Formulir Login Terang & Nyaman di Mata) ==================== -->
        <div class="lg:col-span-5 p-5 sm:p-8 lg:p-12 flex flex-col justify-center bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 relative">
            
            <div class="mb-5 sm:mb-7">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800 text-blue-700 dark:text-blue-300 font-extrabold text-[10px] uppercase tracking-wider mb-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>AUTENTIKASI PENGGUNA</span>
                </div>
                <h3 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Masuk Akun</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs sm:text-sm mt-1 leading-relaxed">
                    Gunakan <strong>Email Dinas</strong> (Guru/Staf) atau <strong>Nomor NISN</strong> (Siswa) beserta kata sandi Anda.
                </p>
            </div>

            @if($errors->any())
                <div class="mb-4 sm:mb-5 p-3.5 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-semibold flex items-center gap-2.5 shadow-sm">
                    <span class="text-base">⚠️</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 sm:mb-5 p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold flex items-center gap-2.5 shadow-sm">
                    <span class="text-base">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Input Login ID -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider flex items-center justify-between">
                        <span>Email atau NISN Siswa</span>
                        <span class="text-[10px] font-mono text-slate-400">Wajib diisi</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="login_id" id="login_id" 
                            value="{{ old('login_id', 'tu@smpn1trimurjo.sch.id') }}" required autofocus
                            placeholder="nama@smpn1trimurjo.sch.id / 0091234567"
                            class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition font-medium input-glow">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                            Kata Sandi
                        </label>
                        <a href="javascript:alert('Silakan hubungi ruang Tata Usaha SMPN 1 Trimurjo untuk bantuan reset sandi.');" class="text-blue-600 dark:text-blue-400 hover:underline text-xs font-semibold transition">
                            Lupa sandi?
                        </a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="password" value="password" required
                            placeholder="••••••••"
                            class="w-full pl-11 pr-12 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition font-medium input-glow">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3.5 top-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1 transition cursor-pointer" title="Tampilkan/Sembunyikan Sandi">
                            <span id="eyeIcon">👁️</span>
                        </button>
                    </div>
                </div>

                <!-- Ingat Sesi -->
                <div class="flex items-center justify-between text-xs pt-0.5">
                    <label class="flex items-center gap-2 text-slate-600 dark:text-slate-300 cursor-pointer select-none">
                        <input type="checkbox" name="remember" checked class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="font-medium">Ingat sesi di perangkat ini</span>
                    </label>
                </div>

                <!-- Tombol Submit (Besar & Nyaman Ditekan di HP) -->
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-extrabold tracking-wide uppercase shadow-lg shadow-blue-500/25 active:scale-[0.99] transition duration-150 flex items-center justify-center gap-2 cursor-pointer mt-2">
                    <span>MASUK SEKARANG</span>
                    <span class="text-base">&rarr;</span>
                </button>
            </form>

            <!-- Tautan Registrasi Akun Baru -->
            <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800 text-center">
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">
                    Belum memiliki akun terdaftar?
                </p>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-slate-700 text-blue-700 dark:text-blue-300 font-bold text-xs uppercase tracking-wider border border-slate-200 dark:border-slate-700 transition active:scale-98">
                    <span>✨</span>
                    <span>DAFTAR AKUN BARU</span>
                </a>

                <div class="mt-4">
                    <button type="button" onclick="alert('Ruang Administrasi SMPN 1 Trimurjo\nJam Pelayanan: Senin - Sabtu (07.00 - 14.00 WIB)\nKontak: Ruang Tata Usaha SMPN 1 Trimurjo\nKabupaten Lampung Tengah');" class="text-[11px] text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition inline-flex items-center gap-1 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Bantuan Sistem & Info Sekolah</span>
                    </button>
                </div>
            </div>

        </div>

    </div>

    <script>
        function updateLoginThemeUI() {
            const isDark = document.documentElement.classList.contains('dark');
            const icon = document.getElementById('loginThemeIcon');
            const text = document.getElementById('loginThemeText');
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
            updateLoginThemeUI();
        }

        function fillDemo(login, pwd) {
            document.getElementById('login_id').value = login;
            document.getElementById('password').value = pwd;
            document.getElementById('login_id').focus();
        }

        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                eyeIcon.innerText = '🙈';
            } else {
                pwdInput.type = 'password';
                eyeIcon.innerText = '👁️';
            }
        }

        document.addEventListener('DOMContentLoaded', updateLoginThemeUI);
    </script>

</body>
</html>
