@extends('layouts.app')

@section('content')
<section class="min-h-screen relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1E1E1E] via-[#2B2A26] to-[#1C1B19]"></div>
    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -left-20 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-[#FFE9A3]/40 via-[#F7D774]/25 to-transparent blur-[120px] opacity-70"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] rounded-full bg-gradient-to-tl from-[#F5C768]/30 via-[#EFC45C]/20 to-transparent blur-[130px] opacity-60"></div>
    </div>

    <div class="relative max-w-md w-full">
        <div class="rounded-[32px] border border-[#FEDA60]/30 bg-white/95 backdrop-blur-xl shadow-2xl shadow-[#FEDA60]/20 overflow-hidden">
            <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full bg-gradient-to-br from-[#FFE184] via-[#FEDA60] to-[#F5B347] opacity-20"></div>
            
            <div class="relative p-8 lg:p-10">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-[#2E2E2E]">✉️ Verifikasi Email</h2>
                    <p class="mt-2 text-sm text-[#4F4F4F]">Kami telah mengirimkan kode verifikasi ke email Anda</p>
                </div>

                @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700">{{ session('success') }}</div>@endif
                @if(session('warning'))<div class="mb-4 p-3 rounded-lg bg-yellow-50 border border-yellow-200 text-sm text-yellow-700">{{ session('warning') }}</div>@endif

                <!-- Dev Helper: Show token if debug is on -->
                @if(config('app.debug') && session('verification_token'))
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-xs font-semibold text-blue-700 mb-2">🔧 DEVELOPMENT MODE</p>
                        <p class="text-xs text-blue-600 mb-2">Kode verifikasi Anda (copy & paste di bawah):</p>
                        <div class="font-mono text-sm bg-white p-2 rounded border border-blue-300 break-all">{{ session('verification_token') }}</div>
                    </div>
                @endif

                <!-- Manual Token Input Form -->
                <form method="POST" action="{{ route('verification.verifyCode') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="code" class="block text-sm font-semibold text-[#2E2E2E] mb-2">Masukkan Kode Verifikasi</label>
                        <input id="code" name="code" type="text" required 
                            class="w-full px-4 py-3 rounded-xl border-2 border-[#E2B136]/30 bg-white/80 focus:outline-none focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 transition-all font-mono text-center"
                            placeholder="Paste kode dari email di sini" autocomplete="off">
                        @if($errors->has('code'))<p class="text-red-600 text-sm mt-2">{{ $errors->first('code') }}</p>@endif
                    </div>
                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold shadow-lg shadow-[#FEDA60]/30 hover:shadow-xl hover:shadow-[#FEDA60]/40 hover:scale-[1.02] transition-all">
                        ✓ Verifikasi Email
                    </button>
                </form>

                <div class="mt-6 border-t border-gray-200 pt-4">
                    <p class="text-sm text-[#4F4F4F] mb-3">Belum menerima kode?</p>
                    <form method="POST" action="{{ route('verification.resend') }}" class="space-y-3">
                        @csrf
                        <div>
                            <input type="email" name="email" placeholder="Masukkan email Anda" required
                                class="w-full px-4 py-2 rounded-xl border-2 border-[#E2B136]/30 bg-white/80 focus:outline-none focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 transition-all text-sm">
                        </div>
                        <button type="submit" class="w-full py-2 px-4 rounded-lg bg-[#E2B136]/20 text-[#2E2E2E] font-medium hover:bg-[#E2B136]/30 transition-all text-sm">
                            📧 Kirim Ulang Kode
                        </button>
                    </form>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-[#FEDA60] transition-colors">← Kembali ke beranda</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
