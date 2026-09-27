# System Architecture Document (SAD)
## A'ritza - Luxury Fashion E-Commerce

### 1. Architectural Pattern
Platform A'ritza menggunakan pola arsitektur **Monolith Modern** yang memanfaatkan pendekatan SPA (Single Page Application) tanpa perlu memisahkan backend dan frontend secara fisik (API-only). Hal ini dicapai berkat penggunaan arsitektur jembatan **Inertia.js**.

- **Model-View-Controller (MVC):** Laravel menangani Model (Database) dan Controller (Business Logic).
- **View:** Vue.js mengambil alih bagian View dengan komponen-komponen reaktif.

### 2. High-Level Architecture
```text
[ Client / Browser ]
        |
        v (HTTP / Inertia Requests)
[ Route (web.php) ]
        |
        v (Middleware: auth, role:admin, guest)
[ Controllers ] (ProductController, OrderController, etc.)
        |
        v (Eloquent ORM)
[ Database ] (Products, Orders, Users, Complaints)
```

### 3. Database Schema (Entity Relationship)

* **Users Table:**
  - `id` (PK)
  - `name`, `email`, `password`
  - `role` (enum: 'admin', 'user') - *Menentukan hak akses sistem.*
* **Products Table:**
  - `id` (PK)
  - `name` (string)
  - `description` (text)
  - `price` (decimal)
  - `category` (string)
  - `image` (string/path)
* **Orders Table:**
  - `id` (PK)
  - `order_number` (string)
  - `user_id` (FK -> Users)
  - `product_id` (FK -> Products)
  - `status` (enum: 'Pending', 'Processing', 'Shipped', 'Delivered')
  - `total_price` (decimal)
* **Complaints Table:**
  - `id` (PK)
  - `name`, `email`
  - `message` (text)
  - `status` (enum: 'Open', 'Resolved')

### 4. Security Measures
1. **SQL Injection Prevention:** Penggunaan Laravel Eloquent ORM secara bawaan melindungi dari *SQL Injection* karena menggunakan PDO parameter binding.
2. **XSS Protection:** Vue.js (`{{ }}`) secara otomatis mengeksekusi HTML-encoding pada semua data (*escaping*), sehingga mencegah serangan *Cross-Site Scripting*.
3. **Authentication & Authorization:** Rute krusial dilindungi menggunakan `auth` middleware. Akses *backoffice* dilindungi secara spesifik melalui pemerikasaan peran (`role:admin` middleware).
4. **CSRF Protection:** Laravel secara native memvalidasi token CSRF pada setiap metode *request* (POST, PATCH, DELETE) baik tradisional maupun yang dilewati melalui Axios/Inertia.

### 5. UI Layout Strategy
A'ritza menggunakan 2 struktur layout utama untuk membedakan fungsi (Separation of Concerns):
1. **`AdminLayout.vue` (Public / Storefront):** Memiliki *top navbar* putih dan logo di tengah. Digunakan untuk halaman murni publik seperti *Welcome*, *Product Catalog*, dan *My Purchases*.
2. **`BackofficeLayout.vue` (Admin-Only):** Memiliki *left sidebar* gelap. Dikhususkan bagi entitas internal untuk melihat *Dashboard*, *Inventory*, *Orders*, dan *Complaints*.
