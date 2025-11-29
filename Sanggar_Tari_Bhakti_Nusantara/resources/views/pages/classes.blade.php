@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-b from-white via-[#FFF9E5] to-[#FFF6D5] py-16 lg:py-14">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        @include('components.ui.section-heading', [
            'subtitle' => 'Kelas Tari',
            'title' => 'Pilih Kelas Tari yang Sesuai Untukmu',
            'description' => 'Bergabunglah dengan kelas tari kami dan kembangkan bakat menari Anda bersama instruktur profesional.'
        ])

        @if (session('success'))
            <div class="rounded-2xl bg-green-50 border border-green-200 p-4">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl bg-red-50 border border-red-200 p-4">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid gap-8 lg:grid-cols-3 md:grid-cols-2">
            @forelse ($classes as $class)
                <article class="flex flex-col h-full rounded-[28px] bg-white border border-[#E2B136]/30 overflow-hidden shadow-lg shadow-[#FEDA60]/10 hover:shadow-xl hover:shadow-[#FEDA60]/20 transition-all hover:scale-[1.02]">
                    @if($class->image)
                        <div class="h-56 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $class->image) }}" alt="{{ $class->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-56 flex-shrink-0 bg-gradient-to-br from-[#FFE184] via-[#FEDA60] to-[#F5B347] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-white/50">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                        </div>
                    @endif
                    
                    <div class="flex flex-col flex-grow p-6">
                        <div class="space-y-2">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">{{ $class->name }}</h3>
                            <p class="text-sm text-[#4F4F4F] leading-relaxed line-clamp-3">{{ $class->description }}</p>
                        </div>

                        <div class="space-y-2 pt-4 mt-4 border-t border-[#FEDA60]/30 flex-grow">
                            <div class="flex items-center gap-2 text-sm text-[#4F4F4F]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FEDA60] flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span><strong>Instruktur:</strong> {{ $class->instructor }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-[#4F4F4F]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FEDA60] flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span><strong>Jadwal:</strong> {{ $class->schedule }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-[#4F4F4F]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FEDA60] flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                <span><strong>Kapasitas:</strong> {{ $class->capacity }} orang</span>
                            </div>

                            <div class="flex items-center justify-between pt-3">
                                <span class="text-2xl font-bold text-[#8C6A08]">Rp {{ number_format($class->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            @auth
                                @if(in_array($class->id, $enrolledClassIds))
                                    <button disabled class="w-full py-3 px-4 rounded-xl bg-gray-300 text-gray-500 font-semibold cursor-not-allowed">
                                        Sudah Terdaftar
                                    </button>
                                @else
                                    <form action="{{ route('classes.enroll', $class) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold shadow-lg shadow-[#FEDA60]/30 hover:shadow-xl hover:shadow-[#FEDA60]/40 hover:scale-[1.02] transition-all cursor-pointer">
                                            Daftar Kelas
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold text-center shadow-lg shadow-[#FEDA60]/30 hover:shadow-xl hover:shadow-[#FEDA60]/40 hover:scale-[1.02] transition-all cursor-pointer">
                                    Login untuk Daftar Kelas
                                </a>
                            @endauth
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-[#4F4F4F] text-lg">Belum ada kelas yang tersedia.</p>
                </div>
            @endforelse
        </div>

        <!-- Instructor Contact Section -->
        <div class="mt-16 rounded-3xl bg-gradient-to-br from-[#2E2E2E] via-[#1a1a1a] to-[#2E2E2E] p-8 lg:p-12 border border-[#FEDA60]/20 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#FEDA60]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#F5B347]/10 rounded-full blur-3xl"></div>
            
            <div class="relative">
                <div class="text-center mb-8">
                    <span class="inline-flex px-4 py-1 rounded-full bg-[#FEDA60]/20 border border-[#FEDA60]/40 text-[#FEDA60] text-xs font-semibold uppercase tracking-[0.2em]">
                        Hubungi Instruktur
                    </span>
                    <h3 class="text-2xl lg:text-3xl font-bold text-[#FEDA60] mt-4">Ada Pertanyaan Tentang Kelas?</h3>
                    <p class="text-gray-300 mt-2 max-w-2xl mx-auto">Hubungi tim instruktur kami untuk konsultasi gratis mengenai kelas yang sesuai dengan kebutuhan Anda.</p>
                </div>
                
                <div class="grid gap-6 md:grid-cols-3">
                    <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center gap-4 p-5 rounded-2xl bg-white/5 border border-[#FEDA60]/20 hover:bg-white/10 transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-green-400">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">WhatsApp</p>
                            <p class="text-[#FEDA60] font-semibold group-hover:text-white transition-colors">+62 812-3456-7890</p>
                        </div>
                    </a>
                    
                    <a href="mailto:instruktur@bhaktinusantara.id" class="flex items-center gap-4 p-5 rounded-2xl bg-white/5 border border-[#FEDA60]/20 hover:bg-white/10 transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Email</p>
                            <p class="text-[#FEDA60] font-semibold group-hover:text-white transition-colors">instruktur@bhaktinusantara.id</p>
                        </div>
                    </a>
                    
                    <a href="https://instagram.com/bhaktinusantara" target="_blank" class="flex items-center gap-4 p-5 rounded-2xl bg-white/5 border border-[#FEDA60]/20 hover:bg-white/10 transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-pink-500/20 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-pink-400">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Instagram</p>
                            <p class="text-[#FEDA60] font-semibold group-hover:text-white transition-colors">@bhaktinusantara</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8">
            {{ $classes->links() }}
        </div>
    </div>
</section>
@endsection
