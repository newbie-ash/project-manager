# Product Requirements Document (PRD)
## A'ritza - Luxury Fashion E-Commerce

### 1. Executive Summary
A'ritza adalah platform *e-commerce* bergaya *high-fashion* yang memungkinkan pelanggan melihat katalog pakaian/aksesoris eksklusif dan melakukan pemesanan (Pre-Order). Platform ini juga dilengkapi dengan antarmuka Backoffice (Dashboard) bagi administrator untuk mengelola inventaris, melacak penjualan, mengubah status pesanan pelanggan, serta menangani keluhan (complaints).

### 2. Target Audience
1. **Buyers / Guests:** Individu yang mencari produk fesyen kelas atas. Mereka dapat melihat produk secara bebas (Guest) namun diwajibkan untuk *Login/Register* jika ingin melakukan *Pre-Order*.
2. **Administrators:** Staf internal A'ritza yang mengelola produk, memproses pengiriman pesanan, melacak data penjualan (*Revenue Analytics*), dan menjawab keluhan pelanggan.

### 3. Core Features & Requirements

#### 3.1 Public Storefront (Front-End)
* **Landing Page:** Menampilkan etalase mewah, *featured products*, dan pesan sambutan yang berkelas.
* **Katalog Produk (The Collection):** Halaman yang menampilkan seluruh koleksi dengan fitur penyaringan (filter) berdasarkan kategori (Handbags, Accessories, dll) dan fitur Pencarian (*Search*).
* **Pre-Order System:** Kemampuan untuk memesan barang. Jika pengguna belum masuk (Guest), pengguna akan diarahkan ke form login.
* **My Purchases:** Dasbor bagi pembeli untuk melihat riwayat dan status dari produk yang telah mereka beli.

#### 3.2 Backoffice System (Admin)
* **Dashboard Analytics:** Grafik interaktif (*Real-Time*) menggunakan Chart.js yang mencakup statistik pendapatan bulanan (Bar Chart) dan penjualan per kategori (Doughnut Chart).
* **Inventory Management:** Antarmuka tabel CRUD untuk menambah (*Add Piece*), mengubah (*Edit*), dan menghapus (*Delete*) koleksi produk.
* **Order Processing:** Melacak pesanan klien dan memutakhirkan status pemesanan (*Processing* -> *Shipped* -> *Delivered*).
* **Customer Support (Complaints):** Sistem tiket sederhana bagi Admin untuk membaca dan menyelesaikan masalah (Mark as Resolved) dari pelanggan.

### 4. Technical Specifications
* **Framework:** Laravel 11 (PHP)
* **Frontend:** Vue.js 3 + Inertia.js + Tailwind CSS
* **Database:** MySQL / SQLite
* **Authentication:** Laravel Breeze (Session-based)
* **Styling Theme:** Maroon-900 (`#611624`), Gold (`#c8a97e`), dan Cream (`#fdfbf7`).

### 5. Future Enhancements
* Fitur *Payment Gateway* terintegrasi (Midtrans / Stripe).
* Form pengisian alamat pengiriman pada saat Pre-Order.
* Fitur *Live Chat* untuk keluhan pelanggan yang lebih dinamis.
