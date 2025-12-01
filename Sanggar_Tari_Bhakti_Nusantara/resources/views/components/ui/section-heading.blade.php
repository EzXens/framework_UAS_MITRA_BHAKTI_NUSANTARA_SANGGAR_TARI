<!-- pass argumen ['dark' ==> true, ... ] di include kalau mau teks nya gelap 
     kalau mau putih ndak usah di pass. -->
@php
    $isDark = $dark ?? false; 
    $descWhite = $descWhite ?? false;
@endphp
<div class="space-y-3 text-center">
    <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full {{ $isDark ? 'bg-[#FEDA60]/20 border border-[#FEDA60]/40 text-[#FEDA60]' : 'bg-[#FFF3B8] text-[#8C6A08]' }} text-xs font-semibold uppercase tracking-[0.2em]">
        {{ $subtitle ?? 'Bhakti Nusantara' }}
    </span>
    <h2 class="text-2xl lg:text-4xl font-semibold {{ $isDark ? 'text-white' : 'text-[#2E2E2E]' }} leading-snug">
        {{ $title }}
    </h2>
    @isset($description)
        <p class="text-sm lg:text-base {{ $descWhite ? 'text-white' : ($isDark ? 'text-gray-300' : 'text-[#4F4F4F]') }} leading-relaxed max-w-2xl mx-auto">
            {{ $description }}
        </p>
    @endisset
</div>
