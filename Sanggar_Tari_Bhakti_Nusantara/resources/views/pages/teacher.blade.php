@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden" style="background-image: url('{{ asset('images/bgbatik2.png') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] pointer-events-none z-0"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-6 py-16 lg:py-20 space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('about') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#FFF6D5] text-[#8C6A08] border border-[#FEDA60]/40 hover:bg-[#FFF0C2] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Kembali
            </a>
        </div>
        <div class="rounded-3xl bg-white/90 backdrop-blur-sm border-2 border-[#FEDA60]/40 p-6 shadow-xl overflow-hidden">
            <div class="relative mx-auto max-w-2xl rounded-3xl border-2 border-[#FEDA60]/40 bg-white/90 shadow-2xl overflow-hidden">
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#FEDA60]/20 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-14 -left-14 w-64 h-64 bg-[#F3B94A]/20 rounded-full blur-2xl"></div>
                <div class="relative p-8 bg-gradient-to-br from-[#FFF6D5] to-[#FFF1C7] flex items-center justify-center">
                    @if($teacher->photo)
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="max-w-sm w-full h-auto max-h-80 object-contain rounded-2xl border border-[#FEDA60]/30 shadow-lg">
                    @else
                        <div class="w-full max-w-sm h-48 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F3B94A] flex items-center justify-center border border-[#FEDA60]/30 shadow-lg">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
            <div class="p-8 space-y-4">
                <div class="space-y-6">
                    <div class="rounded-2xl bg-white/80 border border-[#FEDA60]/40 p-6 shadow">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08] font-semibold mb-2">Nama Lengkap</p>
                        <p class="text-2xl font-bold text-[#2E2E2E]">{{ $teacher->name }}</p>
                    </div>
                    <div class="rounded-2xl bg-white/80 border border-[#FEDA60]/40 p-6 shadow">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08] font-semibold mb-2">Posisi/Jabatan</p>
                        <p class="text-lg font-semibold text-[#2E2E2E]">{{ $teacher->position }}</p>
                    </div>
                    @if($teacher->specialization)
                        <div class="rounded-2xl bg-white/80 border border-[#FEDA60]/40 p-6 shadow">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08] font-semibold mb-2">Spesialisasi</p>
                            <p class="text-[#2E2E2E] font-semibold">{{ $teacher->specialization }}</p>
                        </div>
                    @endif
                    @if($teacher->bio)
                        <div class="rounded-2xl bg-[#FFF9E5] border border-[#FEDA60]/40 p-6 shadow">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08] font-semibold mb-2">Biografi</p>
                            <p class="text-[#2E2E2E] leading-relaxed">{{ $teacher->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
