@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden" style="background-image: url('{{ asset('images/bgbatik2.png') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] pointer-events-none z-0"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-16 lg:py-24 space-y-12">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-[#2E2E2E]">Tim Pengajar</h1>
            <p class="text-[#4F4F4F] mt-2">Profil para instruktur Bhakti Nusantara</p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $colors = ['from-[#FEDA60]', 'from-[#F3B94A]', 'from-[#FFE9A9]', 'from-[#F6B643]'];
            @endphp
            @forelse($teachers as $teacher)
                <article class="group relative rounded-3xl bg-white/90 backdrop-blur-sm border-2 border-[#FEDA60]/40 p-6 space-y-4 shadow-lg hover:shadow-2xl hover:shadow-[#FEDA60]/30 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
                    <a href="{{ route('teacher.show', $teacher) }}" class="absolute inset-0 z-10"></a>
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r {{ $colors[$loop->index % 4] }} to-[#FEDA60] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    @if($teacher->photo)
                        <div class="relative w-16 h-16 rounded-2xl overflow-hidden shadow-lg mx-auto transform group-hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br {{ $colors[$loop->index % 4] }} to-[#F3B94A] flex items-center justify-center shadow-lg mx-auto transform group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="text-center space-y-2">
                        <p class="text-lg font-bold text-[#2E2E2E]">{{ $teacher->name }}</p>
                        <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08] font-semibold">{{ $teacher->position }}</p>
                        @if($teacher->specialization)
                            <p class="text-xs text-[#FEDA60] font-medium">{{ $teacher->specialization }}</p>
                        @endif
                        <div class="pt-2 border-t border-[#FEDA60]/30">
                            <p class="text-sm text-[#4F4F4F] leading-relaxed">{{ Str::limit($teacher->bio, 100) }}</p>
                        </div>
                    </div>
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full bg-[#FFF0C2] text-[#8C6A08] text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        10+ Tahun
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-[#4F4F4F]">Belum ada data pengajar.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

