import os
import base64
import subprocess
import sys

# Paths
base_dir = r"d:\SEMESTER 5\TUGAS UTS BASIS DATA LANJUT"
project_dir = os.path.join(base_dir, "siakad-smp")
logo_path = os.path.join(base_dir, "logo-sekolah.png")
relasi_path = os.path.join(base_dir, "FOTO", "relasi.jpg")
html_output = os.path.join(project_dir, "scripts", "laporan_uts.html")
pdf_output = os.path.join(project_dir, "LAPORAN_UTS_SIAKAD_SMPN1_TRIMURJO.pdf")

# Convert images to base64
def get_base64_image(path):
    if os.path.exists(path):
        with open(path, "rb") as f:
            return base64.b64encode(f.read()).decode('utf-8')
    return ""

logo_b64 = get_base64_image(logo_path)
relasi_b64 = get_base64_image(relasi_path)

html_content = f"""<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan UTS Basis Data Lanjut - SIAKAD SMPN 1 Trimurjo</title>
<style>
  @page {{
    size: A4;
    margin: 20mm 18mm 20mm 18mm;
    @bottom-center {{
      content: counter(page);
      font-size: 9pt;
      font-family: 'Segoe UI', Arial, sans-serif;
      color: #64748b;
    }}
  }}

  * {{
    box-sizing: border-box;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }}

  body {{
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, 'Helvetica Neue', Arial, sans-serif;
    font-size: 10.5pt;
    line-height: 1.6;
    color: #1e293b;
    background-color: #ffffff;
    margin: 0;
    padding: 0;
  }}

  /* Page Break Controls */
  .page-break {{
    page-break-before: always;
    break-before: page;
  }}

  .no-break {{
    page-break-inside: avoid;
    break-inside: avoid;
  }}

  /* Cover Page Styling */
  .cover-container {{
    min-height: 92vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    text-align: center;
    padding: 20px 10px;
    border: 3px double #0284c7;
    border-radius: 12px;
    background: linear-gradient(180deg, #f8fafc 0%, #f0f9ff 100%);
  }}

  .cover-inst-badge {{
    display: inline-block;
    padding: 6px 16px;
    background-color: #e0f2fe;
    color: #0369a1;
    font-size: 11pt;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    border-radius: 20px;
    border: 1px solid #bae6fd;
    margin-bottom: 8px;
  }}

  .cover-title-group h1 {{
    font-size: 20pt;
    font-weight: 800;
    color: #0f172a;
    margin: 8px 0;
    text-transform: uppercase;
    line-height: 1.3;
    letter-spacing: 0.5px;
  }}

  .cover-title-group h2 {{
    font-size: 14pt;
    font-weight: 700;
    color: #0284c7;
    margin: 6px 0 16px 0;
    text-transform: uppercase;
  }}

  .cover-subtitle {{
    font-size: 11.5pt;
    color: #334155;
    max-width: 650px;
    line-height: 1.5;
    margin: 0 auto;
    font-weight: 500;
  }}

  .cover-logo {{
    margin: 25px 0;
  }}

  .cover-logo img {{
    width: 140px;
    height: auto;
    filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
  }}

  .cover-meta {{
    width: 100%;
    max-width: 500px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 24px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    text-align: left;
    margin: 15px auto;
  }}

  .cover-meta table {{
    width: 100%;
    border-collapse: collapse;
    font-size: 10pt;
  }}

  .cover-meta td {{
    padding: 4px 8px;
    vertical-align: top;
  }}

  .cover-meta td.label {{
    font-weight: 600;
    color: #475569;
    width: 38%;
  }}

  .cover-meta td.val {{
    color: #0f172a;
    font-weight: 700;
  }}

  .cover-footer {{
    margin-top: 15px;
    font-size: 11pt;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.4;
  }}

  .cover-footer .dept {{
    color: #0369a1;
  }}

  /* Headings & Content */
  h1.bab-title {{
    font-size: 16pt;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 2.5px solid #0284c7;
    padding-bottom: 6px;
    margin-top: 25px;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }}

  h2.sub-title {{
    font-size: 12.5pt;
    font-weight: 700;
    color: #0369a1;
    margin-top: 20px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
  }}

  h3.sub-sub-title {{
    font-size: 11pt;
    font-weight: 700;
    color: #1e293b;
    margin-top: 14px;
    margin-bottom: 6px;
  }}

  p {{
    text-align: justify;
    margin: 0 0 10px 0;
  }}

  /* Highlight Cards & Callouts */
  .callout {{
    background-color: #f8fafc;
    border-left: 4px solid #0284c7;
    border-radius: 0 8px 8px 0;
    padding: 12px 16px;
    margin: 14px 0;
    font-size: 10pt;
  }}

  .callout-blue {{
    background-color: #f0f9ff;
    border-left-color: #0284c7;
  }}

  .callout-green {{
    background-color: #f0fdf4;
    border-left-color: #16a34a;
  }}

  /* Grid Cards */
  .grid-2 {{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin: 14px 0;
  }}

  .grid-4 {{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 10px;
    margin: 14px 0;
  }}

  .stat-card {{
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px;
    text-align: center;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }}

  .stat-card .num {{
    font-size: 18pt;
    font-weight: 800;
    color: #0284c7;
    margin-bottom: 2px;
  }}

  .stat-card .desc {{
    font-size: 9pt;
    font-weight: 600;
    color: #475569;
  }}

  .role-card {{
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 12px 14px;
    background-color: #ffffff;
  }}

  .role-header {{
    font-weight: 700;
    font-size: 10.5pt;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
  }}

  .role-tu {{ color: #b91c1c; border-top: 3px solid #b91c1c; }}
  .role-guru {{ color: #2563eb; border-top: 3px solid #2563eb; }}
  .role-walas {{ color: #d97706; border-top: 3px solid #d97706; }}
  .role-siswa {{ color: #16a34a; border-top: 3px solid #16a34a; }}

  /* Tables */
  table.data-table {{
    width: 100%;
    border-collapse: collapse;
    margin: 14px 0;
    font-size: 9.5pt;
    page-break-inside: avoid;
  }}

  table.data-table th {{
    background-color: #0f172a;
    color: #ffffff;
    font-weight: 600;
    text-align: left;
    padding: 8px 10px;
    border: 1px solid #0f172a;
  }}

  table.data-table td {{
    padding: 7px 10px;
    border: 1px solid #e2e8f0;
    vertical-align: middle;
  }}

  table.data-table tr:nth-child(even) {{
    background-color: #f8fafc;
  }}

  .badge {{
    display: inline-block;
    padding: 2px 7px;
    border-radius: 4px;
    font-size: 8pt;
    font-weight: 700;
    text-align: center;
  }}

  .badge-crud {{
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
  }}

  .badge-r {{
    background-color: #e0f2fe;
    color: #0369a1;
    border: 1px solid #bae6fd;
  }}

  .badge-cru {{
    background-color: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
  }}

  .badge-success {{
    background-color: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
  }}

  /* Math Box */
  .formula-box {{
    background-color: #0f172a;
    color: #38bdf8;
    padding: 14px 18px;
    border-radius: 8px;
    font-family: 'Consolas', 'Courier New', monospace;
    font-size: 11pt;
    text-align: center;
    margin: 14px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }}

  .formula-box span.math {{
    font-size: 13pt;
    font-weight: bold;
    color: #f8fafc;
  }}

  /* Diagram & Image Containers */
  .image-container {{
    text-align: center;
    margin: 16px 0;
    page-break-inside: avoid;
  }}

  .image-container img {{
    max-width: 95%;
    max-height: 420px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.08);
  }}

  .image-caption {{
    font-size: 9pt;
    color: #64748b;
    font-style: italic;
    margin-top: 6px;
  }}

  /* Code Block */
  pre.code-block {{
    background-color: #0f172a;
    color: #e2e8f0;
    padding: 10px 14px;
    border-radius: 6px;
    font-family: 'Consolas', monospace;
    font-size: 8.5pt;
    line-height: 1.45;
    overflow-x: auto;
    margin: 10px 0;
    page-break-inside: avoid;
  }}

  ul, ol {{
    margin: 6px 0 10px 0;
    padding-left: 22px;
  }}

  li {{
    margin-bottom: 4px;
    text-align: justify;
  }}

  /* Header & Footer on Content Pages */
  .doc-header {{
    border-bottom: 1px solid #cbd5e1;
    padding-bottom: 4px;
    margin-bottom: 16px;
    font-size: 8pt;
    color: #64748b;
    display: flex;
    justify-content: space-between;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }}
</style>
</head>
<body>

<!-- ==================== HALAMAN SAMPUL (COVER) ==================== -->
<div class="cover-container">
  <div>
    <div class="cover-inst-badge">TUGAS UJIAN TENGAH SEMESTER (UTS) BASIS DATA LANJUT</div>
    <div class="cover-title-group">
      <h1>LAPORAN PERANCANGAN & IMPLEMENTASI<br/>SISTEM INFORMASI AKADEMIK (SIAKAD)</h1>
      <h2>BERBASIS CLOUD DATABASE & ROLE-BASED ACCESS CONTROL (RBAC)</h2>
      <p class="cover-subtitle">
        Studi Kasus Digitalisasi Penilaian, Penjadwalan Bebas Bentrok, dan Pelaporan Kurikulum Merdeka pada <strong>SMP Negeri 1 Trimurjo</strong>, Kabupaten Lampung Tengah
      </p>
    </div>
  </div>

  <div class="cover-logo">
    <img src="data:image/png;base64,{logo_b64}" alt="Logo SMP Negeri 1 Trimurjo">
  </div>

  <div class="cover-meta">
    <table>
      <tr>
        <td class="label">Nama Penyusun</td>
        <td>:</td>
        <td class="val">SHOFIANA KARTIKA</td>
      </tr>
      <tr>
        <td class="label">NPM</td>
        <td>:</td>
        <td class="val">22430126</td>
      </tr>
      <tr>
        <td class="label">Mata Kuliah</td>
        <td>:</td>
        <td class="val">Basis Data Lanjut (Semester 5)</td>
      </tr>
      <tr>
        <td class="label">Program Studi</td>
        <td>:</td>
        <td class="val">Ilmu Komputer</td>
      </tr>
      <tr>
        <td class="label">Fakultas</td>
        <td>:</td>
        <td class="val">Fakultas Ilmu Komputer</td>
      </tr>
      <tr>
        <td class="label">Institusi</td>
        <td>:</td>
        <td class="val">Universitas Muhammadiyah Metro</td>
      </tr>
      <tr>
        <td class="label">Repositori GitHub</td>
        <td>:</td>
        <td class="val" style="font-size: 8.5pt;">auliasalsabila169-tech/SIAKAD-SMPN-1-TRIMURJO</td>
      </tr>
      <tr>
        <td class="label">Live URL</td>
        <td>:</td>
        <td class="val" style="color: #0284c7;">https://auliasalsabila.vercel.app</td>
      </tr>
    </table>
  </div>

  <div class="cover-footer">
    PROGRAM STUDI ILMU KOMPUTER &bull; FAKULTAS ILMU KOMPUTER<br/>
    <span class="dept">UNIVERSITAS MUHAMMADIYAH METRO</span><br/>
    TAHUN AKADEMIK 2026
  </div>
</div>

<!-- ==================== HALAMAN 2: RINGKASAN EKSEKUTIF ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>UNIVERSITAS MUHAMMADIYAH METRO</span>
</div>

<h1 class="bab-title">RINGKASAN EKSEKUTIF (ABSTRAK)</h1>

<p>
  Pengelolaan data akademik pada jenjang Sekolah Menengah Pertama yang masih mengandalkan pencatatan manual dan berkas kerja tersebar seringkali menghadapi persoalan klasik berupa keterlambatan kompilasi buku leger, ketidaksinkronan data nilai antar guru mata pelajaran, serta potensi konflik jadwal mengajar guru di ruang kelas.
</p>

<p>
  Laporan ini menyajikan perancangan dan implementasi <strong>Sistem Informasi Akademik (SIAKAD) SMP Negeri 1 Trimurjo</strong> berbasis web modern. Sistem dikembangkan menggunakan <em>framework</em> <strong>Laravel 11</strong> dengan arsitektur penyimpanan komputasi awan terdistribusi <strong>TiDB Serverless Cloud (MySQL Protocol)</strong> berstandar keamanan enkripsi TLS/SSL (<em>CA Certificate</em>). Sistem ini menerapkan mekanisme <strong>Role-Based Access Control (RBAC)</strong> yang membagi hak akses ke dalam 4 entitas pengguna (Tata Usaha, Guru Mapel, Wali Kelas, dan Siswa).
</p>

<div class="grid-4 no-break">
  <div class="stat-card">
    <div class="num">120</div>
    <div class="desc">Siswa Aktif (6 Rombel)</div>
  </div>
  <div class="stat-card">
    <div class="num">10</div>
    <div class="desc">Tenaga Pendidik (Guru)</div>
  </div>
  <div class="stat-card">
    <div class="num">60</div>
    <div class="desc">Jadwal KBM Bebas Bentrok</div>
  </div>
  <div class="stat-card">
    <div class="num">1,200</div>
    <div class="desc">Nilai Rapor Tervalidasi</div>
  </div>
</div>

<p>
  Inovasi utama dalam proyek ini mencakup penerapan algoritma <strong>Round-Robin Shift Modulo</strong> yang secara matematis membuktikan kondisi nol bentrok (<em>zero-conflict schedule</em>) pada penjadwalan KBM mingguan Senin hingga Jumat, pemenuhan standar normalisasi basis data (1NF, 2NF, 3NF), adopsi standar 94 atribut Buku Induk Siswa Kemendikbudristek, serta antarmuka ultra-responsif ponsel pintar (Tailwind CSS) yang dilengkapi bilah navigasi bawah (<em>bottom navigation</em>) dan fitur mode siang/malam (<em>day/night mode</em>).
</p>

<div class="callout callout-green no-break">
  <strong>Kata Kunci:</strong> Sistem Informasi Akademik, TiDB Cloud Serverless, Role-Based Access Control (RBAC), Normalisasi Basis Data, Round-Robin Zero Conflict Scheduling, Laravel 11.
</div>

<hr style="border: none; border-top: 1px solid #e2e8f0; margin: 20px 0;"/>

<h2 class="sub-title">DAFTAR ISI LAPORAN</h2>
<table style="width: 100%; font-size: 9.5pt; border-collapse: collapse;">
  <tr><td style="padding: 4px 0;"><strong>BAB I: PENDAHULUAN</strong></td><td style="text-align: right;">Hal. 3</td></tr>
  <tr><td style="padding: 2px 0 2px 15px; color: #64748b;">1.1 Latar Belakang & Profil Sekolah &bull; 1.2 Tujuan Proyek &bull; 1.3 Ruang Lingkup</td><td></td></tr>
  <tr><td style="padding: 4px 0;"><strong>BAB II: ANALISIS KEBUTUHAN & ROLE-BASED ACCESS CONTROL (RBAC)</strong></td><td style="text-align: right;">Hal. 4</td></tr>
  <tr><td style="padding: 2px 0 2px 15px; color: #64748b;">2.1 Karakteristik 4 Peran Aktor &bull; 2.2 Matriks Hak Akses & Operasi CRUD</td><td></td></tr>
  <tr><td style="padding: 4px 0;"><strong>BAB III: PERANCANGAN BASIS DATA RELASIONAL & NORMALISASI</strong></td><td style="text-align: right;">Hal. 5</td></tr>
  <tr><td style="padding: 2px 0 2px 15px; color: #64748b;">3.1 Diagram Relasi Entitas (ERD) &bull; 3.2 Spesifikasi Skema Tabel &bull; 3.3 Analisis 1NF, 2NF, 3NF</td><td></td></tr>
  <tr><td style="padding: 4px 0;"><strong>BAB IV: ALGORITMA PENJADWALAN KBM BEBAS BENTROK (SENIN - JUMAT)</strong></td><td style="text-align: right;">Hal. 6</td></tr>
  <tr><td style="padding: 2px 0 2px 15px; color: #64748b;">4.1 Struktur 10 Slot &bull; 4.2 Formulasi Shift Modulo & Pembuktian Matematis &bull; 4.3 Matriks Jadwal</td><td></td></tr>
  <tr><td style="padding: 4px 0;"><strong>BAB V: ARSITEKTUR TEKNOLOGI & IMPLEMENTASI SISTEM</strong></td><td style="text-align: right;">Hal. 7</td></tr>
  <tr><td style="padding: 2px 0 2px 15px; color: #64748b;">5.1 Cloud Database TiDB & SSL &bull; 5.2 Antarmuka Responsif Mobile & Fitur Cetak</td><td></td></tr>
  <tr><td style="padding: 4px 0;"><strong>BAB VI: HASIL IMPLEMENTASI, EVALUASI & AKUN PENGUJIAN</strong></td><td style="text-align: right;">Hal. 8</td></tr>
  <tr><td style="padding: 2px 0 2px 15px; color: #64748b;">6.1 Statistik Volume Data &bull; 6.2 Kredensial Demo &bull; 6.3 Pengujian Black Box</td><td></td></tr>
  <tr><td style="padding: 4px 0;"><strong>BAB VII: KESIMPULAN & REKOMENDASI PENGEMBANGAN</strong></td><td style="text-align: right;">Hal. 9</td></tr>
</table>

<!-- ==================== HALAMAN 3: BAB I PENDAHULUAN ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>BAB I: PENDAHULUAN</span>
</div>

<h1 class="bab-title">BAB I: PENDAHULUAN</h1>

<h2 class="sub-title">1.1 Latar Belakang Masalah</h2>
<p>
  SMP Negeri 1 Trimurjo merupakan institusi pendidikan formal tingkat menengah pertama yang berlokasi di Kecamatan Trimurjo, Kabupaten Lampung Tengah, Provinsi Lampung. Sekolah ini mengampu sekitar 890 siswa aktif dan didukung oleh 54 tenaga pengajar serta staf administrasi. Seiring dengan diberlakukannya Kurikulum Merdeka, mekanisme evaluasi pembelajaran menuntut pencatatan asesmen formatif, sumatif, capaian kompetensi per tujuan pembelajaran, serta penerbitan laporan hasil belajar secara berkala dan transparan.
</p>

<p>
  Berdasarkan hasil studi dan wawancara dengan pemangku kepentingan sekolah (di antaranya Ibu Istri Sugiyatmi, S.Pd. selaku perwakilan wali kelas dan Ibu Fildayana Ayu Ning Tyas, S.Pd. selaku staf tata usaha), teridentifikasi kendala mendasar pada operasional akademik berjalan:
</p>
<ol>
  <li><strong>Inkonsistensi dan Fragmentasi Data:</strong> Nilai siswa dicatat oleh masing-masing guru pengampu mata pelajaran dalam buku catatan atau lembar kerja lokal (Microsoft Excel). Hal ini memicu duplikasi data, risiko salah entri, dan kesulitan penelusuran jika terjadi perubahan nilai susulan.</li>
  <li><strong>Keterlambatan Kompilasi Buku Leger:</strong> Menjelang akhir semester, wali kelas harus mengumpulkan berkas nilai dari 10 guru mata pelajaran yang berbeda. Proses perakitan buku leger dan penghitungan ranking kelas dilakukan manual sehingga membutuhkan waktu berhari-hari.</li>
  <li><strong>Keterbatasan Akses Siswa & Orang Tua:</strong> Siswa tidak memiliki akses mandiri untuk melihat rekapitulasi capaian nilai dan jadwal belajar harian secara cepat melalui perangkat seluler.</li>
  <li><strong>Resiko Bentrok Jadwal KBM:</strong> Plotting jadwal mengajar manual sering memicu terjadinya guru yang terdaftar mengajar di dua kelas sekaligus pada jam pelajaran yang sama.</li>
</ol>

<h2 class="sub-title">1.2 Tujuan Proyek</h2>
<p>
  Tujuan utama dari perancangan dan implementasi proyek SIAKAD ini adalah:
</p>
<ol>
  <li>Merancang skema pangkalan data relasional (RDBMS) yang optimal, terstruktur, dan memenuhi standar normalisasi (1NF, 2NF, dan 3NF) untuk mencegah redundansi dan anomali data.</li>
  <li>Mengimplementasikan kontrol hak akses berbasis peran (<em>Role-Based Access Control / RBAC</em>) secara presisi bagi 4 kelompok pengguna (Tata Usaha, Guru Mapel, Wali Kelas, dan Siswa).</li>
  <li>Menyusun formulasi matematis distribusi jadwal KBM mingguan bebas bentrok (<em>zero-conflict schedule</em>) yang menjamin ketiadaan tabrakan jadwal antar 10 guru pada 6 rombel kelas.</li>
  <li>Membangun aplikasi web dengan arsitektur penyimpanan komputasi awan terdistribusi (<em>TiDB Serverless Cloud Database</em>) yang aman melalui jalur enkripsi SSL/TLS.</li>
  <li>Menyediakan antarmuka modern yang ultra-responsif terhadap smartphone serta modul cetak buku leger dan rapor digital yang rapi sesuai format standar dokumen fisik sekolah.</li>
</ol>

<h2 class="sub-title">1.3 Ruang Lingkup & Profil Objek Kasus</h2>
<ul>
  <li><strong>Entitas Pendidikan:</strong> SMP Negeri 1 Trimurjo, Kab. Lampung Tengah.</li>
  <li><strong>Rombongan Belajar Uji:</strong> 6 kelas reguler (Kelas VII A, VII B, VIII A, VIII B, IX A, dan IX B).</li>
  <li><strong>Populasi Data:</strong> 120 siswa aktif (tepat 20 siswa per kelas), 10 guru mata pelajaran dengan penugasan 6 wali kelas definitif, dan 10 mata pelajaran pokok SMP.</li>
  <li><strong>Periode Penilaian:</strong> Semester Ganjil Tahun Ajaran 2026/2027 dengan 1.200 total record nilai tervalidasi.</li>
</ul>

<!-- ==================== HALAMAN 4: BAB II RBAC ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>BAB II: ANALISIS KEBUTUHAN & RBAC</span>
</div>

<h1 class="bab-title">BAB II: ANALISIS KEBUTUHAN & ROLE-BASED ACCESS CONTROL (RBAC)</h1>

<h2 class="sub-title">2.1 Karakteristik 4 Peran Pengguna (Actors)</h2>
<p>
  Untuk memastikan tata kelola data yang aman dan akuntabel, hak otorisasi pengguna dibagi ke dalam 4 peran utama:
</p>

<div class="grid-2 no-break">
  <div class="role-card role-tu">
    <div class="role-header">🏛️ 1. TATA USAHA (ADMIN SEKOLAH)</div>
    <p style="font-size: 9pt; margin: 0;">
      Pengelola tertinggi pangkalan data. Bertanggung jawab atas integritas master data (Siswa, Guru, Kelas, Mapel). Memegang hak tunggal penyusunan jadwal KBM mingguan serta bertindak sebagai validator pengesahan akhir (<strong>ACC Nilai</strong>) seluruh rombel.
    </p>
  </div>
  <div class="role-card role-guru">
    <div class="role-header">👨‍🏫 2. GURU MATA PELAJARAN</div>
    <p style="font-size: 9pt; margin: 0;">
      Tenaga pendidik yang mengampu mata pelajaran tertentu. Memiliki hak membaca jadwal KBM pribadi serta menginput dan memperbarui nilai asesmen (Tugas, UTS, UAS, dan Deskripsi Capaian) khusus untuk siswa pada kelas yang diampunya.
    </p>
  </div>
  <div class="role-card role-walas">
    <div class="role-header">📋 3. WALI KELAS</div>
    <p style="font-size: 9pt; margin: 0;">
      Guru yang ditugaskan membina satu rombongan belajar khusus. Memantau progres kelengkapan nilai dari seluruh guru mata pelajaran yang mengajar di kelas binaannya, merekapitulasi buku leger nilai kelas, dan mencetak dokumen fisik leger.
    </p>
  </div>
  <div class="role-card role-siswa">
    <div class="role-header">🎓 4. SISWA (PESERTA DIDIK)</div>
    <p style="font-size: 9pt; margin: 0;">
      Peserta didik terdaftar yang memiliki akun autentikasi fleksibel (menggunakan nomor NISN atau email). Memiliki hak baca mandiri atas profil buku induk pribadi, jadwal KBM kelas harian, dan transkrip capaian rapor semester.
    </p>
  </div>
</div>

<h2 class="sub-title">2.2 Matriks Relasi Entitas & Operasi CRUD (RBAC Matrix)</h2>
<p>
  Hak akses operasi basis data (<em>Create, Read, Update, Delete</em>) dipetakan secara ketat berdasarkan peran masing-masing:
</p>

<table class="data-table no-break">
  <thead>
    <tr>
      <th style="width: 28%;">Tabel / Entitas Basis Data</th>
      <th style="text-align: center; width: 18%;">🏛️ Tata Usaha (TU)</th>
      <th style="text-align: center; width: 18%;">👨‍🏫 Guru Mapel</th>
      <th style="text-align: center; width: 18%;">📋 Wali Kelas</th>
      <th style="text-align: center; width: 18%;">🎓 Siswa</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>`users`</strong> (Akun & Otentikasi)</td>
      <td style="text-align: center;"><span class="badge badge-crud">C, R, U, D</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R, U (Sendiri)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R, U (Sendiri)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R, U (Sendiri)</span></td>
    </tr>
    <tr>
      <td><strong>`roles`</strong> (Hak Akses Spatie)</td>
      <td style="text-align: center;"><span class="badge badge-crud">C, R, U, D</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R</span></td>
    </tr>
    <tr>
      <td><strong>`guru`</strong> (Data Pendidik)</td>
      <td style="text-align: center;"><span class="badge badge-crud">C, R, U, D</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Profil)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Profil)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Pengajar)</span></td>
    </tr>
    <tr>
      <td><strong>`siswas`</strong> (Buku Induk 94 Kolom)</td>
      <td style="text-align: center;"><span class="badge badge-crud">C, R, U, D</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Siswa Diajar)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Siswa Binaan)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Data Sendiri)</span></td>
    </tr>
    <tr>
      <td><strong>`kelas`</strong> (Rombongan Belajar)</td>
      <td style="text-align: center;"><span class="badge badge-crud">C, R, U, D</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Kelas Mengajar)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Kelas Binaan)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Kelas Sendiri)</span></td>
    </tr>
    <tr>
      <td><strong>`mata_pelajaran`</strong> (Kurikulum)</td>
      <td style="text-align: center;"><span class="badge badge-crud">C, R, U, D</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R</span></td>
    </tr>
    <tr>
      <td><strong>`jadwal`</strong> (Sesi KBM Mingguan)</td>
      <td style="text-align: center;"><span class="badge badge-crud">C, R, U, D (Tunggal)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Jadwal Ajar)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Jadwal Binaan)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Jadwal Belajar)</span></td>
    </tr>
    <tr>
      <td><strong>`nilais`</strong> (Asesmen & Capaian)</td>
      <td style="text-align: center;"><span class="badge badge-cru">R, U (ACC TU)</span></td>
      <td style="text-align: center;"><span class="badge badge-cru">C, R, U (Mapel Ajar)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Leger Kelas)</span></td>
      <td style="text-align: center;"><span class="badge badge-r">R (Rapor Mandiri)</span></td>
    </tr>
  </tbody>
</table>

<!-- ==================== HALAMAN 5: BAB III BASIS DATA ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>BAB III: PERANCANGAN BASIS DATA RELASIONAL</span>
</div>

<h1 class="bab-title">BAB III: PERANCANGAN BASIS DATA RELASIONAL & NORMALISASI</h1>

<h2 class="sub-title">3.1 Entity Relationship Diagram (ERD)</h2>
<p>
  Arsitektur relasional dirancang menggunakan 11 tabel inti yang saling terhubung melalui integritas referensial <em>Foreign Key</em> dengan aturan penanganan <em>CASCADE</em> dan <em>RESTRICT</em> secara tepat.
</p>

<div class="image-container no-break">
  <img src="data:image/jpeg;base64,{relasi_b64}" alt="Diagram Relasi Tabel Basis Data SIAKAD SMP">
  <div class="image-caption">Gambar 3.1 Skema Relasi Tabel Basis Data SIAKAD SMP Negeri 1 Trimurjo</div>
</div>

<h2 class="sub-title">3.2 Analisis Normalisasi Basis Data</h2>
<p>
  Perancangan basis data telah melalui tahapan pengujian normalisasi formal:
</p>
<ol>
  <li><strong>Bentuk Normal Pertama (1NF):</strong> Seluruh tabel tidak mengandung kelompok data berulang (<em>repeating groups</em>). Setiap nilai atribut bernilai atomik (misal: nomor NISN, nama siswa, bobot nilai tersimpan pada kolom masing-masing).</li>
  <li><strong>Bentuk Normal Kedua (2NF):</strong> Seluruh tabel berada dalam 1NF dan tidak memiliki ketergantungan parsial (<em>partial functional dependency</em>). Setiap atribut non-kunci bergantung secara utuh pada kunci utama (<em>Primary Key</em>). Pada tabel transaksi <code>nilais</code>, atribut nilai bergantung secara penuh pada kombinasi foreign key siswa dan jadwal sesi KBM.</li>
  <li><strong>Bentuk Normal Ketiga (3NF):</strong> Seluruh tabel berada dalam 2NF dan dijamin bebas dari ketergantungan transitif (<em>transitive functional dependency</em>). Data profil guru tidak dicatat di tabel <code>jadwal</code> melainkan merujuk tabel master <code>guru</code> via <code>guru_id</code>. Demikian juga atribut mata pelajaran tidak diduplikasi pada jadwal maupun nilai.</li>
</ol>

<!-- ==================== HALAMAN 6: BAB IV PENJADWALAN ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>BAB IV: PENJADWALAN KBM BEBAS BENTROK</span>
</div>

<h1 class="bab-title">BAB IV: ALGORITMA PENJADWALAN KBM BEBAS BENTROK</h1>

<h2 class="sub-title">4.1 Formulasi Matematika Modulo Shift</h2>
<p>
  Untuk mengatasi masalah penugasan 10 guru mata pelajaran ($i \in [0, 9]$) pada 6 rombel kelas ($c \in [0, 5]$) selama hari Senin hingga Jumat (dibagi menjadi 10 slot blok waktu), sistem menerapkan fungsi permutasi pergeseran modulo:
</p>

<div class="formula-box no-break">
  <span class="math">Slot(c, i) = (i + c) mod 10</span><br/>
  <span style="font-size: 9.5pt; color: #94a3b8;">Di mana <em>c</em> = indeks rombel kelas [0..5] dan <em>i</em> = indeks guru pengampu [0..9]</span>
</div>

<h2 class="sub-title">4.2 Pembuktian Bebas Bentrok (Conflict-Free Theorem)</h2>
<p>
  <strong>Teorema:</strong> Tidak ada guru yang mengajar di dua kelas berbeda pada slot waktu yang sama.<br/>
  <strong>Bukti:</strong> Andaikan terdapat dua kelas berbeda $c_1 \neq c_2$ di mana guru $i$ ditempatkan pada slot waktu yang sama. Maka berlaku:
</p>
<p style="text-align: center; font-style: italic; margin: 8px 0;">
  (i + c<sub>1</sub>) &equiv; (i + c<sub>2</sub>) (mod 10) &rArr; c<sub>1</sub> &equiv; c<sub>2</sub> (mod 10)
</p>
<p>
  Karena indeks kelas berada pada rentang $0 \le c_1, c_2 \le 5$, maka selisih $|c_1 - c_2| \le 5 < 10$. Satu-satunya kondisi yang memenuhi kongruensi modulo 10 adalah $c_1 = c_2$. Hal ini bertentangan (kontradiksi) dengan premis awal bahwa $c_1 \neq c_2$. <strong>Terbukti bahwa bentrok jadwal guru tidak mungkin terjadi secara matematis.</strong>
</p>

<h2 class="sub-title">4.3 Matriks Distribusi Jadwal KBM (60 Sesi Pembelajaran Bebas Bentrok)</h2>
<table class="data-table no-break" style="font-size: 8.5pt;">
  <thead>
    <tr>
      <th>Guru & Mata Pelajaran</th>
      <th>VII A (c=0)</th>
      <th>VII B (c=1)</th>
      <th>VIII A (c=2)</th>
      <th>VIII B (c=3)</th>
      <th>IX A (c=4)</th>
      <th>IX B (c=5)</th>
    </tr>
  </thead>
  <tbody>
    <tr><td><strong>Budi Santoso (MTK)</strong></td><td>Senin Jam 1-2</td><td>Senin Jam 3-4</td><td>Selasa Jam 1-2</td><td>Selasa Jam 3-4</td><td>Rabu Jam 1-2</td><td>Rabu Jam 3-4</td></tr>
    <tr><td><strong>Sugiyatmi (IPA)</strong></td><td>Senin Jam 3-4</td><td>Selasa Jam 1-2</td><td>Selasa Jam 3-4</td><td>Rabu Jam 1-2</td><td>Rabu Jam 3-4</td><td>Kamis Jam 1-2</td></tr>
    <tr><td><strong>Arya Pratama (B.Indo)</strong></td><td>Selasa Jam 1-2</td><td>Selasa Jam 3-4</td><td>Rabu Jam 1-2</td><td>Rabu Jam 3-4</td><td>Kamis Jam 1-2</td><td>Kamis Jam 3-4</td></tr>
    <tr><td><strong>Hendro Wibowo (B.Inggris)</strong></td><td>Selasa Jam 3-4</td><td>Rabu Jam 1-2</td><td>Rabu Jam 3-4</td><td>Kamis Jam 1-2</td><td>Kamis Jam 3-4</td><td>Jumat Jam 1-2</td></tr>
    <tr><td><strong>Sri Wahyuni (PAI)</strong></td><td>Rabu Jam 1-2</td><td>Rabu Jam 3-4</td><td>Kamis Jam 1-2</td><td>Kamis Jam 3-4</td><td>Jumat Jam 1-2</td><td>Jumat Jam 3-4</td></tr>
    <tr><td><strong>Rahmat Hidayat (TIK)</strong></td><td>Rabu Jam 3-4</td><td>Kamis Jam 1-2</td><td>Kamis Jam 3-4</td><td>Jumat Jam 1-2</td><td>Jumat Jam 3-4</td><td>Senin Jam 1-2</td></tr>
    <tr><td><strong>Siti Fatimah (IPS)</strong></td><td>Kamis Jam 1-2</td><td>Kamis Jam 3-4</td><td>Jumat Jam 1-2</td><td>Jumat Jam 3-4</td><td>Senin Jam 1-2</td><td>Senin Jam 3-4</td></tr>
    <tr><td><strong>Dewi Sartika (PPKn)</strong></td><td>Kamis Jam 3-4</td><td>Jumat Jam 1-2</td><td>Jumat Jam 3-4</td><td>Senin Jam 1-2</td><td>Senin Jam 3-4</td><td>Selasa Jam 1-2</td></tr>
    <tr><td><strong>Agus Salim (Seni)</strong></td><td>Jumat Jam 1-2</td><td>Jumat Jam 3-4</td><td>Senin Jam 1-2</td><td>Senin Jam 3-4</td><td>Selasa Jam 1-2</td><td>Selasa Jam 3-4</td></tr>
    <tr><td><strong>Bambang P. (PJOK)</strong></td><td>Jumat Jam 3-4</td><td>Senin Jam 1-2</td><td>Senin Jam 3-4</td><td>Selasa Jam 1-2</td><td>Selasa Jam 3-4</td><td>Rabu Jam 1-2</td></tr>
  </tbody>
</table>

<!-- ==================== HALAMAN 7: BAB V ARSITEKTUR ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>BAB V: ARSITEKTUR TEKNOLOGI</span>
</div>

<h1 class="bab-title">BAB V: ARSITEKTUR TEKNOLOGI & IMPLEMENTASI SISTEM</h1>

<h2 class="sub-title">5.1 Integrasi Cloud Database TiDB Serverless & Enkripsi TLS</h2>
<p>
  Dalam pengembangannya, sistem menggunakan teknologi komputasi awan <strong>TiDB Serverless Cloud (MySQL Protocol)</strong>. TiDB menjamin skalabilitas tinggi dan ketersediaan berkelanjutan (<em>high availability</em>) tanpa perlu mengelola server pangkalan data fisik secara manual.
</p>
<p>
  Koneksi antara aplikasi Laravel yang dihosting di <strong>Vercel Serverless</strong> menuju TiDB Cloud diamankan secara menyeluruh menggunakan protokol <strong>TLS/SSL</strong> dengan verifikasi berkas sertifikat publik <code>ca.pem</code> (DigiCert Global Root CA).
</p>

<pre class="code-block">
// Snippet Konfigurasi config/database.php dengan Verifikasi Enkripsi SSL
'mysql' => [
    'driver'    => 'mysql',
    'host'      => env('DB_HOST', 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com'),
    'port'      => env('DB_PORT', '4000'),
    'database'  => env('DB_DATABASE', 'siakad_smpn1_trimurjo'),
    'username'  => env('DB_USERNAME'),
    'password'  => env('DB_PASSWORD'),
    'options'   => [
        PDO::MYSQL_ATTR_SSL_CA => base_path('ca.pem'),
    ],
],
</pre>

<h2 class="sub-title">5.2 Desain Antarmuka Ultra-Responsif Mobile & Mode Siang/Malam</h2>
<p>
  Antarmuka aplikasi dibangun dengan memanfaatkan <strong>Tailwind CSS</strong> dengan berorientasi pada kemudahan penggunaan di perangkat ponsel cerdas:
</p>
<ul>
  <li><strong>Bottom Navigation Bar:</strong> Saat diakses melalui layar smartphone, menu navigasi utama berpindah ke bilah bawah (meniru pengalaman aplikasi native iOS/Android) yang terdiri atas tombol Beranda, Jadwal KBM, Nilai, Siswa, dan Pengaturan.</li>
  <li><strong>Day / Night Mode:</strong> Pengguna dapat beralih antara tema terang dan tema gelap dengan tombol toggle cepat di header. Preferensi warna disimpan pada <code>localStorage.theme</code> untuk memastikan tidak terjadi kedipan (<em>flicker-free</em>) saat halaman dimuat ulang.</li>
  <li><strong>Styling Cetak Fisik (@media print):</strong> Disediakan modul cetak Buku Leger Nilai dan Transkrip Rapor yang secara cerdas menyembunyikan elemen web (sidebar, tombol aksi, banner) dan mengatur margin serta ukuran kertas otomatis pada format A4 landscape/portrait.</li>
</ul>

<!-- ==================== HALAMAN 8: BAB VI PENGUJIAN ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>BAB VI: HASIL PENGUJIAN & EVALUASI</span>
</div>

<h1 class="bab-title">BAB VI: HASIL IMPLEMENTASI, EVALUASI & AKUN PENGUJIAN</h1>

<h2 class="sub-title">6.1 Statistik Volume Data Terpasang di Cloud</h2>
<p>
  Pangkalan data di TiDB Serverless telah diisi dengan volume data riil berskala penuh:
</p>
<ul>
  <li><strong>120 Siswa Aktif:</strong> Tepat 20 siswa per kelas di rombel VII A, VII B, VIII A, VIII B, IX A, dan IX B.</li>
  <li><strong>10 Guru Mata Pelajaran:</strong> Memiliki NIP resmi dan jadwal ajar aktif.</li>
  <li><strong>6 Wali Kelas Definitif:</strong> Masing-masing membina 1 rombel kelas.</li>
  <li><strong>60 Jadwal KBM Mingguan:</strong> Terjadwal rapi Senin s/d Jumat bebas konflik.</li>
  <li><strong>1,200 Nilai Rapor:</strong> 100% siswa memiliki nilai lengkap di seluruh mapel dan berstatus disahkan (<strong>ACC TU</strong>).</li>
</ul>

<h2 class="sub-title">6.2 Kredensial Akun Pengujian Demo (Password Default: <code>password</code>)</h2>
<table class="data-table no-break" style="font-size: 9pt;">
  <thead>
    <tr>
      <th>Peran Pengguna</th>
      <th>Nama Pengguna</th>
      <th>Email / NISN Login</th>
      <th>Kata Sandi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge badge-crud">Tata Usaha (Admin)</span></td>
      <td>Staf Tata Usaha</td>
      <td><code>tu@smpn1trimurjo.sch.id</code></td>
      <td><code>password</code></td>
    </tr>
    <tr>
      <td><span class="badge badge-cru">Wali Kelas VII A</span></td>
      <td>Istri Sugiyatmi, S.Pd.</td>
      <td><code>sugiyatmi@smpn1trimurjo.sch.id</code></td>
      <td><code>password</code></td>
    </tr>
    <tr>
      <td><span class="badge badge-cru">Wali Kelas VII B</span></td>
      <td>Arya Pratama, S.Pd.</td>
      <td><code>arya@smpn1trimurjo.sch.id</code></td>
      <td><code>password</code></td>
    </tr>
    <tr>
      <td><span class="badge badge-cru">Wali Kelas VIII A</span></td>
      <td>Drs. Hendro Wibowo, M.Pd.</td>
      <td><code>hendro@smpn1trimurjo.sch.id</code></td>
      <td><code>password</code></td>
    </tr>
    <tr>
      <td><span class="badge badge-cru">Wali Kelas IX A</span></td>
      <td>Rahmat Hidayat, S.Kom., M.T.</td>
      <td><code>rahmat.hidayat@smpn1trimurjo.sch.id</code></td>
      <td><code>password</code></td>
    </tr>
    <tr>
      <td><span class="badge badge-cru">Guru Matematika</span></td>
      <td>Budi Santoso, S.Pd.</td>
      <td><code>budi@smpn1trimurjo.sch.id</code></td>
      <td><code>password</code></td>
    </tr>
    <tr>
      <td><span class="badge badge-success">Siswa Kelas VII A</span></td>
      <td>Ahmad Pratama</td>
      <td><code>0091234567</code></td>
      <td><code>password</code></td>
    </tr>
    <tr>
      <td><span class="badge badge-success">Siswa Kelas VII B</span></td>
      <td>Eka Putri Handayani</td>
      <td><code>0092100006</code></td>
      <td><code>password</code></td>
    </tr>
  </tbody>
</table>

<h2 class="sub-title">6.3 Pengujian Fungsional (Black Box Testing)</h2>
<table class="data-table no-break" style="font-size: 9pt;">
  <thead>
    <tr>
      <th style="width: 12%;">Kode Uji</th>
      <th style="width: 33%;">Skenario Pengujian</th>
      <th style="width: 40%;">Hasil Pengamatan</th>
      <th style="width: 15%; text-align: center;">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>TC-01</strong></td>
      <td>Login multi-peran (TU, Walas, Siswa via NISN)</td>
      <td>Sistem berhasil mengarahkan ke halaman modul masing-masing</td>
      <td style="text-align: center;"><span class="badge badge-success">VALID</span></td>
    </tr>
    <tr>
      <td><strong>TC-02</strong></td>
      <td>Akses menu TU oleh pengguna berstatus Guru</td>
      <td>Sistem menolak otorisasi dan menampilkan error HTTP 403 Forbidden</td>
      <td style="text-align: center;"><span class="badge badge-success">VALID</span></td>
    </tr>
    <tr>
      <td><strong>TC-03</strong></td>
      <td>Input nilai formatif/sumatif oleh Guru Mapel</td>
      <td>Nilai tersimpan ke TiDB Cloud dan nilai akhir otomatis terhitung</td>
      <td style="text-align: center;"><span class="badge badge-success">VALID</span></td>
    </tr>
    <tr>
      <td><strong>TC-04</strong></td>
      <td>Kompilasi leger & cetak rapor oleh Wali Kelas</td>
      <td>Tabel leger memuat nilai 10 mapel dan urutan ranking terhitung rapi</td>
      <td style="text-align: center;"><span class="badge badge-success">VALID</span></td>
    </tr>
    <tr>
      <td><strong>TC-05</strong></td>
      <td>Pengesahan (ACC Nilai) oleh Staf Tata Usaha</td>
      <td>Flag <code>is_acc_tu</code> terkunci menjadi true dan dapat dilihat siswa</td>
      <td style="text-align: center;"><span class="badge badge-success">VALID</span></td>
    </tr>
  </tbody>
</table>

<!-- ==================== HALAMAN 9: BAB VII KESIMPULAN ==================== -->
<div class="page-break"></div>
<div class="doc-header">
  <span>SIAKAD SMP NEGERI 1 TRIMURJO &bull; LAPORAN UTS BASIS DATA LANJUT</span>
  <span>BAB VII: KESIMPULAN & REFERENSI</span>
</div>

<h1 class="bab-title">BAB VII: KESIMPULAN & REKOMENDASI PENGEMBANGAN</h1>

<h2 class="sub-title">7.1 Kesimpulan</h2>
<ol>
  <li><strong>Keberhasilan Pembangunan Sistem:</strong> Aplikasi SIAKAD SMP Negeri 1 Trimurjo berhasil dibangun dan dideploy secara publik (<em>live</em>) dengan integrasi komputasi awan TiDB Serverless (MySQL) dan hosting Vercel.</li>
  <li><strong>Ketepatan Desain Basis Data:</strong> Struktur skema basis data telah memenuhi prinsip normalisasi 1NF, 2NF, dan 3NF, menghasilkan efisiensi penyimpanan, bebas dari anomali pembaruan data, serta menjaga integritas referensial antar-tabel.</li>
  <li><strong>Penegakan Keamanan RBAC:</strong> Pengendalian hak akses berhasil membatasi wewenang Tata Usaha, Guru Mata Pelajaran, Wali Kelas, dan Siswa sesuai dengan tanggung jawab masing-masing.</li>
  <li><strong>Keberhasilan Algoritma Bebas Bentrok:</strong> Penggunaan algoritma <em>Round-Robin Shift Modulo</em> berhasil menjadwalkan 60 sesi KBM untuk 10 guru dan 6 rombel kelas tanpa ada satu pun konflik jadwal mengajar.</li>
  <li><strong>Kesiapan Uji Skala Riil:</strong> Sistem telah diuji dengan 120 siswa aktif dan 1.200 nilai rapor lengkap, membuktikan kehandalan performa basis data dalam menangani volume data sekolah secara riil.</li>
</ol>

<h2 class="sub-title">7.2 Rekomendasi Pengembangan Selanjutnya</h2>
<ol>
  <li>Pengembangan gerbang notifikasi otomatis WhatsApp Gateway untuk penyampaian presensi harian dan pengumuman rapor ke wali murid.</li>
  <li>Penerapan sistem presensi digital berbasis QR Code pada kartu tanda pelajar siswa.</li>
  <li>Penambahan fitur ekspor rekapitulasi data akademik ke format spreadsheet dinamis (.xlsx) untuk laporan ke Dinas Pendidikan Kabupaten Lampung Tengah.</li>
</ol>

<hr style="border: none; border-top: 1px solid #e2e8f0; margin: 25px 0;"/>

<h2 class="sub-title">DAFTAR PUSTAKA & RUJUKAN</h2>
<ol style="font-size: 9pt; color: #334155;">
  <li>Date, C. J. (2004). <em>An Introduction to Database Systems</em> (8th ed.). Addison-Wesley.</li>
  <li>Elmasri, R., &amp; Navathe, S. B. (2015). <em>Fundamentals of Database Systems</em> (7th ed.). Pearson.</li>
  <li>Silberschatz, A., Korth, H. F., &amp; Sudarshan, S. (2020). <em>Database System Concepts</em> (7th ed.). McGraw-Hill.</li>
  <li>PingCAP. (2026). <em>TiDB Serverless: Distributed Cloud Database Architecture</em>. PingCAP Documentation.</li>
  <li>Laravel LLC. (2026). <em>Laravel 11.x Documentation: Eloquent ORM &amp; Authentication</em>. laravel.com.</li>
  <li>Kemendikbudristek RI. (2024). <em>Panduan Pembelajaran dan Asesmen Kurikulum Merdeka</em>. Jakarta.</li>
</ol>

</body>
</html>
"""

with open(html_output, "w", encoding="utf-8") as f:
    f.write(html_content)

print(f"HTML generated at: {html_output}")

# Run Edge headless to print to PDF
edge_path = r"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"
cmd = [
    edge_path,
    "--headless",
    "--no-sandbox",
    "--disable-gpu",
    "--run-all-compositor-stages-before-draw",
    "--no-pdf-header-footer",
    f"--print-to-pdf={pdf_output}",
    html_output
]

print("Executing Edge headless to generate PDF...")
result = subprocess.run(cmd, capture_output=True, text=True)
print("Return code:", result.returncode)
if os.path.exists(pdf_output):
    size_kb = os.path.getsize(pdf_output) / 1024
    print(f"SUCCESS: PDF generated successfully at {pdf_output} ({size_kb:.1f} KB)")
else:
    print("ERROR: PDF file not found after Edge execution.")
    print("Stderr:", result.stderr)
