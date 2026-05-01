@extends('layouts.navbar')


@php $pageTitle = 'Dashboard'; @endphp

@section('content')
{{-- ===================== MAIN CONTENT ===================== --}}
<main style="max-width:1200px; margin:0 auto; padding:24px 28px;">

    {{-- ===== HERO BANNER ===== --}}
    <div class="hero-banner" style="border-radius:20px; overflow:hidden; margin-bottom:24px; min-height:165px; position:relative; display:flex; align-items:stretch;">

        {{-- Left: Text --}}
        <div style="flex:1; padding:32px 36px; display:flex; flex-direction:column; justify-content:center; z-index:2; position:relative;">
            <p style="color:rgba(219,234,254,0.9); font-size:13.5px; margin-bottom:6px;">
                &#128075; Selamat datang kembali,
            </p>
            <h1 style="color:#ffffff; font-size:30px; font-weight:800; margin-bottom:10px; letter-spacing:-0.3px;">
                Risky!
            </h1>
            <p style="color:rgba(191,219,254,0.85); font-size:13.5px; line-height:1.65; max-width:480px;">
                Sistem SPK Kredit siap membantu Anda memprediksi risiko kredit dengan akurasi tinggi berbasis Machine Learning.
            </p>
        </div>

        {{-- Right: Decorative Area --}}
        <div style="position:relative; min-width:460px; display:flex; align-items:center; justify-content:flex-end; padding-right:20px; overflow:hidden;">

           

           
                
                
                </div>
            </div>
        </div>
    </div>

    {{-- ===== STAT CARDS ===== --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px;">

        {{-- Total Prediksi --}}
        <div class="stat-card">
            <div class="icon-box icon-blue">
                <i class="fa-solid fa-chart-column" style="font-size:17px;"></i>
            </div>
            <div style="font-size:32px; font-weight:800; color:#111827; line-height:1; margin-bottom:6px;">3</div>
            <div style="font-size:13.5px; font-weight:600; color:#4b5563; margin-bottom:3px;">Total Prediksi</div>
            <div style="font-size:12px; color:#9ca3af;">Semua waktu</div>
        </div>

        {{-- Risiko Rendah --}}
        <div class="stat-card">
            <div class="icon-box icon-green">
                <i class="fa-solid fa-circle-check" style="font-size:17px;"></i>
            </div>
            <div style="font-size:32px; font-weight:800; color:#111827; line-height:1; margin-bottom:6px;">2</div>
            <div style="font-size:13.5px; font-weight:600; color:#4b5563; margin-bottom:3px;">Risiko Rendah</div>
            <div style="font-size:12px; color:#9ca3af;">67% dari total</div>
        </div>

        {{-- Risiko Tinggi --}}
        <div class="stat-card">
            <div class="icon-box icon-red">
                <i class="fa-solid fa-triangle-exclamation" style="font-size:17px;"></i>
            </div>
            <div style="font-size:32px; font-weight:800; color:#111827; line-height:1; margin-bottom:6px;">1</div>
            <div style="font-size:13.5px; font-weight:600; color:#4b5563; margin-bottom:3px;">Risiko Tinggi</div>
            <div style="font-size:12px; color:#9ca3af;">33% dari total</div>
        </div>

        {{-- Status Sistem --}}
        <div class="stat-card">
            <div class="icon-box icon-teal">
                <i class="fa-solid fa-heart-pulse" style="font-size:17px;"></i>
            </div>
            <div style="font-size:28px; font-weight:800; color:#111827; line-height:1.1; margin-bottom:6px;">Online</div>
            <div style="font-size:13.5px; font-weight:600; color:#4b5563; margin-bottom:3px;">Status Sistem</div>
            <div style="font-size:12px; color:#9ca3af;">Model siap digunakan</div>
        </div>

    </div>

    {{-- ===== AKSI CEPAT + PREDIKSI TERBARU ===== --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">

        {{-- ---- Aksi Cepat ---- --}}
        <div>
            <h2 style="font-size:17px; font-weight:700; color:#111827; margin-bottom:16px;">Aksi Cepat</h2>

            {{-- Mulai Prediksi Baru --}}
            <a href="{{ route('prediksi') }}" class="action-item">
                <div class="icon-box icon-blue" style="margin-bottom:0; flex-shrink:0;">
                    <i class="fa-solid fa-chart-column" style="font-size:16px;"></i>
                </div>
                <div style="flex:1; min-width:0;">
                    <div style="font-size:13.5px; font-weight:600; color:#1f2937; margin-bottom:3px;">Mulai Prediksi Baru</div>
                    <div style="font-size:12px; color:#9ca3af;">Analisis risiko kredit dengan data terbaru</div>
                </div>
                <i class="fa-solid fa-chevron-right" style="font-size:12px; color:#d1d5db;"></i>
            </a>

            {{-- Lihat Riwayat --}}
            <a href="{{ route('riwayat') }}" class="action-item">
                <div class="icon-box icon-purple" style="margin-bottom:0; flex-shrink:0;">
                    <i class="fa-regular fa-clock" style="font-size:16px;"></i>
                </div>
                <div style="flex:1; min-width:0;">
                    <div style="font-size:13.5px; font-weight:600; color:#1f2937; margin-bottom:3px;">Lihat Riwayat</div>
                    <div style="font-size:12px; color:#9ca3af;">Cek semua hasil prediksi sebelumnya</div>
                </div>
                <i class="fa-solid fa-chevron-right" style="font-size:12px; color:#d1d5db;"></i>
            </a>

            {{-- Pelajari Sistem --}}
            <a href="{{ route('tentang') }}" class="action-item">
                <div class="icon-box icon-teal" style="margin-bottom:0; flex-shrink:0;">
                    <i class="fa-solid fa-arrow-trend-up" style="font-size:16px;"></i>
                </div>
                <div style="flex:1; min-width:0;">
                    <div style="font-size:13.5px; font-weight:600; color:#1f2937; margin-bottom:3px;">Pelajari Sistem</div>
                    <div style="font-size:12px; color:#9ca3af;">Pahami cara kerja Decision Tree</div>
                </div>
                <i class="fa-solid fa-chevron-right" style="font-size:12px; color:#d1d5db;"></i>
            </a>
        </div>

        {{-- ---- Prediksi Terbaru ---- --}}
        <div>
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                <h2 style="font-size:17px; font-weight:700; color:#111827;">Prediksi Terbaru</h2>
                <a href="{{ route('riwayat') }}" style="font-size:13.5px; font-weight:600; color:#2563eb; text-decoration:none; display:flex; align-items:center; gap:4px;">
                    Lihat Semua <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                </a>
            </div>

            <div class="prediction-card">

                {{-- Budi Santoso --}}
                <div class="prediction-row">
                    <div class="icon-box icon-green" style="margin-bottom:0; flex-shrink:0; width:38px; height:38px; border-radius:10px;">
                        <i class="fa-solid fa-arrow-trend-down" style="font-size:14px;"></i>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="font-size:13.5px; font-weight:600; color:#1f2937; margin-bottom:3px;">Budi Santoso</div>
                        <div style="font-size:11.5px; color:#9ca3af;">OWN &middot; PERSONAL &middot; 2026-04-01</div>
                    </div>
                    <div style="text-align:right; flex-shrink:0;">
                        <div><span class="badge-rendah">Risiko Rendah</span></div>
                        <div style="font-size:12px; color:#9ca3af; margin-top:5px;">87.5%</div>
                    </div>
                </div>

                {{-- Siti Rahayu --}}
                <div class="prediction-row">
                    <div class="icon-box icon-red" style="margin-bottom:0; flex-shrink:0; width:38px; height:38px; border-radius:10px;">
                        <i class="fa-solid fa-arrow-trend-up" style="font-size:14px;"></i>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="font-size:13.5px; font-weight:600; color:#1f2937; margin-bottom:3px;">Siti Rahayu</div>
                        <div style="font-size:11.5px; color:#9ca3af;">RENT &middot; VENTURE &middot; 2026-04-02</div>
                    </div>
                    <div style="text-align:right; flex-shrink:0;">
                        <div><span class="badge-tinggi">Risiko Tinggi</span></div>
                        <div style="font-size:12px; color:#9ca3af; margin-top:5px;">91.2%</div>
                    </div>
                </div>

                {{-- Ahmad Fauzi --}}
                <div class="prediction-row">
                    <div class="icon-box icon-green" style="margin-bottom:0; flex-shrink:0; width:38px; height:38px; border-radius:10px;">
                        <i class="fa-solid fa-arrow-trend-down" style="font-size:14px;"></i>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="font-size:13.5px; font-weight:600; color:#1f2937; margin-bottom:3px;">Ahmad Fauzi</div>
                        <div style="font-size:11.5px; color:#9ca3af;">MORTGAGE &middot; HOMEIMPROVEMENT &middot; 2026-04-03</div>
                    </div>
                    <div style="text-align:right; flex-shrink:0;">
                        <div><span class="badge-rendah">Risiko Rendah</span></div>
                        <div style="font-size:12px; color:#9ca3af; margin-top:5px;">78.3%</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ===== INFO BAR ===== --}}
    <div class="info-bar">
        <div style="width:38px; height:38px; background:#dbeafe; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <i class="fa-solid fa-heart-pulse" style="font-size:16px; color:#2563eb;"></i>
        </div>
        <div>
            <div style="font-size:14px; font-weight:700; color:#1e40af; margin-bottom:3px;">
                Sistem Aktif &amp; Berjalan Normal
            </div>
            <div style="font-size:12.5px; color:#3b82f6; line-height:1.5;">
                Model Decision Tree terlatih dari 32.000+ data kredit. Akurasi validasi: 93.2%. Gunakan sistem ini sebagai pendukung keputusan, bukan satu-satunya acuan.
            </div>
        </div>
    </div>

</main>

@endsection