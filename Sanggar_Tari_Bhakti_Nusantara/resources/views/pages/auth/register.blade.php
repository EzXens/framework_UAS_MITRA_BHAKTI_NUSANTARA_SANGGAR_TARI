@extends('layouts.auth')

@section('content')
    <div class="w-full max-w-[480px]">
        <div class="rounded-[36px] bg-white px-10 pb-12 pt-10 shadow-lg shadow-[#0000001a] space-y-10">
            <div class="flex rounded-full bg-[#D9D9D9] p-1 text-sm font-medium">
                <span class="flex-1 rounded-full bg-[#E5B950] px-5 py-2 text-center text-white shadow">Daftar</span>
                <a href="{{ route('login') }}" class="flex-1 rounded-full px-5 py-2 text-center text-[#6B6B6B] transition hover:text-[#2E2E2E]">Masuk</a>
            </div>

            <div class="space-y-8">
                <div class="text-center space-y-3">
                    <h1 class="text-2xl font-semibold">Daftar</h1>
                    <button type="button"
                        class="flex w-full items-center justify-center gap-3 rounded-full border border-[#BFBFBF] px-6 py-3 text-sm font-medium text-[#4B4B4B] transition hover:border-[#E5B950] hover:shadow">
                        <span class="inline-flex h-6 w-6 items-center justify-center">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="#EA4335" d="M12.24 10.3v3.87h5.4c-.21 1.38-1.63 4.05-5.4 4.05-3.25 0-5.9-2.69-5.9-6s2.65-6 5.9-6c1.85 0 3.09.78 3.8 1.45l2.59-2.5C16.96 3.67 14.78 2.7 12.24 2.7 6.99 2.7 2.76 6.93 2.76 12.17s4.23 9.47 9.48 9.47c5.47 0 9.09-3.83 9.09-9.22 0-.62-.07-1.09-.16-1.58z" />
                                <path fill="#FBBC05" d="M3.42 7.45l3.55 2.6c.96-2.32 3.24-4 5.94-4 1.85 0 3.09.78 3.8 1.45l2.59-2.5C16.96 3.67 14.78 2.7 12.24 2.7c-4.02 0-7.43 2.3-8.82 5.3z" />
                                <path fill="#34A853" d="M12.24 21.64c2.48 0 4.56-.82 6.08-2.23l-2.8-2.3c-.75.52-1.76.88-3.28.88-2.44 0-4.51-1.63-5.25-3.87l-3.54 2.73c1.37 2.95 4.38 4.79 8.79 4.79z" />
                                <path fill="#4285F4" d="M21.57 12.42c0-.62-.07-1.09-.16-1.58h-9.17v3.46h5.4c-.21 1.38-1.63 4.05-5.4 4.05-2.63 0-4.83-1.78-5.52-4.16l-3.55 2.75c1.38 2.95 4.4 4.8 8.81 4.8 5.47 0 9.09-3.83 9.09-9.22z" opacity=".1" />
                            </svg>
                        </span>
                        Daftar Dengan Google
                    </button>
                </div>

                <div class="flex items-center justify-center gap-4 text-[#A0A0A0] text-sm">
                    <span class="h-px flex-1 bg-[#D8D8D8]"></span>
                    <span>Atau</span>
                    <span class="h-px flex-1 bg-[#D8D8D8]"></span>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="register-name" class="text-sm text-[#5B5B5B]">Nama</label>
                        <input id="register-name" type="text" name="name"
                            class="w-full rounded-2xl border border-[#D9D9D9] px-4 py-3 text-sm text-[#2E2E2E] focus:border-[#E5B950] focus:outline-none focus:ring-2 focus:ring-[#F6DE9F]" placeholder="Masukkan nama" />
                    </div>
                    <div class="space-y-2">
                        <label for="register-email" class="text-sm text-[#5B5B5B]">Email</label>
                        <input id="register-email" type="email" name="email"
                            class="w-full rounded-2xl border border-[#D9D9D9] px-4 py-3 text-sm text-[#2E2E2E] focus:border-[#E5B950] focus:outline-none focus:ring-2 focus:ring-[#F6DE9F]" placeholder="Masukkan email" />
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label for="register-password" class="text-sm text-[#5B5B5B]">Password</label>
                            <input id="register-password" type="password" name="password"
                                class="w-full rounded-2xl border border-[#D9D9D9] px-4 py-3 text-sm text-[#2E2E2E] focus:border-[#E5B950] focus:outline-none focus:ring-2 focus:ring-[#F6DE9F]" placeholder="Masukkan password" />
                        </div>
                        <div class="space-y-2">
                            <label for="register-password_confirmation" class="text-sm text-[#5B5B5B]">Konfirmasi Password</label>
                            <input id="register-password_confirmation" type="password" name="password_confirmation"
                                class="w-full rounded-2xl border border-[#D9D9D9] px-4 py-3 text-sm text-[#2E2E2E] focus:border-[#E5B950] focus:outline-none focus:ring-2 focus:ring-[#F6DE9F]" placeholder="Masukkan ulang password" />
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full rounded-full bg-[#E5B950] px-6 py-3 text-base font-semibold text-white shadow transition hover:bg-[#d2a13f]">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
