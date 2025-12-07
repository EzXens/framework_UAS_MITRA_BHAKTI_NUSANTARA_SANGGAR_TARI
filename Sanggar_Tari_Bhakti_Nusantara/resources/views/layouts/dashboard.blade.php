<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sanggar Tari Bhakti Nusantara">
    <title>{{ $title ?? 'Dashboard - Bhakti Nusantara' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    <script src="https://unpkg.com/wavesurfer.js"></script>
    <script src="https://unpkg.com/wavesurfer.js/dist/plugins/regions.min.js"></script>
    <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.12.2/dist/ffmpeg.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5] font-sans">
    {{ $slot ?? '' }}
    @yield('content')
</body>
</html>
