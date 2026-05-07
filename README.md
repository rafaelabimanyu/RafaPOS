# 🍃 Rafa Kasir - Modern Point of Sale (POS) System

![Rafa Kasir Banner](https://img.shields.io/badge/Rafa_Kasir-Mint_Green_Edition-7ed9b1?style=for-the-badge)
![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css)

**Rafa Kasir** adalah solusi Point of Sale (POS) berbasis web yang dirancang untuk kecepatan, kemudahan penggunaan, dan estetika modern. Dengan antarmuka **Mint Green Light Theme** yang menyejukkan mata, aplikasi ini memastikan pengalaman transaksi yang mulus bagi petugas dan analitik yang mendalam bagi admin.

---

## 🚀 Fitur Unggulan

### 👑 Modul Super Admin (Full Control)
*   **📊 Laporan & Analitik Visual**: Pantau performa bisnis dengan grafik tren pendapatan harian dan statistik produk terlaris yang didukung oleh **Chart.js**.
*   **🖨️ Ekspor Data Profesional**: Unduh laporan penjualan ke format **Excel (CSV)** atau cetak dokumen **PDF** resmi untuk arsip fisik.
*   **⚙️ Pengaturan Toko Dinamis**: Ubah identitas toko (Nama, Alamat, Telepon, Footer Struk) secara *real-time* yang otomatis terintegrasi pada setiap struk belanja.
*   **📦 Manajemen Inventaris Cerdas**: Kelola Kategori, Master Barang, dan pantau log pergerakan stok (Masuk/Keluar) dengan presisi.
*   **👥 User Management**: Kelola hak akses petugas dengan sistem **Role-Based Access Control (RBAC)** yang ketat dan aman.

### 🛒 Modul Petugas (Kasir Interface)
*   **⚡ POS Interaktif**: Antarmuka kasir yang responsif dengan fitur pencarian barang *real-time* dan manajemen keranjang belanja yang intuitif.
*   **💰 Sistem Diskon Dinamis**: Dukungan pemberian diskon baik dalam bentuk **Persentase (%)** maupun **Nominal (Rp)** secara langsung saat transaksi.
*   **🔄 Workflow Efisien**: Proses pembayaran cepat dengan kalkulasi kembalian otomatis dan update stok *real-time*.

---

## 🛠️ Tech Stack
Aplikasi ini dibangun menggunakan teknologi mutakhir untuk menjamin performa dan skalabilitas:

- **Backend**: [Laravel 11](https://laravel.com/) (The PHP Framework for Web Artisans)
- **Frontend Styling**: [Tailwind CSS 4](https://tailwindcss.com/)
- **Interactivity**: [Alpine.js](https://alpinejs.dev/)
- **Data Visualization**: [Chart.js](https://www.chartjs.org/)
- **UI Components**: SweetAlert2 & Toastify.js

---

## 📦 Instalasi Proyek

Ikuti langkah-langkah berikut untuk menjalankan **Rafa Kasir** di lingkungan lokal Anda:

1. **Clone Repositori**
   ```bash
   git clone https://github.com/username/RafaPOS.git
   cd RafaPOS
   ```

2. **Instalasi Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi & Seeding**
   Jalankan migrasi untuk membuat tabel dan mengisi data awal (Admin & Petugas default).
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   npm run dev
   ```

---

## 🎨 Design Philosophy
Rafa Kasir mengusung tema **Light Mode Only** dengan palet warna **Mint Green**. Keputusan desain ini diambil untuk menciptakan suasana kerja yang bersih, profesional, dan mengurangi kelelahan mata (*eye strain*) selama penggunaan jangka panjang di toko.

---

## 📄 Lisensi
Proyek ini dikembangkan sebagai bagian dari solusi POS kustom. Hak cipta dilindungi oleh pengembang terkait.

---
*Developed with ❤️ by Antigravity AI*
