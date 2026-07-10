@extends('admin.layouts.app')

@section('page-title', 'Dashboard Admin')
@section('page-sub', 'Ringkasan statistik sistem SPK Kredit')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }

    .stat-icon.blue   { background: #eff6ff; color: #2563eb; }
    .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
    .stat-icon.red    { background: #fef2f2; color: #ef4444; }
    .stat-icon.yellow { background: #fffbeb; color: #f59e0b; }

    .stat-info .value { font-size: 26px; font-weight: 800; color: #111827; line-height: 1; }
    .stat-info .label { font-size: 12px; color: #6b7280; font-weight: 500; margin-top: 4px; }

    .section-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .section-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .section-header h2 { font-size: 15px; font-weight: 700; color: #111827; }

    table { width: 100%; border-collapse: collapse; }
    thead th {
        padding: 12px 16px;
        text-align: left;
        font-size: 11.5px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: .5px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }
    tbody td {
        padding: 14px 16px;
        font-size: 13.5px;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: #f9fafb; }

    .badge {
        display: inline-flex; align-items: center;
        padding: 4px 10px; border-radius: 6px;
        font-size: 11.5px; font-weight: 700;
    }
    .badge-success { background: #f0fdf4; color: #16a34a; }
    .badge-danger  { background: #fef2f2; color: #ef4444; }

    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
        <div class="stat-info">
            <div class="value">{{ $totalNasabah }}</div>
            <div class="label">Total Nasabah</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fa-solid fa-file-lines"></i></div>
        <div class="stat-info">
            <div class="value">{{ $totalPrediksi }}</div>
            <div class="label">Total Prediksi</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
        <div class="stat-info">
            <div class="value">{{ $risikoRendah }}</div>
            <div class="label">Risiko Rendah</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div>
        <div class="stat-info">
            <div class="value">{{ $risikoTinggi }}</div>
            <div class="label">Risiko Tinggi</div>
        </div>
    </div>
</div>

<div class="section-card">
    <div class="section-header">
        <h2>Pengajuan Terbaru</h2>
        <a href="{{ route('admin.data-prediksi') }}" style="font-size:13px; color:#2563eb; font-weight:600; text-decoration:none;">
            Lihat Semua →
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Jumlah Pinjaman</th>
                <th>Limit Rekomendasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuanTerbaru as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>Rp{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                <td>
                    @if($item->limit_rekomendasi)
                        Rp{{ number_format($item->limit_rekomendasi, 0, ',', '.') }}
                    @else
                        <span style="color:#9ca3af">—</span>
                    @endif
                </td>
                <td>
                    @if($item->hasil == 'Risiko Rendah')
                        <span class="badge badge-success">Risiko Rendah</span>
                    @else
                        <span class="badge badge-danger">Risiko Tinggi</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#9ca3af; padding:32px;">
                    Belum ada data prediksi
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection