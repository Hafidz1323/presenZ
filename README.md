# PresenZ - Full Stack HRIS System

Sistem Manajemen Kehadiran Karyawan (HRIS) berbasis Full Stack Web Application.

## 🚀 Fitur Utama
- **Frontend Modern**: Menggunakan Inertia.js, Vue 3, dan Tailwind CSS. Terasa sangat cepat layaknya SPA (Single Page Application).
- **Authentication**: Setup instan via Laravel Breeze + Sanctum.
- **Karyawan UI**:
  - Dashboard interaktif.
  - **Live Check-in/Check-out** menggunakan akses Kamera (selfie) dan Geolocation (Latitude & Longitude).
  - Pengajuan Cuti/Izin dengan attachment.
- **Admin/HR UI**:
  - Dashboard statistik kehadiran hari ini.
  - Manajemen Data Master (Departemen, Jabatan, Shift).
  - Manajemen Karyawan.
  - Laporan semua Absensi.
  - Approval Pengajuan Cuti.

## 🛠 Teknologi
- **PHP**: ^8.3
- **Laravel**: ^11.x
- **Frontend**: Vue 3 + Inertia.js + Tailwind CSS
- **Database**: MySQL / MariaDB

## 📦 Instalasi & Menjalankan Project

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi PresenZ Full Stack:

### 1. Clone & Install Dependencies
Jika Anda baru mem-pull / clone repository ini, jalankan:
```bash
composer install
npm install
```

### 2. Setup Environment Variable
Duplikat file `.env.example` menjadi `.env`.
```bash
cp .env.example .env
```
Sesuaikan konfigurasi koneksi database Anda di file `.env`. (Pastikan MySQL berjalan).
Lalu jalankan:
```bash
php artisan key:generate
```

### 3. Setup Database (Migrate & Seed)
Buat database bernama `presenz` di MySQL. Lalu jalankan perintah berikut untuk mengisi tabel dan data dummy:
```bash
php artisan migrate:fresh --seed
```

### 4. Storage Link (Penting untuk Foto Absensi)
Jalankan command ini agar foto selfie bisa diakses di web:
```bash
php artisan storage:link
```

### 5. Build Frontend & Jalankan Server
Buka dua terminal terpisah:

**Terminal 1 (Build Vue Frontend):**
```bash
npm run dev
```
*(Atau jika untuk production, gunakan `npm run build`)*

**Terminal 2 (Jalankan Laravel):**
```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser Anda!

---

## 👩‍💻 Akun Login Dummy

Seeder telah menyiapkan akun dummy:

**1. Admin**
- Email: `admin@presenz.com`
- Password: `password`

**2. HR Manager**
- Email: `hr@presenz.com`
- Password: `password`

**3. Karyawan**
- Email: `karyawan1@presenz.com` s/d `karyawan10@presenz.com`
- Password: `password`

> **Note**: Saat karyawan melakukan Check-in, browser akan meminta izin (Permission) untuk mengakses **Kamera** dan **Lokasi**. Pastikan Anda meng-allow akses tersebut agar fitur bekerja.

---
*Didesain dengan warna dominan biru (#1E40AF) yang modern dan profesional.*
