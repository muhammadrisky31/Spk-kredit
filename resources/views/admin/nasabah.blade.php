@extends('admin.layouts.app')

@section('page-title', 'Kelola User')
@section('page-sub', 'Daftar semua nasabah terdaftar')

@section('content')
<style>
    .page-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .total-badge {
        background: #eff6ff;
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 8px;
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

    .avatar-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .avatar {
        width: 34px; height: 34px;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700; flex-shrink: 0;
    }

    .btn-hapus {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px;
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fecaca;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all .15s;
        text-decoration: none;
    }
    .btn-hapus:hover { background: #fee2e2; }
</style>

<div class="page-actions">
    <span class="total-badge">
        <i class="fa-solid fa-users"></i>
        Total: {{ $nasabah->count() }} nasabah
    </span>
</div>

<div class="section-card">
    <div class="section-header">
        <h2>Daftar Nasabah</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Bergabung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nasabah as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="avatar-cell">
                        <div class="avatar">{{ strtoupper(substr($item->name, 0, 1)) }}</div>
                        <span style="font-weight:600;">{{ $item->name }}</span>
                    </div>
                </td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
                <td>
                    <form action="{{ route('admin.hapus-nasabah', $item->id_user) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus nasabah {{ $item->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#9ca3af; padding:32px;">
                    Belum ada nasabah terdaftar
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection