<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sanggar Tari Bhakti Nusantara">
    <title>{{ $title ?? 'Bhakti Nusantara' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#2E2E2E] text-[#2E2E2E] font-sans">
    <div class="min-h-screen flex flex-col">
        @include('components.layout.navbar')
        <main class="flex-1">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
        @include('components.layout.footer')
        <x-layout.fab/>
    </div>



 @hasSection('carousel')
        <main class="container mx-auto px-4 pb-16">
          <div class="space-y-16 animate-fade-up">
            @yield('carousel')
          </div>
        </main>
      @endif


    <script>
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                const expanded = navToggle.getAttribute('aria-expanded') === 'true';
                navToggle.setAttribute('aria-expanded', String(!expanded));
                navMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
