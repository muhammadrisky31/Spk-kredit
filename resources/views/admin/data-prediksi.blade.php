@extends('admin.layouts.app')

@section('page-title', 'Data Prediksi')
@section('page-sub', 'Semua riwayat prediksi dari seluruh nasabah')

@section('content')
<style>
    .page-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 12px;
    }

    .total-badge {
        background: #eff6ff;
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 8px;
        white-space: nowrap;
    }

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
    }

    .section-header h2 { font-size: 15px; font-weight: 700; color: #111827; }

    .table-wrap { overflow-x: auto; }

    table { width: 100%; border-collapse: collapse; min-width: 900px; }
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
        white-space: nowrap;
    }
    tbody td {
        padding: 14px 16px;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: #f9fafb; }

    .badge {
        display: inline-flex; align-items: center;
        padding: 4px 10px; border-radius: 6px;
        font-size: 11.5px; font-weight: 700;
        white-space: nowrap;
    }
    .badge-success { background: #f0fdf4; color: #16a34a; }
    .badge-danger  { background: #fef2f2; color: #ef4444; }

    .btn-detail {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all .15s;
    }
    .btn-detail:hover { background: #dbeafe; }
</style>

<div class="page-actions">
    <span class="total-badge">
        <i class="fa-solid fa-file-lines"></i>
        Total: {{ $prediksi->count() }} prediksi
    </span>
</div>

<div class="section-card">
    <div class="section-header">
        <h2>Semua Data Prediksi</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Nasabah</th>
                    <th>User</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Suku Bunga</th>
                    <th>Limit Rekomendasi</th>
                    <th>Skor Risiko</th>
                    <th>Hasil</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prediksi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="font-weight:600;">{{ $item->nama }}</td>
                    <td style="color:#6b7280;">{{ $item->user->name ?? '—' }}</td>
                    <td>Rp{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                    <td>{{ $item->suku_bunga }}%</td>
                    <td>
                        @if($item->limit_rekomendasi)
                            <span style="font-weight:700; color:#16a34a;">
                                Rp{{ number_format($item->limit_rekomendasi, 0, ',', '.') }}
                            </span>
                        @else
                            <span style="color:#9ca3af">—</span>
                        @endif
                    </td>
                    <td>
                        @if($item->skor_risiko !== null)
                            <span style="font-weight:700; color:{{ $item->skor_risiko >= 50 ? '#ef4444' : '#16a34a' }}">
                                {{ number_format($item->skor_risiko, 1) }}/100
                            </span>
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
                    <td style="color:#6b7280; white-space:nowrap;">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td>
                        <a href="{{ route('hasil.show', $item->id) }}" class="btn-detail">
                            <i class="fa-solid fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align:center; color:#9ca3af; padding:32px;">
                        Belum ada data prediksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection