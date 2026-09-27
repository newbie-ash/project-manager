# System Flowchart & User Journey
## A'ritza - Luxury Fashion E-Commerce

Berikut adalah alur navigasi dari kedua sisi pengguna (Buyer & Admin) di dalam ekosistem A'ritza.

### 1. Buyer / Guest Flow (Customer Journey)

```mermaid
flowchart TD
    A[Masuk ke Landing Page /] --> B{Pilih Aksi?}
    B -->|Melihat Koleksi| C[Halaman Katalog /products]
    B -->|Pencarian/Filter| D[Filter /products?search=...]
    C --> E{Klik Tombol Pre-Order}
    D --> E
    
    E --> F{Sudah Login?}
    F -->|Belum| G[Halaman /login]
    G -->|Berhasil| H[Redirect ke Halaman Sebelumnya / Katalog]
    H --> E
    
    F -->|Sudah| I[Sistem memproses Pre-Order (POST /orders)]
    I --> J[Halaman /my-purchases]
    J --> K[Pelanggan dapat memantau status pesanan]
    
    J --> L{Selesai Belanja?}
    L -->|Logout| M[Redirect ke Landing Page /]
```

### 2. Administrator Flow (Backoffice Journey)

```mermaid
flowchart TD
    A[Masuk ke /login dengan akun Admin] --> B[Sistem mendeteksi role 'admin']
    B --> C[Masuk ke Backoffice Dashboard /dashboard]
    
    C --> D{Menu Sidebar}
    
    D -->|Dashboard| E[Melihat Chart.js Analytics]
    
    D -->|Manage Products| F[Halaman /admin/products]
    F --> G{Aksi CRUD}
    G -->|Add Piece| H[Form Create Produk]
    G -->|Edit| I[Form Edit Produk]
    G -->|Delete| J[Hapus Produk]
    
    D -->|Client Orders| K[Halaman /orders]
    K --> L[Melihat daftar Pre-Order pelanggan]
    L --> M{Update Status}
    M -->|Klik Ship| N[Status berubah menjadi Shipped]
    M -->|Klik Deliver| O[Status berubah menjadi Delivered]
    
    D -->|Complaints| P[Halaman /complaints]
    P --> Q[Membaca Keluhan]
    Q --> R[Klik 'Resolve' untuk menutup tiket]
    
    E --> S[Logout]
    F --> S
    K --> S
    P --> S
    S --> T[Redirect ke Landing Page /]
```
