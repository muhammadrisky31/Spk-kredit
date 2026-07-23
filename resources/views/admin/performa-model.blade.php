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

    .bar-wrap { margin-bottom: 16px; }

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

    .bar-fill.green  { background: #16a34a; }
    .bar-fill.red    { background: #ef4444; }
    .bar-fill.blue   { background: #2563eb; }
    .bar-fill.orange { background: #f59e0b; }
    .bar-fill.purple { background: #7c3aed; }

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

    /* Confusion Matrix */
    .cm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        max-width: 400px;
        margin: 0 auto;
    }

    .cm-cell {
        border-radius: 12px;
        padding: 20px;
        text-align: center;
    }

    .cm-cell .cm-value { font-size: 32px; font-weight: 800; }
    .cm-cell .cm-label { font-size: 12px; font-weight: 600; margin-top: 4px; }
    .cm-cell .cm-desc  { font-size: 11px; color: #6b7280; margin-top: 2px; }

    .cm-tp { background: #dcfce7; border: 2px solid #16a34a; }
    .cm-tp .cm-value { color: #16a34a; }
    .cm-tp .cm-label { color: #15803d; }

    .cm-tn { background: #dbeafe; border: 2px solid #2563eb; }
    .cm-tn .cm-value { color: #2563eb; }
    .cm-tn .cm-label { color: #1d4ed8; }

    .cm-fp { background: #fef9c3; border: 2px solid #ca8a04; }
    .cm-fp .cm-value { color: #ca8a04; }
    .cm-fp .cm-label { color: #a16207; }

    .cm-fn { background: #fee2e2; border: 2px solid #ef4444; }
    .cm-fn .cm-value { color: #ef4444; }
    .cm-fn .cm-label { color: #dc2626; }

    .cm-wrapper {
        display: flex;
        gap: 40px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .cm-legend {
        flex: 1;
        min-width: 200px;
    }

    .cm-legend-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        font-size: 13px;
        color: #374151;
    }

    .cm-dot {
        width: 12px;
        height: 12px;
        border-radius: 3px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    /* Metric cards */
    .metric-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .metric-card {
        border-radius: 10px;
        padding: 16px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .metric-card .m-label { font-size: 11px; color: #6b7280; font-weight: 500; margin-bottom: 4px; }
    .metric-card .m-class { font-size: 10px; color: #9ca3af; margin-bottom: 8px; }
    .metric-card .m-value { font-size: 22px; font-weight: 800; }

    @media (max-width: 1024px) {
        .stats-grid   { grid-template-columns: repeat(2, 1fr); }
        .model-params { grid-template-columns: repeat(2, 1fr); }
        .metric-grid  { grid-template-columns: repeat(2, 1fr); }
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

{{-- Feature Importance --}}
<div class="section-card">
    <div class="section-title">🔍 Feature Importance — Fitur Paling Berpengaruh</div>

    @php
        $features = [
            ['name' => 'Rasio Pinjaman/Pendapatan', 'value' => 26.07, 'color' => 'blue'],
            ['name' => 'Suku Bunga',                'value' => 22.30, 'color' => 'blue'],
            ['name' => 'Pendapatan',                'value' => 14.83, 'color' => 'blue'],
            ['name' => 'Grade Pinjaman',            'value' => 9.00,  'color' => 'orange'],
            ['name' => 'Kepemilikan Rumah',         'value' => 8.86,  'color' => 'orange'],
            ['name' => 'Tujuan Pinjaman',           'value' => 7.52,  'color' => 'orange'],
            ['name' => 'Lama Kerja',                'value' => 4.37,  'color' => 'purple'],
            ['name' => 'Jumlah Pinjaman',           'value' => 4.15,  'color' => 'purple'],
            ['name' => 'Riwayat Gagal Bayar',       'value' => 1.33,  'color' => 'purple'],
            ['name' => 'Usia',                      'value' => 0.80,  'color' => 'purple'],
            ['name' => 'Lama Riwayat Kredit',       'value' => 0.76,  'color' => 'purple'],
        ];
    @endphp

    @foreach($features as $f)
    <div class="bar-wrap">
        <div class="bar-label">
            <span>{{ $f['name'] }}</span>
            <span>{{ $f['value'] }}%</span>
        </div>
        <div class="bar-track">
            <div class="bar-fill {{ $f['color'] }}" style="width: {{ $f['value'] * 3 }}%"></div>
        </div>
    </div>
    @endforeach

    <p style="font-size:12px; color:#9ca3af; margin-top:8px;">
        * Nilai feature importance menunjukkan seberapa besar kontribusi setiap fitur dalam keputusan model Random Forest
    </p>
</div>

{{-- Evaluasi Model --}}
<div class="section-card">
    <div class="section-title">📈 Evaluasi Model — Precision, Recall, F1-Score</div>

    <div class="metric-grid">
        <div class="metric-card" style="background:#f0fdf4;">
            <div class="m-label">Precision</div>
            <div class="m-class">Kelas Aman</div>
            <div class="m-value" style="color:#16a34a;">84%</div>
        </div>
        <div class="metric-card" style="background:#f0fdf4;">
            <div class="m-label">Recall</div>
            <div class="m-class">Kelas Aman</div>
            <div class="m-value" style="color:#16a34a;">92%</div>
        </div>
        <div class="metric-card" style="background:#fef2f2;">
            <div class="m-label">Precision</div>
            <div class="m-class">Kelas Berisiko</div>
            <div class="m-value" style="color:#ef4444;">91%</div>
        </div>
        <div class="metric-card" style="background:#fef2f2;">
            <div class="m-label">Recall</div>
            <div class="m-class">Kelas Berisiko</div>
            <div class="m-value" style="color:#ef4444;">82%</div>
        </div>
    </div>

    {{-- Confusion Matrix --}}
    <div class="section-title" style="margin-top:8px;">Confusion Matrix</div>
    <div class="cm-wrapper">
        <div>
            <p style="font-size:12px; color:#6b7280; text-align:center; margin-bottom:8px;">
                Prediksi →
            </p>
            <div class="cm-grid">
                <div class="cm-cell cm-tp">
                    <div class="cm-value">4,596</div>
                    <div class="cm-label">True Positive</div>
                    <div class="cm-desc">Berisiko → Berisiko ✓</div>
                </div>
                <div class="cm-cell cm-fp">
                    <div class="cm-value">400</div>
                    <div class="cm-label">False Positive</div>
                    <div class="cm-desc">Aman → Berisiko ✗</div>
                </div>
                <div class="cm-cell cm-fn">
                    <div class="cm-value">896</div>
                    <div class="cm-label">False Negative</div>
                    <div class="cm-desc">Berisiko → Aman ✗</div>
                </div>
                <div class="cm-cell cm-tn">
                    <div class="cm-value">4,596</div>
                    <div class="cm-label">True Negative</div>
                    <div class="cm-desc">Aman → Aman ✓</div>
                </div>
            </div>
        </div>

        <div class="cm-legend">
            <p style="font-size:13px; font-weight:700; color:#111827; margin-bottom:12px;">Keterangan:</p>
            <div class="cm-legend-item">
                <div class="cm-dot" style="background:#16a34a;"></div>
                <div><strong>True Positive</strong> — Model memprediksi Berisiko dan memang benar Berisiko</div>
            </div>
            <div class="cm-legend-item">
                <div class="cm-dot" style="background:#2563eb;"></div>
                <div><strong>True Negative</strong> — Model memprediksi Aman dan memang benar Aman</div>
            </div>
            <div class="cm-legend-item">
                <div class="cm-dot" style="background:#ca8a04;"></div>
                <div><strong>False Positive</strong> — Model memprediksi Berisiko padahal sebenarnya Aman</div>
            </div>
            <div class="cm-legend-item">
                <div class="cm-dot" style="background:#ef4444;"></div>
                <div><strong>False Negative</strong> — Model memprediksi Aman padahal sebenarnya Berisiko</div>
            </div>
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