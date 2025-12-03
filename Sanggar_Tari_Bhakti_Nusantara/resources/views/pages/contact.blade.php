@extends('layouts.app')

@section('content')
<section 
    class="py-16 lg:py-14 bg-gradient-to-b from-white via-[#FFF9E5] to-[#FFF6D5]"
    style="background-image: url('{{ asset('images/bgbatik3.png') }}'); background-size: cover; background-position: center;"
>
    <div class="max-w-4xl mx-auto px-6">

        <!-- GLASS WRAPPER -->
        <div class="glass-dark rounded-3xl border border-gold-soft p-10 shadow-[0_0_25px_rgba(254,218,96,0.15)] backdrop-blur-lg bg-black/30">

            @include('components.ui.section-heading', [
                'subtitle' => 'Kontak',
                'title' => 'Hubungi Support Bhakti Nusantara',
                'description' => 'Silakan kirimkan pertanyaan, saran, atau permintaan bantuan. Tim kami akan menanggapi secepatnya.',
                'dark' => true,
                'descWhite' => true
            ])

            @if(session('success'))
                <div class="rounded-2xl bg-green-50/90 border border-green-200 p-4 my-4">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            <!-- FORM -->
            <div class=" p-8 mt-6 bg-black/20 backdrop-blur-md border border-white/10">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">

                        <div>
                            <label class="text-sm font-medium text-gray-200">Nama</label>
                            <input 
                                type="text" name="name" value="{{ old('name') }}" required
                                class="mt-2 w-full rounded-lg px-4 py-3 border border-white/10 bg-white/10 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400" 
                            />
                            @error('name') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-200">Email</label>
                            <input 
                                type="email" name="email" value="{{ old('email') }}" required
                                class="mt-2 w-full rounded-lg px-4 py-3 border border-white/10 bg-white/10 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400" 
                            />
                            @error('email') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-200">Subjek</label>
                            <input 
                                type="text" name="subject" value="{{ old('subject') }}"
                                class="mt-2 w-full rounded-lg px-4 py-3 border border-white/10 bg-white/10 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400" 
                            />
                            @error('subject') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-200">Pesan</label>
                            <textarea 
                                name="message" rows="6" required
                                class="mt-2 w-full rounded-lg px-4 py-3 border border-white/10 bg-white/10 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            >{{ old('message') }}</textarea>
                            @error('message') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                        </div>

                       <div class="flex items-center justify-end gap-4">

                        <!-- CAPTCHA CLOUDFLARE -->
                        <div class="cf-turnstile" 
                            data-sitekey="0x4AAAAAACEeieCtGo8oT1FO"
                            data-theme="dark">
                        </div>

                        <!-- TOMBOL KIRIM -->
                        <button 
                            type="submit"
                            class="px-6 py-3 bg-gradient-to-br from-[#FEDA60] to-[#F5B347] rounded-xl font-semibold text-[#2E2E2E] shadow-lg hover:shadow-xl transition"
                        >Kirim Pesan</button>
                    </div>


                    </div>
                </form>
            </div>

        </div>

    </div>
</section>
@endsection
