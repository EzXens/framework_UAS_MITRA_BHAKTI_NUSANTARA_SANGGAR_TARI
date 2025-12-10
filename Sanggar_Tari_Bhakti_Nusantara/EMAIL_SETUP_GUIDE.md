# PANDUAN SETUP EMAIL VERIFICATION (Gmail SMTP)

## Masalah: Email Verifikasi Tidak Terkirim ke Gmail

Jika email verifikasi tidak sampai ke Gmail Anda, kemungkinan penyebabnya adalah **konfigurasi SMTP tidak benar** di file `.env`.

---

## SOLUSI CEPAT: Setup Gmail SMTP

### Step 1: Generate App Password Gmail

1. Buka https://myaccount.google.com/security
2. Pastikan **2-Step Verification** sudah aktif
   - Jika belum, klik "2-Step Verification" dan ikuti langkah-langkahnya
3. Kembali ke halaman Security, cari **"App passwords"** (di bawah 2-Step Verification)
4. Pilih:
   - **Select app**: Mail
   - **Select device**: Windows Computer (atau tipe device Anda)
5. Google akan menampilkan **16-character password** seperti: `xxxx xxxx xxxx xxxx`
6. **Copy password ini** (tanpa spasi saat paste ke .env)

### Step 2: Update File `.env`

Buka file `.env` di root proyek Anda dan update bagian email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=xxxxxxxxxxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Bhakti Nusantara"
```

**Contoh hasil akhir:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=user@gmail.com
MAIL_PASSWORD=abcdefghijklmnop
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=user@gmail.com
MAIL_FROM_NAME="Bhakti Nusantara"
```

### Step 3: Test Email Configuration

Jalankan perintah di terminal untuk test:

```powershell
php artisan tinker
```

Di dalam Tinker shell, jalankan:

```php
Mail::raw('Test email', function($message) { 
    $message->to('your-email@gmail.com')->subject('Test'); 
});
```

Tekan Enter. Jika berhasil, Anda akan melihat response dan email akan sampai dalam beberapa detik.

---

## FLOW VERIFIKASI EMAIL (Cara Kerja Sekarang)

### Saat Registrasi:
1. User masukkan nama, email, password → klik "Daftar Sekarang"
2. Sistem:
   - Membuat akun dengan `email_verified_at = NULL` (belum diverifikasi)
   - Generate token verifikasi (32 bytes random)
   - **Simpan hash token di DB** (aman, jika DB bocor token tetap aman)
   - **Kirim email dengan link verifikasi + token plaintext**
   - Jika `APP_DEBUG=true`, tampilkan token di halaman (dev helper)
3. User diarahkan ke halaman "Verifikasi Email" (`/email/verify`)

### Halaman Verifikasi Email:
Halaman ini menawarkan **2 cara verifikasi**:

1. **Input Token Manual**: Paste kode dari email → klik "Verifikasi Email"
   - Berguna jika email sampai tapi user lupa / tidak sadar ada email
   - Route: `POST /email/verify-code`

2. **Kirim Ulang Kode**: Masukkan email → klik "Kirim Ulang Kode"
   - Mengirim token baru (rate limited: max 3x per 24 jam)
   - Route: `POST /email/resend`

### Email yang Dikirim:
Email berisi:
- Tombol "Verifikasi Email" (link `https://yoursite.com/email/verify/{token}`)
- Fallback: Teks dengan token plaintext (untuk copy/paste manual)
- Instruksi: Token berlaku 24 jam

### Setelah Verifikasi:
- Token di-mark sebagai `used_at` (tidak bisa dipakai ulang)
- User `email_verified_at` diset ke waktu sekarang
- User dapat login (login akan check `email_verified_at != NULL`)

---

## DEBUGGING

### Cek Log Email

Buka `storage/logs/laravel.log` dan cari:

```
[timestamp] local.INFO: Email verification token generated {"email":"user@gmail.com","token":"abc123..."}
[timestamp] local.ERROR: Failed sending verification email {"email":"user@gmail.com","err":"SMTP error message"}
```

### Jika Email Tidak Sampai:

1. **Cek MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD** di `.env`
2. **Cek Gmail Account Settings**:
   - Buka https://myaccount.google.com/security/checkup
   - Cek apakah Gmail mengizinkan akses dari "Less secure apps" (jika tidak pakai 2FA + App Password)
3. **Cek Spam Folder Gmail**
   - Email mungkin masuk ke "Promotions" atau "Spam"
   - Tambahkan `no-reply@yourdomain.com` ke kontak
4. **Test dengan Mailtrap** (jika Gmail tidak berhasil):
   - Daftar gratis di https://mailtrap.io
   - Gunakan kredensial Mailtrap di `.env` untuk testing
   - Email akan tertangkap di dashboard Mailtrap (bukan di inbox sungguhan, tapi bagus untuk debug)

### Jika Masih Ada Error:

Pastikan:
- `APP_DEBUG=true` di `.env` (supaya error ditampilkan)
- Jalankan `php artisan config:clear` (clear config cache)
- Jalankan `php artisan cache:clear` (clear semua cache)
- Restart server: `Ctrl+C` di terminal Laravel, lalu `php artisan serve` ulang

---

## FILE KONFIGURASI REFERENSI

Lihat file `.env.example.gmail` di root proyek untuk template lengkap.

---

## ALTERNATIF: Jika Ingin Pakai Queue (Recommended untuk Produksi)

Email queue memungkinkan:
- Pengiriman email tidak memblokir request (lebih cepat)
- Retry otomatis jika gagal
- Background processing

Tapi untuk sekarang (development), SMTP langsung sudah cukup.

---

## TESTING FLOW

1. Buka `/register`
2. Daftar: nama, email, password → "Daftar Sekarang"
3. Akan redirect ke `/email/verify`
4. **Jika APP_DEBUG=true**: Token akan ditampilkan di halaman
5. **Jika Gmail configured benar**: Email akan sampai dalam hitungan detik
6. Pilih salah satu:
   - Copy token dari email → paste di form "Masukkan Kode Verifikasi"
   - Atau klik link di email secara langsung
7. Klik "Verifikasi Email"
8. Redirect ke homepage dengan pesan sukses
9. Sekarang bisa login dengan email+password

---

## PERTANYAAN UMUM

**Q: Apakah token disimpan di database?**
A: Ya, tapi hanya hash-nya (SHA-256). Token plaintext hanya dikirim via email.

**Q: Berapa lama token berlaku?**
A: 24 jam dari waktu generate.

**Q: Bisakah token dipakai berkali-kali?**
A: Tidak. Setelah digunakan, token di-mark `used_at` dan tidak bisa dipakai lagi.

**Q: Bagaimana jika email tidak sampai?**
A: User bisa klik "Kirim Ulang Kode" (max 3x per 24 jam).

**Q: Apa bedanya dengan link di email vs input manual?**
A: Sama saja. Link `/email/verify/{token}` dan form input manual sama-sama memverifikasi token.

---

## NEXT STEPS

1. Update `.env` dengan Gmail SMTP config (App Password)
2. Clear cache: `php artisan config:clear && php artisan cache:clear`
3. Restart server
4. Test registrasi → verifikasi → login
5. Jika berhasil, email produksi bisa pakai konfigurasi Gmail atau SendGrid/AWS SES

Semoga berhasil! 🎉
