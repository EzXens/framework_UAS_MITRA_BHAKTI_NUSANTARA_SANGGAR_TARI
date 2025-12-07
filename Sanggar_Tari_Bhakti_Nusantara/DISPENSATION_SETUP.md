# Setup Surat Dispensasi - Panduan Lengkap

## 📋 Ringkasan Fitur

Sistem dispensasi sekarang memiliki:
1. **User dapat membuat** permohonan surat dispensasi (mahasiswa/siswa)
2. **Admin dapat approve/reject** permohonan
3. **Admin dapat generate** dokumen DOCX otomatis dari template
4. **User dapat melihat**, download DOCX, dan cetak/download PDF surat yang sudah disetujui

---

## 🎯 Langkah Setup

### 1. **Siapkan Template DOCX**

Buat 2 file template di `public/images/surat/`:

**File 1: `dispen_kuliah.docx`** (untuk mahasiswa)
- Template surat dispensasi untuk kuliah
- Placeholder yang harus ada (EXACT - case sensitive):
  ```
  [Nomor_Surat]
  [Tahun_Sekarang]
  [Nama_Kegiatan]
  [Nama_Mahasiswa]
  [Nomor_Induk_Mahasiswa]
  [Prodi_Mahasiswa]
  [Nama_Instansi]
  [Hari]
  [Tanggal_Dilaksanakan]
  [Waktu]
  [Nama_Tempat]
  [Kota_Atau_Provinsi]
  ```

**File 2: `dispen_sekolah.docx`** (untuk siswa)
- Template surat dispensasi untuk sekolah
- Placeholder yang harus ada:
  ```
  [Nomor_Surat]
  [Tahun_Sekarang]
  [Nama_Sekolah]
  [Nama_Kegiatan]
  [Nama_Siswa]
  [Nomor_Induk_Siswa]
  [Kelas_Siswa]
  [Hari]
  [Tanggal_Dilaksanakan]
  [Waktu]
  [Nama_Tempat]
  [Kota_Atau_Provinsi]
  ```

**Cara membuat template:**
1. Buka MS Word
2. Buat desain surat Anda
3. Ganti data dengan placeholder `[NAMA_PLACEHOLDER]` (copy persis seperti di atas)
4. Save sebagai `.docx`
5. Letakkan di `public/images/surat/`

### 2. **Setup Storage Link (PENTING!)**

Jalankan di command line:
```bash
php artisan storage:link
```

Ini membuat symlink sehingga file di `storage/app/public/` bisa diakses via `/storage/...`

### 3. **Verifikasi Folder Struktur**

Folder berikut harus ada:
- ✅ `public/images/surat/` (template files)
- ✅ `storage/app/public/surat/` (akan auto-created ketika generate dokumen)
- ✅ `public/storage/` (symlink dari langkah 2)

---

## 🔄 Workflow Penggunaan

### User Side:
1. User login ke dashboard
2. Klik tab **Dispensasi**
3. Pilih tipe (Mahasiswa/Siswa)
4. Isi form lengkap
5. Klik **Kirim Permohonan**
6. Status: **Pending** (menunggu admin)

### Admin Side:
1. Admin buka **Admin Dashboard**
2. Lihat **Permintaan Surat Dispensasi** (section Aktivitas)
3. Klik **Lihat** untuk detail
4. Klik **Setujui** (approval)
   - Sistem otomatis generate DOCX dari template
   - Jika gagal, akan muncul pesan error
5. Jika ada error, klik **Generate Dokumen** button di detail page
   - Retry generate DOCX/PDF

### User Check Document:
1. User buka dashboard
2. Klik tab **Dispensasi**
3. Cari pengajuan dengan status **Approved**
4. Klik tombol:
   - **Lihat** = preview di modal
   - **DOCX** = download file word
   - **Cetak PDF** = buka PDF di browser (bisa print)
   - **Download PDF** = download file PDF

---

## 🛠️ Troubleshooting

### ❌ Error: "Template DOCX tidak ditemukan"
- ✅ Pastikan file ada di: `public/images/surat/dispen_kuliah.docx` atau `dispen_sekolah.docx`
- ✅ Nama file HARUS persis (case-sensitive)

### ❌ Error: "Placeholder tidak di-replace"
- ✅ Check placeholder di template HARUS persis (case-sensitive)
- ✅ Pastikan di dalam template, placeholder ditulis: `[Nama_Mahasiswa]` bukan `[Nama Mahasiswa]` atau `[nama_mahasiswa]`
- ✅ Di MS Word, pastikan placeholder adalah TEXT biasa, bukan Field atau Shape

### ❌ User tidak bisa download
- ✅ Pastikan `php artisan storage:link` sudah dijalankan
- ✅ Cek file ada di: `storage/app/public/surat/`
- ✅ Cek symlink: `public/storage/` harus menunjuk ke `storage/app/public/`

### ❌ PDF tidak tersedia
- ✅ PDF optional - hanya generate jika LibreOffice di-install dan di PATH
- ✅ Gunakan tombol **Cetak PDF** di browser untuk convert on-the-fly
- ✅ Atau download DOCX dan convert manual di Word

---

## 📁 File yang Dimodifikasi/Dibuat

### Baru Dibuat:
- `app/Helpers/DocxGenerator.php` - Helper untuk manipulasi DOCX (native PHP, no external lib)

### Dimodifikasi:
- `app/Http/Controllers/DispensationController.php` - Add `generate()` action & `generateDocuments()` helper
- `resources/views/user/dashboard.blade.php` - Add DOCX preview modal & download buttons
- `routes/web.php` - Add `admin.dispensations.generate` route

---

## 🔐 Keamanan

- ✅ Hanya user yang membuat/admin yang bisa akses dokumen mereka
- ✅ File disimpan di `storage/app/public/` (aman, dilindungi symlink)
- ✅ Download/view via `Storage::url()` - Laravel handle permission

---

## 📝 Contoh Placeholder Mapping

Ketika user submit dengan data:
```
Nama: John Doe
NIM: 2024001
Event: Seminar Tari
...
```

System otomatis replace:
```
[Nama_Mahasiswa] → John Doe
[Nomor_Induk_Mahasiswa] → 2024001
[Nama_Kegiatan] → Seminar Tari
[Nomor_Surat] → 2025/0001/01 (auto-generated)
...
```

---

## 🚀 Next Steps (Optional Improvements)

1. **Email Notification** - Notify user ketika dokumen siap
2. **PDF Generation** - Install LibreOffice untuk auto PDF conversion
3. **Logging** - Add database log untuk audit trail
4. **Signature Field** - Add digital signature di template
5. **Email Admin** - Auto-email admin ketika ada new request

---

**Status**: ✅ Ready to Use  
**Last Updated**: Dec 4, 2025  
**Version**: 1.0
