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
                <article class="rounded-[28px] bg-white border border-[#E2B136]/30 overflow-hidden shadow-lg shadow-[#FEDA60]/10 hover:shadow-xl hover:shadow-[#FEDA60]/20 transition-all hover:scale-[1.02]">
                    @if($class->image)
                        <div class="h-56 overflow-hidden">
                            <img src="{{ asset('storage/' . $class->image) }}" alt="{{ $class->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-56 bg-gradient-to-br from-[#FFE184] via-[#FEDA60] to-[#F5B347] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-white/50">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-6 space-y-4">
                        <div class="space-y-2">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">{{ $class->name }}</h3>
                            <p class="text-sm text-[#4F4F4F] leading-relaxed line-clamp-3">{{ $class->description }}</p>
                        </div>

                        <div class="space-y-2 pt-2 border-t border-[#FEDA60]/30">
                            <div class="flex items-center gap-2 text-sm text-[#4F4F4F]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FEDA60]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span><strong>Instruktur:</strong> {{ $class->instructor }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-[#4F4F4F]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FEDA60]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span><strong>Jadwal:</strong> {{ $class->schedule }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-[#4F4F4F]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#FEDA60]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                <span><strong>Kapasitas:</strong> {{ $class->capacity }} orang</span>
                            </div>

                            <div class="flex items-center justify-between pt-3">
                                <span class="text-2xl font-bold text-[#8C6A08]">Rp {{ number_format($class->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @auth
                            @if(in_array($class->id, $enrolledClassIds))
                                <button disabled class="w-full py-3 px-4 rounded-xl bg-gray-300 text-gray-500 font-semibold cursor-not-allowed">
                                    Sudah Terdaftar
                                </button>
                            @else
                                <form action="{{ route('classes.enroll', $class) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold shadow-lg shadow-[#FEDA60]/30 hover:shadow-xl hover:shadow-[#FEDA60]/40 hover:scale-[1.02] transition-all">
                                        Daftar Kelas
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold text-center shadow-lg shadow-[#FEDA60]/30 hover:shadow-xl hover:shadow-[#FEDA60]/40 hover:scale-[1.02] transition-all">
                                Login untuk Daftar Kelas
                            </a>
                        @endauth
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-[#4F4F4F] text-lg">Belum ada kelas yang tersedia.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $classes->links() }}
        </div>
    </div>
</section>
@endsection
