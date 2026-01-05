# Spesifikasi Teknis Sistem Tutorial Website Sanggar Tari Bhakti Nusantara

## 1. Inventarisasi Fitur & Klasifikasi Akses

Berikut adalah daftar lengkap fitur yang tersedia dalam sistem, dikategorikan berdasarkan level akses.

### A. Fitur Publik (User Biasa/Guest)
| Nama Fitur | Deskripsi | URL | Komponen UI Utama |
|------------|-----------|-----|-------------------|
| **Beranda** | Halaman utama yang menampilkan ringkasan sanggar. | `/` | Hero section, Carousel, Info Cards |
| **Tentang Kami** | Informasi visi, misi, sejarah, dan profil pengajar. | `/tentang` | Text sections, Team Grid |
| **Daftar Pengajar** | Katalog profil pengajar aktif. | `/pengajar` | Teacher Cards |
| **Produk** | Katalog produk dan merchandise sanggar. | `/produk` | Product Grid, Filter |
| **Galeri** | Dokumentasi foto, video, dan musik. | `/galeri` | Masonry Grid, Media Player |
| **Kontak** | Formulir untuk mengirim pesan ke admin. | `/kontak` | Contact Form, Map |
| **Daftar Kelas** | Informasi kelas tari yang tersedia. | `/kelas` | Class List, Pricing Table |
| **Autentikasi** | Login, Register, Lupa Password. | `/login`, `/register` | Auth Forms |

### B. Fitur User Terdaftar (Siswa/Member)
| Nama Fitur | Deskripsi | URL | Komponen UI Utama |
|------------|-----------|-----|-------------------|
| **Dashboard Siswa** | Pusat informasi member. | `/dashboard` | Stats Cards, Status Badge |
| **Pendaftaran Kelas** | Form untuk mendaftar ke kelas spesifik. | `/kelas/{id}/daftar` | Enrollment Form |
| **Pengajuan Dispensasi** | Mengajukan surat izin/dispensasi. | `/dispensations` | Request Form, Upload Input |
| **Manajemen Profil** | Update foto profil dan data diri. | `/dashboard` | Profile Settings |

### C. Fitur Admin
| Nama Fitur | Deskripsi | URL | Komponen UI Utama |
|------------|-----------|-----|-------------------|
| **Dashboard Admin** | Ringkasan statistik sistem. | `/admin/dashboard` | Admin Charts, Summary Cards |
| **Approval Pendaftaran** | Menyetujui/Menolak pendaftaran siswa baru. | `/admin/dashboard` | Data Tables, Action Buttons |
| **Manajemen Dispensasi** | Kelola pengajuan dan generate surat PDF. | `/admin/dispensations` | Kanban/Table, PDF Preview |
| **Manajemen Konten** | CMS untuk Beranda, Tentang, Hero. | `/admin/homepage/*` | CMS Forms, WYSIWYG Editor |
| **Manajemen Galeri** | Upload dan kelola media. | `/admin/gallery/*` | Media Uploader |
| **Manajemen Master** | CRUD Kelas, Produk, Pengajar. | `/admin/*` | CRUD Forms |

---

## 2. Desain Sistem Pop-up Tutorial

### Konsep Visual
Desain pop-up menggunakan pendekatan *Tooltip Tour* yang menyoroti elemen spesifik pada halaman.

*   **Warna**: Menggunakan skema warna website (Putih, Emas/Kuning `#FBBF24`, Hitam/Abu-abu `#2E2E2E`).
*   **Tipografi**: Font `Poppins` sesuai standar website.
*   **Bentuk**: Rounded corners (`rounded-xl`), Shadow lembut (`shadow-2xl`).

### Wireframe (Deskriptif)
```
+--------------------------------------------------+
| [Judul Fitur]                       [Langkah X/Y]|
|--------------------------------------------------|
|                                                  |
|  Deskripsi singkat tentang fitur ini dan cara    |
|  menggunakannya. (Maks 2-3 baris)                |
|                                                  |
|--------------------------------------------------|
| [ ] Jangan tampilkan lagi                        |
|                                                  |
| [Kembali]   [Lewati]              [Lanjut/Selesai]|
+--------------------------------------------------+
      V  (Arrow pointing to target element)
```

### Interaksi
1.  **Overlay**: Layar belakang diredupkan (dimmed) untuk fokus, kecuali area elemen target yang di-highlight.
2.  **Posisi**: Pop-up secara otomatis menempatkan diri (Atas, Bawah, Kiri, Kanan) relatif terhadap elemen target untuk menghindari terpotong layar.
3.  **Navigasi**: User dapat maju, mundur, atau menutup tutorial kapan saja.

---

## 3. Arsitektur Penyimpanan Preferensi

Penyimpanan dilakukan di sisi klien (Client-side) menggunakan `localStorage` browser untuk performa cepat dan tanpa beban server.

### Schema Key-Value
| Key | Value | Deskripsi |
|-----|-------|-----------|
| `tutorial_completed_{tutorialId}` | `true` | Menandakan user telah menyelesaikan tutorial ID tersebut. |
| `tutorial_dont_show_{tutorialId}` | `true` | Menandakan user memilih "Jangan tampilkan lagi". |

### Logika Pengecekan
```javascript
function checkAutoStart(tutorialId) {
    const isCompleted = localStorage.getItem(`tutorial_completed_${tutorialId}`);
    const isDontShow = localStorage.getItem(`tutorial_dont_show_${tutorialId}`);
    
    if (!isCompleted && !isDontShow) {
        startTutorial(tutorialId);
    }
}
```

---

## 4. Implementasi Teknis

### Struktur File
*   `resources/js/tutorial.js`: Class utama logika sistem tutorial.
*   `resources/js/tutorial-data.js`: Konfigurasi langkah-langkah tutorial per halaman.
*   `resources/js/app.js`: Inisialisasi global.

### Diagram Alur (Pseudocode)

```
START Page Load
    GET Current URL Path
    SEARCH matching tutorial in tutorialData
    
    IF Found AND (Not Completed OR Not "Dont Show") THEN
        CREATE UI Elements (Overlay, Popup) if not exist
        GET First Step Data
        SCROLL to Target Element
        HIGHLIGHT Target Element
        SHOW Popup positioned near Target
        
        WAIT for User Action:
            CASE "Next":
                IF Last Step THEN
                    SAVE "Completed" status
                    CLOSE Popup
                ELSE
                    GO TO Next Step
                ENDIF
                
            CASE "Prev":
                GO TO Previous Step
                
            CASE "Skip":
                IF "Dont Show" checked THEN
                    SAVE "Dont Show" status
                ENDIF
                CLOSE Popup
                
            CASE "Finish":
                SAVE "Completed" status
                IF "Dont Show" checked THEN
                    SAVE "Dont Show" status
                ENDIF
                CLOSE Popup
    ENDIF
END
```

### Penanganan Responsif
Sistem secara dinamis menghitung posisi elemen target (`getBoundingClientRect`) dan ukuran layar (`window.innerWidth`) untuk menentukan posisi terbaik pop-up agar selalu terlihat.

---

## 5. Rencana Pengujian
1.  **Test Case 1: Flow Normal** -> Buka Beranda -> Muncul Tutorial -> Klik Lanjut sampai selesai -> Refresh -> Tutorial tidak muncul lagi (karena status completed).
2.  **Test Case 2: Skip** -> Hapus LocalStorage -> Buka Beranda -> Klik Lewati -> Refresh -> Tutorial muncul lagi.
3.  **Test Case 3: Dont Show** -> Hapus LocalStorage -> Buka Beranda -> Centang "Jangan tampilkan" -> Klik Lewati -> Refresh -> Tutorial TIDAK muncul.
