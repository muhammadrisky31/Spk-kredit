<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Kredit – Sistem Pendukung Keputusan Berbasis Machine Learning Randomforest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 40%, #dbeafe 70%, #e0e7ff 100%);
        }
        .float-card {
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.15);
        }
        .navbar-glass {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .stats-divider:not(:last-child) {
            border-right: 1px solid #e5e7eb;
        }
        .feature-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(59, 130, 246, 0.12);
        }
        .illustration-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(59, 130, 246, 0.18);
            position: relative;
            overflow: visible;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .float-anim { animation: float 3s ease-in-out infinite; }
        .float-anim-delay { animation: float 3s ease-in-out infinite 1.5s; }
    </style>
</head>
<body class="bg-white text-gray-800">

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar-glass fixed top-0 left-0 right-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3v18h18M7 14l3-3 3 2 4-5"/>
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900 text-base">SPK Kredit</span>
                </div>

                <!-- Nav Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') ?? '#' }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-2 rounded-lg transition-colors shadow-sm">
                        Login
                    </a>
                    <a href="{{ route('register') ?? '#' }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-2 rounded-lg transition-colors shadow-sm">
                        Daftar Gratis
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero-bg pt-28 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8">

                <!-- Left Content -->
                <div class="flex-1 max-w-xl">
                    <div class="inline-flex items-center gap-2 mb-5">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-blue-600 font-medium text-sm">Sistem Pendukung Keputusan Kredit</span>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-5">
                        Prediksi Risiko Kredit<br>yang Akurat
                    </h1>
                    <p class="text-gray-500 text-base leading-relaxed mb-8 max-w-md">
                        Platform canggih menggunakan algoritma <strong class="text-gray-700 font-semibold">Randomforest
                        Machine Learning</strong> untuk memprediksi risiko kredit secara cepat, akurat, dan mudah dipahami.
                    </p>
                    <div class="flex flex-wrap items-center gap-3 mb-8">
                        <a href="{{ route('register') ?? '#' }}"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors shadow-md text-sm">
                            Mulai Gratis
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <a href="{{ route('login') ?? '#' }}"
                           class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-semibold px-6 py-3 rounded-lg border border-gray-200 transition-colors text-sm">
                            Masuk ke Akun
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap items-center gap-5">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 text-xs font-medium">Data Aman & Terenkripsi</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 text-xs font-medium">Akurasi 87%</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 text-xs font-medium">Gratis Digunakan</span>
                        </div>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="flex-1 flex justify-center lg:justify-end relative">
                    <div class="relative w-full max-w-md lg:max-w-lg">
                        <div class="illustration-container bg-white p-8 relative z-10">
                            <img src="{{ asset('images/ai-banking.jpeg') }}"
                                 alt="Ilustrasi Kredit"
                                 class="w-full h-auto rounded-xl">

                            <!-- Akurasi badge bottom left -->
                            <div class="absolute bottom-6 left-4 float-anim">
                                <div class="bg-white rounded-xl px-4 py-2.5 float-card flex items-center gap-2.5">
                                    <div class="w-7 h-7 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 leading-none mb-0.5">Akurasi Prediksi</p>
                                        <p class="text-sm font-bold text-gray-800 leading-none">87%</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Random Forest floating badge top right -->
                        <div class="absolute -top-4 -right-4 z-20 float-anim-delay">
                            <div class="bg-white rounded-xl px-4 py-2.5 float-card flex items-center gap-2">
                                <div class="w-7 h-7 bg-indigo-50 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-800">Random Forest</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== STATS SECTION ===== -->
    <section class="bg-white py-16 border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-0">
                <div class="stats-divider flex flex-col items-center justify-center py-8 px-6 text-center">
                    <div class="mb-3">
                        <svg class="w-7 h-7 text-blue-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 mb-1">87%</p>
                    <p class="text-sm text-gray-400 font-medium">Akurasi Model</p>
                </div>
                <div class="stats-divider flex flex-col items-center justify-center py-8 px-6 text-center">
                    <div class="mb-3">
                        <svg class="w-7 h-7 text-blue-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 mb-1">32K+</p>
                    <p class="text-sm text-gray-400 font-medium">Data Training</p>
                </div>
                <div class="stats-divider flex flex-col items-center justify-center py-8 px-6 text-center">
                    <div class="mb-3">
                        <svg class="w-7 h-7 text-blue-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 mb-1">5K+</p>
                    <p class="text-sm text-gray-400 font-medium">Prediksi Dilakukan</p>
                </div>
                <div class="flex flex-col items-center justify-center py-8 px-6 text-center">
                    <div class="mb-3">
                        <svg class="w-7 h-7 text-blue-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 mb-1">256-bit</p>
                    <p class="text-sm text-gray-400 font-medium">Keamanan Data</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FEATURES SECTION ===== -->
    <section class="bg-white py-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="text-blue-600 font-semibold text-sm mb-3 block">Fitur Unggulan</span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4">
                    Mengapa Memilih SPK Kredit?
                </h2>
                <p class="text-gray-400 text-base max-w-xl mx-auto">
                    Sistem kami dirancang untuk memberikan prediksi yang akurat, cepat, dan mudah dipahami oleh siapa pun.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="feature-card bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
                    <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Prediksi Cepat</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Dapatkan hasil prediksi risiko kredit dalam hitungan detik dengan teknologi terdepan.
                    </p>
                </div>
                <div class="feature-card bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Berbasis Machine Learning</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Menggunakan algoritma Random Forest yang terlatih dari ribuan data historis kredit.
                    </p>
                </div>
                <div class="feature-card bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Mudah Digunakan</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Antarmuka intuitif yang dirancang untuk semua kalangan, tanpa perlu keahlian teknis.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="bg-blue-700 py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-4">
                Siap Memulai Prediksi Kredit?
            </h2>
            <p class="text-blue-200 text-base mb-10">
                Daftar sekarang dan mulai prediksi risiko kredit secara gratis.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') ?? '#' }}"
                   class="bg-white hover:bg-gray-50 text-blue-700 font-semibold px-8 py-3 rounded-lg transition-colors shadow-md text-sm">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') ?? '#' }}"
                   class="bg-blue-600 hover:bg-blue-500 border border-blue-400 text-white font-semibold px-8 py-3 rounded-lg transition-colors text-sm">
                    Masuk ke Akun
                </a>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} SPK Kredit &ndash; Sistem Pendukung Keputusan Berbasis Machine Learning Random Forest
                </p>
            </div>
        </div>
    </footer>

</body>
</html>