<!doctype html>
<html>
<body>
  <p>Halo,</p>
  <p>Kami menerima permintaan untuk mereset password akun Anda. Klik tombol di bawah untuk mengatur password baru:</p>
  <p>
    <a href="{{ url('/password/reset/'.$token) }}" style="display:inline-block;padding:10px 16px;background:#FEDA60;color:#111;border-radius:6px;text-decoration:none;font-weight:600">Reset Password</a>
  </p>
  <p>Jika tombol tidak bekerja, salin kode berikut.</p>
  <pre style="background:#f4f4f4;padding:8px;border-radius:6px">{{ $token }}</pre>
  <p>Token akan kedaluwarsa dalam 1 jam.</p>
  <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
</body>
</html>
