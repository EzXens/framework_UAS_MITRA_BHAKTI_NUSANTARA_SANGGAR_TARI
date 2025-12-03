<footer class="bg-[#2E2E2E] text-white">
    <div class="max-w-7xl mx-auto px-8 py-12 grid gap-10 lg:grid-cols-12">
        <div class="lg:col-span-3 space-y-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Bhakti Nusantara" class="h-12 w-12 object-contain drop-shadow-lg">
                <span class="text-lg font-semibold text-[#FEDA60]">Bhakti Nusantara</span>
            </div>
            <p class="text-sm leading-relaxed text-gray-300">
                Sanggar tari Bhakti Nusantara menghadirkan pelestarian budaya melalui pelatihan intensif, pertunjukan berkualitas, dan komunitas kreatif bagi generasi muda.
            </p>
        </div>
        <div class="lg:col-span-2 space-y-3">
            <h3 class="text-base font-semibold text-[#FEDA60]">Navigasi</h3>
            <ul class="space-y-2 text-sm text-gray-300">
                <li><a href="{{ route('home') }}" class="hover:text-[#FEDA60] transition-colors">Beranda</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-[#FEDA60] transition-colors">Tentang</a></li>
                <li><a href="{{ route('products') }}" class="hover:text-[#FEDA60] transition-colors">Produk</a></li>
                <li><a href="{{ route('classes.public') }}" class="hover:text-[#FEDA60] transition-colors">Kelas</a></li>
                <li><a href="{{ route('gallery') }}" class="hover:text-[#FEDA60] transition-colors">Galeri</a></li>
            </ul>
        </div>
        <div class="lg:col-span-3 space-y-3">
            <h3 class="text-base font-semibold text-[#FEDA60]">Kontak</h3>
            <ul class="space-y-2 text-sm text-gray-300" id="kontak">
                <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-[#FEDA60] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <!-- reminder: sesuaikan sama alamat euy, lupa alamat mitra dimana -->
                    <span>Jl. PM. Noor Perum Bumi Sempaja Blok AB No.17 RT.001 Kec. Samarinda Utara Samarinda Kalimantan Timur </span> 
                </li>
                <li class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#FEDA60] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>+62 812-3456-7890</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#FEDA60] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>info@bhaktinusantara.id</span>
                </li>
            </ul>
            <div class="pt-2">
                <h4 class="text-sm font-semibold text-[#FEDA60] mb-3">Ikuti Kami</h4>
                <div class="flex gap-3">
                    @foreach ([['name' => 'Instagram', 'icon' => 'M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z'], ['name' => 'YouTube', 'icon' => 'M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z'], ['name' => 'Facebook', 'icon' => 'M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647z']] as $social)
                        <a href="#" class="w-10 h-10 grid place-items-center rounded-full bg-white/10 hover:bg-[#FEDA60] hover:text-[#2E2E2E] transition-all" aria-label="{{ $social['name'] }} Bhakti Nusantara">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $social['icon'] }}"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="lg:col-span-4 space-y-3">
            <h3 class="text-base font-semibold text-[#FEDA60]">Lokasi Kami</h3>
            <div class="rounded-2xl overflow-hidden border border-[#FEDA60]/20 shadow-lg h-64">
                <!-- reminder: sesuaikan sama alamat euy, lupa alamat mitra dimana -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249.35596618350016!2d117.16697866561252!3d-0.44964516427457385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67898ceb57753%3A0x75cb9190cbb6058b!2sBlk.%20AH%20No.6%2C%20Sempaja%20Sel.%2C%20Kec.%20Samarinda%20Utara%2C%20Kota%20Samarinda%2C%20Kalimantan%20Timur%2075242!5e0!3m2!1sid!2sid!4v1764147841206!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-6 text-center text-sm text-gray-400">
        <p>© {{ date('Y') }} <span class="text-[#FEDA60] font-semibold">Bhakti Nusantara</span>. Seluruh hak cipta dilindungi.</p>
    </div>
</footer>
