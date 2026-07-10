@extends('admin.layouts.app')

@section('page-title', 'Performa Model')
@section('page-sub', 'Statistik performa model Random Forest')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    .stat-label { font-size: 12px; color: #6b7280; font-weight: 500; margin-bottom: 8px; }
    .stat-value { font-size: 28px; font-weight: 800; color: #111827; line-height: 1; }
    .stat-sub   { font-size: 12px; color: #9ca3af; margin-top: 4px; }

    .section-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        padding: 24px;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 15px; font-weight: 700; color: #111827;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f3f4f6;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .info-item {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 16px;
    }

    .info-item .label { font-size: 12px; color: #6b7280; font-weight: 500; margin-bottom: 6px; }
    .info-item .value { font-size: 18px; font-weight: 800; color: #111827; }

    .bar-wrap {
        margin-bottom: 16px;
    }

    .bar-label {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .bar-track {
        height: 10px;
        background: #f3f4f6;
        border-radius: 99px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        border-radius: 99px;
        transition: width 1s ease;
    }

    .bar-fill.green { background: #16a34a; }
    .bar-fill.red   { background: #ef4444; }
    .bar-fill.blue  { background: #2563eb; }

    .model-params {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .param-item {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 14px 16px;
    }

    .param-item .param-label { font-size: 11px; color: #6b7280; font-weight: 500; margin-bottom: 4px; }
    .param-item .param-value { font-size: 16px; font-weight: 800; color: #2563eb; }

    @media (max-width: 1024px) {
        .stats-grid    { grid-template-columns: repeat(2, 1fr); }
        .model-params  { grid-template-columns: repeat(2, 1fr); }
    }
</style>

{{-- Statistik Utama --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Akurasi Model</div>
        <div class="stat-value" style="color:#2563eb;">86.94%</div>
        <div class="stat-sub">Random Forest Classifier</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Rata-rata Confidence</div>
        <div class="stat-value">{{ $avgConfidence }}%</div>
        <div class="stat-sub">Dari {{ $totalPrediksi }} prediksi</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Rata-rata Limit Rekomendasi</div>
        <div class="stat-value" style="font-size:20px;">
            Rp{{ number_format($avgLimit, 0, ',', '.') }}
        </div>
        <div class="stat-sub">Risk-Adjusted Limit</div>
    </div>
</div>

{{-- Distribusi Hasil --}}
<div class="section-card">
    <div class="section-title">Distribusi Hasil Prediksi</div>

    <div class="bar-wrap">
        <div class="bar-label">
            <span>✅ Risiko Rendah</span>
            <span>{{ $risikoRendah }} ({{ $persenRendah }}%)</span>
        </div>
        <div class="bar-track">
            <div class="bar-fill green" style="width: {{ $persenRendah }}%"></div>
        </div>
    </div>

    <div class="bar-wrap">
        <div class="bar-label">
            <span>⚠️ Risiko Tinggi</span>
            <span>{{ $risikoTinggi }} ({{ $persenTinggi }}%)</span>
        </div>
        <div class="bar-track">
            <div class="bar-fill red" style="width: {{ $persenTinggi }}%"></div>
        </div>
    </div>

    <div class="bar-wrap" style="margin-bottom:0;">
        <div class="bar-label">
            <span>📊 Rata-rata Skor Risiko</span>
            <span>{{ $avgSkorRisiko }}/100</span>
        </div>
        <div class="bar-track">
            <div class="bar-fill blue" style="width: {{ $avgSkorRisiko }}%"></div>
        </div>
    </div>
</div>

{{-- Parameter Model --}}
<div class="section-card">
    <div class="section-title">Parameter Model Random Forest</div>
    <div class="model-params">
        <div class="param-item">
            <div class="param-label">Algoritma</div>
            <div class="param-value">Random Forest</div>
        </div>
        <div class="param-item">
            <div class="param-label">Jumlah Pohon (n_estimators)</div>
            <div class="param-value">100</div>
        </div>
        <div class="param-item">
            <div class="param-label">Max Depth</div>
            <div class="param-value">10</div>
        </div>
        <div class="param-item">
            <div class="param-label">Min Samples Split</div>
            <div class="param-value">10</div>
        </div>
        <div class="param-item">
            <div class="param-label">Balancing Data</div>
            <div class="param-value">SMOTE</div>
        </div>
        <div class="param-item">
            <div class="param-label">Split Data</div>
            <div class="param-value">80% / 20%</div>
        </div>
        <div class="param-item">
            <div class="param-label">Jumlah Fitur</div>
            <div class="param-value">11 Fitur</div>
        </div>
        <div class="param-item">
            <div class="param-label">Total Data Training</div>
            <div class="param-value">31.679</div>
        </div>
        <div class="param-item">
            <div class="param-label">Akurasi</div>
            <div class="param-value">86.94%</div>
        </div>
    </div>
</div>

{{-- Info Dataset --}}
<div class="section-card" style="margin-bottom:0;">
    <div class="section-title">Informasi Dataset & Preprocessing</div>
    <div class="info-grid">
        <div class="info-item">
            <div class="label">Dataset Awal</div>
            <div class="value">32.581 baris</div>
        </div>
        <div class="info-item">
            <div class="label">Setelah Cleaning Outlier</div>
            <div class="value">31.679 baris</div>
        </div>
        <div class="info-item">
            <div class="label">Sebelum SMOTE</div>
            <div class="value">24.854 vs 6.825</div>
        </div>
        <div class="info-item">
            <div class="label">Setelah SMOTE</div>
            <div class="value">24.854 vs 24.854</div>
        </div>
    </div>
</div>
@endsection