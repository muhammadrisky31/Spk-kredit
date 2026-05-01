<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Prediksi - SPK Kredit</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f8;
            min-height: 100vh;
        }

        /* ===================== NAVBAR ===================== */
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 40px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b5bdb, #4dabf7);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg {
            width: 22px;
            height: 22px;
            color: #fff;
        }

        .brand-text .brand-title {
            font-size: 15px;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.2;
        }

        .brand-text .brand-subtitle {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.2;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        .navbar-menu a {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
            transition: all 0.2s;
        }

        .navbar-menu a:hover {
            background-color: #f3f4f6;
            color: #1a1a2e;
        }

        .navbar-menu a.active {
            background-color: #eff2ff;
            color: #3b5bdb;
            font-weight: 600;
        }

        .navbar-menu a svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-notif {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: none;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #4b5563;
            transition: background 0.2s;
            position: relative;
        }

        .btn-notif:hover { background-color: #e5e7eb; }
        .btn-notif svg { width: 18px; height: 18px; }

        .notif-dot {
            position: absolute;
            top: 7px;
            right: 8px;
            width: 7px;
            height: 7px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background 0.2s;
            position: relative;
        }

        .user-btn:hover { background-color: #f3f4f6; }

        .user-avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #7950f2, #9c82f5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        .user-btn svg { width: 14px; height: 14px; color: #9ca3af; }

        /* Dropdown Menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            min-width: 160px;
            z-index: 200;
            overflow: hidden;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 10px 16px;
            font-size: 13.5px;
            color: #374151;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            transition: background 0.15s;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover { background: #f9fafb; }

        .dropdown-menu .logout-btn { color: #ef4444; }
        .dropdown-menu svg { width: 15px; height: 15px; }

        .user-btn.open .dropdown-menu { display: block; }

        /* ===================== MAIN CONTENT ===================== */
        .main-content {
            padding: 36px 48px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Page Header */
        .page-header { margin-bottom: 24px; }
        .page-title { font-size: 22px; font-weight: 700; color: #1a1a2e; }
        .page-subtitle { font-size: 13px; color: #6b7280; margin-top: 4px; }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid #e9ecef;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.blue  { background: #eff2ff; }
        .stat-icon.red   { background: #fff0f0; }
        .stat-icon.green { background: #f0fdf4; }
        .stat-icon svg   { width: 20px; height: 20px; }

        .icon-blue  { color: #3b5bdb; }
        .icon-red   { color: #ef4444; }
        .icon-green { color: #22c55e; }

        .stat-number { font-size: 26px; font-weight: 800; color: #1a1a2e; line-height: 1; }
        .stat-label  { font-size: 12px; color: #9ca3af; margin-top: 4px; }

        /* Table Card */
        .table-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            overflow: hidden;
        }

        /* Toolbar */
        .table-toolbar {
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #f3f4f6;
            flex-wrap: wrap;
        }

        .search-wrapper {
            flex: 1;
            position: relative;
            min-width: 220px;
        }

        .search-wrapper svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            color: #9ca3af;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 9px 14px 9px 36px;
            border: 1.5px solid #e5e7eb;
            border-radius: 9px;
            font-size: 13.5px;
            color: #374151;
            outline: none;
            transition: border-color 0.2s;
            background: #f9fafb;
        }

        .search-input:focus { border-color: #3b5bdb; background: #fff; }
        .search-input::placeholder { color: #b0b7c3; }

        .filter-btns { display: flex; gap: 6px; }

        .filter-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.15s;
        }

        .filter-btn:hover { border-color: #3b5bdb; color: #3b5bdb; }
        .filter-btn.active { background: #3b5bdb; color: #fff; border-color: #3b5bdb; }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        thead th {
            padding: 12px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            background: #fafafa;
            border-bottom: 1px solid #f3f4f6;
        }

        tbody tr {
            border-bottom: 1px solid #f9fafb;
            transition: background 0.15s;
        }

        tbody tr:hover { background: #fafbff; }
        tbody tr:last-child { border-bottom: none; }

        tbody td { padding: 16px 20px; vertical-align: middle; }

        .nama      { font-weight: 600; color: #1a1a2e; font-size: 14px; }
        .tanggal   { font-size: 12px; color: #9ca3af; margin-top: 2px; }
        .umur      { font-weight: 600; color: #1a1a2e; }
        .pendapatan { font-size: 12px; color: #6b7280; margin-top: 2px; }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-pemilik { background: #eff2ff; color: #3b5bdb; }
        .badge-rental  { background: #fff7ed; color: #ea580c; }
        .badge-cicilan { background: #fdf4ff; color: #9333ea; }
        .badge-default { background: #f3f4f6; color: #6b7280; }

        /* Hasil */
        .hasil-wrap { display: flex; align-items: center; gap: 7px; }

        .hasil-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dot-rendah { background: #22c55e; }
        .dot-tinggi { background: #ef4444; }

        .label-rendah { font-weight: 600; color: #15803d; font-size: 13.5px; }
        .label-tinggi { font-weight: 600; color: #dc2626; font-size: 13.5px; }

        /* Aksi */
        .aksi-btns { display: flex; gap: 8px; }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
        }

        .btn-view   { background: #eff2ff; color: #3b5bdb; }
        .btn-view:hover  { background: #dbe4ff; }
        .btn-edit   { background: #fff7ed; color: #ea580c; }
        .btn-edit:hover  { background: #ffedd5; }
        .btn-delete { background: #fff0f0; color: #ef4444; }
        .btn-delete:hover { background: #fee2e2; }
        .btn-icon svg { width: 15px; height: 15px; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
            font-size: 14px;
        }

        .empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            color: #d1d5db;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-content { padding: 24px 24px; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 18px; }
            .navbar-menu { display: none; }
            .main-content { padding: 20px 16px; }
            .stats-grid { grid-template-columns: 1fr; }
            thead th:nth-child(3),
            tbody td:nth-child(3) { display: none; }
        }
    </style>
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar">

        <!-- Brand -->
        <a href="{{ url('/dashboard') }}" class="navbar-brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"/>
                    <line x1="12" y1="20" x2="12" y2="4"/>
                    <line x1="6"  y1="20" x2="6"  y2="14"/>
                </svg>
            </div>
            <div class="brand-text">
                <div class="brand-title">SPK Kredit</div>
                <div class="brand-subtitle">Decision Tree</div>
            </div>
        </a>

        <!-- Menu -->
        <ul class="navbar-menu">
            <li>
                <a href="{{ url('/dashboard') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('/prediksi') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                    Prediksi
                </a>
            </li>
            <li>
                <a href="{{ url('/riwayat') }}" class="active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    Riwayat
                </a>
            </li>
            <li>
                <a href="{{ url('/tentang') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Tentang
                </a>
            </li>
        </ul>

        <!-- Right -->
        <div class="navbar-right">
            <button class="btn-notif" title="Notifikasi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                <span class="notif-dot"></span>
            </button>

            <div style="position:relative;">
                <button class="user-btn" id="userBtn" onclick="toggleDropdown()">
                    <div class="user-avatar">
                        {{ strtoupper(substr(session('user_name', 'P'), 0, 1)) }}
                    </div>
                    <span class="user-name">{{ session('user_name', 'Pengguna') }}</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{ url('/dashboard') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Profil Saya
                    </a>
                    <a href="{{ url('/logout') }}" class="logout-btn"
                       onclick="return confirm('Yakin ingin logout?')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </div>

    </nav>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="main-content">

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Riwayat Prediksi</h1>
            <p class="page-subtitle">Semua hasil prediksi risiko kredit yang telah dilakukan.</p>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <svg class="icon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-number">{{ $totalPrediksi }}</div>
                    <div class="stat-label">Total Prediksi</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red">
                    <svg class="icon-red" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-number">{{ $risikoTinggi }}</div>
                    <div class="stat-label">Risiko Tinggi</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <svg class="icon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-number">{{ $risikoRendah }}</div>
                    <div class="stat-label">Risiko Rendah</div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card">

            <!-- Toolbar -->
            <div class="table-toolbar">
                <form method="GET" action="{{ url('/riwayat') }}" style="display:contents;">
                    <div class="search-wrapper">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            class="search-input"
                            placeholder="Cari nama, tujuan, atau status rumah..."
                            value="{{ request('search') }}"
                            oninput="this.form.submit()"
                        >
                    </div>
                </form>

                <div class="filter-btns">
                    <button class="filter-btn active" onclick="filterTable('semua', this)">Semua</button>
                    <button class="filter-btn" onclick="filterTable('rendah', this)">Risiko Rendah</button>
                    <button class="filter-btn" onclick="filterTable('tinggi', this)">Risiko Tinggi</button>
                </div>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th>Nama / Tanggal</th>
                        <th>Umur / Pendapatan</th>
                        <th>Status Rumah</th>
                        <th>Tujuan Pinjaman</th>
                        <th>Hasil Prediksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                @forelse($data as $d)
                    @php
                        $isRendah = strtolower($d->hasil ?? '') === 'risiko rendah';

                        $badgeClass = match(strtolower($d->status_rumah ?? '')) {
                            'pemilik'        => 'badge-pemilik',
                            'rental/kontrak' => 'badge-rental',
                            'dalam cicilan'  => 'badge-cicilan',
                            default          => 'badge-default',
                        };

                        $isAdmin = \App\Models\User::find(session('user_id'))?->role === 'admin';
                    @endphp

                    <tr data-hasil="{{ $isRendah ? 'rendah' : 'tinggi' }}">

                        <td>
                            <div class="nama">{{ $d->nama }}</div>
                            <div class="tanggal">
                                {{ \Carbon\Carbon::parse($d->created_at)->format('Y-m-d') }}
                            </div>
                        </td>

                        <td>
                            <div class="umur">{{ $d->umur }} thn</div>
                            <div class="pendapatan">Rp{{ number_format($d->pendapatan, 0, ',', '.') }}</div>
                        </td>

                        <td>
                            <span class="badge {{ $badgeClass }}">
                                {{ strtoupper($d->status_rumah) }}
                            </span>
                        </td>

                        <td style="color:#374151; font-size:13px; text-transform:uppercase;">
                            {{ $d->tujuan }}
                        </td>

                        <td>
                            <div class="hasil-wrap">
                                <div class="hasil-dot {{ $isRendah ? 'dot-rendah' : 'dot-tinggi' }}"></div>
                                <span class="{{ $isRendah ? 'label-rendah' : 'label-tinggi' }}">
                                    {{ $isRendah ? 'Risiko Rendah' : 'Risiko Tinggi' }}
                                </span>
                            </div>
                        </td>

                        <td>
                            <div class="aksi-btns">
                                <!-- Lihat -->
                                <button class="btn-icon btn-view" title="Lihat Detail">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>

                                @if($isAdmin)
                                    <!-- Edit -->
                                    <a href="/kredit/edit/{{ $d->id }}" class="btn-icon btn-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>

                                    <!-- Hapus -->
                                    <form action="/kredit/delete/{{ $d->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="btn-icon btn-delete"
                                            title="Hapus"
                                            onclick="return confirm('Hapus data ini?')"
                                        >
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6l-1 14H6L5 6"/>
                                                <path d="M10 11v6M14 11v6"/>
                                                <path d="M9 6V4h6v2"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p>Belum ada data prediksi.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

        </div>
    </div>

    <script>
        function filterTable(type, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            document.querySelectorAll('#tableBody tr[data-hasil]').forEach(row => {
                row.style.display = (type === 'semua' || row.dataset.hasil === type) ? '' : 'none';
            });
        }

        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(e) {
            const btn = document.getElementById('userBtn');
            const menu = document.getElementById('dropdownMenu');
            if (!btn.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    </script>

</body>
</html>