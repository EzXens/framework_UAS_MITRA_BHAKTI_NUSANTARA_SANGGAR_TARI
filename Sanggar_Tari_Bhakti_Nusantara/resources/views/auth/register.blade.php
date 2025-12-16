@extends('layouts.app')

@section('content')
    <section class="min-h-screen relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden" style="background-image: url('{{ asset('images/bgbatikemas.png') }}'); background-size: cover; background-position: center;">

        <!-- Radial vignette -->
        <div
        class="absolute inset-0"
        style="
            background: radial-gradient(
            circle at center,
            rgba(0,0,0,0) 0%,
            rgba(0,0,0,0.25) 35%,
            rgba(0,0,0,0.6) 65%,
            rgba(0,0,0,0.9) 100%
            );
        ">
        </div>

        <!-- Gold Soft Glow -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Glow 1 (atas kiri) -->
            <div class="absolute -top-32 -left-20 w-[500px] h-[500px] rounded-full
                    bg-gradient-to-br from-[#FFE9A3]/40 via-[#F7D774]/25 to-transparent
                    blur-[120px] opacity-70"></div>

            <!-- Glow 2 (bawah kanan) -->
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] rounded-full
                    bg-gradient-to-tl from-[#F5C768]/30 via-[#EFC45C]/20 to-transparent
                    blur-[130px] opacity-60"></div>

            <!-- Glow Tengah (lebih halus & besar) -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                    w-[900px] h-[900px] rounded-full
                    bg-gradient-radial from-[#F4D27A]/20 to-transparent
                    blur-[150px] opacity-40"></div>
        </div>

        <!-- Soft Pattern Emas -->
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 2px 2px, #FAD97A 1px, transparent 0);
                background-size: 45px 45px;">
        </div>

        <div class="relative w-full max-w-md lg:max-w-2xl">
    <div
        class="relative rounded-[28px] border border-[#FEDA60]/30 bg-white/95 backdrop-blur-xl
        shadow-2xl shadow-[#FEDA60]/20 overflow-hidden">

        <!-- Ornament -->
        <div class="absolute -top-24 -right-24 w-56 h-56 rounded-full
            bg-gradient-to-br from-[#FFE184]/30 via-[#FEDA60]/20 to-transparent blur-2xl"></div>
        <div class="absolute -bottom-24 -left-24 w-56 h-56 rounded-full
            bg-gradient-to-tr from-[#FEDA60]/20 to-transparent blur-2xl"></div>

        <div class="relative p-6 lg:p-8">

            <!-- Header (compact) -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo/logo2.png') }}"
                    class="h-20 w-20 mx-auto mb-3 object-contain drop-shadow-lg">
                <h2 class="text-3xl font-bold text-[#2E2E2E]">Daftar Akun</h2>
                <p class="text-sm text-[#4F4F4F] mt-1">
                    Bergabung dengan Bhakti Nusantara
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-3">
                    <ul class="text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('register.post') }}" method="POST"
                  class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @csrf

                <!-- Nama -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-1">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" required
                        value="{{ old('name') }}"
                        placeholder="Nama lengkap Anda"
                        class="w-full px-4 py-2.5 rounded-xl border-2 border-[#E2B136]/30 bg-white/80
                        focus:outline-none focus:border-[#FEDA60]
                        focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">
                </div>

                <!-- Email -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-1">
                        Email
                    </label>
                    <input type="email" name="email" required
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        class="w-full px-4 py-2.5 rounded-xl border-2 border-[#E2B136]/30 bg-white/80
                        focus:outline-none focus:border-[#FEDA60]
                        focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-1">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                            placeholder="Min. 8 karakter"
                            class="w-full px-4 pr-12 py-2.5 rounded-xl border-2 border-[#E2B136]/30 bg-white/80
                            focus:outline-none focus:border-[#FEDA60]
                            focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">
                        <button type="button"
                            onclick="togglePassword('password','eye1')"
                            class="absolute right-4 top-0 h-full flex items-center">
                            <svg id="eye1" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-[#6F6F6F]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                                    c4.477 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.065 7-9.542 7
                                    -4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Konfirmasi -->
                <div>
                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-1">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            placeholder="Ulangi password"
                            class="w-full px-4 pr-12 py-2.5 rounded-xl border-2 border-[#E2B136]/30 bg-white/80
                            focus:outline-none focus:border-[#FEDA60]
                            focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">
                        <button type="button"
                            onclick="togglePassword('password_confirmation','eye2')"
                            class="absolute right-4 top-0 h-full flex items-center">
                            <svg id="eye2" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-[#6F6F6F]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                                    c4.477 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.065 7-9.542 7
                                    -4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Button -->
                <div class="lg:col-span-2 mt-2">
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347]
                        text-[#2E2E2E] font-semibold shadow-lg shadow-[#FEDA60]/30 cursor-pointer
                        hover:shadow-xl hover:scale-[1.02] transition-all">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-4 text-center">
                <p class="text-sm text-[#4F4F4F]">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="font-semibold text-[#8C6A08] hover:text-[#FEDA60]">
                        Login disini
                    </a>
                </p>
                <p class="text-sm mt-1">
                    <a href="{{ route('password.forgot') }}"
                        class="font-semibold text-[#8C6A08] hover:text-[#FEDA60]">
                        Lupa Password?
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>

    </section>

    <script>
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3l18 18M9.88 9.88A3 3 0 0114.12 14.12M6.1 6.1C4.29 7.49 2.82 9.5 2.458 12
                3.732 16.057 7.523 19 12 19c1.84 0 3.57-.5 5.06-1.36M17.9 17.9
                C19.71 16.51 21.18 14.5 21.542 12
                20.268 7.943 16.477 5 12 5c-1.96 0-3.82.5-5.45 1.39" />`;
    } else {
        input.type = "password";
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268
                2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477
                0-8.268-2.943-9.542-7z" />`;
    }
}
</script>

@endsection