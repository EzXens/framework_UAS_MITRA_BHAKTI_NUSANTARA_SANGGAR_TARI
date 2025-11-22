# Sistem Login & CRUD Sanggar Tari Bhakti Nusantara

## Fitur yang Telah Dibuat

### 1. Sistem Authentication
- **Login**: User dan Admin dapat login dengan email dan password
- **Register**: User baru dapat mendaftar akun
- **Logout**: User dapat logout dari sistem
- **Role Management**: Sistem membedakan antara user biasa dan admin

### 2. Navbar dengan Username
- Navbar menampilkan nama user yang sedang login
- Menu berbeda untuk admin dan user biasa
- Admin dapat melihat menu "Kelola Produk" dan "Kelola Kelas"

### 3. CRUD Produk (Khusus Admin)
- **Index**: Melihat daftar semua produk dengan pagination
- **Create**: Menambah produk baru dengan upload gambar
- **Edit**: Mengubah data produk yang sudah ada
- **Delete**: Menghapus produk
- Field: Nama, Deskripsi, Harga, Stok, Gambar

### 4. CRUD Kelas (Khusus Admin)
- **Index**: Melihat daftar semua kelas dengan pagination
- **Create**: Menambah kelas baru dengan upload gambar
- **Edit**: Mengubah data kelas yang sudah ada
- **Delete**: Menghapus kelas
- Field: Nama, Deskripsi, Instruktur, Jadwal, Kapasitas, Harga, Gambar

## Akun Default yang Sudah Dibuat

### Admin
- Email: `admin@sanggar.com`
- Password: `admin123`
- Role: Admin (dapat mengakses CRUD Produk & Kelas)

### User Biasa
- Email: `user@sanggar.com`
- Password: `user123`
- Role: User (hanya dapat melihat konten)

## Cara Menjalankan Aplikasi

1. Pastikan database `sanggar_tari` sudah dibuat di MySQL
2. Jalankan migration (sudah dijalankan):
   ```
   php artisan migrate
   ```
3. Seed data admin (sudah dijalankan):
   ```
   php artisan db:seed --class=AdminSeeder
   ```
4. Buat symbolic link untuk storage (sudah dijalankan):
   ```
   php artisan storage:link
   ```
5. Jalankan server:
   ```
   php artisan serve
   ```
6. Buka browser: `http://localhost:8000`

## Struktur File yang Dibuat

### Controllers
- `app/Http/Controllers/AuthController.php` - Login, Register, Logout
- `app/Http/Controllers/ProductController.php` - CRUD Produk
- `app/Http/Controllers/ClassController.php` - CRUD Kelas

### Models
- `app/Models/User.php` - Model User dengan role
- `app/Models/Product.php` - Model Produk
- `app/Models/ClassModel.php` - Model Kelas

### Migrations
- `database/migrations/0001_01_01_000000_create_users_table.php` - Table users
- `database/migrations/2025_11_22_060209_add_role_to_users_table.php` - Tambah kolom role
- `database/migrations/2025_11_22_054932_create_products_table.php` - Table products
- `database/migrations/2025_11_22_054932_create_classes_table.php` - Table classes

### Views

#### Authentication
- `resources/views/auth/login.blade.php` - Halaman Login
- `resources/views/auth/register.blade.php` - Halaman Register

#### Products
- `resources/views/products/index.blade.php` - Daftar Produk
- `resources/views/products/create.blade.php` - Tambah Produk
- `resources/views/products/edit.blade.php` - Edit Produk

#### Classes
- `resources/views/classes/index.blade.php` - Daftar Kelas
- `resources/views/classes/create.blade.php` - Tambah Kelas
- `resources/views/classes/edit.blade.php` - Edit Kelas

#### Layout
- `resources/views/components/layout/navbar.blade.php` - Navbar dengan username dan role-based menu

### Middleware
- `app/Http/Middleware/AdminMiddleware.php` - Middleware untuk membatasi akses admin

### Routes
- `routes/web.php` - Semua routes untuk authentication dan CRUD

## Cara Login

1. Buka halaman: `http://localhost:8000/login`
2. Login dengan akun admin atau user
3. Setelah login, navbar akan menampilkan nama user
4. Admin dapat mengakses menu "Kelola Produk" dan "Kelola Kelas"

## Keamanan

- Password di-hash dengan bcrypt
- Middleware `auth` melindungi routes yang memerlukan login
- Middleware `admin` melindungi routes CRUD yang hanya boleh diakses admin
- Validation pada setiap form input
- CSRF protection pada semua form

## Catatan Penting

- Upload gambar maksimal 2MB
- Format gambar yang didukung: JPG, PNG, GIF
- Gambar disimpan di `storage/app/public/products` dan `storage/app/public/classes`
- Gambar dapat diakses via `public/storage` karena symbolic link
