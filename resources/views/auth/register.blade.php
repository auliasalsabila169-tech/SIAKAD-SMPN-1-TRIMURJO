<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pendaftaran Akun Baru - SIAKAD SMP Negeri 1 Trimurjo</title>
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
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .hero-pattern-light {
            background-image: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%), url('{{ asset('images/gedung-sekolah.jpg') }}');
            background-size: cover;
            background-position: center;
        }
        input[type="date"] {
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 min-h-screen flex flex-col items-center justify-center p-3 sm:p-6 lg:p-8 text-slate-800 dark:text-slate-100 transition-colors">

    <!-- Tombol Mode Malam / Siang -->
    <div class="fixed top-3 right-3 sm:top-5 sm:right-5 z-50">
        <button type="button" onclick="toggleTheme()" class="px-3 py-2 rounded-2xl bg-white/90 dark:bg-slate-800/90 hover:bg-white dark:hover:bg-slate-800 backdrop-blur-md text-slate-700 dark:text-amber-300 border border-slate-200 dark:border-slate-700 shadow-md flex items-center gap-1.5 transition active:scale-95 cursor-pointer text-xs font-bold">
            <span id="regThemeIcon">🌙</span>
            <span id="regThemeText" class="hidden sm:inline">Mode Malam</span>
        </button>
    </div>

    <div class="max-w-4xl w-full bg-white dark:bg-slate-900 rounded-3xl sm:rounded-[32px] shadow-xl dark:shadow-2xl shadow-slate-200/80 dark:shadow-black/50 overflow-hidden border border-slate-200/90 dark:border-slate-800 my-2 sm:my-6">
        
        <!-- Header Section -->
        <div class="hero-pattern-light p-5 sm:p-8 border-b border-blue-400/20 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 sm:w-14 sm:h-14 p-1.5 bg-white/95 rounded-2xl border border-white/40 shadow-lg flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMPN 1 Trimurjo" class="w-full h-full object-contain">
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[9px] sm:text-[10px] font-extrabold uppercase tracking-wider mb-1 border border-white/30">
                        REGISTRASI PENGGUNA BARU
                    </div>
                    <h1 class="text-base sm:text-2xl font-black text-white tracking-tight leading-snug">
                        Pendaftaran Akun SIAKAD SMPN 1 Trimurjo
                    </h1>
                </div>
            </div>

            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/15 hover:bg-white/25 text-white text-xs font-bold transition border border-white/30 w-fit backdrop-blur-sm">
                <span>&larr;</span>
                <span>Sudah Punya Akun? Masuk</span>
            </a>
        </div>

        <!-- Alert Error -->
        @if($errors->any())
            <div class="m-4 sm:m-6 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-semibold shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <span>⚠️</span>
                    <span>Terdapat beberapa kesalahan data input:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 pl-2 text-rose-700 dark:text-rose-400">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="p-5 sm:p-8 lg:p-10">
            
            <!-- Role Toggle Selector -->
            <div class="mb-6 sm:mb-8">
                <span class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">
                    PILIH JENIS PENDAFTARAN:
                </span>
                <div class="grid grid-cols-2 gap-3 sm:gap-4 max-w-md">
                    <button type="button" id="tabBtnSiswa" onclick="switchRole('siswa')" class="p-3 sm:p-3.5 rounded-2xl border-2 transition flex items-center justify-center gap-2 font-black text-xs uppercase tracking-wider border-blue-600 bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 shadow-sm cursor-pointer">
                        <span class="text-lg">🎒</span>
                        <span>DAFTAR SISWA</span>
                    </button>
                    <button type="button" id="tabBtnGuru" onclick="switchRole('guru')" class="p-3 sm:p-3.5 rounded-2xl border-2 transition flex items-center justify-center gap-2 font-black text-xs uppercase tracking-wider border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:border-slate-300 cursor-pointer">
                        <span class="text-lg">👨‍🏫</span>
                        <span>DAFTAR GURU</span>
                    </button>
                </div>
            </div>

            <!-- FORM 1: PENDAFTARAN SISWA -->
            <form id="formSiswa" action="{{ route('register.post') }}" method="POST" class="space-y-4 sm:space-y-5">
                @csrf
                <input type="hidden" name="role_type" value="siswa">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                    
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Nama Lengkap Peserta Didik *
                        </label>
                        <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Contoh: Ahmad Rizky Pratama" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            NISN (Digunakan untuk Login) *
                        </label>
                        <input type="number" name="nisn" required value="{{ old('nisn') }}" placeholder="10 Digit NISN Kemendikbud" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none font-mono transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            NIS (Nomor Induk Siswa di Sekolah) *
                        </label>
                        <input type="number" name="nis" required value="{{ old('nis') }}" placeholder="Contoh: 8901" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none font-mono transition">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                Tingkat Kelas Siswa *
                            </label>
                            <span class="text-[10px] text-blue-600 dark:text-blue-400 font-bold">⚡ Rombel Otomatis</span>
                        </div>
                        <select name="tingkat" id="pilihTingkat" required onchange="tampilkanRombelOtomatis(this.value)" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition font-medium">
                            <option value="">-- Pilih Tingkat Kelas --</option>
                            <option value="7" {{ old('tingkat') == '7' ? 'selected' : '' }}>Tingkat 7</option>
                            <option value="8" {{ old('tingkat') == '8' ? 'selected' : '' }}>Tingkat 8</option>
                            <option value="9" {{ old('tingkat') == '9' ? 'selected' : '' }}>Tingkat 9</option>
                        </select>
                        <p id="infoRombelOtomatis" class="text-[11px] text-slate-500 dark:text-slate-400 mt-1.5 hidden font-medium">
                            Rombel kelas (<span id="labelRombelOtomatis" class="font-bold text-blue-600 dark:text-blue-400 font-mono">VII A</span>, dst.) dialokasikan secara otomatis oleh sistem sekolah.
                        </p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Jenis Kelamin *
                        </label>
                        <select name="jenis_kelamin" required class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition font-medium">
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Tempat Lahir
                        </label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Trimurjo, Lampung Tengah" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Tanggal Lahir
                        </label>
                        <div class="relative">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" 
                                onclick="this.showPicker()"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none cursor-pointer transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Nomor HP / WhatsApp
                        </label>
                        <input type="tel" name="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none font-mono transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Agama
                        </label>
                        <select name="agama" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition font-medium">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Alamat Domisili Siswa
                        </label>
                        <textarea name="alamat" rows="2" placeholder="Nama Jalan, Desa, RT/RW, Kecamatan Trimurjo" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition">{{ old('alamat') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Kata Sandi Baru *
                        </label>
                        <input type="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Konfirmasi Kata Sandi *
                        </label>
                        <input type="password" name="password_confirmation" required minlength="6" placeholder="Ulangi kata sandi" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-blue-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 focus:outline-none transition">
                    </div>

                </div>

                <div class="pt-5 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                        * Setelah mendaftar, akun siswa langsung aktif dan dapat login menggunakan <strong>NISN</strong>.
                    </p>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-blue-500/25 transition cursor-pointer">
                        DAFTARKAN AKUN SISWA SEKARANG
                    </button>
                </div>
            </form>

            <!-- FORM 2: PENDAFTARAN GURU (HIDDEN BY DEFAULT) -->
            <form id="formGuru" action="{{ route('register.post') }}" method="POST" class="space-y-4 sm:space-y-5 hidden">
                @csrf
                <input type="hidden" name="role_type" value="guru">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                    
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Nama Lengkap Guru Beserta Gelar *
                        </label>
                        <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Contoh: Dra. Siti Rahmawati, M.Pd." class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            NIP / NUPTK *
                        </label>
                        <input type="text" name="nip" required value="{{ old('nip') }}" placeholder="19xxxxxxxxxxxxxxxx" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none font-mono transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Alamat Email Resmi (Digunakan untuk Login) *
                        </label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="nama@smpn1trimurjo.sch.id" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none font-medium transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Jenis Kelamin *
                        </label>
                        <select name="jenis_kelamin" required class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none transition font-medium">
                            <option value="L">Laki-laki (L)</option>
                            <option value="P">Perempuan (P)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Nomor HP / WhatsApp
                        </label>
                        <input type="tel" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none font-mono transition">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Alamat Domisili
                        </label>
                        <textarea name="alamat" rows="2" placeholder="Alamat lengkap tempat tinggal" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none transition">{{ old('alamat') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Kata Sandi Baru *
                        </label>
                        <input type="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">
                            Konfirmasi Kata Sandi *
                        </label>
                        <input type="password" name="password_confirmation" required minlength="6" placeholder="Ulangi kata sandi" class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:border-emerald-600 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 focus:outline-none transition">
                    </div>

                </div>

                <div class="pt-5 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                        * Akun Guru terhubung langsung dengan sistem KBM dan manajemen penilaian mata pelajaran.
                    </p>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-emerald-500/25 transition cursor-pointer">
                        DAFTARKAN AKUN GURU SEKARANG
                    </button>
                </div>
            </form>

        </div>

    </div>

    <script>
        function updateRegThemeUI() {
            const isDark = document.documentElement.classList.contains('dark');
            const icon = document.getElementById('regThemeIcon');
            const text = document.getElementById('regThemeText');
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
            updateRegThemeUI();
        }

        function switchRole(role) {
            const formSiswa = document.getElementById('formSiswa');
            const formGuru = document.getElementById('formGuru');
            const btnSiswa = document.getElementById('tabBtnSiswa');
            const btnGuru = document.getElementById('tabBtnGuru');

            if (role === 'siswa') {
                formSiswa.classList.remove('hidden');
                formGuru.classList.add('hidden');

                btnSiswa.className = "p-3 sm:p-3.5 rounded-2xl border-2 transition flex items-center justify-center gap-2 font-black text-xs uppercase tracking-wider border-blue-600 bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 shadow-sm cursor-pointer";
                btnGuru.className = "p-3 sm:p-3.5 rounded-2xl border-2 transition flex items-center justify-center gap-2 font-black text-xs uppercase tracking-wider border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:border-slate-300 cursor-pointer";
            } else {
                formSiswa.classList.add('hidden');
                formGuru.classList.remove('hidden');

                btnGuru.className = "p-3 sm:p-3.5 rounded-2xl border-2 transition flex items-center justify-center gap-2 font-black text-xs uppercase tracking-wider border-emerald-600 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 shadow-sm cursor-pointer";
                btnSiswa.className = "p-3 sm:p-3.5 rounded-2xl border-2 transition flex items-center justify-center gap-2 font-black text-xs uppercase tracking-wider border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:border-slate-300 cursor-pointer";
            }
        }

        function tampilkanRombelOtomatis(tingkat) {
            const info = document.getElementById('infoRombelOtomatis');
            const label = document.getElementById('labelRombelOtomatis');
            if (tingkat) {
                let contoh = tingkat === '7' ? 'VII A / VII B' : (tingkat === '8' ? 'VIII A / VIII B' : 'IX A / IX B');
                label.innerText = contoh;
                info.classList.remove('hidden');
            } else {
                info.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateRegThemeUI();
            const selectTingkat = document.getElementById('pilihTingkat');
            if (selectTingkat && selectTingkat.value) {
                tampilkanRombelOtomatis(selectTingkat.value);
            }
        });
    </script>

</body>
</html>
