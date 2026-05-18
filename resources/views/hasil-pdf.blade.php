<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Prediksi - {{ $prediksi->nama }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #111827;
            background: #ffffff;
            padding: 28px 32px;
        }

        /* ── HEADER ── */
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; border-bottom: 2.5px solid #2563eb; padding-bottom: 12px; }
        .header-title { font-size: 17px; font-weight: 800; color: #111827; }
        .header-sub   { font-size: 10px; color: #6b7280; margin-top: 3px; }
        .header-date  { font-size: 10px; color: #6b7280; text-align: right; line-height: 1.7; }

        /* ── BANNER ── */
        .banner { width: 100%; border-collapse: collapse; border-radius: 8px; margin-bottom: 16px; }
        .banner-danger  { background: #fef2f2; border: 1.5px solid #fecaca; }
        .banner-success { background: #f0fdf4; border: 1.5px solid #bbf7d0; }
        .banner td { padding: 14px 18px; vertical-align: middle; }

        .result-label { font-size: 10px; color: #6b7280; margin-bottom: 3px; }
        .result-name  { font-size: 15px; font-weight: 800; color: #111827; margin-bottom: 6px; }

        .badge { display: inline-block; padding: 5px 14px; border-radius: 6px; font-size: 11px; font-weight: 800; color: #fff; letter-spacing: .4px; }
        .badge-danger  { background: #ef4444; }
        .badge-success { background: #16a34a; }

        .result-desc { font-size: 10px; color: #6b7280; margin-top: 6px; line-height: 1.5; }

        .conf-val   { font-size: 22px; font-weight: 800; text-align: center; }
        .conf-label { font-size: 10px; color: #6b7280; text-align: center; margin-top: 2px; }
        .conf-danger  { color: #ef4444; }
        .conf-success { color: #16a34a; }

        /* ── LIMIT BOX ── */
        .limit-box { width: 100%; border-collapse: collapse; margin-bottom: 16px; border-radius: 8px; }
        .limit-success { background: #f0fdf4; border: 1.5px solid #bbf7d0; }
        .limit-danger  { background: #fef2f2; border: 1.5px solid #fecaca; }
        .limit-box td  { padding: 12px 18px; vertical-align: middle; }
        .limit-label   { font-size: 10px; color: #6b7280; margin-bottom: 4px; }
        .limit-amount  { font-size: 20px; font-weight: 800; }
        .limit-amount-success { color: #16a34a; }
        .limit-amount-danger  { color: #ef4444; }
        .limit-note    { font-size: 10px; color: #9ca3af; margin-top: 3px; }
        .skor-label    { font-size: 10px; color: #6b7280; text-align: center; margin-bottom: 2px; }
        .skor-val      { font-size: 22px; font-weight: 800; text-align: center; }
        .skor-unit     { font-size: 10px; color: #9ca3af; text-align: center; }

        /* ── SECTION TITLE ── */
        .section-title {
            font-size: 11px;
            font-weight: 800;
            color: #374151;
            background: #f3f4f6;
            padding: 7px 12px;
            border-left: 3px solid #2563eb;
            margin-bottom: 8px;
        }

        /* ── RISK TABLE ── */
        .risk-table { width: 100%; border-collapse: separate; border-spacing: 6px 0; margin-bottom: 14px; }
        .risk-cell  { width: 25%; border-radius: 7px; padding: 10px 12px; vertical-align: top; }
        .risk-cell-success { background: #f0fdf4; border: 1px solid #bbf7d0; }
        .risk-cell-danger  { background: #fef2f2; border: 1px solid #fecaca; }
        .rc-label  { font-size: 9.5px; color: #6b7280; margin-bottom: 3px; }
        .rc-badge  { display: inline-block; font-size: 9px; font-weight: 700; padding: 1px 6px; border-radius: 4px; margin-bottom: 4px; }
        .rc-badge-success { background: #dcfce7; color: #16a34a; }
        .rc-badge-danger  { background: #fee2e2; color: #ef4444; }
        .rc-value  { font-size: 17px; font-weight: 800; }
        .rc-value-success { color: #16a34a; }
        .rc-value-danger  { color: #ef4444; }
        .rc-limit  { font-size: 9.5px; color: #9ca3af; margin-top: 2px; }

        /* ── DATA TABLE ── */
        .data-wrap { width: 100%; border-collapse: separate; border-spacing: 8px 0; margin-bottom: 14px; }
        .data-wrap td { vertical-align: top; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table tr td { padding: 7px 10px; border-bottom: 1px solid #f3f4f6; }
        .data-table tr:last-child td { border-bottom: none; }
        .dt-lbl { font-size: 10px; color: #9ca3af; font-weight: 500; width: 45%; }
        .dt-val { font-size: 11px; font-weight: 700; color: #111827; }

        /* ── FOOTER ── */
        .footer-table { width: 100%; border-collapse: collapse; margin-top: 24px; border-top: 1px solid #e5e7eb; padding-top: 8px; }
        .footer-table td { font-size: 9.5px; color: #9ca3af; padding-top: 8px; }
    </style>
</head>
<body>

@php
    $isRisikoTinggi = $prediksi->hasil === 'Risiko Tinggi';
    $rasioAman   = $prediksi->rasio_pinjaman <= 35;
    $sukuAman    = $prediksi->suku_bunga <= 15;
    $riwayatAman = $prediksi->lama_riwayat >= 5;
    $kerjaAman   = $prediksi->lama_kerja >= 3;
@endphp

{{-- HEADER --}}
<table class="header-table">
    <tr>
        <td style="padding-bottom:12px;">
            <div class="header-title">Hasil Prediksi Risiko Kredit</div>
            <div class="header-sub">SPK Kredit &mdash; Sistem Pendukung Keputusan</div>
        </td>
        <td style="padding-bottom:12px;">
            <div class="header-date">
                Dicetak: {{ now()->format('d M Y, H:i') }}<br>
                ID Prediksi: #{{ $prediksi->id }}
            </div>
        </td>
    </tr>
</table>

{{-- RESULT BANNER --}}
<table class="banner {{ $isRisikoTinggi ? 'banner-danger' : 'banner-success' }}">
    <tr>
        <td style="width:75%;">
            <div class="result-label">Hasil Prediksi untuk</div>
            <div class="result-name">{{ $prediksi->nama }}</div>
            <span class="badge {{ $isRisikoTinggi ? 'badge-danger' : 'badge-success' }}">
                {{ $isRisikoTinggi ? 'RISIKO TINGGI' : 'RISIKO RENDAH' }}
            </span>
            <div class="result-desc">
                @if($isRisikoTinggi)
                    Pemohon ini memiliki probabilitas gagal bayar yang cukup tinggi. Perlu pertimbangan lebih lanjut.
                @else
                    Pemohon ini memiliki profil kredit yang baik dan kemungkinan gagal bayar rendah.
                @endif
            </div>
        </td>
        <td style="width:25%; text-align:center; border-left: 1px solid {{ $isRisikoTinggi ? '#fecaca' : '#bbf7d0' }};">
            <div class="conf-val {{ $isRisikoTinggi ? 'conf-danger' : 'conf-success' }}">
                {{ number_format($prediksi->confidence, 1) }}%
            </div>
            <div class="conf-label">Tingkat Confidence</div>
        </td>
    </tr>
</table>

{{-- LIMIT KREDIT REKOMENDASI --}}
@if($prediksi->limit_rekomendasi !== null)
<div class="section-title">Limit Kredit Rekomendasi</div>
<table class="limit-box {{ $isRisikoTinggi ? 'limit-danger' : 'limit-success' }}">
    <tr>
        <td style="width:75%;">
            <div class="limit-label">Maksimal kredit yang dapat diberikan</div>
            <div class="limit-amount {{ $isRisikoTinggi ? 'limit-amount-danger' : 'limit-amount-success' }}">
                Rp{{ number_format($prediksi->limit_rekomendasi, 0, ',', '.') }}
            </div>
            <div class="limit-note">Berdasarkan kapasitas bayar dan profil risiko nasabah</div>
        </td>
        @if($prediksi->skor_risiko !== null)
        <td style="width:25%; text-align:center; border-left: 1px solid {{ $isRisikoTinggi ? '#fecaca' : '#bbf7d0' }};">
            <div class="skor-label">Skor Risiko</div>
            <div class="skor-val {{ $prediksi->skor_risiko >= 50 ? 'conf-danger' : 'conf-success' }}">
                {{ number_format($prediksi->skor_risiko, 1) }}
            </div>
            <div class="skor-unit">/ 100</div>
        </td>
        @endif
    </tr>
</table>
@endif

{{-- FAKTOR RISIKO --}}
<div class="section-title">Indikator Risiko</div>
<table class="risk-table">
    <tr>
        <td class="risk-cell {{ $rasioAman ? 'risk-cell-success' : 'risk-cell-danger' }}">
            <div class="rc-label">Rasio Pinjaman/Pendapatan</div>
            <span class="rc-badge {{ $rasioAman ? 'rc-badge-success' : 'rc-badge-danger' }}">{{ $rasioAman ? 'Aman' : 'Perhatian' }}</span>
            <div class="rc-value {{ $rasioAman ? 'rc-value-success' : 'rc-value-danger' }}">{{ $prediksi->rasio_pinjaman }}%</div>
            <div class="rc-limit">Batas: 35%</div>
        </td>
        <td class="risk-cell {{ $sukuAman ? 'risk-cell-success' : 'risk-cell-danger' }}">
            <div class="rc-label">Suku Bunga</div>
            <span class="rc-badge {{ $sukuAman ? 'rc-badge-success' : 'rc-badge-danger' }}">{{ $sukuAman ? 'Aman' : 'Perhatian' }}</span>
            <div class="rc-value {{ $sukuAman ? 'rc-value-success' : 'rc-value-danger' }}">{{ $prediksi->suku_bunga }}%</div>
            <div class="rc-limit">Batas: 15%</div>
        </td>
        <td class="risk-cell {{ $riwayatAman ? 'risk-cell-success' : 'risk-cell-danger' }}">
            <div class="rc-label">Lama Riwayat Kredit</div>
            <span class="rc-badge {{ $riwayatAman ? 'rc-badge-success' : 'rc-badge-danger' }}">{{ $riwayatAman ? 'Aman' : 'Perhatian' }}</span>
            <div class="rc-value {{ $riwayatAman ? 'rc-value-success' : 'rc-value-danger' }}">{{ $prediksi->lama_riwayat }} thn</div>
            <div class="rc-limit">Batas: 5 thn</div>
        </td>
        <td class="risk-cell {{ $kerjaAman ? 'risk-cell-success' : 'risk-cell-danger' }}">
            <div class="rc-label">Lama Kerja</div>
            <span class="rc-badge {{ $kerjaAman ? 'rc-badge-success' : 'rc-badge-danger' }}">{{ $kerjaAman ? 'Aman' : 'Perhatian' }}</span>
            <div class="rc-value {{ $kerjaAman ? 'rc-value-success' : 'rc-value-danger' }}">{{ $prediksi->lama_kerja }} thn</div>
            <div class="rc-limit">Batas: 3 thn</div>
        </td>
    </tr>
</table>

{{-- DATA PRIBADI & PINJAMAN --}}
<table class="data-wrap">
    <tr>
        <td style="width:50%;">
            <div class="section-title">Data Pribadi</div>
            <table class="data-table">
                <tr><td class="dt-lbl">Nama</td><td class="dt-val">{{ $prediksi->nama }}</td></tr>
                <tr><td class="dt-lbl">Umur</td><td class="dt-val">{{ $prediksi->umur }} tahun</td></tr>
                <tr><td class="dt-lbl">Pendapatan</td><td class="dt-val">Rp{{ number_format($prediksi->pendapatan, 0, ',', '.') }},-</td></tr>
                <tr><td class="dt-lbl">Lama Kerja</td><td class="dt-val">{{ $prediksi->lama_kerja }} tahun</td></tr>
                <tr><td class="dt-lbl">Status Rumah</td><td class="dt-val">{{ strtoupper($prediksi->status_rumah) }}</td></tr>
            </table>
        </td>
        <td style="width:50%;">
            <div class="section-title">Data Pinjaman</div>
            <table class="data-table">
                <tr><td class="dt-lbl">Jumlah Pinjaman</td><td class="dt-val">Rp{{ number_format($prediksi->jumlah_pinjaman, 0, ',', '.') }}</td></tr>
                <tr><td class="dt-lbl">Suku Bunga</td><td class="dt-val">{{ $prediksi->suku_bunga }}%</td></tr>
                <tr><td class="dt-lbl">% dari Pendapatan</td><td class="dt-val">{{ $prediksi->rasio_pinjaman }}%</td></tr>
                <tr><td class="dt-lbl">Tujuan</td><td class="dt-val">{{ strtoupper($prediksi->tujuan) }}</td></tr>
                <tr><td class="dt-lbl">Grade</td><td class="dt-val">{{ $prediksi->grade }}</td></tr>
            </table>
        </td>
    </tr>
</table>

{{-- RIWAYAT KREDIT --}}
<div class="section-title">Riwayat Kredit</div>
<table class="data-table" style="margin-bottom:16px;">
    <tr><td class="dt-lbl">Riwayat Default</td><td class="dt-val">{{ $prediksi->riwayat_default }}</td></tr>
    <tr><td class="dt-lbl">Lama Riwayat Kredit</td><td class="dt-val">{{ $prediksi->lama_riwayat }} tahun</td></tr>
</table>

{{-- FOOTER --}}
<table class="footer-table">
    <tr>
        <td>SPK Kredit &mdash; Dokumen ini digenerate otomatis oleh sistem</td>
        <td style="text-align:right;">{{ now()->format('d/m/Y H:i') }}</td>
    </tr>
</table>

</body>
</html>