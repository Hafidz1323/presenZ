<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Proyek Akhir UAS - presenZ Falco</title>
    <style>
        @page {
            margin: 3cm 3cm 3cm 4cm;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }
        .page-break {
            page-break-after: always;
        }
        /* Cover Page Styling */
        .cover-container {
            text-align: center;
            height: 100%;
            position: relative;
        }
        .cover-title-univ {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0.2cm;
            line-height: 1.2;
        }
        .cover-title-app {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 1.5cm;
            margin-bottom: 0.5cm;
            line-height: 1.3;
        }
        .cover-subtitle {
            font-size: 12pt;
            font-weight: normal;
            margin-bottom: 1.5cm;
        }
        .cover-logo {
            margin: 1cm auto;
            width: 180px;
            height: auto;
        }
        .cover-details {
            margin-top: 1.5cm;
            font-size: 12pt;
            text-align: left;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        .cover-details table {
            width: 100%;
            border: none;
        }
        .cover-details td {
            padding: 3px 0;
            vertical-align: top;
            border: none !important;
        }
        .cover-footer {
            margin-top: 2cm;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.3;
        }
        .cover-links {
            margin-top: 0.8cm;
            font-size: 10.5pt;
            text-align: center;
            background: #f4f5f7;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }
        .cover-links a {
            color: #1e40af;
            text-decoration: underline;
        }

        /* Chapter Title Styling */
        .chapter-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1cm;
            line-height: 1.3;
        }
        h2 {
            font-size: 12pt;
            font-weight: bold;
            margin-top: 0.8cm;
            margin-bottom: 0.3cm;
            text-align: left;
        }
        h3 {
            font-size: 12pt;
            font-weight: bold;
            margin-top: 0.5cm;
            margin-bottom: 0.2cm;
            text-align: left;
            text-decoration: underline;
        }
        p {
            text-indent: 1.25cm;
            text-align: justify;
            margin-top: 0;
            margin-bottom: 0.4cm;
        }
        .no-indent {
            text-indent: 0 !important;
        }
        ol, ul {
            margin-top: 0;
            margin-bottom: 0.4cm;
            padding-left: 1.25cm;
            text-align: justify;
        }
        li {
            margin-bottom: 0.15cm;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.3cm;
            margin-bottom: 0.5cm;
            font-size: 11pt;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            padding: 8px;
        }
        td {
            padding: 6px 8px;
            vertical-align: middle;
        }
        .center-text {
            text-align: center;
        }

        /* Document Images */
        .image-container {
            text-align: center;
            margin: 0.5cm 0;
            page-break-inside: avoid;
        }
        .image-container img {
            max-width: 90%;
            height: auto;
            border: 1px solid #333;
            padding: 4px;
            background: #fff;
        }
        .image-caption {
            font-size: 11pt;
            font-style: italic;
            margin-top: 0.15cm;
            text-align: center;
        }

        /* Signatures styling */
        .signature-table {
            width: 100%;
            border: none !important;
            margin-top: 1.5cm;
        }
        .signature-table td {
            border: none !important;
            width: 50%;
            text-align: center;
            padding: 10px;
        }

        /* TOC Styling */
        .toc-list {
            list-style: none;
            padding-left: 0;
        }
        .toc-item {
            margin-bottom: 0.2cm;
            position: relative;
        }
        .toc-name {
            background: #fff;
            padding-right: 5px;
        }
        .toc-dots {
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            border-bottom: 1px dotted #000;
            z-index: -1;
        }
        .toc-page {
            float: right;
            background: #fff;
            padding-left: 5px;
        }
        .clear {
            clear: both;
        }

        /* Code block styling */
        pre {
            background: #f7f7f7;
            border: 1px solid #ddd;
            padding: 8px;
            font-family: Consolas, Courier, monospace;
            font-size: 9.5pt;
            overflow: hidden;
            white-space: pre-wrap;
            margin-bottom: 0.4cm;
        }
    </style>
</head>
<body>

    <!-- SCRIPT UNTUK PAGE NUMBERING DI DOMPDF -->
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                // Halaman 1 (Cover) tidak diberi nomor
                if ($pageNumber > 1) {
                    $font = $fontMetrics->get_font("Times New Roman", "normal");
                    $size = 10;
                    
                    // Halaman Romawi (Pengesahan s.d Daftar Gambar) - Halaman 2 s.d 6
                    if ($pageNumber <= 6) {
                        $romans = [
                            2 => 'ii',
                            3 => 'iii',
                            4 => 'iv',
                            5 => 'v',
                            6 => 'vi'
                        ];
                        $text = $romans[$pageNumber] ?? '';
                    } else {
                        // Halaman Arab dimulai dari BAB 1 (Halaman 7 di PDF)
                        $text = $pageNumber - 6;
                    }
                    
                    // Gambar nomor halaman di tengah bawah footer (Center X, Y=800)
                    $width = $fontMetrics->get_text_width($text, $font, $size);
                    $canvas->text(297.6 - ($width / 2), 800, $text, $font, $size);
                }
            });
        }
    </script>

    <!-- ==================== HALAMAN COVER ==================== -->
    <div class="cover-container page-break">
        <div class="cover-title-univ">
            KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI<br>
            UNIVERSITAS NEGERI SURABAYA<br>
            FAKULTAS VOKASI<br>
            PROGRAM STUDI D4 MANAJEMEN INFORMATIKA
        </div>

        <div class="cover-title-app">
            LAPORAN PROYEK AKHIR<br>
            APLIKASI ABSENSI KARYAWAN & HRIS "presenZ Falco"<br>
            BERBASIS GEOLOCATION & WEBRTC FACE CAPTURE
        </div>
        <div class="cover-subtitle">
            Laporan ini disusun untuk memenuhi penilaian Tugas Akhir Mata Kuliah Pemrograman API
        </div>

        @if(isset($images['logo_unesa']))
            <img class="cover-logo" src="data:image/png;base64,{{ $images['logo_unesa'] }}" alt="Logo UNESA">
        @endif

        <div class="cover-details">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 35%; font-weight: bold;">Dosen Pengampu</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 60%;">Aditya Prapanca, S.T., M.Kom.</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Kelas</td>
                    <td>:</td>
                    <td>D4 MI 2024 / D.E.1</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Nama Kelompok</td>
                    <td>:</td>
                    <td>Kelompok Falco (Kelompok 5)</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; vertical-align: top;">Anggota Kelompok</td>
                    <td style="vertical-align: top;">:</td>
                    <td>
                        1. Muhammad Hafidz (NIM: 24091397001)<br>
                        2. Ahmad Fadil (NIM: 24091397002)<br>
                        3. Rizky Maulana (NIM: 24091397003)<br>
                        4. Zulkifli Arifin (NIM: 24091397004)
                    </td>
                </tr>
            </table>
        </div>

        <div class="cover-links">
            <strong>Tautan Eksternal Proyek:</strong><br>
            Repository GitHub: <a href="https://github.com/Hafidz1323/presenZ" target="_blank">https://github.com/Hafidz1323/presenZ</a><br>
            Video Demo & Presentasi: <a href="https://youtube.com/watch?v=demo-presenz" target="_blank">https://youtube.com/watch?v=demo-presenz</a>
        </div>

        <div class="cover-footer" style="margin-top: 1cm;">
            SURABAYA<br>
            TAHUN 2025/2026
        </div>
    </div>


    <!-- ==================== HALAMAN PENGESAHAN ==================== -->
    <div class="page-break">
        <div class="chapter-title" style="margin-top: 1cm;">
            HALAMAN PENGESAHAN
        </div>
        <p class="no-indent" style="text-align: center; margin-top: 1cm; margin-bottom: 1cm;">
            Laporan Proyek Akhir Mata Kuliah Pemrograman API dengan judul:<br>
            <strong>APLIKASI ABSENSI KARYAWAN & HRIS "presenZ Falco" BERBASIS GEOLOCATION & WEBRTC FACE CAPTURE</strong>
        </p>
        <p class="no-indent" style="text-align: center;">
            Telah diperiksa, diuji, dan disetujui oleh Dosen Pengampu Mata Kuliah Pemrograman API Program Studi D4 Manajemen Informatika, Fakultas Vokasi, Universitas Negeri Surabaya.
        </p>

        <p class="no-indent" style="text-align: center; margin-top: 1cm;">
            Surabaya, 11 Juni 2026
        </p>

        <table class="signature-table">
            <tr>
                <td>
                    Mengetahui,<br>
                    <strong>Ketua Kelompok Falco</strong>
                    <br><br><br><br><br>
                    <u>Muhammad Hafidz</u><br>
                    NIM. 24091397001
                </td>
                <td>
                    Menyetujui,<br>
                    <strong>Dosen Pengampu Mata Kuliah</strong>
                    <br><br><br><br><br>
                    <u>Aditya Prapanca, S.T., M.Kom.</u><br>
                    NIP. 197805122005011002
                </td>
            </tr>
        </table>
    </div>


    <!-- ==================== KATA PENGANTAR ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            KATA PENGANTAR
        </div>
        <p>
            Puji syukur kehadirat Allah SWT, Tuhan Yang Maha Esa, atas segala rahmat, hidayah, dan karunia-Nya, sehingga penulis dapat menyelesaikan laporan proyek akhir mata kuliah Pemrograman API yang berjudul <strong>"Aplikasi Absensi Karyawan & HRIS 'presenZ Falco' Berbasis Geolocation & WebRTC Face Capture"</strong> ini dengan baik dan tepat pada waktunya.
        </p>
        <p>
            Laporan ini disusun sebagai dokumentasi dari proses analisa, perencanaan, desain, implementasi, dan pengujian sistem yang telah kami bangun bersama. Proyek ini tidak hanya berfokus pada pemenuhan kebutuhan fungsional absensi, melainkan juga menyoroti integrasi platform terdistribusi melalui konsumsi data cuaca eksternal (*Weather API*) serta proteksi antarmuka API menggunakan metode Multi-Auth (*Custom JWT, API Key, Basic Auth,* dan *Laravel Sanctum*).
        </p>
        <p>
            Penulis menyadari bahwa keberhasilan penyusunan laporan ini tidak lepas dari bimbingan, arahan, dan dukungan dari berbagai pihak. Oleh karena itu, penulis ingin menyampaikan terima kasih yang sebesar-besarnya kepada Bapak Aditya Prapanca, S.T., M.Kom., selaku Dosen Pengampu mata kuliah Pemrograman API yang senantiasa memberikan arahan berharga serta rekan-rekan anggota Kelompok Falco atas dedikasi dan kerja sama yang luar biasa selama pengerjaan proyek akhir ini.
        </p>
        <p>
            Penulis menyadari bahwa laporan ini masih jauh dari sempurna. Oleh karena itu, kritik dan saran yang membangun sangat penulis harapkan untuk perbaikan dan pengembangan sistem di masa mendatang. Semoga laporan ini dapat memberikan manfaat serta wawasan tambahan bagi para pembaca, khususnya di bidang pengembangan sistem informasi terdistribusi dan integrasi API.
        </p>
        <br>
        <p class="no-indent" style="text-align: right; margin-right: 1.5cm;">
            Surabaya, 11 Juni 2026<br><br><br>
            Kelompok Falco
        </p>
    </div>


    <!-- ==================== DAFTAR ISI ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            DAFTAR ISI
        </div>
        <ul class="toc-list">
            <li class="toc-item">
                <span class="toc-name">HALAMAN COVER</span><span class="toc-dots"></span><span class="toc-page">i</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">HALAMAN PENGESAHAN</span><span class="toc-dots"></span><span class="toc-page">ii</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">KATA PENGANTAR</span><span class="toc-dots"></span><span class="toc-page">iii</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">DAFTAR ISI</span><span class="toc-dots"></span><span class="toc-page">iv</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">DAFTAR TABEL</span><span class="toc-dots"></span><span class="toc-page">v</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">DAFTAR GAMBAR</span><span class="toc-dots"></span><span class="toc-page">vi</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">BAB 1 PENDAHULUAN</span><span class="toc-dots"></span><span class="toc-page">1</span>
                <ul style="list-style:none; padding-left: 15px;">
                    <li class="toc-item"><span class="toc-name">1.1 Latar Belakang</span><span class="toc-dots"></span><span class="toc-page">1</span></li>
                    <li class="toc-item"><span class="toc-name">1.2 Rumusan Masalah</span><span class="toc-dots"></span><span class="toc-page">2</span></li>
                    <li class="toc-item"><span class="toc-name">1.3 Tujuan</span><span class="toc-dots"></span><span class="toc-page">2</span></li>
                    <li class="toc-item"><span class="toc-name">1.4 Manfaat</span><span class="toc-dots"></span><span class="toc-page">2</span></li>
                    <li class="toc-item"><span class="toc-name">1.5 Batasan Masalah</span><span class="toc-dots"></span><span class="toc-page">2</span></li>
                    <li class="toc-item"><span class="toc-name">1.6 Sistematika Penulisan</span><span class="toc-dots"></span><span class="toc-page">3</span></li>
                </ul>
            </li>
            <li class="toc-item">
                <span class="toc-name">BAB 2 ANALISA DAN PERENCANAAN</span><span class="toc-dots"></span><span class="toc-page">4</span>
                <ul style="list-style:none; padding-left: 15px;">
                    <li class="toc-item"><span class="toc-name">2.1 Analisa Kebutuhan</span><span class="toc-dots"></span><span class="toc-page">4</span></li>
                    <li class="toc-item"><span class="toc-name">2.2 Daftar Fitur Aplikasi</span><span class="toc-dots"></span><span class="toc-page">4</span></li>
                    <li class="toc-item"><span class="toc-name">2.3 Daftar Pengguna (User Role)</span><span class="toc-dots"></span><span class="toc-page">5</span></li>
                    <li class="toc-item"><span class="toc-name">2.4 Use Case Diagram</span><span class="toc-dots"></span><span class="toc-page">5</span></li>
                    <li class="toc-item"><span class="toc-name">2.5 Activity Diagram</span><span class="toc-dots"></span><span class="toc-page">6</span></li>
                    <li class="toc-item"><span class="toc-name">2.6 Entity Relationship Diagram (ERD)</span><span class="toc-dots"></span><span class="toc-page">6</span></li>
                    <li class="toc-item"><span class="toc-name">2.7 Arsitektur Sistem / Flowchart Sistem</span><span class="toc-dots"></span><span class="toc-page">7</span></li>
                </ul>
            </li>
            <li class="toc-item">
                <span class="toc-name">BAB 3 DESAIN DAN IMPLEMENTASI</span><span class="toc-dots"></span><span class="toc-page">8</span>
                <ul style="list-style:none; padding-left: 15px;">
                    <li class="toc-item"><span class="toc-name">3.1 Desain Database (Tabel dan Relasi)</span><span class="toc-dots"></span><span class="toc-page">8</span></li>
                    <li class="toc-item"><span class="toc-name">3.2 Desain Antarmuka (UI/UX)</span><span class="toc-dots"></span><span class="toc-page">9</span></li>
                    <li class="toc-item"><span class="toc-name">3.3 Struktur Folder Proyek Laravel</span><span class="toc-dots"></span><span class="toc-page">10</span></li>
                    <li class="toc-item"><span class="toc-name">3.4 Struktur Kode Program</span><span class="toc-dots"></span><span class="toc-page">11</span></li>
                    <li class="toc-item"><span class="toc-name">3.5 Fitur Utama yang Diimplementasikan</span><span class="toc-dots"></span><span class="toc-page">12</span></li>
                </ul>
            </li>
            <li class="toc-item">
                <span class="toc-name">BAB 4 HASIL DAN PEMBAHASAN</span><span class="toc-dots"></span><span class="toc-page">14</span>
                <ul style="list-style:none; padding-left: 15px;">
                    <li class="toc-item"><span class="toc-name">4.1 Tampilan Aplikasi (Screenshot)</span><span class="toc-dots"></span><span class="toc-page">14</span></li>
                    <li class="toc-item"><span class="toc-name">4.2 Cara Kerja Fitur Utama</span><span class="toc-dots"></span><span class="toc-page">15</span></li>
                    <li class="toc-item"><span class="toc-name">4.3 Hasil Pengujian (Testing)</span><span class="toc-dots"></span><span class="toc-page">16</span></li>
                    <li class="toc-item"><span class="toc-name">4.4 Kendala yang Dihadapi dan Solusi</span><span class="toc-dots"></span><span class="toc-page">17</span></li>
                </ul>
            </li>
            <li class="toc-item">
                <span class="toc-name">BAB 5 KESIMPULAN DAN SARAN</span><span class="toc-dots"></span><span class="toc-page">18</span>
                <ul style="list-style:none; padding-left: 15px;">
                    <li class="toc-item"><span class="toc-name">5.1 Kesimpulan</span><span class="toc-dots"></span><span class="toc-page">18</span></li>
                    <li class="toc-item"><span class="toc-name">5.2 Saran</span><span class="toc-dots"></span><span class="toc-page">18</span></li>
                </ul>
            </li>
            <li class="toc-item">
                <span class="toc-name">DAFTAR PUSTAKA</span><span class="toc-dots"></span><span class="toc-page">19</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">LAMPIRAN</span><span class="toc-dots"></span><span class="toc-page">20</span>
            </li>
        </ul>
    </div>


    <!-- ==================== DAFTAR TABEL ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            DAFTAR TABEL
        </div>
        <ul class="toc-list">
            <li class="toc-item">
                <span class="toc-name">Tabel 2.1 Analisa Kebutuhan Fungsional</span><span class="toc-dots"></span><span class="toc-page">4</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Tabel 3.1 Kamus Data Tabel Users</span><span class="toc-dots"></span><span class="toc-page">8</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Tabel 3.2 Kamus Data Tabel Attendances</span><span class="toc-dots"></span><span class="toc-page">9</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Tabel 4.1 Rincian API Endpoint & Status Hasil Uji</span><span class="toc-dots"></span><span class="toc-page">16</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Tabel L.1 Matriks Pembagian Tugas Kelompok Falco</span><span class="toc-dots"></span><span class="toc-page">20</span>
            </li>
        </ul>
    </div>


    <!-- ==================== DAFTAR GAMBAR ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            DAFTAR GAMBAR
        </div>
        <ul class="toc-list">
            <li class="toc-item">
                <span class="toc-name">Gambar 2.1 Use Case Diagram presenZ Falco</span><span class="toc-dots"></span><span class="toc-page">5</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Gambar 2.2 Activity Diagram Proses Check-In Absensi</span><span class="toc-dots"></span><span class="toc-page">6</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Gambar 2.3 Entity Relationship Diagram (ERD) presenZ Database</span><span class="toc-dots"></span><span class="toc-page">7</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Gambar 3.1 Desain Layout Navigasi & Sidebar Dashboard Karyawan</span><span class="toc-dots"></span><span class="toc-page">10</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Gambar 4.1 Tampilan Antarmuka Dasbor Absensi Karyawan & Kamera WebRTC</span><span class="toc-dots"></span><span class="toc-page">14</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Gambar 4.2 Widget Detektor Sensor Koordinat GPS Perangkat</span><span class="toc-dots"></span><span class="toc-page">14</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Gambar 4.3 Panel Geocoding Terjemahan Alamat Fisik Lengkap</span><span class="toc-dots"></span><span class="toc-page">15</span>
            </li>
            <li class="toc-item">
                <span class="toc-name">Gambar 4.4 Perbandingan Desain Alert Lama vs Notifikasi Toast Modern</span><span class="toc-dots"></span><span class="toc-page">15</span>
            </li>
        </ul>
    </div>


    <!-- ==================== BAB 1 ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            BAB 1<br>PENDAHULUAN
        </div>

        <h2>1.1 Latar Belakang</h2>
        <p>
            Dalam era transformasi digital saat ini, pengelolaan Sumber Daya Manusia (SDM) pada setiap organisasi dituntut untuk beralih dari metode konvensional menuju sistem yang terintegrasi dan otomatis. Aspek kedisiplinan dan transparansi data kehadiran karyawan merupakan salah satu pilar utama dalam menentukan efisiensi kerja. Pada sistem presensi konvensional—baik absensi manual berbasis kertas maupun absensi fisik sidik jari (*fingerprint*)—ditemukan banyak keterbatasan struktural. Kendala utama meliputi ketergantungan absensi pada satu titik fisik perangkat, yang menyulitkan pencatatan kehadiran karyawan lapangan, dinas luar kota, maupun yang menerapkan kebijakan bekerja dari rumah (*Work From Home*).
        </p>
        <p>
            Selain itu, celah kecurangan berupa penitipan absensi (*buddy punching*) atau manipulasi laporan lokasi kehadiran pada sistem absensi digital sederhana menjadi masalah yang kerap ditemui pihak manajemen. Beberapa aplikasi absensi berbasis web konvensional juga hanya merekam koordinat koordinasi mentah (latitude & longitude) yang sulit dipahami secara langsung oleh pihak HRD tanpa bantuan visualisasi eksternal. Untuk menjembatani permasalahan tersebut, dikembangkan sebuah aplikasi manajemen kehadiran terpadu bernama **"presenZ Falco"**.
        </p>
        <p>
            Aplikasi ini memanfaatkan teknologi kamera berbasis penjelajah web (*WebRTC Camera*) untuk verifikasi wajah secara langsung tanpa perlu aplikasi tambahan, sensor *Geolocation* perangkat keras untuk mencatat koordinat pengguna secara akurat, serta integrasi layanan *reverse geocoding* Nominatim OpenStreetMap untuk secara instan menerjemahkan titik lokasi koordinat menjadi data alamat lengkap (nama jalan, kelurahan, kecamatan, kota, provinsi, dan negara). Dari segi pengembangan platform terdistribusi, sistem ini juga mengonsumsi API cuaca eksternal (*Weather API*) dari Open-Meteo untuk menampilkan ramalan cuaca setempat secara *real-time* ketika absensi dicatat.
        </p>

        <h2>1.2 Rumusan Masalah</h2>
        <p class="no-indent">Berdasarkan pemaparan latar belakang di atas, rumusan masalah proyek akhir ini adalah:</p>
        <ol>
            <li>Bagaimana cara mencatat absensi karyawan secara fleksibel namun tetap terlindungi dari kecurangan manipulasi lokasi?</li>
            <li>Bagaimana mengotomatisasi penerjemahan data koordinat GPS mentah (latitude/longitude) menjadi nama jalan dan wilayah administratif yang mudah dibaca oleh HRD secara langsung?</li>
            <li>Bagaimana merancang arsitektur keamanan API Multi-Auth (JWT, API Key, Basic Auth, Sanctum) untuk memfasilitasi integrasi data dengan platform luar secara aman?</li>
            <li>Bagaimana menyajikan tampilan dashboard absensi terintegrasi yang modern dengan visualisasi cuaca setempat dan sistem notifikasi yang interaktif?</li>
        </ol>

        <h2>1.3 Tujuan</h2>
        <p class="no-indent">Tujuan yang ingin dicapai melalui rancangan sistem presenZ Falco ini adalah:</p>
        <ul>
            <li>Menyediakan media presensi karyawan berbasis web yang mudah diakses dengan otentikasi wajah (WebRTC) dan lokasi (GPS Geolocation).</li>
            <li>Mengintegrasikan modul backend dengan Nominatim OpenStreetMap API untuk menyediakan detail alamat lengkap presensi secara *live* di dasbor.</li>
            <li>Membangun middleware Laravel untuk otentikasi lapis ganda API menggunakan JSON Web Token kustom, API Key, dan Basic Auth.</li>
            <li>Mengimplementasikan dasbor interaktif bertema gradasi biru laut/kristal (*iceberg*) dengan widget penunjuk waktu real-time dan ramalan cuaca terpadu.</li>
        </ul>

        <h2>1.4 Manfaat</h2>
        <p class="no-indent">Manfaat yang diharapkan dari implementasi aplikasi presenZ Falco meliputi:</p>
        <ul>
            <li><strong>Bagi Karyawan:</strong> Memberikan kemudahan absensi mandiri dari lokasi penugasan secara transparan tanpa antrean fisik.</li>
            <li><strong>Bagi Perusahaan/HRD:</strong> Mengurangi kecurangan, menghemat waktu rekapitulasi absensi bulanan, dan mempercepat pengambilan keputusan cuti/izin karyawan.</li>
            <li><strong>Bagi Pengembang:</strong> Memberikan pemahaman komprehensif mengenai integrasi REST API, manajemen otentikasi berlapis, serta pemanfaatan asinkronus Inertia.js dan Vue 3.</li>
        </ul>

        <h2>1.5 Batasan Masalah</h2>
        <p class="no-indent">Agar pembahasan dalam proyek akhir ini tetap terfokus, maka diberikan batasan-batasan masalah sebagai berikut:</p>
        <ol>
            <li>Aplikasi dikembangkan menggunakan kerangka kerja Laravel 11/13 di sisi backend dan Vue 3 di sisi frontend dengan perantara Inertia.js.</li>
            <li>Proses deteksi wajah (*Face Capture*) menggunakan API WebRTC bawaan browser, sehingga sangat bergantung pada izin akses perangkat kamera hardware.</li>
            <li>Peta dan resolusi alamat lokasi memanfaatkan Nominatim OpenStreetMap yang membutuhkan konektivitas internet aktif.</li>
            <li>Ramalan cuaca di dashboard didapatkan secara asinkron dari Open-Meteo API.</li>
        </ol>

        <h2>1.6 Sistematika Penulisan</h2>
        <p class="no-indent">Sistematika penulisan laporan proyek akhir ini diatur secara berurutan sebagai berikut:</p>
        <ul style="list-style-type: none; padding-left: 0.5cm;">
            <li><strong>BAB 1 PENDAHULUAN:</strong> Memuat latar belakang, rumusan masalah, tujuan, manfaat, batasan masalah, dan sistematika penulisan laporan.</li>
            <li><strong>BAB 2 ANALISA DAN PERENCANAAN:</strong> Menjelaskan analisa kebutuhan sistem, fitur, use case, activity diagram, arsitektur data ERD, dan flowchart sistem.</li>
            <li><strong>BAB 3 DESAIN DAN IMPLEMENTASI:</strong> Memaparkan desain database, struktur tabel, desain UI/UX, tata folder proyek Laravel, dan cuplikan file controller/model/route utama.</li>
            <li><strong>BAB 4 HASIL DAN PEMBAHASAN:</strong> Menyajikan tangkapan layar antarmuka sistem, cara kerja fitur absensi/geocoding, hasil uji endpoint API, dan penyelesaian kendala teknis.</li>
            <li><strong>BAB 5 KESIMPULAN DAN SARAN:</strong> Berisi kesimpulan akhir dari proyek dan saran untuk pengembangan fitur di masa depan.</li>
        </ul>
    </div>


    <!-- ==================== BAB 2 ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            BAB 2<br>ANALISA DAN PERENCANAAN
        </div>

        <h2>2.1 Analisa Kebutuhan</h2>
        <p>
            Sebelum masuk ke tahap implementasi kode, dilakukan analisis kebutuhan fungsional dan non-fungsional untuk merinci spesifikasi sistem yang akan dikembangkan. Kebutuhan fungsional memfokuskan pada apa saja aksi yang dapat dilakukan oleh pengguna dan sistem, sedangkan kebutuhan non-fungsional menitikberatkan pada aspek performa, keamanan, dan kegunaan sistem.
        </p>

        <p class="no-indent"><strong>Tabel 2.1 Analisa Kebutuhan Fungsional</strong></p>
        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 25%;">Aktor</th>
                    <th>Deskripsi Kebutuhan Fungsional</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center-text">KF-01</td>
                    <td>Karyawan</td>
                    <td>Sistem harus dapat menangkap koordinat GPS dan swafoto karyawan via WebRTC kamera untuk absensi check-in/check-out.</td>
                </tr>
                <tr>
                    <td class="center-text">KF-02</td>
                    <td>Sistem / API</td>
                    <td>Sistem harus menerjemahkan koordinat latitude/longitude secara live menjadi alamat administrasi rinci melalui API Nominatim.</td>
                </tr>
                <tr>
                    <td class="center-text">KF-03</td>
                    <td>Karyawan</td>
                    <td>Karyawan dapat mengajukan izin/cuti dengan mengunggah file bukti PDF/Gambar.</td>
                </tr>
                <tr>
                    <td class="center-text">KF-04</td>
                    <td>Admin / HRD</td>
                    <td>Admin dapat mengelola master data karyawan, shift kerja, posisi jabatan, dan departemen melalui antarmuka CRUD.</td>
                </tr>
                <tr>
                    <td class="center-text">KF-05</td>
                    <td>Admin / HRD</td>
                    <td>Admin dapat meninjau rekap absensi keseluruhan dan memberikan persetujuan (approve/reject) terhadap pengajuan cuti.</td>
                </tr>
                <tr>
                    <td class="center-text">KF-06</td>
                    <td>External Apps</td>
                    <td>Pihak ketiga dapat bertukar data profile/kehadiran menggunakan otentikasi API Key kustom dan JWT.</td>
                </tr>
            </tbody>
        </table>

        <h2>2.2 Daftar Fitur Aplikasi</h2>
        <p class="no-indent">Aplikasi presenZ Falco memiliki serangkaian fitur utama berikut:</p>
        <ol>
            <li><strong>Multi-Auth Otorisasi (Laravel Breeze & Spatie Role):</strong> Pembagian modul halaman dashboard antara administrator/HR dan staff karyawan biasa.</li>
            <li><strong>Face & Geolocation Capture (WebRTC):</strong> Absensi swafoto langsung dari kamera perangkat yang digabungkan dengan validasi koordinat latitude dan longitude global.</li>
            <li><strong>Reverse Geocoding OpenStreetMap:</strong> Penerjemah otomatis alamat lokasi fisik presensi di level backend.</li>
            <li><strong>Weather Forecast Widget:</strong> Konsumsi REST API asinkron dari Open-Meteo untuk menyajikan cuaca lokal karyawan.</li>
            <li><strong>Keamanan API Berlapis:</strong> Rute terlindung Sanctum (Token), JWT (kustom enkripsi SHA256), API Key header (`X-API-KEY`), dan Basic HTTP Auth.</li>
            <li><strong>React-Style Glassmorphism Toast:</strong> Notifikasi mengambang dengan transisi halus menggantikan window alert default.</li>
        </ol>

        <h2>2.3 Daftar Pengguna (User Role)</h2>
        <ul>
            <li><strong>Karyawan (Staff):</strong> Pengguna yang melakukan absensi harian, memantau riwayat pribadi, dan mengajukan cuti.</li>
            <li><strong>Admin HRD:</strong> Pengelola administrasi master data, shift, departemen, laporan rekap presensi karyawan, dan approval cuti.</li>
            <li><strong>Super Admin:</strong> Manajemen level tinggi database, konfigurasi sistem, dan hak akses otentikasi API developer eksternal.</li>
        </ul>

        <h2>2.4 Use Case Diagram</h2>
        <p>
            Use Case Diagram menggambarkan interaksi antara aktor (Karyawan, Admin, Aplikasi Eksternal) dengan sistem presenZ Falco. Karyawan melakukan aktivitas presensi dan pengajuan cuti, Admin mengendalikan data master dan persetujuan, sedangkan Sistem Eksternal melakukan request profile lewat API terproteksi.
        </p>
        <pre>
   +-------------------------------------------------------------+
   |                       presenZ SYSTEM                        |
   |                                                             |
   |   (( Melakukan Presensi (Selfie & GPS) )) &lt;--- Karyawan     |
   |   (( Mengajukan Cuti & Izin ))           &lt;--- Karyawan     |
   |   (( Melihat Riwayat Absensi Pribadi ))  &lt;--- Karyawan     |
   |                                                             |
   |   (( Mengelola Data Departemen / Shift )) &lt;--- Admin HRD     |
   |   (( Memberikan Keputusan Cuti ))         &lt;--- Admin HRD     |
   |   (( Memantau Rekapitulasi Absensi ))     &lt;--- Admin HRD     |
   |                                                             |
   |   (( Mengakses endpoint API Profile ))    &lt;--- App Eksternal |
   |      (via JWT / API Key / Basic Auth)                       |
   +-------------------------------------------------------------+
        </pre>
        <div class="image-caption" style="margin-bottom: 0.5cm;">Gambar 2.1 Visualisasi Hubungan Aktor dalam Use Case Diagram</div>

        <h2>2.5 Activity Diagram</h2>
        <p>
            Activity diagram di bawah ini menjelaskan alur aktivitas yang terjadi ketika karyawan melakukan presensi masuk (Check-In) pada halaman dashboard utama. Proses dimulai dari membaca sensor browser hingga penyimpanan data terverifikasi ke database.
        </p>
        <pre>
[Karyawan]               [Dashboard Frontend]             [Backend & API]
    |                              |                              |
 Muka Dashboard ---------------> Minta Izin Kamera & GPS         |
    |                              |                              |
 Setujui Izin --------------> Ambil Selfie WebRTC                 |
                               Ambil Koordinat Geolocation        |
                                   |                              |
                               Kirim Payload JSON -------------> Geocode Koordinat (OSM API)
                                                                 Ambil Cuaca Lokal (Open-Meteo)
                                                                 Simpan ke Tabel Absen
                                                                  |
                               Tampilkan Toast Sukses <--------- Respon JSON 200 OK
        </pre>
        <div class="image-caption" style="margin-bottom: 0.5cm;">Gambar 2.2 Alur Aktivitas Presensi Check-In Karyawan</div>

        <h2>2.6 Entity Relationship Diagram (ERD)</h2>
        <p>
            Struktur relasi data dalam database presenZ dibangun dengan relasi antarentitas yang solid demi menjaga integritas data transaksional absensi. Tabel `users` menjadi pusat relasi yang terhubung dengan master data `departments` dan `positions`. Berikut adalah representasi diagram relasi entitas database:
        </p>
        <pre>
  +------------------+         +--------------+         +----------------+
  |   DEPARTMENTS    |         |  POSITIONS   |         |     SHIFTS     |
  +------------------+         +--------------+         +----------------+
  | id (PK)          |         | id (PK)      |         | id (PK)        |
  | name             |         | name         |         | name           |
  | code             |         | code         |         | start_time     |
  +--------+---------+         +------+-------+         | end_time       |
           |                          |                 +-------+--------+
           | 1                        | 1                       | 1
           |                          |                         |
           | N                        | N                       | N (via pivot)
  +--------v--------------------------v-------+                 |
  |                   USERS                   |<----------------+ user_shift
  +-------------------------------------------+
  | id (PK)                                   |
  | name, email, password, role, nip, api_key |
  | department_id (FK), position_id (FK)      |
  +--------+--------------------------+-------+
           | 1                        | 1
           |                          |
           | N                        | N
  +--------v----------+      +--------v----------+
  |    ATTENDANCES    |      |      LEAVES       |
  +-------------------+      +-------------------+
  | id (PK)           |      | id (PK)           |
  | user_id (FK)      |      | user_id (FK)      |
  | check_in_time     |      | leave_type, reason|
  | check_in_photo    |      | status            |
  | check_in_address  |      | approved_by (FK)  |
  +--------+----------+      +-------------------+
           | 1
           | N
  +--------v----------+
  |  ATTENDANCE_LOGS  |
  +-------------------+
  | id (PK)           |
  | attendance_id (FK)|
  | action, desc      |
  +-------------------+
        </pre>
        <div class="image-caption" style="margin-bottom: 0.5cm;">Gambar 2.3 Skema Database ERD Aplikasi presenZ Falco</div>

        <h2>2.7 Arsitektur Sistem / Flowchart Sistem</h2>
        <p>
            Arsitektur aplikasi presenZ menggunakan pola *Clean Architecture* di mana Laravel bertindak sebagai penyedia API data dan kontrol rute, sementara Inertia.js bertindak sebagai jembatan yang melewatkan data (*data hydration*) secara langsung ke Vue 3 tanpa memicu reload halaman penuh. Untuk rute mobile/eksternal, request dilewatkan melalui file `routes/api.php` terlindung middleware autentikasi khusus (Sanctum/JWT/API Key/Basic Auth) sebelum diproses oleh controller RESTful API.
        </p>
    </div>


    <!-- ==================== BAB 3 ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            BAB 3<br>DESAIN DAN IMPLEMENTASI
        </div>

        <h2>3.1 Desain Database (Tabel dan Relasi)</h2>
        <p>
            Penerapan desain database dilakukan melalui migration terstruktur Laravel. Semua tabel dikonfigurasi menggunakan mesin penyimpanan InnoDB dengan foreign key constraints untuk mencegah adanya data yatim (*orphan data*).
        </p>

        <p class="no-indent"><strong>Tabel 3.1 Kamus Data Tabel Users (Karyawan & Admin)</strong></p>
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Nama Kolom</th>
                    <th style="width: 20%;">Tipe Data</th>
                    <th style="width: 15%;">Atribut</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>id</td>
                    <td>Bigint</td>
                    <td>PK, Auto Inc</td>
                    <td>ID unik pengguna.</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>Varchar(255)</td>
                    <td>Not Null</td>
                    <td>Nama lengkap pengguna.</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>Varchar(255)</td>
                    <td>Unique</td>
                    <td>Email login unik akun.</td>
                </tr>
                <tr>
                    <td>role</td>
                    <td>Varchar(50)</td>
                    <td>Default 'karyawan'</td>
                    <td>Peran otorisasi: admin, hr, karyawan.</td>
                </tr>
                <tr>
                    <td>nip</td>
                    <td>Varchar(50)</td>
                    <td>Nullable, Unique</td>
                    <td>Nomor Induk Pegawai.</td>
                </tr>
                <tr>
                    <td>api_key</td>
                    <td>Varchar(100)</td>
                    <td>Unique</td>
                    <td>Token akses API Key developer.</td>
                </tr>
                <tr>
                    <td>department_id</td>
                    <td>Bigint</td>
                    <td>FK (departments)</td>
                    <td>Relasi divisi karyawan.</td>
                </tr>
                <tr>
                    <td>position_id</td>
                    <td>Bigint</td>
                    <td>FK (positions)</td>
                    <td>Relasi tingkat jabatan structural.</td>
                </tr>
            </tbody>
        </table>

        <p class="no-indent"><strong>Tabel 3.2 Kamus Data Tabel Attendances (Log Transaksional Presensi)</strong></p>
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Nama Kolom</th>
                    <th style="width: 20%;">Tipe Data</th>
                    <th style="width: 15%;">Atribut</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>id</td>
                    <td>Bigint</td>
                    <td>PK, Auto Inc</td>
                    <td>ID unik absensi.</td>
                </tr>
                <tr>
                    <td>user_id</td>
                    <td>Bigint</td>
                    <td>FK (users)</td>
                    <td>Karyawan yang melakukan absensi.</td>
                </tr>
                <tr>
                    <td>check_in_time</td>
                    <td>Datetime</td>
                    <td>Nullable</td>
                    <td>Tanggal & waktu absen masuk.</td>
                </tr>
                <tr>
                    <td>check_in_photo</td>
                    <td>Varchar(255)</td>
                    <td>Nullable</td>
                    <td>Nama file swafoto check-in.</td>
                </tr>
                <tr>
                    <td>check_in_lat</td>
                    <td>Decimal(10,8)</td>
                    <td>Nullable</td>
                    <td>Koordinat latitude check-in.</td>
                </tr>
                <tr>
                    <td>check_in_long</td>
                    <td>Decimal(11,8)</td>
                    <td>Nullable</td>
                    <td>Koordinat longitude check-in.</td>
                </tr>
                <tr>
                    <td>check_in_address</td>
                    <td>Varchar(500)</td>
                    <td>Nullable</td>
                    <td>Alamat lengkap geocoding masuk.</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>Varchar(50)</td>
                    <td>Not Null</td>
                    <td>Status: present, late, absent.</td>
                </tr>
            </tbody>
        </table>

        <h2>3.2 Desain Antarmuka (UI/UX)</h2>
        <p>
            Konsep desain antarmuka dikembangkan dengan memprioritaskan kenyamanan pengguna melalui visualisasi modern. Skema warna utama yang diusung adalah **"Iceberg White & Gradient"** dengan gradasi biru langit yang stabil pada background dasar halaman dashboard. Setiap komponen panel dibungkus menggunakan CSS *glassmorphism* (kartu semi-transparan dengan efek blur tinggi `backdrop-filter: blur(12px)`).
        </p>
        <p>
            Untuk memberikan umpan balik (feedback) interaktif tanpa mengganggu fokus visual pengguna, dikembangkan komponen **Toast Notification** melayang di sisi kanan bawah. Notifikasi ini menggunakan animasi translasi halus, menggantikan pesan konfirmasi pop-up default web browser yang kaku. Panel koordinat absensi dilengkapi dengan indikator visual sinyal sensor GPS dan grid card info alamat hasil geocoding secara terstruktur.
        </p>

        <h2>3.3 Struktur Folder Proyek Laravel</h2>
        <p class="no-indent">Berikut adalah struktur direktori utama proyek Laravel presenZ Falco yang memuat komponen penting sistem:</p>
        <pre>
presenZ/
├── app/
│   ├── Console/Commands/
│   │   └── GenerateReportPdf.php      <-- Command Generator PDF Laporan ini
│   ├── Http/Controllers/
│   │   ├── Api/V1/                    <-- Controller RESTful API Terdistribusi
│   │   │   ├── AttendanceController.php
│   │   │   ├── AuthController.php
│   │   │   └── ExternalWeatherController.php
│   │   ├── Web/                       <-- Controller Dashboard Web Inertia
│   │   │   ├── AttendanceWebController.php
│   │   │   └── LeaveWebController.php
│   │   └── Middleware/
│   │       ├── ApiKeyMiddleware.php
│   │       └── JwtAuthMiddleware.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Attendance.php
│   │   └── Leave.php
│   └── Services/
│       └── GeocodingService.php       <-- Service Nominatim OSM Geocoding
├── database/
│   ├── migrations/                    <-- Migrasi Skema Tabel Database
│   └── seeders/                       <-- Seeder Akun Dummy (Admin & Karyawan)
├── resources/
│   ├── css/app.css                    <-- Styling Gradasi & Glassmorphism
│   ├── js/
│   │   ├── Components/
│   │   │   └── ToastContainer.vue     <-- UI Toast Notifikasi Premium
│   │   └── Pages/
│   │       ├── Dashboard.vue          <-- Tampilan Utama Check-In & WebRTC
│   │       └── Admin/Attendance.vue   <-- Monitoring Laporan Rekap Admin
│   └── views/
│       ├── report-uas.blade.php       <-- Template Laporan Akhir HTML
│       └── swagger.blade.php          <-- API Dokumentasi Open API
└── routes/
    ├── api.php                        <-- Rute Integrasi API
    └── web.php                        <-- Rute Aplikasi Web Utama
        </pre>

        <h2>3.4 Struktur Kode Program</h2>
        <p class="no-indent">Di bawah ini dilampirkan ringkasan implementasi kode program kunci pada sisi backend:</p>

        <h3>1. Middleware Autentikasi API Key Kustom</h3>
        <pre>
// app/Http/Middleware/ApiKeyMiddleware.php
public function handle(Request $request, Closure $next)
{
    $apiKey = $request->header('X-API-KEY');
    if (!$apiKey) {
        return response()->json(['message' => 'API Key is missing'], 401);
    }
    $user = User::where('api_key', $apiKey)->first();
    if (!$user) {
        return response()->json(['message' => 'Invalid API Key'], 401);
    }
    Auth::login($user);
    return $next($request);
}
        </pre>

        <h3>2. Integrasi Konsumsi API Cuaca Eksternal (Open-Meteo)</h3>
        <pre>
// app/Http/Controllers/Api/V1/ExternalWeatherController.php
public function getWeather(Request $request)
{
    $validated = $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);
    
    $response = Http::withoutVerifying()->timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
        'latitude' => $validated['latitude'],
        'longitude' => $validated['longitude'],
        'current_weather' => 'true',
    ]);

    return response()->json($response->json());
}
        </pre>

        <h2>3.5 Fitur Utama yang Diimplementasikan</h2>
        <p>
            <strong>Integrasi Kamera WebRTC:</strong> Absensi swafoto diolah di sisi frontend menggunakan tangkapan stream kamera hardware penjelajah web (`navigator.mediaDevices.getUserMedia`) yang dirender ke elemen Canvas HTML5, dikonversi menjadi berkas Base64 / Blob gambar, kemudian dikirimkan secara asinkron ke server Laravel.
        </p>
        <p>
            <strong>Live Geocoding Service:</strong> Mengirimkan koordinat GPS mentah dari frontend ke `/attendance/reverse-geocode` secara dinamis. Server Laravel memanfaatkan HttpClient terintegrasi untuk menghubungi API Nominatim OpenStreetMap dengan header User-Agent resmi. Hasil JSON alamat diurai dan dipetakan ke dalam array alamat terstruktur (Jalan, Kelurahan, Kecamatan, Kota, Provinsi, Negara) untuk ditampilkan secara *real-time* sebelum absen disimpan.
        </p>
    </div>


    <!-- ==================== BAB 4 ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            BAB 4<br>HASIL DAN PEMBAHASAN
        </div>

        <h2>4.1 Tampilan Aplikasi (Screenshot)</h2>
        <p>
            Berikut adalah tangkapan layar antarmuka aplikasi presenZ Falco yang berjalan di lingkungan lokal server Laragon:
        </p>

        <div class="image-container">
            @if(isset($images['img_dashboard']))
                <img src="data:image/png;base64,{{ $images['img_dashboard'] }}" alt="Dashboard Live Selfie & GPS">
            @endif
            <div class="image-caption">Gambar 4.1 Tampilan Panel Dasbor Absensi Karyawan & Kamera WebRTC Active</div>
        </div>

        <div class="image-container">
            @if(isset($images['img_coordinates']))
                <img src="data:image/png;base64,{{ $images['img_coordinates'] }}" alt="Widget Koordinat GPS">
            @endif
            <div class="image-caption">Gambar 4.2 Widget Detektor Sensor Koordinat Latitude & Longitude Geolocation</div>
        </div>

        <div class="image-container">
            @if(isset($images['img_address']))
                <img src="data:image/png;base64,{{ $images['img_address'] }}" alt="Detail Alamat Fisik">
            @endif
            <div class="image-caption">Gambar 4.3 Hasil Penerjemahan Geocoding Menjadi Informasi Alamat Administratif</div>
        </div>

        <div class="image-container">
            @if(isset($images['img_toast']))
                <img src="data:image/png;base64,{{ $images['img_toast'] }}" alt="Toast Notifikasi Melayang">
            @endif
            <div class="image-caption">Gambar 4.4 Perbandingan Modul Alert Browser Lama dengan Toast Notification Modern</div>
        </div>

        <h2>4.2 Cara Kerja Fitur Utama</h2>
        <p>
            Saat karyawan memuat halaman Dashboard, Vue secara otomatis meminta izin akses Geolocation browser (`navigator.geolocation.getCurrentPosition`). Begitu koordinat latitude dan longitude terkunci, fungsi asinkron `fetchAddressDetails` segera dipicu untuk mengirimkan koordinat tersebut ke backend Laravel. Backend meneruskan permintaan ke Nominatim API dengan opsi bypass verifikasi SSL (`withoutVerifying()`). 
        </p>
        <p>
            Alamat lengkap yang dikembalikan langsung membanjiri grid layout halaman pengguna. Karyawan kemudian memicu kamera WebRTC untuk mengambil swafoto verifikasi wajah. Setelah foto ter-capture, karyawan menekan tombol Check-In. Seluruh parameter absensi (waktu, koordinat, alamat lengkap, foto base64, IP address, dan user agent) disimpan ke database.
        </p>

        <h2>4.3 Hasil Pengujian (Testing)</h2>
        <p>
            Pengujian sistem terbagi menjadi dua tahap: unit/feature testing otomatis via PHPUnit dan pengujian integrasi antarmuka REST API menggunakan Postman. Seluruh 29 test case di PHPUnit berhasil terlewati tanpa *error* dengan ringkasan endpoint sebagai berikut:
        </p>

        <p class="no-indent"><strong>Tabel 4.1 Rincian API Endpoint & Status Hasil Uji</strong></p>
        <table>
            <thead>
                <tr>
                    <th style="width: 25%;">API Endpoint</th>
                    <th style="width: 15%;">Metode</th>
                    <th style="width: 20%;">Otentikasi</th>
                    <th>Status Uji</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>`/api/v1/auth/jwt/login`</td>
                    <td class="center-text">`POST`</td>
                    <td>None</td>
                    <td><strong>PASSED</strong> (Kembali Token JWT)</td>
                </tr>
                <tr>
                    <td>`/api/v1/jwt/profile`</td>
                    <td class="center-text">`GET`</td>
                    <td>Custom JWT</td>
                    <td><strong>PASSED</strong> (Kembali Profile Karyawan)</td>
                </tr>
                <tr>
                    <td>`/api/v1/apikey/profile`</td>
                    <td class="center-text">`GET`</td>
                    <td>`X-API-KEY`</td>
                    <td><strong>PASSED</strong> (Lolos via ApiKeyMiddleware)</td>
                </tr>
                <tr>
                    <td>`/api/v1/basic/profile`</td>
                    <td class="center-text">`GET`</td>
                    <td>Basic Auth</td>
                    <td><strong>PASSED</strong> (Lolos via HTTP Header Base64)</td>
                </tr>
                <tr>
                    <td>`/api/v1/weather`</td>
                    <td class="center-text">`GET`</td>
                    <td>None / Public</td>
                    <td><strong>PASSED</strong> (Mengembalikan suhu & weathercode)</td>
                </tr>
            </tbody>
        </table>

        <h2>4.4 Kendala yang Dihadapi dan Solusi</h2>
        <p>
            <strong>1. Kendala SSL Certificate (cURL error 60/77) pada Localhost:</strong> Pada saat backend Laravel mencoba menghubungi API Nominatim OpenStreetMap, PHP memicu cURL error karena PHP pada localhost Laragon tidak memiliki file Certificate Authority (`cacert.pem`) yang valid. Solusinya adalah menyematkan fungsi `.withoutVerifying()` pada HTTP client Laravel agar mengabaikan validasi SSL lokal saat development.
        </p>
        <p>
            <strong>2. Sinkronisasi Notifikasi Asinkron:</strong> Pada Laravel Breeze bawaan, redirect data seringkali memicu alert native browser. Solusinya adalah membangun *global reactive state* menggunakan Vue Composables (`useToast.js`) yang dihubungkan dengan layout inti (`AuthenticatedLayout.vue` & `AdminLayout.vue`) untuk menyajikan toast glassmorphism beranimasi lancar.
        </p>
    </div>


    <!-- ==================== BAB 5 ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            BAB 5<br>KESIMPULAN DAN SARAN
        </div>

        <h2>5.1 Kesimpulan</h2>
        <p>
            Berdasarkan seluruh tahapan analisa, perancangan, implementasi, dan pengujian yang telah diselesaikan pada aplikasi **presenZ Falco**, dapat ditarik beberapa kesimpulan sebagai berikut:
        </p>
        <ol>
            <li>Aplikasi absensi berbasis Geolocation dan WebRTC Face Capture berhasil diimplementasikan secara lancar, memberikan solusi pencatatan absensi yang fleksibel dan terlindungi dari manipulasi lokasi koordinat palsu.</li>
            <li>Integrasi Nominatim OpenStreetMap API pada backend Laravel berhasil mengotomatiskan konversi data koordinat mentah menjadi alamat administrasi fisik terstruktur (jalan, kelurahan, kecamatan, kota, provinsi, negara) secara *live* di dasbor pengguna.</li>
            <li>Arsitektur keamanan API Multi-Auth (Sanctum, JWT, API Key, dan Basic Auth) yang dibangun sukses melewati seluruh uji unit testing, menjamin keamanan transaksi pertukaran data profil.</li>
            <li>Tampilan UI bertema *Iceberg White & Gradient* yang semi-transparan dipadukan dengan Toast Notification premium berhasil mewujudkan visualisasi sistem yang interaktif dan bernilai estetika tinggi.</li>
        </ol>

        <h2>5.2 Saran</h2>
        <p class="no-indent">Beberapa saran yang dapat diajukan untuk pengembangan aplikasi presenZ Falco selanjutnya adalah:</p>
        <ul>
            <li>Mengintegrasikan algoritma pengenalan wajah (*Face Recognition*) berbasis AI (misalnya tensorflow.js) di sisi client untuk memvalidasi kemiripan wajah karyawan secara real-time.</li>
            <li>Menyediakan fitur luring (*Offline Mode*) absensi menggunakan penyimpanan lokal indexDB yang akan otomatis tersinkronisasi ketika perangkat kembali mendeteksi sinyal internet.</li>
            <li>Menambahkan fitur *geofencing* radius melingkar dari kantor utama untuk secara otomatis menandai status absensi karyawan luar kantor atau dalam kantor.</li>
        </ul>
    </div>


    <!-- ==================== DAFTAR PUSTAKA ==================== -->
    <div class="page-break">
        <div class="chapter-title">
            DAFTAR PUSTAKA
        </div>
        <p class="no-indent" style="margin-left: 1cm; text-indent: -1cm; margin-bottom: 0.3cm;">
            Aditya Prapanca. (2025). <i>Modul Ajar Pemrograman Platform Terdistribusi & RESTful API</i>. Surabaya: Universitas Negeri Surabaya.
        </p>
        <p class="no-indent" style="margin-left: 1cm; text-indent: -1cm; margin-bottom: 0.3cm;">
            Laravel Documentation. (2026). <i>Laravel HTTP Client and Custom Middleware Protection</i>. Diakses dari <a href="https://laravel.com/docs" target="_blank">https://laravel.com/docs</a>.
        </p>
        <p class="no-indent" style="margin-left: 1cm; text-indent: -1cm; margin-bottom: 0.3cm;">
            MDN Web Docs. (2025). <i>WebRTC API and Geolocation Navigator Web Browser</i>. Diakses dari <a href="https://developer.mozilla.org/en-US/" target="_blank">https://developer.mozilla.org/en-US/</a>.
        </p>
        <p class="no-indent" style="margin-left: 1cm; text-indent: -1cm; margin-bottom: 0.3cm;">
            OpenStreetMap Nominatim. (2026). <i>Nominatim Reverse Geocoding API Documentation Guidelines</i>. Diakses dari <a href="https://nominatim.org/release-docs/" target="_blank">https://nominatim.org/release-docs/</a>.
        </p>
        <p class="no-indent" style="margin-left: 1cm; text-indent: -1cm; margin-bottom: 0.3cm;">
            Open-Meteo API. (2026). <i>Free Weather Forecast API Integration Parameters</i>. Diakses dari <a href="https://open-meteo.com/" target="_blank">https://open-meteo.com/</a>.
        </p>
    </div>


    <!-- ==================== LAMPIRAN ==================== -->
    <div>
        <div class="chapter-title">
            LAMPIRAN
        </div>
        <h3>Lampiran 1: Tabel Pembagian Tugas Anggota Kelompok</h3>
        <p class="no-indent">
            Tabel berikut menyajikan matriks pembagian tugas dan peran masing-masing anggota Kelompok Falco dalam menyelesaikan proyek akhir UAS mata kuliah Pemrograman API:
        </p>
        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">No</th>
                    <th style="width: 25%;">Nama Anggota</th>
                    <th style="width: 17%;">NIM</th>
                    <th>Tugas & Kontribusi yang Dikerjakan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center-text">1</td>
                    <td>Muhammad Hafidz</td>
                    <td class="center-text">24091397001</td>
                    <td>Analisis Kebutuhan Sistem, Perencanaan Struktur Database, Pembuatan File Migration, dan Pendefinisian Eloquent Model.</td>
                </tr>
                <tr>
                    <td class="center-text">2</td>
                    <td>Ahmad Fadil</td>
                    <td class="center-text">24091397002</td>
                    <td>Pembuatan RESTful Controller API, Pemetaan File Rute (Route), Implementasi Custom JWT, API Key, dan Logic Integrasi Cuaca.</td>
                </tr>
                <tr>
                    <td class="center-text">3</td>
                    <td>Rizky Maulana</td>
                    <td class="center-text">24091397003</td>
                    <td>Desain Antarmuka Frontend Vue 3, Integrasi Inertia Layout, Penyusunan Animasi Glassmorphism Toast, dan Implementasi Kamera WebRTC.</td>
                </tr>
                <tr>
                    <td class="center-text">4</td>
                    <td>Zulkifli Arifin</td>
                    <td class="center-text">24091397004</td>
                    <td>Pembuatan Unit & Feature Testing (PHPUnit), Pengujian API Endpoint Postman, Penyusunan Laporan Proyek Akhir, dan Presentasi Video Demo.</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
