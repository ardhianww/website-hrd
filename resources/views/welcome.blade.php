<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Human Resource Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-gray-900">{{ config('app.name') }}</h1>
            </div>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                @endif
                @endauth
                @endif
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-6">Sistem Manajemen SDM Terpadu</h2>
                <p class="text-xl mb-8">Kelola sumber daya manusia perusahaan Anda dengan lebih efisien dan efektif</p>
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300">
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h3 class="text-2xl font-bold text-center mb-12">Fitur Unggulan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Employee Management -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Manajemen Karyawan</h4>
                    <p class="text-gray-600">Kelola data karyawan, riwayat kerja, dan dokumen penting dengan mudah</p>
                </div>

                <!-- Attendance -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Absensi Digital</h4>
                    <p class="text-gray-600">Sistem absensi modern dengan fitur lokasi dan laporan real-time</p>
                </div>

                <!-- Payroll -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Penggajian</h4>
                    <p class="text-gray-600">Otomatisasi penggajian dengan perhitungan yang akurat dan transparan</p>
                </div>

                <!-- Recruitment -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Rekrutmen</h4>
                    <p class="text-gray-600">Kelola lowongan kerja dan proses rekrutmen secara efisien</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-6">Siap Meningkatkan Manajemen SDM Anda?</h3>
            <p class="text-lg mb-8 text-gray-300">Bergabung sekarang dan rasakan kemudahan mengelola SDM dengan sistem kami</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-md hover:bg-blue-700">
                    Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="bg-gray-800 text-white px-8 py-3 rounded-md hover:bg-gray-700">
                    Masuk
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-gray-600">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>