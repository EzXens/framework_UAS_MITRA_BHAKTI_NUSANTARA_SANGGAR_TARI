@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen relative" style="background-image: url('{{ asset('images/bg2.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <!-- Black overlay -->
    <div class="absolute inset-0 bg-black/50"></div>
    
    <div class="relative flex">
        <!-- sidebar -->
        <aside id="sidebar" class="fixed lg:sticky top-0 left-0 h-screen w-64 bg-[#2E2E2E] text-white transition-transform duration-300 z-40 lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full">
                <!-- logo -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                        <span class="text-lg font-semibold text-[#FEDA60]">Dashboard</span>
                    </div>
                </div>

                <!-- nav -->
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="#overview" onclick="showSection('overview')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm active">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Beranda
                    </a>
                    <a href="#schedule" onclick="showSection('schedule')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Jadwal Saya
                    </a>
                    <a href="#classes" onclick="showSection('classes')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                        Kelas Saya
                    </a>
                    <a href="#profile" onclick="showSection('profile')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        Profil Saya
                    </a>
                    <a href="#dispensation" onclick="showSection('dispensation')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        Dispensasi
                    </a>
                </nav>

                <div class="p-4 border-t border-white/10">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </aside>

        <!-- sidebar toggle (mobile) -->
        <button id="sidebar-toggle" class="fixed top-4 left-4 z-50 lg:hidden p-2 rounded-xl bg-[#2E2E2E] text-white shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <!-- overview (tanpa background foto) -->
            <section id="overview-section" class="dashboard-section min-h-screen -m-6 lg:-m-10 p-6 lg:p-10 bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5] relative z-10">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Selamat Datang, {{ $user->name }}!</h1>
                    <p class="text-[#4F4F4F] mt-2">Kelola kelas dan jadwal latihan tari Anda di sini.</p>
                </div>

                @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                    <div class="mb-6">
                        <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-4">
                            <h3 class="font-semibold text-[#2E2E2E] mb-2">Pemberitahuan Terbaru</h3>
                            <div class="space-y-2">
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                    @php $data = $notification->data; @endphp
                                    <div class="p-3 rounded-lg bg-[#FFF9E5] border border-[#FEDA60]/20">
                                        <p class="text-sm text-[#2E2E2E]"><strong>{{ $data['class_name'] ?? 'Kelas' }}</strong> — Status: <span class="font-semibold">{{ ucfirst($data['status'] ?? '') }}</span></p>
                                        @if(($data['status'] ?? '') === 'rejected' && !empty($data['notes']))
                                            <p class="text-sm text-red-600 mt-1">Alasan penolakan: {{ $data['notes'] }}</p>
                                        @endif
                                        <p class="text-xs text-gray-500 mt-1">Klik untuk melihat detail di riwayat notifikasi.</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid gap-6 md:grid-cols-3 mb-8">
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-xl bg-[#FEDA60]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#8C6A08]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-[#2E2E2E]">{{ $enrolledClasses->count() }}</p>
                            </div>

                        {{-- Admin: Aktivitas Terkini (persetujuan surat) --}}
                        @if(isset($pendingDispensations) && auth()->user()->role === 'admin')
                            <div class="mb-6">
                                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-4">
                                    <h3 class="font-semibold text-[#2E2E2E] mb-3">Aktivitas Terkini — Persetujuan Surat</h3>
                                    @if(count($pendingDispensations) > 0)
                                        <div class="space-y-3">
                                            @foreach($pendingDispensations as $pd)
                                                @php $pp = (array) $pd->payload; @endphp
                                                <div class="p-3 rounded-lg bg-[#FFF9E5] border border-[#FEDA60]/20 flex items-start justify-between">
                                                    <div>
                                                        <p class="text-sm text-[#2E2E2E]"><strong>{{ $pp['name'] ?? '—' }}</strong> — {{ ucfirst($pd->type) }}</p>
                                                        <p class="text-xs text-gray-600">Kegiatan: {{ $pp['event_name'] ?? '—' }} — {{ $pp['date_from'] ?? '—' }} @if(!empty($pp['date_to'])) sampai {{ $pp['date_to'] }} @endif</p>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <form method="POST" action="{{ route('admin.dispensations.approve', $pd->id) }}">
                                                            @csrf
                                                            <button type="submit" class="px-3 py-1 rounded-lg bg-green-500 text-white text-sm">Setuju</button>
                                                        </form>

                                                        <button class="px-3 py-1 rounded-lg bg-red-500 text-white text-sm" onclick="document.getElementById('reject-box-{{ $pd->id }}').classList.remove('hidden')">Tolak</button>
                                                    </div>
                                                </div>

                                                <form id="reject-box-{{ $pd->id }}" method="POST" action="{{ route('admin.dispensations.reject', $pd->id) }}" class="hidden mt-2">
                                                    @csrf
                                                    <div class="flex gap-2">
                                                        <input type="text" name="rejection_reason" placeholder="Alasan penolakan..." class="w-full rounded-md border-gray-200 p-2" required>
                                                        <button type="submit" class="px-3 py-1 rounded-lg bg-red-600 text-white">Kirim</button>
                                                        <button type="button" onclick="document.getElementById('reject-box-{{ $pd->id }}').classList.add('hidden')" class="px-3 py-1 rounded-lg bg-gray-200">Batal</button>
                                                    </div>
                                                </form>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500">Belum ada permintaan surat baru.</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-xl bg-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-[#2E2E2E]">{{ count($schedules) }}</p>
                                <p class="text-sm text-[#4F4F4F]">Jadwal Mingguan</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-xl bg-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-purple-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-[#2E2E2E]">{{ $enrolledClasses->unique('class.instructor')->count() }}</p>
                                <p class="text-sm text-[#4F4F4F]">Instruktur</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <h2 class="text-xl font-bold text-[#2E2E2E] mb-4">Jadwal Terdekat</h2>
                    @if(count($schedules) > 0)
                        <div class="space-y-3">
                            @foreach(array_slice($schedules, 0, 3) as $schedule)
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5] border border-[#FEDA60]/20">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-[#2E2E2E]">{{ $schedule['class_name'] }}</p>
                                        <p class="text-sm text-[#4F4F4F] flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $schedule['schedule'] }}
                                        </p>
                                        <p class="text-xs text-[#8C6A08] mt-1 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                            Instruktur: {{ $schedule['instructor'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-[#4F4F4F] text-center py-8">Belum ada jadwal kelas.</p>
                    @endif
                </div>
            </section>

            <!-- jadwal section -->
            <section id="schedule-section" class="dashboard-section hidden">
                <div class="mb-8 bg-white p-6 rounded-2xl">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Jadwal Latihan</h1>
                    <p class="text-[#4F4F4F] mt-2">Timeline jadwal kelas tari yang Anda ikuti.</p>
                </div>

                @if(count($schedules) > 0)
                    <div class="space-y-6">
                        @php
                            $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                            $daySchedules = array_fill_keys($daysOfWeek, []);
                            
                            foreach($schedules as $schedule) {
                                // Parse "Senin & Rabu, 16:00-18:00"
                                $parts = explode(',', $schedule['schedule']);
                                if (count($parts) >= 2) {
                                    $days = explode('&', $parts[0]);
                                    $time = trim($parts[1]);
                                    
                                    foreach ($days as $day) {
                                        $day = trim($day);
                                        if (in_array($day, $daysOfWeek)) {
                                            $daySchedules[$day][] = [
                                                'class_name' => $schedule['class_name'],
                                                'time' => $time,
                                                'instructor' => $schedule['instructor']
                                            ];
                                        }
                                    }
                                }
                            }
                        @endphp

                        @foreach($daysOfWeek as $day)
                            <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-[#2E2E2E] mb-4 flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-[#FEDA60]"></div>
                                    {{ $day }}
                                </h3>
                                @if(count($daySchedules[$day]) > 0)
                                    <div class="space-y-3 ml-5 border-l-2 border-[#FEDA60]/30 pl-6">
                                        @foreach($daySchedules[$day] as $item)
                                            <div class="relative">
                                                <div class="absolute -left-[29px] top-3 w-4 h-4 rounded-full bg-[#FEDA60] border-4 border-white"></div>
                                                <div class="p-4 rounded-xl bg-[#FFF9E5] border border-[#FEDA60]/20">
                                                    <p class="font-semibold text-[#2E2E2E]">{{ $item['class_name'] }}</p>
                                                    <p class="text-sm text-[#4F4F4F] mt-1 flex items-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $item['time'] }}
                                                    </p>
                                                    <p class="text-sm text-[#8C6A08] mt-1 flex items-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                        </svg>
                                                        {{ $item['instructor'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-[#4F4F4F] text-sm ml-5 pl-6">Tidak ada jadwal</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-12 shadow-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 mx-auto mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <p class="text-[#4F4F4F] text-lg">Belum ada jadwal kelas.</p>
                        <a href="{{ route('classes.public') }}" class="inline-block mt-4 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold">Daftar Kelas</a>
                    </div>
                @endif
            </section>

            <!-- class section -->
            <section id="classes-section" class="dashboard-section hidden">
                <div class="mb-8 bg-white p-6 rounded-2xl">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Kelas Saya</h1>
                    <p class="text-[#4F4F4F] mt-2">Daftar kelas tari yang sedang Anda ikuti.</p>
                </div>

                @if($enrolledClasses->count() > 0)
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($enrolledClasses as $enrollment)
                            @if($enrollment->class)
                                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 overflow-hidden shadow-lg hover:shadow-xl transition-all">
                                    @if($enrollment->class->image)
                                        <div class="h-48 overflow-hidden">
                                            <img src="{{ asset('storage/' . $enrollment->class->image) }}" alt="{{ $enrollment->class->name }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="h-48 bg-gradient-to-br from-[#FFE184] via-[#FEDA60] to-[#F5B347] flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-white/50">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="p-6">
                                        <h3 class="text-lg font-bold text-[#2E2E2E] mb-3">{{ $enrollment->class->name }}</h3>
                                        <p class="text-sm text-[#4F4F4F] mb-4 line-clamp-2">{{ $enrollment->class->description }}</p>
                                        <div class="space-y-2 text-sm">
                                            <p class="text-[#4F4F4F] flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                </svg>
                                                {{ $enrollment->class->instructor }}
                                            </p>
                                            <p class="text-[#4F4F4F] flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                </svg>
                                                {{ $enrollment->class->schedule }}
                                            </p>
                                            {{-- price removed from enrolled class card --}}
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-[#FEDA60]/20">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Terdaftar
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-12 shadow-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 mx-auto mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                        <p class="text-[#4F4F4F] text-lg">Anda belum mendaftar kelas apapun.</p>
                        <a href="{{ route('classes.public') }}" class="inline-block mt-4 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold">Jelajahi Kelas</a>
                    </div>
                @endif
            </section>

            <!-- profile -->
            <section id="profile-section" class="dashboard-section hidden">
                <div class="mb-8 bg-white p-6 rounded-2xl">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Profil Saya</h1>
                    <p class="text-[#4F4F4F] mt-2">Informasi lengkap akun Anda.</p>
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-1">
                        <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-8 shadow-lg text-center">
                            @if($user->profile_picture)
                                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-32 h-32 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center text-white text-4xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                            <h2 class="text-xl font-bold text-[#2E2E2E]">{{ $user->name }}</h2>
                            <p class="text-sm text-[#4F4F4F] mt-1">{{ ucfirst($user->role) }}</p>
                            <p class="text-sm text-[#8C6A08] mt-2">{{ $user->email }}</p>
                            
                            <!-- upload pp -->
                            <form action="{{ route('user.updateProfilePicture') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                                @csrf
                                <label for="profile_picture" class="block w-full cursor-pointer px-4 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold text-sm hover:shadow-lg transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                    Ganti Foto Profil
                                </label>
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden" onchange="this.form.submit()">
                            </form>
                            
                            @if(session('success'))
                                <p class="mt-3 text-sm text-green-600">{{ session('success') }}</p>
                            @endif
                            @error('profile_picture')
                                <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-8 shadow-lg">
                            <h3 class="text-xl font-bold text-[#2E2E2E] mb-6">Informasi Akun</h3>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Nama Lengkap</p>
                                        <p class="font-semibold text-[#2E2E2E]">{{ $user->name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Email</p>
                                        <p class="font-semibold text-[#2E2E2E]">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Status Akun</p>
                                        <p class="font-semibold text-green-600">Aktif</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Bergabung Sejak</p>
                                        <p class="font-semibold text-[#2E2E2E]">{{ $user->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- dispensation section -->
            <section  id="dispensation-section" class="dashboard-section hidden">
                <div class="mb-8 bg-white p-6 rounded-2xl">
                        <h1 class="text-3xl font-bold text-[#2E2E2E]">Dispensasi Saya</h1>
                        <p class="text-[#4F4F4F] mt-2">Buat Surat Dispensasi Anda.</p>
                    </div> 
                @if(session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
                @endif

                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <form id="dispensation-form" action="{{ route('dispensations.store') }}" method="POST">
                        @csrf

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Pilih Jenis Surat</label>
                                <select id="disp-type" name="type"
                                    class="w-full rounded-md border-gray-200 p-2 text-black" required>
                                    <option value="mahasiswa">Surat Dispensasi - Mahasiswa (Kuliah)</option>
                                    <option value="siswa">Surat Dispensasi - Siswa (Sekolah)</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-600">Isilah formulir sesuai tipe yang dipilih. Semua teks input berwarna hitam.</p>
                            </div>

                            <!-- FORM MAHASISWA -->
                            <div id="form-mahasiswa" class="type-form">
                                <label class="block text-sm font-semibold text-black mb-1">Nama Mahasiswa</label>
                                <input type="text" name="name" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g,'')" maxlength="100">

                                <label class="block text-sm font-semibold text-black mb-1">NIM Mahasiswa</label>
                                <input type="text" name="id_number" inputmode="numeric" pattern="\d*" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required oninput="this.value = this.value.replace(/\D/g,'')" maxlength="20">

                                <label class="block text-sm font-semibold text-black mb-1">Prodi</label>
                                <input type="text" name="program" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g,'')" maxlength="100">

                                <label class="block text-sm font-semibold text-black mb-1">Instansi</label>
                                <input type="text" name="school_or_program" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g,'')" maxlength="150">

                                <label class="block text-sm font-semibold text-black mb-1">Nama Kegiatan</label>
                                <input type="text" name="event_name" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s]/g,'')" maxlength="150">

                                <label class="block text-sm font-semibold text-black mb-1">Hari</label>
                                <select name="day" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>

                                <div class="grid gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-semibold text-black mb-1">Jumlah Hari Dispensasi</label>
                                        <select class="w-full rounded-md border-gray-200 bg-black/10 p-2 text-black date-type" aria-controls="mahasiswa-dates">
                                            <option value="single">1 hari</option>
                                            <option value="range">Lebih dari 1 hari</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-black mb-1">Dari Tanggal</label>
                                        <input type="date" name="date_from" class="mhs-input w-full rounded-md border-gray-200 bg-black/30 p-2 text-black mb-3" required>
                                    </div>
                                    <div id="mahasiswa-dates" class="md:col-span-2 hidden">
                                        <label class="block text-sm font-semibold text-black mb-1">Sampai Tanggal</label>
                                        <input type="date" name="date_to" class="mhs-input w-full rounded-md border-gray-200 bg-black/30 p-2 text-black mb-3">
                                    </div>
                                </div>

                                <label class="block text-sm font-semibold text-black mb-1">Waktu</label>
                                <div class="flex items-center gap-2 mb-3">
                                <input type="text" id="hour_mhs" maxlength="2" placeholder="Jam"
                                    class="mhs-input w-20 rounded-md border-gray-200 bg-black/10 p-2 text-black text-center">

                                <span class="text-lg font-bold text-black">:</span>

                                <input type="text" id="minute_mhs" maxlength="2" placeholder="Menit"
                                    class="mhs-input w-20 rounded-md border-gray-200 bg-black/10 p-2 text-black text-center">
                            </div>

                            <input type="hidden" name="time" id="time_mhs">

                                
                                <label class="block text-sm font-semibold text-black mb-1">Tempat</label>
                                <input type="text" name="place" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3">

                                <label class="block text-sm font-semibold text-black mb-1">Kota / Provinsi</label>
                                <input type="text" name="city_province" class="mhs-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g,'')" maxlength="150">
                            </div>

                            <!-- FORM SISWA -->
                            <div id="form-siswa" class="type-form hidden">
                                <label class="block text-sm font-semibold text-black mb-1">Nama Siswa</label>
                                <input type="text" name="name_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g,'')" maxlength="100">

                                <label class="block text-sm font-semibold text-black mb-1">NIS Siswa</label>
                                <input type="text" name="id_number_siswa" inputmode="numeric" pattern="\d*" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required oninput="this.value = this.value.replace(/\D/g,'')" maxlength="20">

                                <label class="block text-sm font-semibold text-black mb-1">Kelas</label>
                                <input type="text" name="student_class" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required >

                                <label class="block text-sm font-semibold text-black mb-1">Nama Sekolah</label>
                                <input type="text" name="school_or_program_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required>

                                <label class="block text-sm font-semibold text-black mb-1">Nama Kegiatan</label>
                                <input type="text" name="event_name_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s]/g,'')" maxlength="150">

                                <label class="block text-sm font-semibold text-black mb-1">Hari</label>
                                <select name="day_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>

                                <div class="grid gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-semibold text-black mb-1">Tipe Tanggal</label>
                                        <select class="w-full rounded-md border-gray-200 bg-black/10 p-2 text-black date-type" aria-controls="siswa-dates">
                                            <option value="single">1 hari</option>
                                            <option value="range">Lebih dari 1 hari</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-black mb-1">Dari Tanggal</label>
                                        <input type="date" name="date_from_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" required>
                                    </div>
                                    <div id="siswa-dates" class="md:col-span-2 hidden">
                                        <label class="block text-sm font-semibold text-black mb-1">Sampai Tanggal</label>
                                        <input type="date" name="date_to_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3">
                                    </div>
                                </div>

                                 <label class="block text-sm font-semibold text-black mb-1">Waktu</label>
                                <div class="flex items-center gap-2 mb-3">
                                <input type="text" id="hour_siswa" maxlength="2" placeholder="Jam"
                                    class="siswa-input w-20 rounded-md border-gray-200 bg-black/10 p-2 text-black text-center">

                                <span class="text-lg font-bold text-black">:</span>

                                <input type="text" id="minute_siswa" maxlength="2" placeholder="Menit"
                                    class="siswa-input w-20 rounded-md border-gray-200 bg-black/10 p-2 text-black text-center">
                            </div>
                            <input type="hidden" name="time_siswa" id="time_siswa">

                                <label class="block text-sm font-semibold text-black mb-1">Tempat</label>
                                <input type="text" name="place_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3">

                                <label class="block text-sm font-semibold text-black mb-1">Kota / Provinsi</label>
                                <input type="text" name="city_province_siswa" class="siswa-input w-full rounded-md border-gray-200 bg-black/10 p-2 text-black mb-3" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g,'')" maxlength="150">
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <button type="button" onclick="openConfirmSubmitModal()" class="px-6 py-2 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold cursor-pointer">
                                Kirim Permohonan
                            </button>
                        </div>
                    </form>
                </div>
                
                <script>
                    function toggleForm() {
                        const type = document.getElementById("disp-type").value;

                        document.getElementById("form-mahasiswa").classList.add("hidden");
                        document.getElementById("form-siswa").classList.add("hidden");

                        document.querySelectorAll(".mhs-input").forEach(el => el.disabled = true);
                        document.querySelectorAll(".siswa-input").forEach(el => el.disabled = true);

                        if (type === "mahasiswa") {
                            document.getElementById("form-mahasiswa").classList.remove("hidden");
                            document.querySelectorAll(".mhs-input").forEach(el => el.disabled = false);
                        } else {
                            document.getElementById("form-siswa").classList.remove("hidden");
                            document.querySelectorAll(".siswa-input").forEach(el => el.disabled = false);
                        }
                    }

                    document.getElementById("disp-type").addEventListener("change", toggleForm);

                    // run once on load
                    toggleForm();
                </script>

                <div class="mt-6 rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <h3 class="text-lg font-semibold text-[#2E2E2E] mb-4">Daftar Pengajuan Dispensasi Saya</h3>
                    @if(isset($dispensations) && $dispensations->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 w-full text-sm">
                                <thead>
                                    <tr class="text-left text-black">
                                        <th class="px-3 py-2">#</th>
                                        <th class="px-3 py-2">Tipe</th>
                                        <th class="px-3 py-2">Nama</th>
                                        <th class="px-3 py-2">Diajukan</th>
                                        <th class="px-3 py-2">Status</th>
                                        <th class="px-3 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($dispensations as $d)
                                        @php $p = (array) $d->payload; @endphp
                                        <tr class="text-black">
                                            <td class="px-3 py-2">{{ $d->id }}</td>
                                            <td class="px-3 py-2">{{ ucfirst($d->type) }}</td>
                                            <td class="px-3 py-2">{{ $p['name'] ?? '—' }}</td>
                                            <td class="px-3 py-2">{{ $d->created_at->format('d M Y H:i') }}</td>
                                            <td class="px-3 py-2">
                                                @if($d->status === 'pending')
                                                    <span class="inline-block px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                                @elseif($d->status === 'approved')
                                                    <span class="inline-block px-2 py-1 rounded-full bg-green-100 text-green-800">Approved</span>
                                                @else
                                                    <span class="inline-block px-2 py-1 rounded-full bg-red-100 text-red-800">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-2 flex flex-wrap gap-2">
                                                @if($d->status === 'approved')
                                                      {{-- Tombol LIHAT hanya membuka PDF --}}
                                                @if($d->pdf)
                                                    <a href="{{ Storage::url($d->pdf) }}" 
                                                    target="_blank" 
                                                    class="px-3 py-1 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700">
                                                    Lihat
                                                    </a>
                                                    
                                                    <a href="{{ Storage::url($d->pdf) }}" 
                                                    download 
                                                    class="px-3 py-1 rounded-lg bg-green-600 text-white text-sm hover:bg-green-700">
                                                    Download PDF
                                                    </a>
                                                @else
                                                    <p class="text-sm text-yellow-600">⚠️ PDF belum tersedia. Hubungi admin.</p>
                                                @endif

                                                {{-- ini yang word --}}
                                                    {{-- @if($d->template)
                                                        <button type="button" onclick="viewDocxPreview('{{ Storage::url($d->template) }}', {{ $d->id }})" class="px-3 py-1 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700">Lihat</button>
                                                        <a href="{{ Storage::url($d->template) }}" download class="px-3 py-1 rounded-lg bg-indigo-600 text-white text-sm hover:bg-indigo-700">DOCX</a>
                                                    @endif
                                                    @if($d->pdf)
                                                        <a href="{{ Storage::url($d->pdf) }}" target="_blank" class="px-3 py-1 rounded-lg bg-green-600 text-white text-sm hover:bg-green-700">Cetak PDF</a>
                                                        <a href="{{ Storage::url($d->pdf) }}" download class="px-3 py-1 rounded-lg bg-teal-600 text-white text-sm hover:bg-teal-700">Download PDF</a>
                                                    @endif --}}

                                                @elseif($d->status === 'rejected')
                                                    <p class="text-sm text-red-700">❌ {{ $d->rejection_reason ?? 'Ditolak' }}</p>
                                                @else
                                                    <p class="text-sm text-yellow-600">⏳ Menunggu...</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada pengajuan dispensasi.</p>
                    @endif
                </div>

                <script>
                    (function(){
                        const typeSelect = document.getElementById('disp-type');
                        const mahasiswa = document.getElementById('form-mahasiswa');
                        const siswa = document.getElementById('form-siswa');
                        const dateTypeSelectors = document.querySelectorAll('.date-type');

                        function showType(type){
                            if(type === 'mahasiswa'){
                                mahasiswa.classList.remove('hidden');
                                siswa.classList.add('hidden');
                            } else {
                                siswa.classList.remove('hidden');
                                mahasiswa.classList.add('hidden');
                            }
                        }

                        typeSelect.addEventListener('change', function(e){
                            showType(e.target.value);
                        });

                        dateTypeSelectors.forEach(function(sel){
                            sel.addEventListener('change', function(e){
                                const targetId = e.target.getAttribute('aria-controls');
                                const target = document.getElementById(targetId);
                                if(!target) return;
                                if(e.target.value === 'range'){
                                    target.classList.remove('hidden');
                                } else {
                                    // hide and clear any date inputs so stale values are not submitted
                                    target.classList.add('hidden');
                                    target.querySelectorAll('input[type="date"]').forEach(function(inp){ inp.value = ''; });
                                }
                            });
                        });

                        // init
                        showType(typeSelect.value);
                    })();
                </script>

                <!-- DOCX Preview Modal -->
                <!-- Confirm Submit Modal -->
                <div id="confirm-submit-modal" class="hidden fixed inset-0 bg-black/40 z-50 items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
                        <h3 class="text-lg font-bold mb-3 text-black">Konfirmasi Pengiriman Surat</h3>
                        <p id="confirm-submit-text" class="mb-4 text-black">Apakah Anda yakin ingin mengirim surat dispensasi? Setelah dikirim, surat akan menunggu persetujuan admin.</p>
                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeConfirmSubmitModal()" class="px-4 py-2 bg-[#FEDA60] text-black rounded">Batal</button>
                            <button type="button" id="confirm-submit-yes" class="px-4 py-2 bg-green-600 text-white rounded">Kirim</button>
                        </div>
                    </div>
                </div>
                <!-- Date error alert modal -->
                <div id="date-error-modal" class="hidden fixed inset-0 bg-black/40 z-50 items-center justify-center">
                    <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
                        <h3 class="text-lg font-bold mb-3 text-black">Kesalahan Tanggal</h3>
                        <p id="date-error-text" class="mb-4 text-black"></p>
                        <div class="flex justify-end">
                            <button type="button" id="date-error-ok" class="px-4 py-2 bg-[#FEDA60] text-black rounded">OK</button>
                        </div>
                    </div>
                </div>
                <script>
                    (function(){
                        const modal = document.getElementById('confirm-submit-modal');
                        const confirmBtn = document.getElementById('confirm-submit-yes');
                        const dateErrorModal = document.getElementById('date-error-modal');
                        const dateErrorText = document.getElementById('date-error-text');
                        const dateErrorOk = document.getElementById('date-error-ok');
                        let lastInvalidEl = null;

                                        window.openConfirmSubmitModal = function(){
                                            const frm = document.getElementById('dispensation-form');
                                            if(!frm) return;

                                            // Validate form first using HTML5 constraint validation API
                                            if(typeof frm.reportValidity === 'function'){
                                                const ok = frm.reportValidity();
                                                if(!ok){
                                                    // focus first invalid field if possible
                                                    try{
                                                        const invalid = frm.querySelector(':invalid');
                                                        if(invalid) invalid.focus();
                                                    }catch(e){}
                                                    return; // don't open modal when form invalid
                                                }
                                            }

                                            // Additional: validate logical date ranges when range selected
                                            function validateDateRanges(){
                                                const type = document.getElementById('disp-type') ? document.getElementById('disp-type').value : null;
                                                if(type === 'mahasiswa'){
                                                    const dtSel = document.querySelector('#form-mahasiswa .date-type');
                                                    if(dtSel && dtSel.value === 'range'){
                                                        const from = document.querySelector('#form-mahasiswa input[name="date_from"]')?.value || '';
                                                        const to = document.querySelector('#form-mahasiswa input[name="date_to"]')?.value || '';
                                                        if(!from || !to) return { ok: false, message: 'Tanggal dari dan sampai harus diisi.', el: !from ? document.querySelector('#form-mahasiswa input[name="date_from"]') : document.querySelector('#form-mahasiswa input[name="date_to"]') };
                                                        if(from > to) return { ok: false, message: 'Tanggal mulai tidak boleh lebih besar dari tanggal sampai.', el: document.querySelector('#form-mahasiswa input[name="date_from"]') };
                                                    }
                                                } else if(type === 'siswa'){
                                                    const dtSel = document.querySelector('#form-siswa .date-type');
                                                    if(dtSel && dtSel.value === 'range'){
                                                        const from = document.querySelector('#form-siswa input[name="date_from_siswa"]')?.value || '';
                                                        const to = document.querySelector('#form-siswa input[name="date_to_siswa"]')?.value || '';
                                                        if(!from || !to) return { ok: false, message: 'Tanggal dari dan sampai harus diisi.', el: !from ? document.querySelector('#form-siswa input[name="date_from_siswa"]') : document.querySelector('#form-siswa input[name="date_to_siswa"]') };
                                                        if(from > to) return { ok: false, message: 'Tanggal mulai tidak boleh lebih besar dari tanggal sampai.', el: document.querySelector('#form-siswa input[name="date_from_siswa"]') };
                                                    }
                                                }
                                                return { ok: true };
                                            }

                                            const dateCheck = validateDateRanges();
                                            if(!dateCheck.ok){
                                                if(dateErrorText) dateErrorText.textContent = dateCheck.message || 'Kesalahan tanggal.';
                                                lastInvalidEl = dateCheck.el || null;
                                                if(dateErrorModal) { dateErrorModal.classList.remove('hidden'); dateErrorModal.classList.add('flex'); }
                                                return;
                                            }

                                            const type = document.getElementById('disp-type') ? document.getElementById('disp-type').value : null;
                                            const txt = document.getElementById('confirm-submit-text');
                                            if(type){
                                                txt.textContent = `Apakah Anda yakin ingin mengirim surat dispensasi (${type})? Setelah dikirim, surat akan menunggu persetujuan admin.`;
                                            }
                                            if(!modal) return;
                                            modal.classList.remove('hidden');
                                            modal.classList.add('flex');
                                        };

                        window.closeConfirmSubmitModal = function(){
                            if(!modal) return;
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                        };

                        function setTimeHiddenValues(){
                            // mahasiswa
                            const hourM = document.getElementById('hour_mhs');
                            const minM = document.getElementById('minute_mhs');
                            const hiddenM = document.getElementById('time_mhs');
                            if(hourM && minM && hiddenM){
                                const h = hourM.value.trim();
                                const m = minM.value.trim();
                                if(h !== '' && m !== ''){
                                    hiddenM.value = h.padStart(2, '0') + ':' + m.padStart(2, '0');
                                } else {
                                    hiddenM.value = '';
                                }
                            }

                            // siswa
                            const hourS = document.getElementById('hour_siswa');
                            const minS = document.getElementById('minute_siswa');
                            const hiddenS = document.getElementById('time_siswa');
                            if(hourS && minS && hiddenS){
                                const h = hourS.value.trim();
                                const m = minS.value.trim();
                                if(h !== '' && m !== ''){
                                    hiddenS.value = h.padStart(2, '0') + ':' + m.padStart(2, '0');
                                } else {
                                    hiddenS.value = '';
                                }
                            }
                        }

                        if(confirmBtn){
                            confirmBtn.addEventListener('click', function(){
                                const form = document.getElementById('dispensation-form');
                                if(!form) return;
                                if(typeof form.reportValidity === 'function'){
                                    if(!form.reportValidity()) return; // keep modal open for corrections
                                }
                                // ensure hidden time values are set (because form.submit() does not trigger submit handlers)
                                try{ setTimeHiddenValues(); }catch(e){}
                                // submit
                                form.submit();
                            });
                        }
                        if(dateErrorOk){
                            dateErrorOk.addEventListener('click', function(){
                                if(dateErrorModal){ dateErrorModal.classList.add('hidden'); dateErrorModal.classList.remove('flex'); }
                                if(lastInvalidEl && typeof lastInvalidEl.focus === 'function') lastInvalidEl.focus();
                                lastInvalidEl = null;
                            });
                        }
                    })();
                </script>
                <div id="docx-preview-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col">
                        <!-- Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-[#FEDA60] to-[#F5B347]">
                            <h2 class="text-xl font-bold text-[#2E2E2E]">Preview Surat Dispensasi</h2>
                            <button onclick="closeDocxPreview()" class="text-gray-600 hover:text-gray-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
                            <div id="docx-preview-content" class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                                <p class="text-center text-gray-500">Loading preview...</p>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-100">
                            <p class="text-sm text-gray-600">💡 Preview surat Anda. Gunakan tombol download untuk menyimpan file.</p>
                            <button onclick="closeDocxPreview()" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Tutup</button>
                        </div>
                    </div>
                </div>

                <script>
                    function viewDocxPreview(fileUrl, dispensationId) {
                        const modal = document.getElementById('docx-preview-modal');
                        const content = document.getElementById('docx-preview-content');
                        
                        // Show loading state
                        modal.classList.remove('hidden');
                        content.innerHTML = '<p class="text-center text-gray-500">Memuat preview surat...</p>';
                        
                        // Try to fetch and display DOCX
                        fetch(fileUrl)
                            .then(response => response.blob())
                            .then(blob => {
                                // Create URL untuk preview
                                const fileUrl = URL.createObjectURL(blob);
                                
                                // Use a library like mammoth.js untuk convert DOCX to HTML
                                // Atau display info bahwa file siap untuk download
                                const fileName = 'Dispensation_' + dispensationId + '.docx';
                                
                                content.innerHTML = `
                                    <div class="text-center py-8">
                                        <svg class="w-16 h-16 mx-auto text-blue-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1 1 0 11-2 0 1 1 0 012 0zM15 7a1 1 0 11-2 0 1 1 0 012 0zM4 20H3a1 1 0 01-1-1v-2a1 1 0 011-1h1v3zm6 0h-.5a1 1 0 01-1-1v-2a1 1 0 011-1h.5v3zm6 0h1a1 1 0 001-1v-2a1 1 0 00-1-1h-1v3zM4.333 11H2a1 1 0 00-1 1v2a1 1 0 001 1h2.333v-3zM2.5 5a1 1 0 11-2 0 1 1 0 012 0zM18 4H9v2h9V4z"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Dokumen Word (.DOCX)</h3>
                                        <p class="text-gray-600 mb-4">${fileName}</p>
                                        <p class="text-sm text-gray-500 mb-6">Preview inline tidak tersedia untuk file Word. Gunakan tombol di bawah untuk membuka atau mendownload file.</p>
                                        <div class="flex gap-3 justify-center">
                                            <a href="${fileUrl}" target="_blank" download class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Download DOCX</a>
                                            <a href="${fileUrl}" target="_blank" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Buka di Aplikasi Default</a>
                                        </div>
                                    </div>
                                `;
                            })
                            .catch(error => {
                                console.error('Error loading preview:', error);
                                content.innerHTML = `
                                    <div class="text-center py-8">
                                        <p class="text-red-600">Gagal memuat preview.</p>
                                        <p class="text-sm text-gray-500 mt-2">Silakan gunakan tombol download untuk mengakses file.</p>
                                    </div>
                                `;
                            });
                    }
                    
                    function closeDocxPreview() {
                        document.getElementById('docx-preview-modal').classList.add('hidden');
                    }
                </script>
            </section>
        </main>
    </div>
</div>

<script>
    // sidebar toggle mobile
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    
    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // section nav
    function showSection(sectionName) {
        // hide sections
        document.querySelectorAll('.dashboard-section').forEach(section => {
            section.classList.add('hidden');
        });
        
        // show selected section
        document.getElementById(sectionName + '-section').classList.remove('hidden');
        
        // update nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
        });
        event.target.closest('.nav-link').classList.add('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
        
        // close sidebar mobile
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }
    }

    // innit navlink
    document.querySelector('.nav-link').classList.add('bg-[#FEDA60]/10', 'text-[#FEDA60]');
</script>

{{-- popup sukses --}}
@if(session('success'))
<div id="success-popup" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 shadow-xl w-80 text-center animate-fadeIn">
        
        <div class="mx-auto mb-3 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <p class="font-semibold text-green-700">{{ session('success') }}</p>

        <button onclick="document.getElementById('success-popup').remove()"
                class="mt-4 px-4 py-2 rounded-lg bg-green-600 text-white">
            OK
        </button>
    </div>
</div>
@endif

{{-- script input waktu --}}
<script>
// ========================
// BATASI INPUT ANGKA
// ========================
function onlyNumber(input, max) {
    input.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, "");
        if (this.value.length > 2) this.value = this.value.slice(0, 2);
        if (parseInt(this.value) > max) {
            this.value = max.toString().padStart(2, "0");
        }
    });

    input.addEventListener("blur", function () {
        if (this.value !== "") {
            this.value = this.value.padStart(2, "0");
        }
    });
}

// ========================
// SETUP JAM & MENIT UNTUK SEMUA FORM
// ========================
function setupTimeFields(hourId, minuteId, hiddenId, maxHour = 23) {

    const hourInput = document.getElementById(hourId);
    const minuteInput = document.getElementById(minuteId);
    const hiddenInput = document.getElementById(hiddenId);

    // Batasi input
    onlyNumber(hourInput, maxHour);
    onlyNumber(minuteInput, 59);

    // Saat submit -> gabungkan
    document.addEventListener("submit", function (e) {

        // Cek apakah form yang disubmit adalah dispensations.store
        const form = e.target.closest('form[action="{{ route('dispensations.store') }}"]');
        if (!form) return;

        const hour = hourInput.value;
        const minute = minuteInput.value;

        if (hour === "" || minute === "") {
            hiddenInput.value = null;
            return;
        }

        hiddenInput.value = hour.padStart(2, "0") + ":" + minute.padStart(2, "0");

        console.log("TIME SET:", hiddenInput.value);
    });
}

// ========================
// PASANGKAN UNTUK MAHASISWA
// ========================
setupTimeFields("hour_mhs", "minute_mhs", "time_mhs", 23);

// ========================
// PASANGKAN UNTUK SISWA
// ========================
setupTimeFields("hour_siswa", "minute_siswa", "time_siswa", 23);

</script>




@endsection
