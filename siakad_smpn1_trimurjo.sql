-- SIAKAD SMP Negeri 1 Trimurjo Database Dump (Updated with 34+ Siswa, 6 Guru, Jadwal & Nilai)
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `guru` (
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

CREATE TABLE IF NOT EXISTS `hari` (
  `id_hari` bigint(20) UNSIGNED NOT NULL,
  `nama_hari` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `jadwal` (
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

CREATE TABLE IF NOT EXISTS `jam_pelajaran` (
  `id_jam_pelajaran` bigint(20) UNSIGNED NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL DEFAULT 'Umum',
  `guru_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_acc_tu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `kelas_siswa` (
  `id_kelas_siswa` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Aktif','Lulus','Pindah','Tinggal Kelas') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `id_mata_pelajaran` bigint(20) UNSIGNED NOT NULL,
  `kode_mapel` varchar(50) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `kkm` int(11) NOT NULL DEFAULT 75,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL DEFAULT 'App\\Models\\User',
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `nilais` (
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

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `guard_name` varchar(50) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `siswas` (
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

CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `semester_aktif` enum('Ganjil','Genap') NOT NULL DEFAULT 'Ganjil',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Tata Usaha', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, 'Guru', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(3, 'Wali Kelas', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(4, 'Siswa', 'web', '2026-11-04 14:14:59', '2026-11-04 14:14:59');

INSERT INTO `users` (`id_user`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Staf Tata Usaha', 'tu@smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'eczVRiINHqI7sGv3xYRVXDguPFZtCQV3rQBHsKO6jofGqgbFuZvew7XnrqHK', '2026-11-04 14:14:59', '2026-11-24 15:09:21'),
(2, 'Istri Sugiyatmi, S.Pd.', 'sugiyatmi@smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'P65CtQYoyJJ979kYq1E8f3aMSj54eAOGAKuFLAsYeRWePHiWyvAa3gL1JsbG', '2026-11-04 14:14:59', '2026-11-24 14:28:22'),
(3, 'Budi Santoso, S.Pd.', 'budi@smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wq2vap10DZSroGOgWc4M769zATJUG3HhvNcSJDVTMpprTzKYgotxMyAXSmxN', '2026-11-04 14:14:59', '2026-11-24 14:26:50'),
(4, 'Ahmad Pratama', '0091234567@siswa.smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jUrDBXKLkFSIpYRuAr59ULlnQzJc0Ro5tGd9jAjIbq7kvF7CjsLDaX68fnZ2', '2026-11-04 14:14:59', '2026-11-24 14:25:02'),
(5, 'Siti Nurhaliza', '0091234568@siswa.smpn1trimurjo.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2026-11-04 14:14:59', '2026-11-09 08:53:27'),
(6, 'Nela Safitri', '0091234590@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$jhWILPt1AX3oKXVvhp67KOir5icIacUCqiaF0cMar0wR5UyCdANk.', 'f4vsDBGKtpv0OiVjqHeEKs7VdbpcFmSg01VslIUwb4FsuEsTK4fZF6yN62pQ', '2026-11-09 10:13:27', '2026-11-09 17:14:01'),
(7, 'Sefa Andita', '0091234593@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$AqTwBcrRdyDDUFdeGUEiKuppVwCU1KKE/fQt0N3Z5Jj01Ax1u33v6', 'EWSPkwukAabpfmpBY4vVOxnKQDuXXqEb8RT9XDqBOWdTD3kyB54jedyxp533', '2026-11-09 10:34:15', '2026-11-09 17:35:14'),
(8, 'Arya Pratama, S.Pd', 'aryapratama19@gmail.com', NULL, '$2y$12$GwaoQh/X.bU3fPtChwAojOnwPORs.N.YhvlItVNymfx3LVZGkOvDa', 'hIbQHWDdW7cjojR1kceZXU9GF05kFk2j67MwhCY4Wyp3pZrjePMLCgoaDwBw', '2026-11-09 10:39:52', '2026-11-12 15:18:10'),
(30002, 'Drs. Hendro Wibowo, M.Pd.', 'hendro@smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30003, 'Sri Wahyuni, S.Pd.', 'sri.wahyuni@smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30004, 'Rahmat Hidayat, S.Kom., M.T.', 'rahmat.hidayat@smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30005, 'Aditya Nugraha', 'aditya.nugraha@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30006, 'Annisa Rahmawati', 'annisa.rahmawati@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30007, 'Bayu Saputra', 'bayu.saputra@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30008, 'Cantika Dewi Lestari', 'cantika.dewi.lestari@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30009, 'Dimas Maulana', 'dimas.maulana@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30010, 'Eka Putri Handayani', 'eka.putri.handayani@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30011, 'Fajar Alamsyah', 'fajar.alamsyah@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30012, 'Gita Gutawa Putri', 'gita.gutawa.putri@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30013, 'Hafiz Rizky Pratama', 'hafiz.rizky.pratama@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30014, 'Indah Permata Sari', 'indah.permata.sari@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30015, 'Joko Tri Atmojo', 'joko.tri.atmojo@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30016, 'Kurnia Anggraini', 'kurnia.anggraini@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30017, 'Lucky Firmansyah', 'lucky.firmansyah@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30018, 'Mega Utami', 'mega.utami@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30019, 'Naufal Izzudin', 'naufal.izzudin@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30020, 'Oki Setiana', 'oki.setiana@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30021, 'Panji Gemilang', 'panji.gemilang@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30022, 'Qonita Mufidah', 'qonita.mufidah@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30023, 'Rian Kurniawan', 'rian.kurniawan@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30024, 'Safira Azzahra', 'safira.azzahra@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30025, 'Tegar Prasetyo', 'tegar.prasetyo@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30026, 'Ulfa Nur Azizah', 'ulfa.nur.azizah@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30027, 'Vino Bastian', 'vino.bastian@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30028, 'Winda Amalia', 'winda.amalia@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30029, 'Yusuf Habibi', 'yusuf.habibi@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30030, 'Zahra Amelia', 'zahra.amelia@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30031, 'Aldi Taher', 'aldi.taher@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30032, 'Bella Safira', 'bella.safira@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30033, 'Candra Wijaya', 'candra.wijaya@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30034, 'Dian Sastrowardoyo', 'dian.sastrowardoyo@siswa.smpn1trimurjo.sch.id', NULL, '$2y$12$Gy9OS/BCdBV2kRNtUyc1lOl2stP4KZtZRSFzietFFfiiqyFHqzOXq', NULL, '2026-11-25 14:17:28', '2026-11-25 14:17:28');

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 30002),
(3, 'App\\Models\\User', 30002),
(2, 'App\\Models\\User', 30003),
(3, 'App\\Models\\User', 30003),
(2, 'App\\Models\\User', 30004),
(3, 'App\\Models\\User', 30004),
(4, 'App\\Models\\User', 30005),
(4, 'App\\Models\\User', 30006),
(4, 'App\\Models\\User', 30007),
(4, 'App\\Models\\User', 30008),
(4, 'App\\Models\\User', 30009),
(4, 'App\\Models\\User', 30010),
(4, 'App\\Models\\User', 30011),
(4, 'App\\Models\\User', 30012),
(4, 'App\\Models\\User', 30013),
(4, 'App\\Models\\User', 30014),
(4, 'App\\Models\\User', 30015),
(4, 'App\\Models\\User', 30016),
(4, 'App\\Models\\User', 30017),
(4, 'App\\Models\\User', 30018),
(4, 'App\\Models\\User', 30019),
(4, 'App\\Models\\User', 30020),
(4, 'App\\Models\\User', 30021),
(4, 'App\\Models\\User', 30022),
(4, 'App\\Models\\User', 30023),
(4, 'App\\Models\\User', 30024),
(4, 'App\\Models\\User', 30025),
(4, 'App\\Models\\User', 30026),
(4, 'App\\Models\\User', 30027),
(4, 'App\\Models\\User', 30028),
(4, 'App\\Models\\User', 30029),
(4, 'App\\Models\\User', 30030),
(4, 'App\\Models\\User', 30031),
(4, 'App\\Models\\User', 30032),
(4, 'App\\Models\\User', 30033),
(4, 'App\\Models\\User', 30034);

INSERT INTO `guru` (`id_guru`, `user_id`, `nip`, `nama_guru`, `jenis_kelamin`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 2, 197508122005012003, 'Istri Sugiyatmi, S.Pd.', 'P', '081234567890', 'Trimurjo, Lampung Tengah', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, 3, 198203152008021004, 'Budi Santoso, S.Pd.', 'L', '081398765432', 'Metro, Lampung', '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(3, 8, 197801221995111006, 'Arya Pratama, S.Pd', 'L', NULL, 'Bandar Lampung', '2026-11-09 10:39:52', '2026-11-09 10:39:52'),
(30002, 30002, 197604122003121002, 'Drs. Hendro Wibowo, M.Pd.', 'L', '081281492785', 'Trimurjo, Lampung Tengah', '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30003, 30003, 198109252006042015, 'Sri Wahyuni, S.Pd.', 'P', '081260894546', 'Trimurjo, Lampung Tengah', '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30004, 30004, 198503102009011008, 'Rahmat Hidayat, S.Kom., M.T.', 'L', '081280770570', 'Trimurjo, Lampung Tengah', '2026-11-25 14:17:28', '2026-11-25 14:17:28');

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `kode_mapel`, `nama_mapel`, `kkm`, `created_at`, `updated_at`) VALUES
(1, 'MP-IPA', 'Ilmu Pengetahuan Alam (IPA)', 75, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, 'MP-MTK', 'Matematika', 75, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(3, 'MP-BINDO', 'Bahasa Indonesia', 78, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(4, 'MP-BING', 'Bahasa Inggris', 75, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(5, 'MP-PAI', 'Pendidikan Agama Islam', 80, '2026-11-04 14:14:59', '2026-11-04 14:14:59');

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tingkat`, `jurusan`, `guru_id`, `is_acc_tu`, `created_at`, `updated_at`) VALUES
(7, 'VII A', 7, 'Umum', 1, 1, '2026-11-09 09:32:07', '2026-11-20 02:22:25'),
(8, 'VII B', 7, 'Umum', 3, 0, '2026-11-09 17:28:16', '2026-11-09 10:41:32'),
(9, 'VIII A', 8, 'Umum', 30002, 0, '2026-11-09 17:28:16', '2026-11-25 14:17:28'),
(10, 'VIII B', 8, 'Umum', 30003, 0, '2026-11-09 17:28:16', '2026-11-25 14:17:28'),
(11, 'IX A', 9, 'Umum', 30004, 0, '2026-11-09 17:28:16', '2026-11-25 14:17:28'),
(12, 'IX B', 9, 'Umum', NULL, 0, '2026-11-09 17:28:16', '2026-11-09 17:28:16');

INSERT INTO `siswas` (`id_siswa`, `user_id`, `kelas_id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `kewarganegaraan`, `anak_ke`, `jumlah_saudara_kandung`, `jumlah_saudara_tiri`, `jumlah_saudara_angkat`, `bahasa_sehari_hari`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `jarak_ke_sekolah`, `tinggal_dengan`, `transportasi`, `telepon`, `golongan_darah`, `penyakit`, `penyakit_pernah_diderita`, `kelainan_jasmani`, `tinggi_badan`, `berat_badan`, `created_at`, `updated_at`) VALUES
(1, 4, 7, 24001, '0091234567', 'Ahmad Pratama', 'L', 'Lampung Tengah', '2011-04-12', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jl. Merdeka No. 12', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', NULL, NULL, NULL, NULL, '0812345678910', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-04 14:14:59', '2026-11-09 09:32:32'),
(2, 5, 7, 24002, '0091234568', 'Siti Nurhaliza', 'P', 'Metro', '2011-09-20', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jl. Sudirman No. 45', 'Simbarwaringin', 'Trimurjo', 'Lampung Tengah', 'Lampung', NULL, NULL, NULL, NULL, '0812345678910', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-04 14:14:59', '2026-11-09 09:32:49'),
(3, 6, 7, 24003, '0091234590', 'Nela Safitri', 'P', 'Bogor, Jakarta', '2010-03-13', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jalan Batu tinggi, Rt 12/Rw 10, lampung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08123243654', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-09 10:13:28', '2026-11-09 10:35:49'),
(4, 7, 8, 24004, '0091234593', 'Sefa Andita', 'P', 'Nuban, Lampung', '2011-01-01', 'Islam', 'Indonesia', NULL, 0, 0, 0, 'Bahasa Indonesia', 'Jalan Nimas, Lampung', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08987654321', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-09 10:34:15', '2026-11-09 10:34:15'),
(30002, 30005, 7, 24005, '0092100001', 'Aditya Nugraha', 'L', 'Lampung Tengah', '2010-04-01', 'Islam', 'WNI', 2, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 67, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '2 km', 'Orang Tua', 'Sepeda Motor', '082161570113', 'O', NULL, NULL, NULL, 159, 54, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30003, 30006, 7, 24006, '0092100002', 'Annisa Rahmawati', 'P', 'Lampung Tengah', '2010-11-13', 'Islam', 'WNI', 1, 1, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 23, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '1 km', 'Orang Tua', 'Sepeda Motor', '082178170886', 'O', NULL, NULL, NULL, 147, 40, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30004, 30007, 7, 24007, '0092100003', 'Bayu Saputra', 'L', 'Lampung Tengah', '2010-04-22', 'Islam', 'WNI', 2, 1, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 79, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '4 km', 'Orang Tua', 'Sepeda Motor', '082170630310', 'B', NULL, NULL, NULL, 161, 48, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30005, 30008, 7, 24008, '0092100004', 'Cantika Dewi Lestari', 'P', 'Lampung Tengah', '2010-06-27', 'Islam', 'WNI', 1, 1, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 94, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '2 km', 'Orang Tua', 'Sepeda Motor', '082148068813', 'B', NULL, NULL, NULL, 170, 51, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30006, 30009, 7, 24009, '0092100005', 'Dimas Maulana', 'L', 'Lampung Tengah', '2010-06-18', 'Islam', 'WNI', 1, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 58, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '5 km', 'Orang Tua', 'Sepeda Motor', '082134676224', 'O', NULL, NULL, NULL, 155, 40, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30007, 30010, 8, 24010, '0092100006', 'Eka Putri Handayani', 'P', 'Lampung Tengah', '2010-01-22', 'Islam', 'WNI', 2, 2, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 84, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '5 km', 'Orang Tua', 'Sepeda Motor', '082168038125', 'O', NULL, NULL, NULL, 145, 56, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30008, 30011, 8, 24011, '0092100007', 'Fajar Alamsyah', 'L', 'Lampung Tengah', '2010-05-05', 'Islam', 'WNI', 3, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 62, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '5 km', 'Orang Tua', 'Sepeda Motor', '082153064429', 'A', NULL, NULL, NULL, 148, 48, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30009, 30012, 8, 24012, '0092100008', 'Gita Gutawa Putri', 'P', 'Lampung Tengah', '2010-06-26', 'Islam', 'WNI', 3, 3, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 62, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '2 km', 'Orang Tua', 'Sepeda Motor', '082193578782', 'O', NULL, NULL, NULL, 149, 54, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30010, 30013, 8, 24013, '0092100009', 'Hafiz Rizky Pratama', 'L', 'Lampung Tengah', '2010-09-10', 'Islam', 'WNI', 2, 1, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 1, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '2 km', 'Orang Tua', 'Sepeda Motor', '082173752120', 'B', NULL, NULL, NULL, 147, 47, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30011, 30014, 8, 24014, '0092100010', 'Indah Permata Sari', 'P', 'Lampung Tengah', '2010-04-18', 'Islam', 'WNI', 2, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 98, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '1 km', 'Orang Tua', 'Sepeda Motor', '082156480452', 'A', NULL, NULL, NULL, 145, 40, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30012, 30015, 9, 23015, '0082100011', 'Joko Tri Atmojo', 'L', 'Lampung Tengah', '2010-09-14', 'Islam', 'WNI', 3, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 58, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082122342956', 'AB', NULL, NULL, NULL, 147, 41, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30013, 30016, 9, 23016, '0082100012', 'Kurnia Anggraini', 'P', 'Lampung Tengah', '2010-08-28', 'Islam', 'WNI', 2, 3, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 86, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '1 km', 'Orang Tua', 'Sepeda Motor', '082118586332', 'O', NULL, NULL, NULL, 165, 56, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30014, 30017, 9, 23017, '0082100013', 'Lucky Firmansyah', 'L', 'Lampung Tengah', '2010-06-27', 'Islam', 'WNI', 3, 3, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 4, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '5 km', 'Orang Tua', 'Sepeda Motor', '082185575234', 'O', NULL, NULL, NULL, 159, 41, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30015, 30018, 9, 23018, '0082100014', 'Mega Utami', 'P', 'Lampung Tengah', '2010-06-14', 'Islam', 'WNI', 2, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 49, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082165417411', 'B', NULL, NULL, NULL, 155, 52, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30016, 30019, 9, 23019, '0082100015', 'Naufal Izzudin', 'L', 'Lampung Tengah', '2010-04-02', 'Islam', 'WNI', 2, 3, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 35, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '4 km', 'Orang Tua', 'Sepeda Motor', '082143260153', 'B', NULL, NULL, NULL, 156, 56, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30017, 30020, 10, 23020, '0082100016', 'Oki Setiana', 'P', 'Lampung Tengah', '2010-02-10', 'Islam', 'WNI', 3, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 28, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082147894127', 'O', NULL, NULL, NULL, 147, 54, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30018, 30021, 10, 23021, '0082100017', 'Panji Gemilang', 'L', 'Lampung Tengah', '2010-03-13', 'Islam', 'WNI', 3, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 94, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082140560248', 'AB', NULL, NULL, NULL, 150, 46, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30019, 30022, 10, 23022, '0082100018', 'Qonita Mufidah', 'P', 'Lampung Tengah', '2010-06-27', 'Islam', 'WNI', 3, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 12, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '5 km', 'Orang Tua', 'Sepeda Motor', '082111046797', 'B', NULL, NULL, NULL, 161, 48, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30020, 30023, 10, 23023, '0082100019', 'Rian Kurniawan', 'L', 'Lampung Tengah', '2010-12-26', 'Islam', 'WNI', 1, 2, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 43, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '2 km', 'Orang Tua', 'Sepeda Motor', '082126493046', 'O', NULL, NULL, NULL, 156, 53, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30021, 30024, 10, 23024, '0082100020', 'Safira Azzahra', 'P', 'Lampung Tengah', '2010-01-02', 'Islam', 'WNI', 2, 3, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 3, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '4 km', 'Orang Tua', 'Sepeda Motor', '082157299798', 'O', NULL, NULL, NULL, 147, 59, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30022, 30025, 11, 22025, '0072100021', 'Tegar Prasetyo', 'L', 'Lampung Tengah', '2010-03-20', 'Islam', 'WNI', 1, 3, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 11, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082137404214', 'AB', NULL, NULL, NULL, 156, 42, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30023, 30026, 11, 22026, '0072100022', 'Ulfa Nur Azizah', 'P', 'Lampung Tengah', '2010-05-23', 'Islam', 'WNI', 2, 1, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 68, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082174397837', 'A', NULL, NULL, NULL, 166, 44, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30024, 30027, 11, 22027, '0072100023', 'Vino Bastian', 'L', 'Lampung Tengah', '2010-07-03', 'Islam', 'WNI', 1, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 95, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '4 km', 'Orang Tua', 'Sepeda Motor', '082164965605', 'A', NULL, NULL, NULL, 145, 42, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30025, 30028, 11, 22028, '0072100024', 'Winda Amalia', 'P', 'Lampung Tengah', '2010-03-16', 'Islam', 'WNI', 3, 2, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 44, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082171395161', 'A', NULL, NULL, NULL, 167, 57, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30026, 30029, 11, 22029, '0072100025', 'Yusuf Habibi', 'L', 'Lampung Tengah', '2010-06-06', 'Islam', 'WNI', 1, 3, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 29, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082113621752', 'A', NULL, NULL, NULL, 146, 43, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30027, 30030, 12, 22030, '0072100026', 'Zahra Amelia', 'P', 'Lampung Tengah', '2010-05-08', 'Islam', 'WNI', 2, 2, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 78, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082162575725', 'O', NULL, NULL, NULL, 159, 51, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30028, 30031, 12, 22031, '0072100027', 'Aldi Taher', 'L', 'Lampung Tengah', '2010-04-14', 'Islam', 'WNI', 2, 4, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 24, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '4 km', 'Orang Tua', 'Sepeda Motor', '082143148912', 'A', NULL, NULL, NULL, 160, 43, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30029, 30032, 12, 22032, '0072100028', 'Bella Safira', 'P', 'Lampung Tengah', '2010-10-13', 'Islam', 'WNI', 2, 2, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 46, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '1 km', 'Orang Tua', 'Sepeda Motor', '082148401977', 'AB', NULL, NULL, NULL, 160, 49, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30030, 30033, 12, 22033, '0072100029', 'Candra Wijaya', 'L', 'Lampung Tengah', '2010-02-25', 'Islam', 'WNI', 2, 2, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 38, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '1 km', 'Orang Tua', 'Sepeda Motor', '082144435565', 'B', NULL, NULL, NULL, 146, 49, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30031, 30034, 12, 22034, '0072100030', 'Dian Sastrowardoyo', 'P', 'Lampung Tengah', '2010-09-04', 'Islam', 'WNI', 3, 1, 0, 0, 'Indonesia / Jawa', 'Jl. Merdeka No. 16, Trimurjo', 'Trimurjo', 'Trimurjo', 'Lampung Tengah', 'Lampung', 34172, '3 km', 'Orang Tua', 'Sepeda Motor', '082154965188', 'AB', NULL, NULL, NULL, 156, 54, '2026-11-25 14:17:28', '2026-11-25 14:17:28');

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
(5, 'Jumat'),
(4, 'Kamis'),
(3, 'Rabu'),
(6, 'Sabtu'),
(2, 'Selasa'),
(1, 'Senin');

INSERT INTO `jam_pelajaran` (`id_jam_pelajaran`, `jam_mulai`, `jam_selesai`, `urutan`) VALUES
(1, '07:15:00', '07:55:00', 1),
(2, '07:55:00', '08:35:00', 2),
(3, '08:35:00', '09:15:00', 3),
(4, '09:30:00', '10:10:00', 4);

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun`, `semester_aktif`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2025/2026', 'Ganjil', 1, '2026-11-04 14:14:59', '2026-11-04 14:14:59'),
(2, '2024/2025', 'Genap', 0, '2026-11-04 14:14:59', '2026-11-04 14:14:59');

INSERT INTO `jadwal` (`id_jadwal`, `guru_id`, `mapel_id`, `kelas_id`, `hari_id`, `jam_id`, `tahun_ajaran_id`, `created_at`, `updated_at`) VALUES
(5, 2, 1, 7, 5, 3, 1, '2026-11-09 09:34:26', '2026-11-09 09:34:26'),
(6, 2, 5, 7, 4, 1, 1, '2026-11-09 09:34:48', '2026-11-09 09:34:48'),
(8, 2, 1, 8, 2, 4, 1, '2026-11-09 10:44:38', '2026-11-09 10:44:38'),
(30006, 2, 2, 7, 1, 1, 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30007, 1, 3, 7, 2, 2, 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30008, 3, 4, 7, 3, 1, 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30009, 2, 2, 8, 1, 2, 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30010, 1, 3, 8, 2, 3, 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28');

INSERT INTO `nilais` (`id_nilai`, `siswa_id`, `jadwal_id`, `tahun_ajaran_id`, `semester`, `nilai_pengetahuan`, `nilai_keterampilan`, `nilai_sikap`, `nilai_akhir`, `deskripsi`, `is_acc_tu`, `created_at`, `updated_at`) VALUES
(5, 1, 5, 1, 'Ganjil', 78, 85, 'B', 81.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 1, '2026-11-09 09:37:33', '2026-11-20 02:22:25'),
(6, 2, 5, 1, 'Ganjil', 86, 85, 'A', 85.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 1, '2026-11-09 16:53:33', '2026-11-20 02:22:25'),
(7, 1, 6, 1, 'Ganjil', 70, 85, 'C', 77.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 1, '2026-11-09 09:55:38', '2026-11-20 02:22:25'),
(8, 2, 6, 1, 'Ganjil', 85, 85, 'B', 85.00, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 1, '2026-11-09 09:55:38', '2026-11-20 02:22:25'),
(9, 4, 8, 1, 'Ganjil', 80, 85, 'B', 82.50, 'Menunjukkan penguasaan materi yang sangat baik dan aktif dalam diskusi kelompok.', 0, '2026-11-12 08:12:34', '2026-11-12 08:12:34'),
(30006, 3, 5, 1, 'Ganjil', 80, 80, 88, 82.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30007, 30002, 5, 1, 'Ganjil', 94, 85, 94, 90.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30008, 30003, 5, 1, 'Ganjil', 87, 88, 91, 88.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30009, 30004, 5, 1, 'Ganjil', 88, 94, 85, 90.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30010, 30005, 5, 1, 'Ganjil', 83, 78, 92, 83.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30011, 30006, 5, 1, 'Ganjil', 87, 79, 83, 83.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30012, 3, 6, 1, 'Ganjil', 88, 78, 81, 83.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30013, 30002, 6, 1, 'Ganjil', 94, 95, 84, 92.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30014, 30003, 6, 1, 'Ganjil', 86, 88, 89, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30015, 30004, 6, 1, 'Ganjil', 95, 94, 89, 93.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30016, 30005, 6, 1, 'Ganjil', 83, 88, 89, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30017, 30006, 6, 1, 'Ganjil', 90, 93, 91, 91.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30018, 30007, 8, 1, 'Ganjil', 90, 82, 89, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30019, 30008, 8, 1, 'Ganjil', 82, 78, 82, 80.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30020, 30009, 8, 1, 'Ganjil', 87, 96, 85, 90.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30021, 30010, 8, 1, 'Ganjil', 83, 89, 85, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30022, 30011, 8, 1, 'Ganjil', 81, 93, 92, 88.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30023, 1, 30006, 1, 'Ganjil', 90, 90, 86, 89.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30024, 2, 30006, 1, 'Ganjil', 83, 91, 84, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30025, 3, 30006, 1, 'Ganjil', 80, 92, 82, 85.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30026, 30002, 30006, 1, 'Ganjil', 83, 88, 93, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30027, 30003, 30006, 1, 'Ganjil', 83, 89, 88, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30028, 30004, 30006, 1, 'Ganjil', 82, 87, 95, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30029, 30005, 30006, 1, 'Ganjil', 87, 78, 81, 82.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30030, 30006, 30006, 1, 'Ganjil', 85, 87, 91, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30031, 1, 30007, 1, 'Ganjil', 90, 84, 80, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30032, 2, 30007, 1, 'Ganjil', 78, 91, 92, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30033, 3, 30007, 1, 'Ganjil', 78, 93, 83, 85.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30034, 30002, 30007, 1, 'Ganjil', 85, 94, 90, 90.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30035, 30003, 30007, 1, 'Ganjil', 81, 96, 86, 88.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30036, 30004, 30007, 1, 'Ganjil', 93, 89, 88, 90.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30037, 30005, 30007, 1, 'Ganjil', 88, 90, 80, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30038, 30006, 30007, 1, 'Ganjil', 82, 89, 91, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30039, 1, 30008, 1, 'Ganjil', 91, 96, 90, 93.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30040, 2, 30008, 1, 'Ganjil', 84, 89, 82, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30041, 3, 30008, 1, 'Ganjil', 88, 82, 93, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30042, 30002, 30008, 1, 'Ganjil', 80, 87, 91, 85.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30043, 30003, 30008, 1, 'Ganjil', 89, 85, 90, 88.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30044, 30004, 30008, 1, 'Ganjil', 92, 81, 88, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30045, 30005, 30008, 1, 'Ganjil', 93, 82, 89, 88.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30046, 30006, 30008, 1, 'Ganjil', 94, 92, 89, 92.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30047, 4, 30009, 1, 'Ganjil', 93, 88, 88, 90.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30048, 30007, 30009, 1, 'Ganjil', 90, 84, 90, 88.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30049, 30008, 30009, 1, 'Ganjil', 90, 96, 93, 93.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30050, 30009, 30009, 1, 'Ganjil', 87, 96, 93, 92.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30051, 30010, 30009, 1, 'Ganjil', 78, 81, 89, 81.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30052, 30011, 30009, 1, 'Ganjil', 76, 92, 95, 86.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30053, 4, 30010, 1, 'Ganjil', 93, 90, 86, 90.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30054, 30007, 30010, 1, 'Ganjil', 92, 93, 83, 91.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30055, 30008, 30010, 1, 'Ganjil', 77, 95, 91, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30056, 30009, 30010, 1, 'Ganjil', 89, 83, 90, 87.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30057, 30010, 30010, 1, 'Ganjil', 88, 95, 91, 91.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28'),
(30058, 30011, 30010, 1, 'Ganjil', 91, 78, 86, 85.00, 'Menunjukkan penguasaan kompetensi yang sangat baik dalam pembelajaran.', 1, '2026-11-25 14:17:28', '2026-11-25 14:17:28');

SET FOREIGN_KEY_CHECKS=1;
