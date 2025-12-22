@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden"
    style="background-image: url('{{ asset('images/bgbatik1.png') }}'); background-size: cover; background-position: center;">

    <!-- BACKGROUND OVERLAY -->
    <div class="absolute inset-0 bg-gradient-to-br from-white via-[#FFF1C7]/80 to-[#FFF1C7] z-0"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">

        <!-- GLASS CARD -->
        <div class="rounded-[32px] bg-black/20 backdrop-blur-2xl border border-[#F5D275]/20 shadow-[0_0_50px_rgba(255,224,150,0.18)] overflow-hidden">

            <div class="relative bg-gradient-to-br from-[#2E2E2E] via-[#1a1a1a] to-[#2E2E2E]
                        text-white px-8 py-14 lg:px-16 lg:py-16">

                <!-- GOLD GLOW -->
                <div class="absolute -top-16 -left-16 w-40 h-40 bg-yellow-300/20 blur-3xl rounded-full"></div>

                <div class="relative grid grid-cols-1 md:grid-cols-2 gap-12 items-stretch">


                    <!-- ==================================================
                         ATAS TENGAH — JUDUL KONTAK
                    =================================================== -->
                    <div class="md:col-span-2 text-center max-w-3xl mx-auto">

                        <div class="flex justify-start mb-6">
                            <div class="w-24 h-1.5 bg-gradient-to-r from-yellow-300 to-yellow-500 rounded-full"></div>
                        </div>

                        @include('components.ui.section-heading', [
                            'subtitle' => 'Kontak',
                            'title' => 'Hubungi Support Bhakti Nusantara',
                            'description' => 'Tim kami siap membantu Anda dengan cepat dan profesional.',
                            'dark' => true,
                            'descWhite' => true
                        ])

                    </div>

                    <!-- ==================================================
                         BAWAH KIRI — INFORMASI KONTAK
                    =================================================== -->
                    <div class="flex flex-col gap-8">

                        <!-- KAMI INGIN -->
                        <div class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xl shadow-inner">
                            <p class="text-gray-300 leading-relaxed">
                                Kami ingin memastikan pengalaman terbaik untuk seluruh keluarga besar
                                Bhakti Nusantara. Jangan ragu menghubungi kami kapan saja untuk informasi
                                maupun bantuan.
                            </p>
                        </div>

                        <!-- LOKASI -->
                        <div class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xl shadow-inner">
                            <h3 class="mb-5 text-base font-semibold text-[#FEDA60]">Lokasi Kami</h3>
                            <div class="h-64 rounded-xl overflow-hidden border border-[#FEDA60]/20 shadow-lg">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249.35596618350016!2d117.16697866561252!3d-0.44964516427457385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67898ceb57753%3A0x75cb9190cbb6058b!2sBlk.%20AH%20No.6%2C%20Sempaja%20Sel.%2C%20Kec.%20Samarinda%20Utara%2C%20Kota%20Samarinda%20Utara!5e0!3m2!1sid!2sid!4v1764147841206"
                                    class="w-full h-full border-0"
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>

                        <!-- KONTAK DETAIL -->
                        <div class="space-y-5 text-gray-200">

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-yellow-400/20 border border-yellow-400/30 flex items-center justify-center">
                                    <span class="text-yellow-300 text-2xl">📍</span>
                                </div>
                                <p class="text-lg leading-relaxed">
                                    Jl. Budaya Raya No. 12<br>
                                    Jakarta Selatan
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-yellow-400/20 border border-yellow-400/30 flex items-center justify-center">
                                    <span class="text-yellow-300 text-2xl">📞</span>
                                </div>
                                <p class="text-lg">0851-2345-6789</p>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-yellow-400/20 border border-yellow-400/30 flex items-center justify-center">
                                    <span class="text-yellow-300 text-2xl">📧</span>
                                </div>
                                <p class="text-lg">support@bhaktinusantara.com</p>
                            </div>

                        </div>
                    </div>

                    <!-- ==================================================
                         BAWAH KANAN — FORM KONTAK
                    =================================================== -->
                    <div class="h-full flex">

                        @if(session('success'))
                            <div class="mb-6 p-4 rounded-2xl bg-green-50/90 border border-green-200">
                                <p class="text-green-700 text-sm">{{ session('success') }}</p>
                            </div>
                        @endif

                        <div class="p-8 rounded-2xl bg-white/10 border border-white/10 backdrop-blur-xl shadow-lg h-full flex flex-col w-full">

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf

                                <div class="space-y-6">

                                    <div>
                                        <label class="text-sm font-medium text-gray-200">Nama</label>
                                        <input type="text" name="name" required
                                            class="mt-2 w-full rounded-xl px-4 py-3 bg-white/10 border border-white/10
                                                   text-white focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium text-gray-200">Email</label>
                                        <input type="email" name="email" required
                                            class="mt-2 w-full rounded-xl px-4 py-3 bg-white/10 border border-white/10
                                                   text-white focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium text-gray-200">Subjek</label>
                                        <select name="subject"
                                            class="mt-2 w-full rounded-xl px-4 py-3 bg-white/10 border border-white/10
                                                   text-white focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                                            <option value="" class="text-black">-- Pilih Subjek --</option>
                                            <option value="Keluhan" class="bg-black">Keluhan</option>
                                            <option value="Saran" class="bg-black">Saran</option>
                                            <option value="Lainnya" class="bg-black">Lainnya</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium text-gray-200">Pesan</label>
                                        <textarea name="message" rows="6" required
                                            class="mt-2 w-full rounded-xl px-4 py-3 bg-white/10 border border-white/10
                                                   text-white focus:ring-2 focus:ring-yellow-400 focus:outline-none"></textarea>
                                    </div>

                                    <button type="submit"
                                        class="w-full py-4 rounded-2xl font-bold
                                               bg-gradient-to-br from-[#FEDA60] to-[#F5B347]
                                               text-[#2E2E2E] shadow-lg hover:scale-105 transition">
                                        Kirim Pesan
                                    </button>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
