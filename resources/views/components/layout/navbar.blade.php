@php
    $menu = [
        ['label' => 'Beranda', 'route' => 'home'],
        ['label' => 'Tentang', 'route' => 'about'],
        ['label' => 'Produk', 'route' => 'products'],
        ['label' => 'Galeri', 'route' => 'gallery'],
    ];
@endphp

<header class="bg-[#2E2E2E] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Bhakti Nusantara" class="h-12 w-12 object-contain">
            <span class="text-lg font-semibold tracking-wide">Bhakti Nusantara</span>
        </a>
        <button id="nav-toggle" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#FEDA60] text-[#2E2E2E]" aria-label="Toggle navigation" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <nav class="hidden lg:flex flex-col lg:flex-row items-start lg:items-center gap-6 lg:gap-10 font-medium text-sm">
            @foreach ($menu as $item)
                <a href="{{ route($item['route']) }}" class="relative transition hover:text-[#E2B136] {{ request()->routeIs($item['route']) ? 'text-[#ece9e1]' : 'text-[#E2B136]' }}">
                    {{ $item['label'] }}
                    @if (request()->routeIs($item['route']))
                        <span class="hidden lg:block absolute -bottom-1 inset-x-0 h-1 rounded-full bg-[#FEDA60]"></span>
                    @endif
                </a>
            @endforeach
            <a href="{{ route('login') }}" class="px-5 py-2 rounded-full bg-[#FEDA60] text-[#2E2E2E] text-sm shadow transition hover:bg-[#e2c24f]">Sign In</a>
        </nav>
    </div>
    <div class="hidden lg:hidden" id="nav-menu">
        <div class="px-6 pb-4 flex flex-col gap-4 text-sm font-medium text-[#2E2E2E] bg-white border-t border-[#F4DC88]">
            @foreach ($menu as $item)
                <a href="{{ route($item['route']) }}" class="py-1 border-b border-[#F4DC88] {{ request()->routeIs($item['route']) ? 'text-[#E2B136]' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-full bg-[#FEDA60] text-[#2E2E2E] text-center text-sm transition hover:bg-[#e2c24f]">Sign In</a>
        </div>
    </div>
</header>
