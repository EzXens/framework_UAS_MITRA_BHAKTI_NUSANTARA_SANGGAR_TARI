
export const tutorialData = {
    'onboarding': {
        routes: ['/', '/produk', '/kelas', '/galeri', '/kontak'],
        nextRoute: '/login',
        steps: [
            {
                route: '/',
                target: '#main-header nav ul',
                title: 'Menu Utama',
                description: 'Area navigasi utama untuk berpindah antar halaman inti.',
                position: 'bottom',
                icon: 'home'
            },
            {
                route: '/',
                target: '#main-header nav ul a[href="/"]',
                title: 'Beranda',
                description: 'Halaman utama dengan ringkasan aktivitas, notifikasi, dan akses cepat.',
                position: 'bottom',
                icon: 'home'
            },
            {
                route: '/produk',
                target: 'h1, h2',
                title: 'Produk',
                description: 'Katalog produk dengan fitur filter, sort, dan pencarian.',
                position: 'bottom',
                icon: 'products'
            },
            {
                route: '/kelas',
                target: 'h1, h2',
                title: 'Kelas',
                description: 'Daftar kelas dan materi dengan informasi lengkap.',
                position: 'bottom',
                icon: 'classes'
            },
            {
                route: '/galeri',
                target: 'h1, h2',
                title: 'Galeri',
                description: 'Koleksi media dengan zoom, slideshow, dan opsi unduh.',
                position: 'bottom',
                icon: 'gallery'
            },
            {
                route: '/kontak',
                target: 'h1, h2',
                title: 'Kontak',
                description: 'Hubungi support via live chat, email, atau media sosial melalui form dibawah ini.',
                position: 'bottom',
                icon: 'contact'
            }
        ]
    },
    'home': {
        routes: ['/'],
        nextRoute: '/login',
        steps: [
            {
                target: '#main-header nav ul',
                title: 'Menu Utama',
                description: 'Area navigasi utama untuk berpindah antar halaman inti.',
                position: 'bottom'
            },
            {
                target: '#main-header nav ul a[href="/"]',
                title: 'Beranda',
                description: 'Halaman utama dengan ringkasan aktivitas, notifikasi, dan akses cepat.',
                position: 'bottom',
                icon: 'home'
            },
            {
                target: '#main-header nav ul a[href="/produk"]',
                title: 'Produk',
                description: 'Katalog produk dengan fitur filter, sort, dan pencarian.',
                position: 'bottom',
                icon: 'products'
            },
            {
                target: '#main-header nav ul a[href="/kelas"]',
                title: 'Kelas',
                description: 'Daftar kelas dan materi dengan progress tracking dan badge.',
                position: 'bottom',
                icon: 'classes'
            },
            {
                target: '#main-header nav ul a[href="/galeri"]',
                title: 'Galeri',
                description: 'Koleksi media dengan zoom, slideshow, dan opsi unduh.',
                position: 'bottom',
                icon: 'gallery'
            },
            {
                target: '#main-header nav ul a[href="/kontak"]',
                title: 'Kontak',
                description: 'Hubungi support via live chat, email, atau media sosial.',
                position: 'bottom',
                icon: 'contact'
            },
        ]
    },
    'products': {
        routes: ['/produk'],
        nextRoute: '/kelas',
        steps: [
            {
                target: 'h1', 
                title: 'Katalog Produk', 
                description: 'Temukan kostum, aksesoris, dan merchandise tari berkualitas di sini.',
                position: 'bottom'
            },
            {
                target: '.grid article:first-child',
                title: 'Detail Produk',
                description: 'Klik pada kartu produk untuk melihat detail harga, stok, dan deskripsi lengkap.',
                position: 'right'
            },
            {
                target: 'a[href*="wa.me"]',
                title: 'Pemesanan',
                description: 'Tertarik dengan produk kami? Hubungi admin via WhatsApp untuk pemesanan.',
                position: 'top'
            }
        ]
    },
    'classes': {
        routes: ['/kelas'],
        nextRoute: '/galeri',
        steps: [
            {
                target: 'h1, h2', // Fallback
                title: 'Kelas Tari',
                description: 'Pilih kelas yang sesuai dengan minat dan tingkat kemahiran Anda.',
                position: 'bottom'
            },
            {
                target: '.grid article:first-child',
                title: 'Informasi Kelas',
                description: 'Setiap kartu menampilkan nama kelas, instruktur, jadwal latihan, dan kuota yang tersedia.',
                position: 'right'
            },
            {
                target: 'button[type="submit"], a[href*="login"]',
                title: 'Daftar Sekarang',
                description: 'Klik tombol ini untuk mendaftar ke kelas pilihan Anda (perlu login).',
                position: 'top'
            },
            {
                target: '.rounded-3xl.bg-gradient-to-br', // Targeting the Instructor Contact section container
                title: 'Konsultasi',
                description: 'Bingung memilih kelas? Hubungi instruktur kami untuk konsultasi gratis.',
                position: 'top'
            }
        ]
    },
    'gallery': {
        routes: ['/galeri'],
        nextRoute: '/tentang',
        steps: [
            {
                target: '#carousel3d',
                title: 'Sorotan Kegiatan',
                description: 'Lihat dokumentasi 3D interaktif dari penampilan dan kegiatan terbaru kami.',
                position: 'bottom'
            },
            {
                target: '.flex.flex-wrap.items-center.gap-3',
                title: 'Kategori Media',
                description: 'Gunakan tombol ini untuk menyaring galeri berdasarkan Foto, Video, atau Musik.',
                position: 'bottom'
            },
            {
                target: '#media-content',
                title: 'Koleksi Galeri',
                description: 'Jelajahi koleksi lengkap dokumentasi seni kami di sini.',
                position: 'top'
            }
        ]
    },
    'about': {
        routes: ['/tentang'],
        nextRoute: '/kontak',
        steps: [
            {
                target: 'h1, h2',
                title: 'Tentang Kami',
                description: 'Mengenal lebih dekat sejarah dan filosofi Sanggar Tari Bhakti Nusantara.',
                position: 'bottom'
            },
            {
                target: '.grid > div:first-child > article:nth-of-type(1)', // Visi Card
                title: 'Visi Kami',
                description: 'Tujuan jangka panjang kami dalam melestarikan budaya tari tradisional.',
                position: 'right'
            },
            {
                target: '.grid > div:first-child > article:nth-of-type(2)', // Misi Card
                title: 'Misi Kami',
                description: 'Langkah-langkah nyata yang kami lakukan untuk mewujudkan visi sanggar.',
                position: 'right'
            },
            {
                target: 'section:nth-of-type(2)', // Core Values section
                title: 'Nilai Utama',
                description: 'Nilai-nilai budaya, kreativitas, dan karakter yang kami tanamkan dalam setiap latihan.',
                position: 'top'
            },
            {
                target: 'section:nth-of-type(3)', // Teachers section
                title: 'Tim Pengajar',
                description: 'Berlatih bersama instruktur profesional dan berpengalaman di bidangnya.',
                position: 'top'
            }
        ]
    },
    'contact': {
        routes: ['/kontak'],
        steps: [
            {
                target: 'iframe', // Map
                title: 'Lokasi Sanggar',
                description: 'Kunjungi studio latihan kami di alamat yang tertera di peta ini.',
                position: 'right'
            },
            {
                target: '.space-y-5.text-gray-200', // Contact Info Container
                title: 'Informasi Kontak',
                description: 'Hubungi kami melalui telepon, WhatsApp, atau email untuk respon cepat.',
                position: 'left'
            },
            {
                target: 'form', // Contact Form
                title: 'Kirim Pesan',
                description: 'Anda juga dapat mengirimkan pesan, saran, atau pertanyaan melalui formulir ini.',
                position: 'top'
            }
        ]
    },
    'login_onboarding': {
        routes: ['/login'],
        steps: [
            {
                target: '#auth-card',
                title: 'Login diperlukan',
                description: 'Login diperlukan untuk mengakses fitur lengkap. Anda dapat mencoba demo terlebih dahulu.',
                position: 'bottom',
                icon: 'login',
                actions: [
                    { label: 'Login', variant: 'primary', href: '/login' },
                    { label: 'Explore Demo', variant: 'secondary', href: '/?reset-tutorial' }
                ]
            },
            {
                target: 'section form button[type="submit"]',
                title: 'Login',
                description: 'Tekan tombol ini untuk masuk sebagai user dan membuka semua fitur.',
                position: 'top',
                icon: 'login'
            }
        ]
    },
    'admin_dashboard': {
        routes: ['/admin/dashboard'],
        steps: [
            {
                target: 'aside#sidebar nav',
                title: 'Menu Navigasi',
                description: 'Gunakan menu di samping kiri ini untuk mengakses berbagai fitur pengelolaan.',
                position: 'right'
            },
            {
                target: 'aside#sidebar nav a[href*="classes"]',
                title: 'Kelola Kelas',
                description: 'Menu untuk menambah, mengedit, atau menghapus data kelas tari.',
                position: 'right'
            },
            {
                target: 'aside#sidebar nav a[href*="products"]',
                title: 'Kelola Produk',
                description: 'Menu untuk mengelola produk sewa kostum dan aksesoris.',
                position: 'right'
            },
            {
                target: 'aside#sidebar nav a[href*="dispensations"]',
                title: 'Surat Dispensasi',
                description: 'Kelola pengajuan surat dispensasi dari siswa.',
                position: 'right'
            },
            {
                target: 'aside#sidebar nav a[href*="gallery"]',
                title: 'Galeri Media',
                description: 'Kelola konten galeri foto, video, dan musik.',
                position: 'right'
            },
            {
                target: '#dashboard-section h1',
                title: 'Dashboard Admin',
                description: 'Selamat datang di pusat kontrol admin. Di sini Anda dapat memantau ringkasan data sanggar.',
                position: 'bottom'
            },
            {
                target: '.grid > div:nth-child(1)',
                title: 'Statistik Pengguna',
                description: 'Lihat jumlah total pengguna yang terdaftar di sistem.',
                position: 'bottom'
            }
        ]
    },
    'user_dashboard': {
        routes: ['/dashboard'],
        steps: [
            {
                target: 'aside#sidebar nav',
                title: 'Navigasi',
                description: 'Gunakan menu ini untuk berpindah antar bagian tanpa memuat ulang halaman.',
                position: 'right'
            },
            {
                target: 'aside#sidebar nav a[href="#schedule"]',
                title: 'Jadwal Saya',
                description: 'Cek jadwal latihan mingguan Anda di sini.',
                position: 'right'
            },
            {
                target: 'aside#sidebar nav a[href="#classes"]',
                title: 'Kelas Saya',
                description: 'Lihat detail kelas yang Anda ikuti.',
                position: 'right'
            },
            {
                target: 'aside#sidebar nav a[href="#dispensation"]',
                title: 'Dispensasi',
                description: 'Ajukan surat dispensasi jika berhalangan hadir.',
                position: 'right'
            },
            {
                target: '#overview-section h1',
                title: 'Dashboard Siswa',
                description: 'Selamat datang! Ini adalah halaman utama untuk memantau aktivitas Anda.',
                position: 'bottom'
            },
            {
                target: '.grid > div:nth-child(1)',
                title: 'Ringkasan Kelas',
                description: 'Lihat jumlah kelas yang sedang Anda ikuti saat ini.',
                position: 'bottom'
            }
        ]
    }
};
