@extends('layouts.app')

@section('content')
    <section class="min-h-screen relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Background Gradient Soft -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#1E1E1E] via-[#2B2A26] to-[#1C1B19]"></div>

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

        <div class="relative max-w-md w-full">
            <div
                class="rounded-[32px] border border-[#FEDA60]/30 bg-white/95 backdrop-blur-xl shadow-2xl shadow-[#FEDA60]/20 overflow-hidden">
                <div
                    class="absolute -top-20 -right-20 w-40 h-40 rounded-full bg-gradient-to-br from-[#FFE184] via-[#FEDA60] to-[#F5B347] opacity-20">
                </div>
                <div
                    class="absolute -bottom-16 -left-16 w-32 h-32 rounded-full bg-gradient-to-br from-[#FEDA60] to-[#F4BD4D] opacity-20">
                </div>

                <div class="relative p-8 lg:p-10">
                    <div class="text-center mb-8">
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="Bhakti Nusantara"
                                class="h-16 w-16 object-contain drop-shadow-lg">
                        </div>
                        <h2 class="text-3xl font-bold text-[#2E2E2E]">Reset Password</h2>
                        <p class="mt-2 text-sm text-[#4F4F4F]">
                            Periksa email Anda untuk kode reset
                        </p>
                    </div>

                    @if (session('success'))
                        <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 p-4">
                            <ul class="text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Input Kode Manual -->
                    <form action="{{ route('password.verifyCode') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="code" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                Kode Reset Password
                            </label>
                            <input 
                                id="code" 
                                name="code" 
                                type="text" 
                                required 
                                placeholder="Masukkan kode dari email"
                                class="w-full px-4 py-3 rounded-xl border-2 border-[#E2B136]/30 bg-white/80 
                                    focus:outline-none focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 transition-all
                                    font-mono text-center text-lg tracking-widest"
                            >
                        </div>

                        <button 
                            type="submit"
                            class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold shadow-lg shadow-[#FEDA60]/30 hover:shadow-xl hover:shadow-[#FEDA60]/40 hover:scale-[1.02] transition-all">
                            Verifikasi Kode
                        </button>
                    </form>

                    <!-- Info Development -->
                    @if (config('app.debug') && session('reset_token'))
                        <div class="mt-6 rounded-xl bg-blue-50 border border-blue-200 p-4">
                            <p class="text-xs text-blue-600 font-mono break-all">
                                Token: {{ session('reset_token') }}
                            </p>
                        </div>
                    @endif

                    <!-- Link ke halaman forgot -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-[#4F4F4F]">
                            Belum menerima email?
                            <a href="{{ route('password.forgot') }}"
                                class="font-semibold text-[#8C6A08] hover:text-[#FEDA60] transition-colors">
                                Kirim ulang
                            </a>
                        </p>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-sm text-[#4F4F4F]">
                            Kembali ke
                            <a href="{{ route('login') }}"
                                class="font-semibold text-[#8C6A08] hover:text-[#FEDA60] transition-colors">
                                Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
