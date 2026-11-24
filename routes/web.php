<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\WalasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

// 1. Rute Otentikasi & Registrasi
Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Publik: Flowchart & Panduan Alur Sistem (UTS Basis Data Lanjut)
Route::get('/alur', function () {
    return view('panduan.alur');
})->name('alur');
Route::get('/alur-siakad', function () {
    return view('panduan.alur');
});
Route::get('/alur-siakad.html', function () {
    return view('panduan.alur');
});

// 2. Rute Terlindungi (Wajib Login)
Route::middleware(['auth'])->group(function () {

    // Group 1: Tata Usaha / Admin
    // Peran TU:
    // - Membuat dan mengelola jadwal pelajaran seluruh kelas
    // - Mengakses rekapitulasi semua nilai dari setiap kelas
    // - Mengelola master data siswa, guru, kelas, kurikulum
    Route::prefix('tu')->name('tu.')->group(function () {
        Route::get('/dashboard', [TuController::class, 'dashboard'])->name('dashboard');
        
        // Data Siswa (CRUD)
        Route::get('/siswa', [TuController::class, 'siswaIndex'])->name('siswa.index');
        Route::post('/siswa', [TuController::class, 'siswaStore'])->name('siswa.store');
        Route::put('/siswa/{id}', [TuController::class, 'siswaUpdate'])->name('siswa.update');
        Route::delete('/siswa/{id}', [TuController::class, 'siswaDestroy'])->name('siswa.destroy');
        
        // Data Guru (CRUD)
        Route::get('/guru', [TuController::class, 'guruIndex'])->name('guru.index');
        Route::post('/guru', [TuController::class, 'guruStore'])->name('guru.store');
        Route::put('/guru/{id}', [TuController::class, 'guruUpdate'])->name('guru.update');
        Route::delete('/guru/{id}', [TuController::class, 'guruDestroy'])->name('guru.destroy');

        // Data Kelas (CRUD)
        Route::get('/kelas', [TuController::class, 'kelasIndex'])->name('kelas.index');
        Route::post('/kelas', [TuController::class, 'kelasStore'])->name('kelas.store');
        Route::put('/kelas/{id}', [TuController::class, 'kelasUpdate'])->name('kelas.update');
        Route::delete('/kelas/{id}', [TuController::class, 'kelasDestroy'])->name('kelas.destroy');

        // Jadwal Pelajaran (HANYA TU YANG MEMBUAT)
        Route::get('/jadwal', [TuController::class, 'jadwalIndex'])->name('jadwal.index');
        Route::post('/jadwal', [TuController::class, 'jadwalStore'])->name('jadwal.store');
        Route::put('/jadwal/{id}', [TuController::class, 'jadwalUpdate'])->name('jadwal.update');
        Route::delete('/jadwal/{id}', [TuController::class, 'jadwalDestroy'])->name('jadwal.destroy');

        // Rekapitulasi Nilai (TU DAPAT MENGAKSES SEMUA NILAI SETIAP KELAS)
        Route::get('/nilai', [TuController::class, 'nilaiIndex'])->name('nilai.index');
        Route::post('/nilai/acc/{id}', [TuController::class, 'toggleAccKelas'])->name('nilai.acc');

        // Data Mapel / Kurikulum (CRUD)
        Route::post('/mapel', [TuController::class, 'mapelStore'])->name('mapel.store');
        Route::put('/mapel/{id}', [TuController::class, 'mapelUpdate'])->name('mapel.update');
        Route::delete('/mapel/{id}', [TuController::class, 'mapelDestroy'])->name('mapel.destroy');
    });

    // Group 2: Wali Kelas
    // Peran Walas:
    // - Mengecek jadwal pelajaran kelasnya (read-only)
    // - Merekap semua nilai dari guru mata pelajaran (Leger nilai kelas)
    Route::prefix('walas')->name('walas.')->group(function () {
        Route::get('/dashboard', [WalasController::class, 'dashboard'])->name('dashboard');
        
        // Pengecekan Jadwal Kelas
        Route::get('/jadwal', [WalasController::class, 'jadwalIndex'])->name('jadwal.index');

        // Merekap Nilai & Cetak Leger
        Route::get('/nilai', [WalasController::class, 'nilaiIndex'])->name('nilai.index');
        Route::get('/leger', [WalasController::class, 'cetakLeger'])->name('leger.cetak');
    });

    // Group 3: Guru Mata Pelajaran
    // Peran Guru:
    // - Melihat kapan dia mengajar (jadwal mengajar)
    // - Memberikan / input nilai siswa
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');
        
        // Input Nilai Siswa
        Route::get('/nilai', [GuruController::class, 'nilaiIndex'])->name('nilai.index');
        Route::get('/nilai/{jadwal_id}', [GuruController::class, 'inputNilai'])->name('nilai.input');
        Route::post('/nilai/{jadwal_id}', [GuruController::class, 'simpanNilai'])->name('nilai.store');
    });

    // Group 4: Siswa
    // Peran Siswa:
    // - Melihat jadwal pelajaran kelasnya
    // - Melihat hasil belajar / rapor
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
    });

});
