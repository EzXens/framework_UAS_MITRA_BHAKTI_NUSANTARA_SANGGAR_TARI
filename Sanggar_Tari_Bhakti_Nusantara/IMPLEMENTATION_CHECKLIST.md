# CHECKLIST IMPLEMENTASI EMAIL VERIFICATION

## ✅ PERSIAPAN AWAL

- [ ] Jalankan migrasi database:
  ```powershell
  php artisan migrate
  ```

- [ ] Clear config cache:
  ```powershell
  php artisan config:clear
  php artisan cache:clear
  ```

- [ ] Pastikan `APP_DEBUG=true` di `.env` (untuk development)

---

## 🔧 SETUP GMAIL SMTP

- [ ] Generate App Password Gmail:
  1. Buka https://myaccount.google.com/security
  2. Aktifkan 2-Step Verification
  3. Cari "App passwords" → Mail + Windows Computer
  4. Copy 16-character password

- [ ] Update file `.env`:
  ```
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.gmail.com
  MAIL_PORT=587
  MAIL_USERNAME=your-email@gmail.com
  MAIL_PASSWORD=xxxxxxxxxxxx
  MAIL_ENCRYPTION=tls
  MAIL_FROM_ADDRESS=your-email@gmail.com
  MAIL_FROM_NAME="Bhakti Nusantara"
  ```

- [ ] Test email configuration di Tinker:
  ```powershell
  php artisan tinker
  Mail::raw('Test', function($m) { $m->to('your-email@gmail.com')->subject('Test'); });
  exit
  ```

---

## 🧪 TEST FLOW REGISTRASI & VERIFIKASI

- [ ] Buka browser: http://localhost:8000/register

- [ ] Daftar akun baru:
  - Nama: Test User
  - Email: your-test-email@gmail.com
  - Password: password123
  - Confirm: password123
  - Klik "Daftar Sekarang"

- [ ] Validasi redirect ke `/email/verify`:
  - Halaman harus menampilkan "Verifikasi Email"
  - Jika `APP_DEBUG=true`, token akan muncul di halaman (dev helper)

- [ ] Cek email masuk:
  - Buka Gmail inbox
  - Cari email dari "Bhakti Nusantara"
  - Seharusnya ada di Inbox (cek juga Spam/Promotions folder)
  - Email berisi tombol "Verifikasi Email" dan token fallback

- [ ] Verifikasi dengan 2 cara (pilih salah satu):

  **Cara 1: Klik link di email**
  - Klik tombol "Verifikasi Email" di email
  - Redirect ke homepage dengan pesan "Email berhasil diverifikasi"
  
  **Cara 2: Input manual**
  - Copy token dari email (atau dari halaman jika debug)
  - Paste di form "Masukkan Kode Verifikasi"
  - Klik "Verifikasi Email"
  - Redirect ke homepage dengan pesan sukses

- [ ] Test login:
  - Buka `/login`
  - Email: your-test-email@gmail.com
  - Password: password123
  - Klik "Login"
  - Seharusnya berhasil login (redirect ke homepage)

---

## 🚨 TROUBLESHOOTING

Jika email tidak sampai:

- [ ] Cek Laravel log:
  ```powershell
  Get-Content storage\logs\laravel.log -Tail 50
  ```
  Cari baris: `Email verification token generated` atau `Failed sending verification email`

- [ ] Cek Gmail SMTP config:
  - MAIL_HOST: `smtp.gmail.com` (bukan `mail.gmail.com`)
  - MAIL_PORT: `587` (bukan 465 atau 25)
  - MAIL_ENCRYPTION: `tls` (bukan `ssl`)
  - MAIL_PASSWORD: App Password (bukan password Gmail biasa)

- [ ] Cek Gmail Security Settings:
  - Buka https://myaccount.google.com/security
  - Pastikan 2-Step Verification aktif
  - Pastikan App passwords sudah digenerate

- [ ] Jika Gmail tetap gagal, gunakan Mailtrap:
  - Daftar gratis di https://mailtrap.io
  - Copy SMTP credentials ke `.env`
  - Email akan tertangkap di dashboard Mailtrap

---

## 📋 FILE-FILE YANG DIUBAH/DITAMBAH

**Backend Changes:**
- `app/Http/Controllers/AuthController.php` — register, verify, resend, verifyCode methods
- `app/Mail/VerificationMail.php` — mailable class
- `app/Mail/PasswordResetMail.php` — mailable class (untuk forgot password)
- `routes/web.php` — email verification + password reset routes
- `database/migrations/2025_12_10_000000_create_email_verification_tokens_table.php` — migration

**Views:**
- `resources/views/auth/verify_notice.blade.php` — halaman verifikasi (NEW)
- `resources/views/emails/verify.blade.php` — email template
- `resources/views/emails/password_reset.blade.php` — email template
- `resources/views/auth/passwords/forgot.blade.php` — forgot password form
- `resources/views/auth/passwords/reset.blade.php` — reset password form

**Guides:**
- `EMAIL_SETUP_GUIDE.md` — panduan setup email (NEW)
- `.env.example.gmail` — contoh .env untuk Gmail (NEW)

---

## 🎯 FITUR YANG SUDAH DIIMPLEMENTASIKAN

✅ **Email Verification pada Registrasi:**
- User daftar → token generated + dikirim via email
- Redirect ke halaman verifikasi
- Token disimpan hashed di DB (aman)
- Token berlaku 24 jam

✅ **Manual Token Input:**
- Halaman `/email/verify` punya form input kode
- User bisa paste token dari email
- Jika debug, token ditampilkan di halaman

✅ **Resend Verification:**
- User bisa kirim ulang kode (max 3x per 24 jam)
- Rate limited untuk mencegah abuse

✅ **Login Restriction:**
- User tidak bisa login sebelum email diverifikasi
- Pesan error: "Akun belum diverifikasi"

✅ **Forgot Password:**
- Route `/password/forgot` → form input email
- Email dikirim dengan link reset
- User dapat reset password dengan token baru

---

## 📞 NEXT STEPS

1. **Setup Gmail SMTP** ← WAJIB DILAKUKAN DULU
2. **Test registrasi & verifikasi flow**
3. **Test forgot password flow**
4. Setelah siap, bisa tuning UI/UX lebih lanjut
5. Untuk produksi, pertimbangkan:
   - Queue untuk email (background sending)
   - SendGrid/AWS SES untuk deliverability lebih baik
   - Rate limiting lebih ketat

---

Good luck! 🚀
