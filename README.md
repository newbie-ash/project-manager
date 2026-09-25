# Product Manager (Laravel Version)

Aplikasi manajemen produk berbasis web menggunakan arsitektur MVC pada framework Laravel. Aplikasi ini dibuat sebagai pemenuhan spesifikasi tugas (diadaptasi dari PHP Native) yang mendemonstrasikan pemahaman tentang operasi CRUD, keamanan (Security), dan UI/UX yang responsif.

## Fitur
1. **Create:** Menambah produk baru dengan validasi ketat.
2. **Read:** Menampilkan daftar produk menggunakan Card UI yang responsif.
3. **Update:** Mengubah data produk yang ada.
4. **Delete:** Menghapus data produk dengan aman menggunakan POST/DELETE method & CSRF token.
5. **Bonus:** Pencarian/Filter dengan GET, serta Pagination.

## Persyaratan
- PHP >= 8.2
- Composer
- (Database secara otomatis menggunakan SQLite bawaan Laravel)

## Cara Menjalankan
1. Buka terminal di dalam folder proyek ini.
2. (Opsional jika proyek baru di-clone) Jalankan `composer install`
3. (Opsional jika `.env` belum ada) Salin `.env.example` ke `.env` lalu jalankan `php artisan key:generate`
4. Pastikan database SQLite siap dengan menjalankan: `php artisan migrate`
5. Jalankan local server: `php artisan serve`
6. Akses aplikasi di browser melalui URL: `http://localhost:8000`

## Refleksi Keamanan
Terkait pertanyaan "*Di bagian mana aplikasi paling rentan: input, query, output, atau alur request? Jelaskan kontrol keamanan yang telah Anda implementasikan.*", berikut adalah jawabannya:

1. **Input (Rentan terhadap data tidak valid & Bypass):**
   * **Kontrol:** Diimplementasikan Form Request Validation (`ProductRequest`). Validasi berjalan di sisi server (Backend) sehingga memblokir input manipulatif (seperti nama kurang dari 3 karakter, harga negatif, atau nama produk duplikat).

2. **Query (Rentan SQL Injection):**
   * **Kontrol:** Aplikasi ini menggunakan **Eloquent ORM** Laravel. Di balik layar, Eloquent menggunakan *PDO Parameterized Queries* persis seperti spesifikasi `prepare()` dan `execute()` pada PHP native, sehingga SQL Injection mustahil dilakukan.

3. **Output (Rentan Cross-Site Scripting / XSS):**
   * **Kontrol:** Output data dari database ke HTML menggunakan *Blade templating engine* dengan sintaks `{{ $product->name }}`. Sintaks ini secara otomatis menjalankan `htmlspecialchars` (escaping), sehingga input seperti `<b>Promo</b>` atau tag `<script>` akan dirender sebagai teks biasa dan aman.

4. **Alur Request (Rentan CSRF & Resubmission Data Ganda):**
   * **Kontrol CSRF:** Setiap form aksi (Create, Update, Delete) dilindungi oleh perintah `@csrf` bawaan Laravel yang memverifikasi token pada setiap HTTP POST/PUT/DELETE. Tombol delete juga dibungkus dalam tag `<form>` alih-alih menggunakan link `<a>` biasa (GET) yang tidak aman.
   * **Kontrol Anti-Duplikasi (PRG):** Menggunakan pola *Post/Redirect/Get*. Setelah proses `store` atau `update` berhasil, aplikasi menjalankan fungsi `redirect()->route('products.index')`. Hal ini mengubah *state* request di browser menjadi GET, sehingga jika pengguna me-refresh halaman (F5), browser tidak akan mengirimkan data ulang.
