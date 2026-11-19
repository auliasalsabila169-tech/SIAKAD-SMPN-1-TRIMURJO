-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2026 pada 16.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad_smpn1_trimurjo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `user_id`, `nip`, `nama_guru`, `jenis_kelamin`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 2, '197508122005012003', 'Istri Sugiyatmi, S.Pd.', 'P', '081234567890', 'Trimurjo, Lampung Tengah', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, 3, '198203152008021004', 'Budi Santoso, S.Pd.', 'L', '081398765432', 'Metro, Lampung', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(3, 8, '197801221995111006', 'Arya Pratama, S.Pd', 'L', NULL, 'Bandar Lampung', '2026-11-09 10:39:52', '2026-11-09 10:39:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id_hari` bigint(20) UNSIGNED NOT NULL,
  `nama_hari` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
(5, 'Jumat'),
(4, 'Kamis'),
(3, 'Rabu'),
(6, 'Sabtu'),
(2, 'Selasa'),
(1, 'Senin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `guru_id` bigint(20) UNSIGNED NOT NULL,
  `mapel_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `hari_id` bigint(20) UNSIGNED NOT NULL,
  `jam_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `guru_id`, `mapel_id`, `kelas_id`, `hari_id`, `jam_id`, `tahun_ajaran_id`, `created_at`, `updated_at`) VALUES
(5, 2, 1, 7, 5, 3, 1, '2026-11-09 09:34:26', '2026-11-09 09:34:26'),
(6, 2, 5, 7, 4, 1, 1, '2026-11-09 09:34:48', '2026-11-09 09:34:48'),
(8, 2, 1, 8, 2, 4, 1, '2026-11-09 10:44:38', '2026-11-09 10:44:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_pelajaran`
--

CREATE TABLE `jam_pelajaran` (
  `id_jam_pelajaran` bigint(20) UNSIGNED NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jam_pelajaran`
--

INSERT INTO `jam_pelajaran` (`id_jam_pelajaran`, `jam_mulai`, `jam_selesai`, `urutan`) VALUES
(1, '07:15:00', '07:55:00', 1),
(2, '07:55:00', '08:35:00', 2),
(3, '08:35:00', '09:15:00', 3),
(4, '09:30:00', '10:10:00', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL DEFAULT 'Umum',
  `guru_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_acc_tu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tingkat`, `jurusan`, `guru_id`, `is_acc_tu`, `created_at`, `updated_at`) VALUES
(7, 'VII A', '7', 'Umum', 1, 0, '2026-11-09 09:32:07', '2026-11-09 10:14:44'),
(8, 'VII B', '7', 'Umum', 3, 0, '2026-11-09 17:28:16', '2026-11-09 10:41:32'),
(9, 'VIII A', '8', 'Umum', NULL, 0, '2026-11-09 17:28:16', '2026-11-09 17:28:16'),
(10, 'VIII B', '8', 'Umum', NULL, 0, '2026-11-09 17:28:16', '2026-11-09 17:28:16'),
(11, 'IX A', '9', 'Umum', NULL, 0, '2026-11-09 17:28:16', '2026-11-09 17:28:16'),
(12, 'IX B', '9', 'Umum', NULL, 0, '2026-11-09 17:28:16', '2026-11-09 17:28:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id_kelas_siswa` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Aktif','Lulus','Pindah','Tinggal Kelas') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` bigint(20) UNSIGNED NOT NULL,
  `kode_mapel` varchar(50) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `kkm` int(11) NOT NULL DEFAULT 75,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `kode_mapel`, `nama_mapel`, `kkm`, `created_at`, `updated_at`) VALUES
(1, 'MP-IPA', 'Ilmu Pengetahuan Alam (IPA)', 75, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, 'MP-MTK', 'Matematika', 75, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(3, 'MP-BINDO', 'Bahasa Indonesia', 78, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(4, 'MP-BING', 'Bahasa Inggris', 75, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(5, 'MP-PAI', 'Pendidikan Agama Islam', 80, '2026-11-04 14:14:59', '2026-11-04 14:14:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL DEFAULT 'App\\Models\\User',
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilais`
--

CREATE TABLE `nilais` (
  `id_nilai` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint(20) UNSIGNED NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL DEFAULT 'Ganjil',
  `nilai_pengetahuan` int(11) NOT NULL DEFAULT 0,
  `nilai_keterampilan` int(11) NOT NULL DEFAULT 0,
  `nilai_sikap` varchar(10) NOT NULL DEFAULT 'B',
  `nilai_akhir` decimal(5,2) NOT NULL DEFAULT 0.00,
  `deskripsi` text DEFAULT NULL,
  `is_acc_tu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilais`
--

INSERT INTO `nilais` (`id_nilai`, `siswa_id`, `jadwal_id`, `tahun_ajaran_id`, `semester`, `nilai_pengetahuan`, `nilai_keterampilan`, `nilai_sikap`, `nilai_akhir`, `deskripsi`, `is_acc_tu`, `created_at`, `updated_at`) VALUES
(5, 1, 5, 1, 'Ganjil', 78, 85, 'B', 81.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 0, '2026-11-09 09:37:33', '2026-11-09 10:14:44'),
(6, 2, 5, 1, 'Ganjil', 86, 85, 'A', 85.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 0, '2026-11-09 16:53:33', '2026-11-09 10:14:44'),
(7, 1, 6, 1, 'Ganjil', 70, 85, 'C', 77.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 0, '2026-11-09 09:55:38', '2026-11-09 10:14:44'),
(8, 2, 6, 1, 'Ganjil', 85, 85, 'B', 85.00, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 0, '2026-11-09 09:55:38', '2026-11-09 10:14:44'),
(9, 4, 8, 1, 'Ganjil', 80, 85, 'B', 82.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 0, '2026-11-12 08:12:34', '2026-11-12 08:12:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `guard_name` varchar(50) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Tata Usaha', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, 'Guru', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(3, 'Wali Kelas', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(4, 'Siswa', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nis` varchar(50) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(50) NOT NULL DEFAULT 'Islam',
  `kewarganegaraan` varchar(50) NOT NULL DEFAULT 'Indonesia',
  `anak_ke` varchar(10) DEFAULT NULL,
  `jumlah_saudara_kandung` int(11) NOT NULL DEFAULT 0,
  `jumlah_saudara_tiri` int(11) NOT NULL DEFAULT 0,
  `jumlah_saudara_angkat` int(11) NOT NULL DEFAULT 0,
  `bahasa_sehari_hari` varchar(100) NOT NULL DEFAULT 'Bahasa Indonesia',
  `alamat` text DEFAULT NULL,
  `desa` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(20) DEFAULT NULL,
  `jarak_ke_sekolah` varchar(50) DEFAULT NULL,
  `tinggal_dengan` varchar(50) DEFAULT NULL,
  `transportasi` varchar(50) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `golongan_darah` varchar(10) DEFAULT NULL,
  `penyakit` varchar(100) DEFAULT NULL,
  `penyakit_pernah_diderita` text DEFAULT NULL,
  `kelainan_jasmani` varchar(100) DEFAULT NULL,
  `tinggi_badan` varchar(20) DEFAULT NULL,
  `berat_badan` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id_siswa`, `user_id`, `kelas_id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `kewarganegaraan`, `anak_ke`, `jumlah_saudara_kandung`, `jumlah_saudara_tiri`, `jumlah_saudara_angkat`, `bahasa_sehari_hari`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `jarak_ke_sekolah`, `tinggal_dengan`, `transportasi`, `telepon`, `golongan_darah`, `penyakit`, `penyakit_pernah_diderita`, `kelainan_jasmani`, `tinggi_badan`, `berat_badan`, `created_at`, `updated_at`) VALUES
(1, 4, 7, '24001', '0091234567', 'Ahmad Pratama', 'L', 'Lampung Tengah', '2011-04-12', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jl. Merdeka No. 12', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', NULL, NULL, NULL, NULL, '0812345678910', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-04 14:14:59', '2026-11-09 09:32:32'),
(2, 5, 7, '24002', '0091234568', 'Siti Nurhaliza', 'P', 'Metro', '2011-09-20', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jl. Sudirman No. 45', 'Simbarwaringin', 'Trimurjo', 'Lampung Tengah', 'Lampung', NULL, NULL, NULL, NULL, '0812345678910', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-04 14:14:59', '2026-11-09 09:32:49'),
(3, 6, 7, '24003', '0091234590', 'Nela Safitri', 'P', 'Bogor, Jakarta', '2010-03-13', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jalan Batu tinggi, Rt 12/Rw 10, lampung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08123243654', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-09 10:13:28', '2026-11-09 10:35:49'),
(4, 7, 8, '24004', '0091234593', 'Sefa Andita', 'P', 'Nuban, Lampung', '2011-01-01', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jalan Nimas, Lampung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08987654321', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-09 10:34:15', '2026-11-09 10:34:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `semester_aktif` enum('Ganjil','Genap') NOT NULL DEFAULT 'Ganjil',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun`, `semester_aktif`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2025/2026', 'Ganjil', 1, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, '2024/2025', 'Genap', 0, '2026-11-04 14:14:59', '2026-11-04 14:14:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Staf Tata Usaha', 'tu@smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'itpy2ScTEM8TvPB6WfyCPFw8DCMvSsT7fXQjXAypo0lcNitNbo1AKgDPPoWv', '2026-11-04 14:14:59', '2026-11-13 01:09:14'),
(2, 'Istri Sugiyatmi, S.Pd.', 'sugiyatmi@smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DPhA12iW2BqLSzHxzYil861KgZJGrT0fhiVtC1DZokQ1MtW3L31ybWI6DzSt', '2026-11-04 14:14:59', '2026-11-12 15:09:42'),
(3, 'Budi Santoso, S.Pd.', 'budi@smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uPd11v0HpCeVxPH58R8zAbG7rIh0cuaBEJZ4hlpoVZgxsAaDiPuK0XKaTAU9', '2026-11-04 14:14:59', '2026-11-13 01:02:57'),
(4, 'Ahmad Pratama', '0091234567@siswa.smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qdbh1ombb6oi4ttzzA9pxE17788yn61LPJxMX0w3g9l5xz4VxPKSOK4rkvYE', '2026-11-04 14:14:59', '2026-11-13 01:05:02'),
(5, 'Siti Nurhaliza', '0091234568@siswa.smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-11-04 14:14:59', '2026-11-09 08:53:27'),
(6, 'Nela Safitri', '0091234590@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$jhWILPt1AX3oKXVvhp67KOir5icIacUCqiaF0cMar0wR5UyCdANk.', 'f4vsDBGKtpv0OiVjqHeEKs7VdbpcFmSg01VslIUwb4FsuEsTK4fZF6yN62pQ', '2026-11-09 10:13:27', '2026-11-09 17:14:01'),
(7, 'Sefa Andita', '0091234593@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$AqTwBcrRdyDDUFdeGUEiKuppVwCU1KKE/fQt0N3Z5Jj01Ax1u33v6', 'EWSPkwukAabpfmpBY4vVOxnKQDuXXqEb8RT9XDqBOWdTD3kyB54jedyxp533', '2026-11-09 10:34:15', '2026-11-09 17:35:14'),
(8, 'Arya Pratama, S.Pd', 'aryapratama19@gmail.com', NULL, '$2y$12$GwaoQh/X.bU3fPtChwAojOnwPORs.N.YhvlItVNymfx3LVZGkOvDa', 'hIbQHWDdW7cjojR1kceZXU9GF05kFk2j67MwhCY4Wyp3pZrjePMLCgoaDwBw', '2026-11-09 10:39:52', '2026-11-12 15:18:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `fk_guru_user` (`user_id`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`),
  ADD UNIQUE KEY `nama_hari` (`nama_hari`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_jadwal_guru` (`guru_id`),
  ADD KEY `fk_jadwal_mapel` (`mapel_id`),
  ADD KEY `fk_jadwal_kelas` (`kelas_id`),
  ADD KEY `fk_jadwal_hari` (`hari_id`),
  ADD KEY `fk_jadwal_jam` (`jam_id`),
  ADD KEY `fk_jadwal_tahun` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `jam_pelajaran`
--
ALTER TABLE `jam_pelajaran`
  ADD PRIMARY KEY (`id_jam_pelajaran`),
  ADD UNIQUE KEY `urutan` (`urutan`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `fk_kelas_walikelas` (`guru_id`);

--
-- Indeks untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id_kelas_siswa`),
  ADD UNIQUE KEY `uk_siswa_tahun` (`siswa_id`,`tahun_ajaran_id`),
  ADD KEY `fk_ks_kelas` (`kelas_id`),
  ADD KEY `fk_ks_tahun` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`),
  ADD UNIQUE KEY `kode_mapel` (`kode_mapel`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `fk_nilai_siswa` (`siswa_id`),
  ADD KEY `fk_nilai_jadwal` (`jadwal_id`),
  ADD KEY `fk_nilai_tahun` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `fk_siswa_user` (`user_id`),
  ADD KEY `fk_siswa_kelas` (`kelas_id`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jam_pelajaran`
--
ALTER TABLE `jam_pelajaran`
  MODIFY `id_jam_pelajaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id_kelas_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mata_pelajaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id_nilai` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_guru_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_hari` FOREIGN KEY (`hari_id`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_jam` FOREIGN KEY (`jam_id`) REFERENCES `jam_pelajaran` (`id_jam_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_mapel` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_tahun` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_kelas_walikelas` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id_guru`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `fk_ks_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ks_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ks_tahun` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `fk_mhr_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mhr_user` FOREIGN KEY (`model_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD CONSTRAINT `fk_nilai_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_tahun` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `fk_siswa_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_siswa_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
