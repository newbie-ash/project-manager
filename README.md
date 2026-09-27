# A'ritza - Maison de Luxe 💎

A'ritza adalah aplikasi *e-commerce* premium bergaya *luxury fashion boutique* (terinspirasi dari Chanel, Balenciaga, dan H&M). Proyek ini dibangun sebagai **Tugas Mini Project Pemrograman Web (Durasi 1 Minggu)**.

Platform ini mendemonstrasikan integrasi penuh antara **VILT Stack** (Vue, Inertia, Laravel, Tailwind CSS) dengan implementasi sistem *Role-Based Access Control* (RBAC), arsitektur *Monolith* Modern, dan interaktivitas tingkat lanjut yang dibalut dalam *User Interface* kelas atas.

## 🌟 Fitur Utama

- **VILT Stack Modern:** Memisahkan *backend* (Laravel) dan *frontend* (Vue 3) menjadi SPA (*Single Page Application*) reaktif tanpa perlu mengonfigurasi REST API secara manual berkat **Inertia.js**.
- **Role-Based Access Control (RBAC):** Membedakan dua perjalanan pengguna (*User Journey*):
  - `Admin`: Memiliki akses ke Backoffice (Dashboard, CRUD Inventaris, pemrosesan Pesanan, dan penyelesaian Komplain).
  - `Guest/Buyer`: Dapat menelusuri Katalog Publik, mencari produk, dan melakukan Pre-Order produk (yang membutuhkan Autentikasi).
- **Luxury UI/UX & Layout Separation:** Menggunakan palet eksklusif (Maroon, Cream, Gold) dengan pemisahan *layout* secara struktural:
  - `AdminLayout`: *Top-navbar* minimalis (digunakan untuk halaman etalase/publik).
  - `BackofficeLayout`: *Left-sidebar* profesional (digunakan khusus untuk Dasbor Admin).
- **Interactive Dashboard (Real-Time Charts):** Dasbor terintegrasi dengan pustaka `Chart.js` dan `vue-chartjs` untuk merender metrik *Revenue Analytics* (Bar Chart) dan *Sales by Category* (Doughnut Chart).
- **Search & Filter Terintegrasi:** Katalog produk dilengkapi kolom pencarian interaktif dan filter kategori (Handbags, Accessories, dll) yang parameternya saling terhubung via SSR (*Server-Side* Laravel).
- **Order Management & Customer Support:** Admin dapat memperbarui status pesanan secara *real-time* (*Processing -> Shipped -> Delivered*) serta mengelola tiket komplain pelanggan.
- **Keamanan (Web Security):** Terproteksi secara *default* dari celah SQL Injection (PDO Eloquent), XSS (Vue *escaping*), dan CSRF (Native Laravel Tokens).

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 11.x
- **Frontend:** Vue 3 (Composition API)
- **Routing:** Inertia.js (untuk Vue) & Ziggy (untuk *route helpers*)
- **Styling:** Tailwind CSS 3
- **Data Visualization:** Chart.js & vue-chartjs
- **Bundler:** Vite
- **Database:** SQLite / MySQL

## 🚀 Panduan Instalasi (Setup Guide)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda:

### 1. Kloning Repositori
```bash
git clone https://github.com/username-anda/nama-repo-anda.git
cd nama-repo-anda
```

### 2. Instalasi Dependensi
Pastikan Anda telah menginstal PHP, Composer, dan Node.js.
```bash
# Install PHP Dependencies
composer install

# Install Frontend Dependencies (termasuk Chart.js)
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```
*(Gunakan `DB_CONNECTION=sqlite` di file `.env` jika ingin setup yang lebih ringkas tanpa MySQL).*

### 4. Migrasi & Seeding Database
Jalankan perintah ini untuk membangun tabel (Users, Products, Orders, Complaints) dan mengisi data *dummy* eksklusif.
```bash
php artisan migrate:fresh --seed
```
*Gunakan akun bawaan dari seeder untuk mencoba fitur:*
- **Admin**: `admin@example.com` | Password: `password123`
- **Buyer/Staff**: `staff@example.com` | Password: `password123`

### 5. Menjalankan Server Development
Buka 2 tab terminal untuk menjalankan PHP Server dan Vite Bundler secara simultan:

**Terminal 1:**
```bash
php artisan serve
```

**Terminal 2:**
```bash
npm run dev
```

Buka `http://127.0.0.1:8000` di *browser* Anda untuk menikmati etalase A'ritza!

---

## 📁 Dokumentasi Arsitektur Lengkap
Untuk melihat pemodelan teknis proyek ini (Flowchart, ERD, dan struktur diagram MVC), silakan lihat dokumen Blueprint di folder `docs/`:
- [Product Requirements Document (PRD)](./docs/PRD.md)
- [System Architecture Document (SAD)](./docs/SAD.md)
- [System Flowchart & User Journey](./docs/FLOWCHART.md)

## 🎨 Konvensi Desain
- **Maroon-900** (`#611624`): Warna utama/dominan untuk memberikan kesan mahal, elegan, dan tegas.
- **Cream-50** (`#fdfbf7`): Latar belakang utama pengganti warna putih murni agar lebih ramah di mata (hangat).
- **Gold** (`#c8a97e`): Warna aksen untuk sorotan penting (Status pemesanan, *hover* interaktif, dsb).
