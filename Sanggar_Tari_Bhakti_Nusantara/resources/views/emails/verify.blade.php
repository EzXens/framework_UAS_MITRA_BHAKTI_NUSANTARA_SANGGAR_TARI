<!doctype html>
<html>
<body>
  <p>Halo,</p>
  <p>Terima kasih telah mendaftar. Silakan klik tombol di bawah untuk memverifikasi alamat email Anda:</p>
  <p>
    <a href="{{ url('/email/verify/'.$token) }}" style="display:inline-block;padding:10px 16px;background:#FEDA60;color:#111;border-radius:6px;text-decoration:none;font-weight:600">Verifikasi Email</a>
  </p>
  <p>Jika tombol tidak berfungsi, salin kode berikut dan masukkan pada halaman verifikasi:</p>
  <pre style="background:#f4f4f4;padding:8px;border-radius:6px">{{ $token }}</pre>
  <p>Token akan kedaluwarsa dalam 24 jam.</p>
  <p>Jika Anda tidak mendaftar, abaikan email ini.</p>
</body>
</html>
