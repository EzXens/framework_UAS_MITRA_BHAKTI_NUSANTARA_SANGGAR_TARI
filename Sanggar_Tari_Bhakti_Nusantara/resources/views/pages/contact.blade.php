@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden" 
         style="background-image: url('{{ asset('images/bgbatik1.png') }}'); background-size: cover; background-position: center;">
    
    <div class="absolute inset-0 bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-6 py-20">

        <!-- GLASS WRAPPER PREMIUM -->
        <div class="relative rounded-[32px] overflow-hidden bg-black/20 
                    backdrop-blur-2xl border border-[#F5D275]/20 shadow-[0_0_50px_rgba(255,224,150,0.18)]">

            <!-- Soft Gradient Shine -->
            <div class="rounded-[32px] bg-gradient-to-br from-[#2E2E2E] via-[#1a1a1a] to-[#2E2E2E] text-white px-8 py-12 lg:px-16 lg:py-16 flex flex-col lg:flex-row items-start lg:items-center gap-8 shadow-2xl border border-[#FEDA60]/20 relative overflow-hidden">

            <!-- Golden Glow -->
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-yellow-300/20 blur-3xl rounded-full"></div>

            <div class="relative p-12 grid grid-cols-1 md:grid-cols-2 gap-12">

                <!-- =====================================================
                     PANEL KIRI — INFORMASI & BRANDING
                ====================================================== -->
                <div class="flex flex-col justify-center">

                    <!-- Accent Bar -->
                    <div class="w-20 h-1.5 bg-gradient-to-r from-yellow-300 to-yellow-500 rounded-full mb-6"></div>

                    @include('components.ui.section-heading', [
                        'subtitle' => 'Kontak',
                        'title' => 'Hubungi Support Bhakti Nusantara',
                        'description' => 'Tim kami siap membantu Anda dengan cepat dan profesional.',
                        'dark' => true,
                        'descWhite' => true
                    ])

                    <!-- Highlight Message -->
                    <div class="mt-8 p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xl shadow-inner">
                        <p class="text-gray-300 leading-relaxed">
                            Kami ingin memastikan pengalaman terbaik untuk seluruh keluarga besar Bhakti 
                            Nusantara. Jangan ragu menghubungi kami kapan saja untuk informasi atau bantuan.
                        </p>
                    </div>

                    <!-- Contact Info List -->
                    <div class="mt-8 space-y-5 text-gray-200">

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

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-yellow-400/20 border border-yellow-400/30 flex items-center justify-center">
                                <span class="text-yellow-300 text-2xl">📍</span>
                            </div>
                            <p class="text-lg leading-relaxed">
                                Jl. Budaya Raya No. 12 <br>
                                Jakarta Selatan
                            </p>
                        </div>

                    </div>
                </div>

                <!-- =====================================================
                     PANEL KANAN — FORM KONTAK
                ====================================================== -->
                <div>

                    @if(session('success'))
                        <div class="rounded-2xl bg-green-50/90 border border-green-200 p-4 mb-5">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="p-8 rounded-2xl bg-white/10 border border-white/10 backdrop-blur-xl shadow-lg">
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 gap-6">

                                <div>
                                    <label class="text-sm font-medium text-gray-200">Nama</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                           class="mt-2 w-full rounded-xl px-4 py-3 border border-white/10 
                                                  bg-white/10 text-white placeholder-gray-300 
                                                  focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                    @error('name') 
                                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p> 
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-200">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           class="mt-2 w-full rounded-xl px-4 py-3 border border-white/10 
                                                  bg-white/10 text-white placeholder-gray-300 
                                                  focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                    @error('email') 
                                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p> 
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-200">Subjek</label>

                                    <select name="subject"
                                        class="mt-2 w-full rounded-xl px-4 py-3 border border-white/10 
                                            bg-white/10 text-white placeholder-gray-300 
                                            focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                        <option value="" class="text-black">-- Pilih Subjek --</option>
                                        <option style="background: rgba(0, 0, 0, 0.85);" value="Keluhan"  {{ old('subject') == 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                                        <option style="background: rgba(0, 0, 0, 0.85);" value="Saran"    {{ old('subject') == 'Saran' ? 'selected' : '' }}>Saran</option>
                                        <option style="background: rgba(0, 0, 0, 0.85);" value="Lainnya"  {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>

                                    @error('subject') 
                                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p> 
                                    @enderror
                                </div>


                                <div>
                                    <label class="text-sm font-medium text-gray-200">Pesan</label>
                                    <textarea name="message" rows="6" required
                                              class="mt-2 w-full rounded-xl px-4 py-3 border border-white/10 
                                                     bg-white/10 text-white placeholder-gray-300 
                                                     focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- ==============================
                                    CAPTCHA + BUTTON (RAPI & MEWAH)
                                ================================ -->
                                <div>
                                    <div class="rounded-2xl bg-black/50 border border-white/10 backdrop-blur-xl p-2 shadow-inner">
                                        <div class="flex flex-col md:flex-row items-center justify-between">

                                            <!-- CAPTCHA -->
                                            <div class="cf-turnstile" 
                                                data-sitekey="0x4AAAAAACEeieCtGo8oT1FO"
                                                data-theme="dark">
                                            </div>

                                            <!-- SEND BUTTON -->
                                            <button type="submit"
                                                class="px-6 py-4 bg-gradient-to-br from-[#FEDA60] to-[#F5B347]
                                                    font-bold text-[#2E2E2E] cursor-pointer rounded-2xl
                                                    shadow-lg hover:shadow-2xl hover:scale-105
                                                    transition-all duration-300 flex items-center justify-center">

                                                <!-- SVG ICON SEND -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14 10l-3 3m9.288-9.969a.535.535 0 0 1 .68.681l-5.924 16.93a.535.535 0 0 1-.994.04l-3.219-7.242a.534.534 0 0 0-.271-.271l-7.242-3.22a.535.535 0 0 1 .04-.993l16.93-5.925Z"/>
                                                </svg>
                                            </button>

                                        </div>

                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection
