@extends('layouts.navbar')

@section('content')

<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --primary: #2563eb;
        --primary-light: #eff6ff;
        --danger: #ef4444;
        --danger-light: #fef2f2;
        --danger-border: #fecaca;
        --success: #16a34a;
        --success-light: #f0fdf4;
        --success-border: #bbf7d0;
        --warning: #d97706;
        --warning-light: #fffbeb;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-700: #374151;
        --gray-900: #111827;
        --white: #ffffff;
        --radius: 12px;
        --shadow: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.07), 0 2px 4px rgba(0,0,0,0.06);
    }

    .page {
        max-width: 1100px;
        margin: 0 auto;
        padding: 32px 24px 64px;
    }

    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .page-title { font-size: 22px; font-weight: 800; color: var(--gray-900); margin-bottom: 4px; }
    .page-subtitle { font-size: 13px; color: var(--gray-400); font-weight: 500; }

    .header-actions { display: flex; align-items: center; gap: 10px; }

    .btn-new {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 18px; background: var(--white);
        border: 1px solid var(--gray-200); border-radius: 9px;
        font-size: 13px; font-weight: 600; color: var(--gray-700);
        text-decoration: none; cursor: pointer; transition: all .15s; box-shadow: var(--shadow);
    }
    .btn-new:hover { background: var(--gray-100); }
    .btn-new svg { width: 15px; height: 15px; }

    .btn-pdf {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 18px; background: #dc2626;
        border: 1px solid #dc2626; border-radius: 9px;
        font-size: 13px; font-weight: 600; color: #ffffff;
        text-decoration: none; cursor: pointer; transition: all .15s; box-shadow: var(--shadow);
    }
    .btn-pdf:hover { background: #b91c1c; border-color: #b91c1c; }
    .btn-pdf svg { width: 15px; height: 15px; }

    .grid-main {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 20px;
        align-items: start;
    }

    .card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    .result-card {
        border-radius: var(--radius);
        padding: 28px 24px 24px;
        text-align: center;
    }
    .result-card.risiko-tinggi { background: var(--danger-light); border: 1px solid var(--danger-border); }
    .result-card.risiko-rendah { background: var(--success-light); border: 1px solid var(--success-border); }

    .result-icon-wrap {
        width: 56px; height: 56px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
    }
    .risiko-tinggi .result-icon-wrap { background: rgba(239,68,68,.12); }
    .risiko-rendah .result-icon-wrap { background: rgba(22,163,74,.12); }
    .risiko-tinggi .result-icon-wrap svg { width: 26px; height: 26px; color: var(--danger); }
    .risiko-rendah .result-icon-wrap svg { width: 26px; height: 26px; color: var(--success); }

    .result-label { font-size: 12px; color: var(--gray-500); font-weight: 500; margin-bottom: 4px; }
    .result-user  { font-size: 15px; font-weight: 700; color: var(--gray-900); margin-bottom: 14px; }

    .badge-risk {
        display: inline-flex; align-items: center; gap: 6px;
        color: white; font-size: 12px; font-weight: 700;
        padding: 7px 16px; border-radius: 8px; letter-spacing: .3px; margin-bottom: 14px;
    }
    .risiko-tinggi .badge-risk { background: var(--danger); }
    .risiko-rendah .badge-risk { background: var(--success); }
    .badge-risk svg { width: 13px; height: 13px; }

    .result-desc { font-size: 12.5px; color: var(--gray-500); line-height: 1.6; margin-bottom: 22px; }

    .donut-wrap { position: relative; width: 100px; height: 100px; margin: 0 auto 6px; }
    .donut-svg { transform: rotate(-90deg); }
    .donut-track-danger  { fill: none; stroke: #fecaca; stroke-width: 8; }
    .donut-track-success { fill: none; stroke: #bbf7d0; stroke-width: 8; }
    .donut-fill-danger   { fill: none; stroke: var(--danger);  stroke-width: 8; stroke-linecap: round; stroke-dasharray: 251; transition: stroke-dashoffset 1s ease; }
    .donut-fill-success  { fill: none; stroke: var(--success); stroke-width: 8; stroke-linecap: round; stroke-dasharray: 251; transition: stroke-dashoffset 1s ease; }
    .donut-center { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .donut-pct-danger  { font-size: 17px; font-weight: 800; color: var(--danger);  line-height: 1; }
    .donut-pct-success { font-size: 17px; font-weight: 800; color: var(--success); line-height: 1; }
    .donut-label  { font-size: 10px; color: var(--gray-400); font-weight: 500; }
    .result-trust { font-size: 11.5px; color: var(--gray-400); font-weight: 500; margin-top: 4px; }

    .action-card { padding: 20px; margin-top: 16px; }
    .action-title { font-size: 13px; font-weight: 700; color: var(--gray-700); margin-bottom: 12px; }

    .action-btn {
        display: flex; align-items: center; gap: 10px; width: 100%;
        padding: 11px 14px; border: 1px solid var(--gray-200); border-radius: 9px;
        background: var(--white); font-size: 13px; font-weight: 600; color: var(--gray-700);
        cursor: pointer; text-decoration: none; transition: all .15s; margin-bottom: 8px;
    }
    .action-btn:last-child { margin-bottom: 0; }
    .action-btn:hover { background: var(--gray-50); border-color: var(--gray-300); }
    .action-btn svg { width: 15px; height: 15px; color: var(--gray-400); flex-shrink: 0; }
    .action-btn.pdf-btn { background: #fef2f2; border-color: #fecaca; color: #dc2626; }
    .action-btn.pdf-btn:hover { background: #fee2e2; }
    .action-btn.pdf-btn svg { color: #dc2626; }

    .right-col { display: flex; flex-direction: column; gap: 16px; }
    .section-card { padding: 24px; }

    .section-header { display: flex; align-items: center; gap: 9px; margin-bottom: 18px; }
    .section-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .icon-blue   { background: #eff6ff; color: var(--primary); }
    .icon-green  { background: #f0fdf4; color: var(--success); }
    .icon-yellow { background: #fefce8; color: #ca8a04; }
    .icon-purple { background: #f5f3ff; color: #7c3aed; }
    .section-icon svg { width: 16px; height: 16px; }
    .section-title { font-size: 15px; font-weight: 700; color: var(--gray-900); }

    .risk-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .risk-item { border: 1px solid var(--gray-200); border-radius: 10px; padding: 14px 16px; }
    .risk-item-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
    .risk-item-label { font-size: 12px; color: var(--gray-500); font-weight: 500; }
    .risk-badge { font-size: 10.5px; font-weight: 700; padding: 2px 8px; border-radius: 5px; }
    .badge-danger  { background: var(--danger-light);  color: var(--danger); }
    .badge-success { background: var(--success-light); color: var(--success); }
    .risk-value { font-size: 20px; font-weight: 800; margin-bottom: 2px; }
    .risk-value.danger  { color: var(--danger); }
    .risk-value.success { color: var(--success); }
    .risk-limit { font-size: 11px; color: var(--gray-400); font-weight: 500; }

    .data-grid   { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0; }
    .data-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0; }
    .data-item { padding: 14px 0; border-bottom: 1px solid var(--gray-100); }
    .data-item:nth-child(n+4) { border-bottom: none; }
    .data-grid-2 .data-item:nth-child(n+3) { border-bottom: none; }
    .data-label { font-size: 11.5px; color: var(--gray-400); font-weight: 500; margin-bottom: 4px; }
    .data-value { font-size: 14px; font-weight: 700; color: var(--gray-900); }

    .loan-grid-top    { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0; border-bottom: 1px solid var(--gray-100); }
    .loan-grid-bottom { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0; }
    .loan-item { padding: 14px 0; }

    /* ── Limit Rekomendasi ── */
    .limit-box {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1.5px solid var(--success-border);
        border-radius: 12px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .limit-box.risiko-tinggi-limit {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        border-color: var(--danger-border);
    }
    .limit-label { font-size: 12px; color: var(--gray-500); font-weight: 500; margin-bottom: 6px; }
    .limit-amount { font-size: 26px; font-weight: 800; color: var(--success); line-height: 1; }
    .limit-amount.danger { color: var(--danger); }
    .limit-note { font-size: 11.5px; color: var(--gray-400); margin-top: 4px; }
    .limit-skor-wrap { text-align: center; flex-shrink: 0; }
    .limit-skor-label { font-size: 11px; color: var(--gray-400); font-weight: 500; margin-bottom: 4px; }
    .limit-skor-value { font-size: 28px; font-weight: 800; line-height: 1; }
    .limit-skor-value.danger  { color: var(--danger); }
    .limit-skor-value.success { color: var(--success); }
    .limit-skor-unit { font-size: 12px; color: var(--gray-400); font-weight: 500; }

    /* ── SHAP Justifikasi ── */
    .shap-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .shap-col-title {
        font-size: 12px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .5px; margin-bottom: 10px;
    }
    .shap-col-title.danger  { color: var(--danger); }
    .shap-col-title.success { color: var(--success); }

    .shap-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 10px 12px; border-radius: 8px; margin-bottom: 8px;
        border: 1px solid;
    }
    .shap-item:last-child { margin-bottom: 0; }
    .shap-item.danger  { background: var(--danger-light);  border-color: var(--danger-border); }
    .shap-item.success { background: var(--success-light); border-color: var(--success-border); }

    .shap-faktor { font-size: 12.5px; font-weight: 600; }
    .shap-faktor.danger  { color: #991b1b; }
    .shap-faktor.success { color: #14532d; }

    .shap-bar-wrap { flex: 1; margin: 0 10px; height: 5px; background: var(--gray-200); border-radius: 3px; overflow: hidden; }
    .shap-bar { height: 100%; border-radius: 3px; }
    .shap-bar.danger  { background: var(--danger); }
    .shap-bar.success { background: var(--success); }

    .shap-empty { font-size: 12px; color: var(--gray-400); font-style: italic; padding: 8px 0; }

    @media (max-width: 768px) {
        .grid-main { grid-template-columns: 1fr; }
        .risk-grid  { grid-template-columns: 1fr; }
        .data-grid  { grid-template-columns: repeat(2, 1fr); }
        .loan-grid-top { grid-template-columns: repeat(2, 1fr); }
        .shap-grid  { grid-template-columns: 1fr; }
        .limit-box  { flex-direction: column; align-items: flex-start; }
        .page { padding: 20px 16px 48px; }
        .header-actions { flex-direction: column; align-items: flex-end; gap: 6px; }
    }
</style>

@php
    $isRisikoTinggi = $prediksi->hasil === 'Risiko Tinggi';
    $dashoffset     = 251 - (251 * $prediksi->confidence / 100);
    $shap           = $prediksi->justifikasi ?? [];
    $faktorRisiko   = $shap['faktor_risiko'] ?? [];
    $faktorAman     = $shap['faktor_aman']   ?? [];
    $maxShap        = collect(array_merge($faktorRisiko, $faktorAman))->max(fn($f) => abs($f['nilai_shap'])) ?: 1;
@endphp

<div class="page">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Hasil Prediksi Risiko Kredit</h1>
            <p class="page-subtitle">Analisis selesai pada {{ $prediksi->created_at->format('Y-m-d') }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('hasil.pdf', $prediksi->id) }}" class="btn-pdf" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export PDF
            </a>
            <a href="{{ route('prediksi') }}" class="btn-new">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Prediksi Baru
            </a>
        </div>
    </div>

    <div class="grid-main">

        {{-- ── LEFT PANEL ── --}}
        <div>
            <div class="result-card {{ $isRisikoTinggi ? 'risiko-tinggi' : 'risiko-rendah' }}">
                <div class="result-icon-wrap">
                    @if($isRisikoTinggi)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @endif
                </div>

                <p class="result-label">Hasil Prediksi untuk</p>
                <p class="result-user">{{ $prediksi->nama }}</p>

                <div class="badge-risk">
                    @if($isRisikoTinggi)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    RISIKO TINGGI
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    RISIKO RENDAH
                    @endif
                </div>

                <p class="result-desc">
                    @if($isRisikoTinggi)
                        Pemohon ini memiliki probabilitas gagal bayar yang cukup tinggi. Perlu pertimbangan lebih lanjut.
                    @else
                        Pemohon ini memiliki profil kredit yang baik dan kemungkinan gagal bayar rendah.
                    @endif
                </p>

                <div class="donut-wrap">
                    <svg class="donut-svg" width="100" height="100" viewBox="0 0 100 100">
                        @if($isRisikoTinggi)
                        <circle class="donut-track-danger" cx="50" cy="50" r="40"/>
                        <circle class="donut-fill-danger"  cx="50" cy="50" r="40" style="stroke-dashoffset: {{ $dashoffset }}"/>
                        @else
                        <circle class="donut-track-success" cx="50" cy="50" r="40"/>
                        <circle class="donut-fill-success"  cx="50" cy="50" r="40" style="stroke-dashoffset: {{ $dashoffset }}"/>
                        @endif
                    </svg>
                    <div class="donut-center">
                        <span class="{{ $isRisikoTinggi ? 'donut-pct-danger' : 'donut-pct-success' }}">
                            {{ number_format($prediksi->confidence, 1) }}%
                        </span>
                        <span class="donut-label">Confidence</span>
                    </div>
                </div>
                <p class="result-trust">Tingkat kepercayaan model</p>
            </div>

            {{-- Action Card --}}
            <div class="card action-card">
                <p class="action-title">Tindakan</p>
                <a href="{{ route('hasil.pdf', $prediksi->id) }}" class="action-btn pdf-btn" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export PDF
                </a>
                <a href="{{ route('riwayat') }}" class="action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan ke Riwayat
                </a>
                <a href="{{ route('prediksi') }}" class="action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Prediksi Data Baru
                </a>
                <a href="{{ route('riwayat') }}" class="action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Lihat Riwayat
                </a>
            </div>
        </div>

        {{-- ── RIGHT PANEL ── --}}
        <div class="right-col">

            {{-- ══ BARU: Limit Rekomendasi ══ --}}
            @if($prediksi->limit_rekomendasi !== null)
            <div class="card section-card">
                <div class="section-header">
                    <div class="section-icon icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="section-title">Limit Kredit Rekomendasi</span>
                </div>

                <div class="limit-box {{ $isRisikoTinggi ? 'risiko-tinggi-limit' : '' }}">
                    <div>
                        <div class="limit-label">Maksimal kredit yang dapat diberikan</div>
                        <div class="limit-amount {{ $isRisikoTinggi ? 'danger' : '' }}">
                            Rp{{ number_format($prediksi->limit_rekomendasi, 0, ',', '.') }}
                        </div>
                        <div class="limit-note">
                            Berdasarkan kapasitas bayar dan profil risiko nasabah
                        </div>
                    </div>
                    @if($prediksi->skor_risiko !== null)
                    <div class="limit-skor-wrap">
                        <div class="limit-skor-label">Skor Risiko</div>
                        <div class="limit-skor-value {{ $prediksi->skor_risiko >= 50 ? 'danger' : 'success' }}">
                            {{ number_format($prediksi->skor_risiko, 1) }}
                        </div>
                        <div class="limit-skor-unit">/ 100</div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- ══ BARU: Justifikasi SHAP ══ --}}
            @if(!empty($faktorRisiko) || !empty($faktorAman))
            <div class="card section-card">
                <div class="section-header">
                    <div class="section-icon icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <span class="section-title">Justifikasi Keputusan (SHAP)</span>
                </div>

                <div class="shap-grid">
                    {{-- Faktor Risiko --}}
                    <div>
                        <div class="shap-col-title danger">⬆ Mendorong Risiko</div>
                        @forelse($faktorRisiko as $f)
                        @php $pct = round(abs($f['nilai_shap']) / $maxShap * 100); @endphp
                        <div class="shap-item danger">
                            <span class="shap-faktor danger">{{ $f['faktor'] }}</span>
                            <div class="shap-bar-wrap">
                                <div class="shap-bar danger" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                        @empty
                        <p class="shap-empty">Tidak ada faktor risiko signifikan</p>
                        @endforelse
                    </div>

                    {{-- Faktor Aman --}}
                    <div>
                        <div class="shap-col-title success">⬇ Menurunkan Risiko</div>
                        @forelse($faktorAman as $f)
                        @php $pct = round(abs($f['nilai_shap']) / $maxShap * 100); @endphp
                        <div class="shap-item success">
                            <span class="shap-faktor success">{{ $f['faktor'] }}</span>
                            <div class="shap-bar-wrap">
                                <div class="shap-bar success" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                        @empty
                        <p class="shap-empty">Tidak ada faktor aman signifikan</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @endif

            {{-- Faktor Risiko (rule-based lama) --}}
            <div class="card section-card">
                <div class="section-header">
                    <div class="section-icon icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <span class="section-title">Indikator Risiko</span>
                </div>
                <div class="risk-grid">
                    @php $rasioAman = $prediksi->rasio_pinjaman <= 35; @endphp
                    <div class="risk-item" style="background:{{ $rasioAman ? 'var(--success-light)' : 'var(--danger-light)' }}; border-color:{{ $rasioAman ? 'var(--success-border)' : 'var(--danger-border)' }};">
                        <div class="risk-item-header">
                            <span class="risk-item-label">Rasio Pinjaman/Pendapatan</span>
                            <span class="risk-badge {{ $rasioAman ? 'badge-success' : 'badge-danger' }}">{{ $rasioAman ? 'Aman' : 'Perhatian' }}</span>
                        </div>
                        <div class="risk-value {{ $rasioAman ? 'success' : 'danger' }}">{{ $prediksi->rasio_pinjaman }}%</div>
                        <div class="risk-limit">Batas: 35.0%</div>
                    </div>

                    @php $sukuAman = $prediksi->suku_bunga <= 15; @endphp
                    <div class="risk-item" style="background:{{ $sukuAman ? 'var(--success-light)' : 'var(--danger-light)' }}; border-color:{{ $sukuAman ? 'var(--success-border)' : 'var(--danger-border)' }};">
                        <div class="risk-item-header">
                            <span class="risk-item-label">Suku Bunga</span>
                            <span class="risk-badge {{ $sukuAman ? 'badge-success' : 'badge-danger' }}">{{ $sukuAman ? 'Aman' : 'Perhatian' }}</span>
                        </div>
                        <div class="risk-value {{ $sukuAman ? 'success' : 'danger' }}">{{ $prediksi->suku_bunga }}%</div>
                        <div class="risk-limit">Batas: 15%</div>
                    </div>

                    @php $riwayatAman = $prediksi->lama_riwayat >= 5; @endphp
                    <div class="risk-item" style="background:{{ $riwayatAman ? 'var(--success-light)' : 'var(--danger-light)' }}; border-color:{{ $riwayatAman ? 'var(--success-border)' : 'var(--danger-border)' }};">
                        <div class="risk-item-header">
                            <span class="risk-item-label">Lama Riwayat Kredit</span>
                            <span class="risk-badge {{ $riwayatAman ? 'badge-success' : 'badge-danger' }}">{{ $riwayatAman ? 'Aman' : 'Perhatian' }}</span>
                        </div>
                        <div class="risk-value {{ $riwayatAman ? 'success' : 'danger' }}">{{ $prediksi->lama_riwayat }} thn</div>
                        <div class="risk-limit">Batas: 5 thn</div>
                    </div>

                    @php $kerjaAman = $prediksi->lama_kerja >= 3; @endphp
                    <div class="risk-item" style="background:{{ $kerjaAman ? 'var(--success-light)' : 'var(--danger-light)' }}; border-color:{{ $kerjaAman ? 'var(--success-border)' : 'var(--danger-border)' }};">
                        <div class="risk-item-header">
                            <span class="risk-item-label">Lama Kerja</span>
                            <span class="risk-badge {{ $kerjaAman ? 'badge-success' : 'badge-danger' }}">{{ $kerjaAman ? 'Aman' : 'Perhatian' }}</span>
                        </div>
                        <div class="risk-value {{ $kerjaAman ? 'success' : 'danger' }}">{{ $prediksi->lama_kerja }} thn</div>
                        <div class="risk-limit">Batas: 3 thn</div>
                    </div>
                </div>
            </div>

            {{-- Data Pribadi --}}
            <div class="card section-card">
                <div class="section-header">
                    <div class="section-icon icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="section-title">Data Pribadi</span>
                </div>
                <div class="data-grid">
                    <div class="data-item">
                        <div class="data-label">Nama</div>
                        <div class="data-value">{{ $prediksi->nama }}</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Umur</div>
                        <div class="data-value">{{ $prediksi->umur }} tahun</div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Pendapatan</div>
                        <div class="data-value">Rp{{ number_format($prediksi->pendapatan, 0, ',', '.') }},-</div>
                    </div>
                </div>
                <div class="data-grid-2" style="margin-top:4px;">
                    <div class="data-item" style="border-bottom:none;">
                        <div class="data-label">Lama Kerja</div>
                        <div class="data-value">{{ $prediksi->lama_kerja }} tahun</div>
                    </div>
                    <div class="data-item" style="border-bottom:none;">
                        <div class="data-label">Status Rumah</div>
                        <div class="data-value">{{ strtoupper($prediksi->status_rumah) }}</div>
                    </div>
                </div>
            </div>

            {{-- Data Pinjaman --}}
            <div class="card section-card">
                <div class="section-header">
                    <div class="section-icon icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="section-title">Data Pinjaman</span>
                </div>
                <div class="loan-grid-top">
                    <div class="loan-item">
                        <div class="data-label">Jumlah Pinjaman</div>
                        <div class="data-value">Rp{{ number_format($prediksi->jumlah_pinjaman, 0, ',', '.') }}</div>
                    </div>
                    <div class="loan-item">
                        <div class="data-label">Suku Bunga</div>
                        <div class="data-value">{{ $prediksi->suku_bunga }}%</div>
                    </div>
                    <div class="loan-item">
                        <div class="data-label">% dari Pendapatan</div>
                        <div class="data-value">{{ $prediksi->rasio_pinjaman }}%</div>
                    </div>
                </div>
                <div class="loan-grid-bottom">
                    <div class="loan-item">
                        <div class="data-label">Tujuan</div>
                        <div class="data-value">{{ strtoupper($prediksi->tujuan) }}</div>
                    </div>
                    <div class="loan-item">
                        <div class="data-label">Grade</div>
                        <div class="data-value">{{ $prediksi->grade }}</div>
                    </div>
                </div>
            </div>

            {{-- Riwayat Kredit --}}
            <div class="card section-card">
                <div class="section-header">
                    <div class="section-icon icon-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <span class="section-title">Riwayat Kredit</span>
                </div>
                <div class="data-grid-2">
                    <div class="data-item" style="border-bottom:none;">
                        <div class="data-label">Riwayat Default</div>
                        <div class="data-value">{{ $prediksi->riwayat_default }}</div>
                    </div>
                    <div class="data-item" style="border-bottom:none;">
                        <div class="data-label">Lama Riwayat Kredit</div>
                        <div class="data-value">{{ $prediksi->lama_riwayat }} tahun</div>
                    </div>
                </div>
            </div>

        </div>{{-- end right-col --}}
    </div>{{-- end grid-main --}}
</div>{{-- end page --}}

@endsection