# Sistem Penghapusan User Terjadwal

## Fitur
Sistem ini memungkinkan admin untuk menghapus akun user dengan waktu penundaan (soft delete dengan jadwal). User tidak langsung terhapus dari database, tetapi dijadwalkan untuk dihapus setelah periode waktu tertentu (default 15 hari). Admin dapat membatalkan penghapusan sebelum waktu habis.

## Cara Kerja

### 1. **Admin Menghapus User**
- Admin klik tombol "Hapus" pada user yang ingin dihapus
- Modal konfirmasi muncul dengan input untuk menentukan berapa hari penghapusan
- Default: 15 hari (dapat diubah antara 1-365 hari)
- Admin klik "Ya, Jadwalkan Penghapusan"

### 2. **Status Penghapusan Tertunda**
- User yang dijadwalkan untuk dihapus akan pindah ke section "Penghapusan Tertunda"
- Menampilkan:
  - Nama user
  - Email
  - Tanggal penghapusan terjadwal
  - Sisa hari sampai penghapusan
  
### 3. **Membatalkan Penghapusan**
- Admin dapat klik tombol "Batalkan" pada user dalam section "Penghapusan Tertunda"
- User akan kembali normal dan dapat login lagi

### 4. **Penghapusan Otomatis**
- Setelah deadline tiba, user akan ditampilkan dengan status "Lewat Jatuh Tempo"
- Admin dapat klik tombol "Hapus Sekarang" untuk menghapus user secara permanen
- Atau jalankan command: `php artisan users:delete-scheduled`

## Kolom Database Baru

```sql
scheduled_deletion_at (datetime, nullable) -- Waktu penghapusan terjadwal
deletion_days (integer, nullable) -- Jumlah hari sampai penghapusan
deleted_at (datetime, nullable) -- Waktu penghapusan aktual (soft delete)
```

## Methods pada User Model

### `isScheduledForDeletion()`
Cek apakah user dijadwalkan untuk dihapus
```php
if ($user->isScheduledForDeletion()) {
    // User dijadwalkan untuk dihapus
}
```

### `isDeletionDeadlinePassed()`
Cek apakah deadline penghapusan sudah terlewat
```php
if ($user->isDeletionDeadlinePassed()) {
    // Sudah boleh dihapus
}
```

### `getDaysUntilDeletion()`
Mendapatkan sisa hari sampai penghapusan
```php
$days = $user->getDaysUntilDeletion(); // Returns: int or null
```

## Routes

```php
POST   /admin/users/{user}/schedule-delete  // Jadwalkan penghapusan
POST   /admin/users/{user}/cancel-delete    // Batalkan penghapusan
DELETE /admin/users/{user}                   // Hapus permanen
```

## Command

Jalankan command ini untuk menghapus users yang sudah melewati deadline:

```bash
php artisan users:delete-scheduled
```

Output:
```
✓ User 'John Doe' (john@example.com) berhasil dihapus permanen.
✓ User 'Jane Smith' (jane@example.com) berhasil dihapus permanen.

Total 2 user(s) berhasil dihapus permanen.
```

## Cara Setup Cron Job (Opsional)

Jika ingin penghapusan otomatis, tambahkan ke cron job:

```bash
* * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1
```

Atau setup di `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('users:delete-scheduled')
             ->daily()
             ->at('02:00'); // Jalankan setiap hari jam 2 pagi
}
```

## Kontrol Admin

Admin dapat:
1. ✅ Memilih berapa hari sebelum user dihapus (1-365 hari)
2. ✅ Membatalkan penghapusan kapan saja sebelum deadline
3. ✅ Melihat jadwal penghapusan untuk setiap user
4. ✅ Menghapus secara manual jika sudah lewat deadline

## Keamanan

- User yang dijadwalkan untuk dihapus masih bisa login sampai deadline
- Jika ingin mencegah login, gunakan soft delete biasa (ubah logika di middleware)
- Penghapusan permanen tidak bisa dibatalkan lagi
