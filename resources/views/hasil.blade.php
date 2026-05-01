<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Prediksi – SPK Kredit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }

        /* Circular confidence ring */
        .confidence-ring {
            position: relative;
            width: 110px;
            height: 110px;
            margin: 0 auto;
        }
        .confidence-ring svg {
            transform: rotate(-90deg);
        }
        .confidence-ring .label {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Nav active underline */
        .nav-active {
            color: #3b82f6;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 2px;
        }

        /* Badge risk */
        .badge-high {
            background: #ef4444;
            color: #fff;
        }
        .badge-low {
            background: #22c55e;
            color: #fff;
        }

        /* Factor card accent */
        .factor-danger { background: #fff5f5; border: 1px solid #fecaca; }
        .factor-safe   { background: #f0fdf4; border: 1px solid #bbf7d0; }

        /* Ring animation */
        @keyframes ringFill {
            from { stroke-dashoffset: 283; }
            to   { stroke-dashoffset: var(--target-offset); }
        }
        .ring-anim {
            animation: ringFill 1s ease-out forwards;
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
        }
    </style>
</head>
<body>

{{-- ============================
     NAVBAR
============================= --}}
<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-14 flex items-center justify-between">

        {{-- Logo --}}
        <div class="flex items-center gap-2 min-w-[160px]">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-900 leading-none">SPK Kredit</p>
                <p class="text-[10px] text-gray-400 leading-none mt-0.5">Decision Tree</p>
            </div>
        </div>

        {{-- Nav links --}}
        <div class="hidden md:flex items-center gap-7 text-sm font-medium text-gray-500">
            <a href="#" class="flex items-center gap-1.5 hover:text-gray-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center gap-1.5 nav-active font-semibold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
                Prediksi
            </a>
            <a href="#" class="flex items-center gap-1.5 hover:text-gray-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                Riwayat
            </a>
            <a href="#" class="flex items-center gap-1.5 hover:text-gray-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                Tentang
            </a>
        </div>

        {{-- Right: notif + user --}}
        <div class="flex items-center gap-3">
            <button class="relative p-2 text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <div class="flex items-center gap-2 cursor-pointer">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">P</div>
                <span class="text-sm font-medium text-gray-700 hidden sm:block">Pengguna</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>
        </div>
    </div>
</nav>

{{-- ============================
     PAGE BODY
============================= --}}
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Page Header --}}
    <div class="flex items-start justify-between mb-7">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Hasil Prediksi Risiko Kredit</h1>
            <p class="text-sm text-gray-400 mt-0.5">
                Analisis selesai pada {{ $prediksi['tanggal'] ?? date('Y-m-d') }}
            </p>
        </div>
        <a href="{{ route('prediksi.index') ?? '#' }}"
           class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Prediksi Baru
        </a>
    </div>

    {{-- ===== TWO-COLUMN LAYOUT ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-[370px_1fr] gap-6 items-start">

        {{-- ==============================
             LEFT CARD: Hasil & Tindakan
        =============================== --}}
        <div class="flex flex-col gap-4">

            {{-- Result Card --}}
            @php
                $isHighRisk = ($prediksi['risiko'] ?? 'TINGGI') === 'TINGGI';
                $confidence = $prediksi['confidence'] ?? 67.2;
                $circumference = 283;
                $offset = $circumference - ($confidence / 100) * $circumference;
                $ringColor = $isHighRisk ? '#ef4444' : '#22c55e';
                $bgCard   = $isHighRisk ? 'bg-red-50' : 'bg-green-50';
                $borderCard = $isHighRisk ? 'border-red-100' : 'border-green-100';
            @endphp

            <div class="bg-white border {{ $borderCard }} rounded-2xl p-6 text-center {{ $bgCard }}">

                {{-- Icon --}}
                <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4
                    {{ $isHighRisk ? 'bg-red-100' : 'bg-green-100' }}">
                    @if($isHighRisk)
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    @else
                        <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </div>

                <p class="text-xs text-gray-400 mb-1">Hasil Prediksi untuk</p>
                <p class="text-base font-bold text-gray-900 mb-4">{{ $prediksi['nama'] ?? 'user' }}</p>

                {{-- Risk Badge --}}
                <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-bold
                    {{ $isHighRisk ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                    @if($isHighRisk)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        RISIKO TINGGI
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        RISIKO RENDAH
                    @endif
                </div>

                {{-- Description --}}
                <p class="mt-4 text-sm leading-relaxed {{ $isHighRisk ? 'text-red-600' : 'text-green-700' }}">
                    @if($isHighRisk)
                        Pemohon ini memiliki probabilitas gagal bayar yang cukup tinggi. Perlu pertimbangan lebih lanjut.
                    @else
                        Pemohon ini memiliki probabilitas gagal bayar yang rendah. Kelayakan kredit tergolong baik.
                    @endif
                </p>

                {{-- Confidence Ring --}}
                <div class="confidence-ring mt-6">
                    <svg width="110" height="110" viewBox="0 0 110 110">
                        {{-- Track --}}
                        <circle cx="55" cy="55" r="45"
                            fill="none"
                            stroke="{{ $isHighRisk ? '#fecaca' : '#bbf7d0' }}"
                            stroke-width="10"/>
                        {{-- Progress --}}
                        <circle cx="55" cy="55" r="45"
                            fill="none"
                            stroke="{{ $ringColor }}"
                            stroke-width="10"
                            stroke-linecap="round"
                            class="ring-anim"
                            style="--target-offset: {{ $offset }};"
                        />
                    </svg>
                    <div class="label">
                        <span class="text-xl font-bold {{ $isHighRisk ? 'text-red-500' : 'text-green-500' }}">
                            {{ number_format($confidence, 1) }}%
                        </span>
                        <span class="text-[10px] text-gray-400 mt-0.5">Confidence</span>
                    </div>
                </div>

                <p class="text-xs text-gray-400 mt-3">Tingkat kepercayaan model</p>
            </div>

            {{-- Actions Card --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <p class="text-sm font-semibold text-gray-700 mb-4">Tindakan</p>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('riwayat.store') ?? '#' }}"
                       class="flex items-center gap-3 px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-700 font-medium hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Simpan ke Riwayat
                    </a>
                    <a href="{{ route('prediksi.index') ?? '#' }}"
                       class="flex items-center gap-3 px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-700 font-medium hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                        Prediksi Data Baru
                    </a>
                    <a href="{{ route('riwayat.index') ?? '#' }}"
                       class="flex items-center gap-3 px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-700 font-medium hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Lihat Riwayat
                    </a>
                </div>
            </div>
        </div>

        {{-- ==============================
             RIGHT PANEL: Details
        =============================== --}}
        <div class="flex flex-col gap-5">

            {{-- FAKTOR RISIKO --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-5">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                    <h2 class="text-base font-bold text-gray-900">Faktor Risiko</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    {{-- Card helper macro via include-like structure --}}
                    @php
                        $factors = [
                            [
                                'label'  => 'Rasio Pinjaman/Pendapatan',
                                'value'  => $prediksi['rasio_pinjaman'] ?? '300.0%',
                                'batas'  => 'Batas: 35.0%',
                                'status' => 'Perhatian',
                                'safe'   => false,
                            ],
                            [
                                'label'  => 'Suku Bunga',
                                'value'  => $prediksi['suku_bunga'] ?? '1%',
                                'batas'  => 'Batas: 15%',
                                'status' => 'Aman',
                                'safe'   => true,
                            ],
                            [
                                'label'  => 'Lama Riwayat Kredit',
                                'value'  => $prediksi['lama_riwayat'] ?? '3 thn',
                                'batas'  => 'Batas: 5 thn',
                                'status' => 'Perhatian',
                                'safe'   => false,
                            ],
                            [
                                'label'  => 'Lama Kerja',
                                'value'  => $prediksi['lama_kerja'] ?? '5 thn',
                                'batas'  => 'Batas: 3 thn',
                                'status' => 'Aman',
                                'safe'   => true,
                            ],
                        ];
                    @endphp

                    @foreach($factors as $f)
                    <div class="rounded-xl p-4 {{ $f['safe'] ? 'factor-safe' : 'factor-danger' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs text-gray-500">{{ $f['label'] }}</span>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full
                                {{ $f['safe'] ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }}">
                                {{ $f['status'] }}
                            </span>
                        </div>
                        <p class="text-xl font-bold {{ $f['safe'] ? 'text-green-700' : 'text-red-600' }}">{{ $f['value'] }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $f['batas'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- DATA PRIBADI --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-5">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <h2 class="text-base font-bold text-gray-900">Data Pribadi</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @php
                        $personalData = [
                            ['label' => 'Nama',        'value' => $prediksi['nama']        ?? 'user'],
                            ['label' => 'Umur',        'value' => ($prediksi['umur']        ?? '20') . ' tahun'],
                            ['label' => 'Pendapatan',  'value' => 'Rp' . number_format($prediksi['pendapatan'] ?? 5000000, 0, ',', '.') . ',-'],
                            ['label' => 'Lama Kerja',  'value' => ($prediksi['lama_kerja']  ?? '5') . ' tahun'],
                            ['label' => 'Status Rumah','value' => $prediksi['status_rumah'] ?? 'RENT'],
                        ];
                    @endphp
                    @foreach($personalData as $item)
                    <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">{{ $item['label'] }}</p>
                        <p class="text-sm font-bold text-gray-900">{{ $item['value'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- DATA PINJAMAN --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-5">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                    </svg>
                    <h2 class="text-base font-bold text-gray-900">Data Pinjaman</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @php
                        $loanData = [
                            ['label' => 'Jumlah Pinjaman',    'value' => 'Rp' . number_format($prediksi['jumlah_pinjaman'] ?? 10000000, 0, ',', '.')],
                            ['label' => 'Suku Bunga',         'value' => ($prediksi['suku_bunga']   ?? '1') . '%'],
                            ['label' => '% dari Pendapatan',  'value' => ($prediksi['rasio_pinjaman'] ?? '300.0') . '%'],
                            ['label' => 'Tujuan',             'value' => $prediksi['tujuan']        ?? 'PERSONAL'],
                            ['label' => 'Grade',              'value' => $prediksi['grade']         ?? 'Grade A'],
                        ];
                    @endphp
                    @foreach($loanData as $item)
                    <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">{{ $item['label'] }}</p>
                        <p class="text-sm font-bold text-gray-900">{{ $item['value'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RIWAYAT KREDIT --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-5">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>
                    </svg>
                    <h2 class="text-base font-bold text-gray-900">Riwayat Kredit</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">Riwayat Default</p>
                        <p class="text-sm font-bold text-gray-900">{{ $prediksi['riwayat_default'] ?? 'Tidak Pernah Default' }}</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">Lama Riwayat Kredit</p>
                        <p class="text-sm font-bold text-gray-900">{{ ($prediksi['lama_riwayat'] ?? '3') }} tahun</p>
                    </div>
                </div>
            </div>

        </div>
        {{-- end right panel --}}

    </div>
</div>

<script>
    // Animate ring on load
    document.addEventListener('DOMContentLoaded', () => {
        const rings = document.querySelectorAll('.ring-anim');
        rings.forEach(r => {
            const t = r.style.getPropertyValue('--target-offset');
            r.style.strokeDashoffset = 283;
            requestAnimationFrame(() => {
                r.style.transition = 'stroke-dashoffset 1s ease-out';
                r.style.strokeDashoffset = t;
            });
        });
    });
</script>

</body>
</html>
