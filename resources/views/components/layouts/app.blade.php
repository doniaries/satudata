<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Satu Data Kabupaten Sijunjung' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap');
        .font-roboto, .font-roboto * {
            font-family: 'Roboto', Arial, sans-serif !important;
        }
    </style>
</head>

<body>
    @livewire('partials.navbar')
    <main class="min-h-screen">
        {{ $slot }}
    </main>
    @livewire('partials.footer')
    @livewireScripts
</body>

</html>

{{-- Pastikan semua link global sesuai dengan navigasi utama --}}
