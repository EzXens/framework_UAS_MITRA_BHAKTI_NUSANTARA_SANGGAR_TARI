@extends('layouts.app')

@section('content')
    <section class="bg-linear-to-b from-white via-[#FFF9E5] to-[#FFF6D5] text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-14 space-y-12">
            @include('components.ui.section-heading', [
                'subtitle' => 'Produk',
                'title' => 'Koleksi Pilihan Bhakti Nusantara',
                'description' => 'Eksplorasi paket pentas, kostum, serta materi pembelajaran terkurasi untuk mendukung pengalaman seni tari yang lebih berkesan.'
            ])
            <div class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3">
                @forelse ($products as $product)
                    <article class="flex flex-col h-full overflow-hidden rounded-[28px] border border-[#FEDA60]/30 bg-white shadow-lg shadow-[#FEDA60]/10 hover:shadow-xl hover:shadow-[#FEDA60]/20 transition-all hover:scale-[1.02]">
                        @if($product->image)
                            <div class="h-56 w-full overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-56 w-full flex-shrink-0 bg-gradient-to-br from-[#FFE184] via-[#FEDA60] to-[#F5B347] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-white/50">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex flex-col flex-grow p-6 bg-white text-[#2E2E2E]">
                            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                            <p class="text-sm leading-relaxed text-[#4F4F4F] line-clamp-3 mt-2 flex-grow">{{ $product->description }}</p>
                            <div class="flex items-center justify-between pt-4 mt-4 border-t border-[#FEDA60]/30">
                                {{-- <span class="text-2xl font-bold text-[#8C6A08]">Rp {{ number_format($product->price, 0, ',', '.') }}</span> --}}
                                <span class="text-sm text-[#4F4F4F]">Stok: <strong>{{ $product->stock }}</strong></span>
                            </div>
                            <a href="mailto:info@bhaktinusantara.id?subject=Inquiry about {{ $product->name }}" class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-[#2E2E2E] bg-gradient-to-r from-[#FEDA60] to-[#F5B347] px-6 py-3 rounded-xl shadow-lg shadow-[#FEDA60]/30 hover:shadow-xl hover:scale-[1.02] transition-all mt-4">
                                Hubungi Kami
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0-6.75 6.75M19.5 12l-6.75-6.75" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-[#4F4F4F] text-lg">Belum ada produk yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            @if($products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection
