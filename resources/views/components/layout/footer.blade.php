<footer class="bg-[#F4F5EF]  text-[#E2B136]">
    <div class="max-w-7xl mx-auto px-6 py-8 grid gap-10 lg:grid-cols-4">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Bhakti Nusantara" class="h-12 w-12 object-contain">
                <span class="text-lg font-semibold">Bhakti Nusantara</span>
            </div>
            <p class="text-sm leading-relaxed text-[#2E2E2E]">
                Sanggar tari Bhakti Nusantara menghadirkan pelestarian budaya melalui pelatihan intensif, pertunjukan berkualitas, dan komunitas kreatif bagi generasi muda.
            </p>
        </div>
        <div class="space-y-3">
            <h3 class="text-base font-semibold">Navigasi</h3>
            <ul class="space-y-2 text-sm text-[#2E2E2E]">
                <li><a href="{{ route('home') }}" class="hover:text-[#FEDA60]">Beranda</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-[#FEDA60]">Tentang</a></li>
                <li><a href="{{ route('products') }}" class="hover:text-[#FEDA60]">Produk</a></li>
                <li><a href="{{ route('gallery') }}" class="hover:text-[#FEDA60]">Galeri</a></li>
            </ul>
        </div>
        <div class="space-y-3">
            <h3 class="text-base font-semibold">Kontak</h3>
            <ul class="space-y-2 text-sm text-[#2E2E2E]" id="kontak">
                <li>Jl. Budaya No. 18, Kota Bandung</li>
                <li>+62 812-3456-7890</li>
                <li>info@bhaktinusantara.id</li>
            </ul>
        </div>
        <div class="space-y-3">
            <h3 class="text-base font-semibold">Ikuti Kami</h3>
            <div class="flex gap-3">
                @foreach (['instagram', 'youtube', 'facebook'] as $social)
                    <a href="#" class="w-10 h-10 grid place-items-center rounded-full bg-white/10 hover:bg-[#FEDA60] hover:text-[#2E2E2E] transition" aria-label="{{ ucfirst($social) }} Bhakti Nusantara">
                        <span class="capitalize text-sm">{{ substr($social, 0, 2) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 pb-4 text-center text-xs text-black/60">
        © {{ date('Y') }} Bhakti Nusantara. Seluruh hak cipta dilindungi.
    </div>
</footer>
