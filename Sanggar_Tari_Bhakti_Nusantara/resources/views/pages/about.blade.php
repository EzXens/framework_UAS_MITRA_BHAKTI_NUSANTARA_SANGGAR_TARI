@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-white via-[#FFF6D5] to-[#FEDA60]/20">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-14 space-y-10">
            @include('components.ui.section-heading', [
                'subtitle' => 'Profil Sanggar',
                'title' => 'Bhakti Nusantara, Rumah Bagi Pecinta Tari Tradisional',
                'description' => 'Sejak 2012 kami mewadahi generasi muda untuk mempelajari dan menampilkan tari-tari Nusantara dengan standar pertunjukan profesional.'
            ])
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] items-start">
                <div class="space-y-8">
                    <article class="rounded-3xl bg-white border border-[#FEDA60]/40 p-8 space-y-4 shadow-lg shadow-[#FEDA60]/10">
                        <h3 class="text-xl font-semibold text-[#2E2E2E]">Visi</h3>
                        <p class="text-sm text-[#4F4F4F] leading-relaxed">Menjadi sanggar tari rujukan nasional yang mengedepankan pelestarian budaya, inovasi koreografi, dan pengembangan karakter melalui seni tari.</p>
                    </article>
                    <article class="rounded-3xl bg-white border border-[#FEDA60]/40 p-8 space-y-4 shadow-lg shadow-[#FEDA60]/10">
                        <h3 class="text-xl font-semibold text-[#2E2E2E]">Misi</h3>
                        <ul class="space-y-3 text-sm text-[#4F4F4F] leading-relaxed list-disc list-inside">
                            <li>Menghadirkan kurikulum tari tradisional yang sistematis dan adaptif.</li>
                            <li>Memberikan fasilitas latihan dan panggung yang layak bagi penari.</li>
                            <li>Menjalin kolaborasi dengan komunitas budaya dan institusi pendidikan.</li>
                            <li>Mendorong penari untuk aktif berkarya dan berkompetisi secara sehat.</li>
                        </ul>
                    </article>
                    <div class="grid gap-6 sm:grid-cols-2">
                        @foreach ([
                            ['label' => 'Instruktur', 'value' => '15'],
                            ['label' => 'Alumni', 'value' => '450+'],
                            ['label' => 'Pentas Tahunan', 'value' => '6'],
                            ['label' => 'Workshop Nasional', 'value' => '12'],
                        ] as $stat)
                            <div class="rounded-2xl bg-[#FFF0C2] px-6 py-8 text-center border border-[#E2B136]/30">
                                <p class="text-2xl font-semibold text-[#2E2E2E]">{{ $stat['value'] }}</p>
                                <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-6 rounded-[36px] bg-[#FEDA60]/20 blur-3xl -z-10"></div>
                    <div class="relative rounded-[32px] border border-[#FEDA60]/60 bg-white shadow-xl overflow-hidden p-8 space-y-6">
                        <div class="absolute -top-16 right-[-10%] h-48 w-48 rounded-full bg-[conic-gradient(from_45deg,_#FFF4C6,_#FEDA60,_#F3B94A,_#FFF4C6)] opacity-70"></div>
                        <div class="absolute bottom-[-18%] left-[-8%] h-56 w-56 rounded-full bg-[radial-gradient(circle_at_center,_#FFE9A9,_#F6B643)] opacity-60"></div>
                        <div class="relative grid gap-5">
                            <img src="https://cdn.antaranews.com/cache/1200x800/2024/07/06/18_1.jpg" alt="Festival Tari Kreasi" class="w-full h-94 object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#1a1a1a] via-[#2E2E2E] to-[#1a1a1a]">
        <div class="max-w-6xl mx-auto px-6 py-16 lg:py-24 space-y-12">
            @include('components.ui.section-heading', [
                'dark' => true,
                'subtitle' => 'Nilai Utama',
                'title' => 'Budaya, Kreativitas, dan Karakter',
                'description' => 'Setiap latihan dikemas untuk menanamkan rasa cinta terhadap budaya, kepekaan terhadap detail, serta sikap disiplin.'
            ])
        <div class="grid gap-6 lg:grid-cols-3">
            @foreach ([
                ['title' => 'Pelestarian Budaya', 'desc' => 'Mempelajari filosofi di balik setiap gerak dan musik tradisi sebagai wujud penghargaan pada leluhur.'],
                ['title' => 'Inovasi Kreatif', 'desc' => 'Mendorong penari untuk bereksperimen dengan koreografi baru tanpa meninggalkan pakem.'],
                ['title' => 'Pembinaan Karakter', 'desc' => 'Mengembangkan disiplin, kerja sama, dan kepemimpinan melalui kerja tim dalam produksi pertunjukan.'],
            ] as $item)
                <article class="rounded-3xl bg-white border border-[#FEDA60]/30 p-8 space-y-4 shadow-lg shadow-[#FEDA60]/10">
                    <h3 class="text-xl font-semibold text-[#2E2E2E]">{{ $item['title'] }}</h3>
                    <p class="text-sm text-[#4F4F4F] leading-relaxed">{{ $item['desc'] }}</p>
                </article>
            @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-white via-[#FFF6D5] to-[#FEDA60]/20">
        <div class="max-w-6xl mx-auto px-6 py-16 lg:py-24 space-y-12">
            @include('components.ui.section-heading', [
                'subtitle' => 'Instruktur Profesional',
                'title' => 'Tim Pengajar',
                'description' => 'Pelatih Bhakti Nusantara merupakan seniman aktif yang rutin tampil di festival Nusantara dan mendapat sertifikasi dari lembaga tari nasional.'
            ])
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['name' => 'Ratna Widyasari', 'role' => 'Direktur Artistik'],
                    ['name' => 'Taufik Nugraha', 'role' => 'Pelatih Koreografi'],
                    ['name' => 'Mita Arindya', 'role' => 'Pelatih Teknik'],
                    ['name' => 'Adi Wibowo', 'role' => 'Pelatih Musik & Iringan'],
                ] as $coach)
                    <article class="rounded-3xl bg-white border border-[#FEDA60]/40 p-6 space-y-3 shadow-lg shadow-[#FEDA60]/10 hover:shadow-xl hover:scale-[1.02] transition-all">
                        <p class="text-lg font-semibold text-[#2E2E2E]">{{ $coach['name'] }}</p>
                        <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">{{ $coach['role'] }}</p>
                        <p class="text-sm text-[#4F4F4F] leading-relaxed">Pengalaman 10+ tahun dalam pertunjukan dan pendidikan tari tradisi.</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
