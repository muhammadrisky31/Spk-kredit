<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SPK Kredit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', 'Segoe UI', sans-serif; }
        body { background-color: #f3f4f8; }

        /* ---- Navbar ---- */
        .nav-active {
            background-color: #2563eb;
            color: #ffffff !important;
            border-radius: 8px;
            padding: 7px 16px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            color: #6b7280;
            padding: 7px 14px;
            border-radius: 8px;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }
        .nav-link:hover { background-color: #f3f4f6; color: #374151; }

        /* ---- Hero ---- */
        .hero-banner {
            background: linear-gradient(130deg, #1230b8 0%, #1a3fd4 35%, #2554e8 65%, #3b6af8 100%);
        }

        /* ---- Cards ---- */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #f1f2f6;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.07); }

        .icon-box {
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
        }
        .icon-blue  { background: #eff2ff; color: #3b5bdb; }
        .icon-green { background: #ecfdf5; color: #059669; }
        .icon-red   { background: #fff1f2; color: #e11d48; }
        .icon-teal  { background: #f0fdfa; color: #0d9488; }
        .icon-purple{ background: #f5f3ff; color: #7c3aed; }

        /* ---- Action Items ---- */
        .action-item {
            display: flex; align-items: center; gap: 16px;
            background: #ffffff;
            border: 1px solid #f1f2f6;
            border-radius: 14px;
            padding: 16px;
            text-decoration: none;
            transition: background 0.15s, box-shadow 0.15s;
            margin-bottom: 10px;
        }
        .action-item:last-child { margin-bottom: 0; }
        .action-item:hover { background: #f8f9ff; box-shadow: 0 4px 12px rgba(59,91,219,0.06); }

        /* ---- Prediksi Terbaru ---- */
        .prediction-card {
            background: #ffffff;
            border: 1px solid #f1f2f6;
            border-radius: 16px;
            overflow: hidden;
        }
        .prediction-row {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 20px;
            border-bottom: 1px solid #f8f9fb;
        }
        .prediction-row:last-child { border-bottom: none; }

        /* ---- Badges ---- */
        .badge-rendah { background: #dcfce7; color: #15803d; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 999px; }
        .badge-tinggi { background: #fee2e2; color: #dc2626; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 999px; }

        /* ---- Info Bar ---- */
        .info-bar {
            background: linear-gradient(90deg, #eff6ff 0%, #e0eaff 100%);
            border: 1px solid #bfdbfe;
            border-radius: 16px;
            display: flex; align-items: center; gap: 16px;
            padding: 18px 24px;
        }

        /* ---- Avatar ---- */
        .avatar-blue {
            width: 34px; height: 34px;
            background: #2563eb;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 13px;
        }

        /* ---- Scrollbar ---- */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #c7d2fe; border-radius: 4px; }
    </style>
</head>
<body>

{{-- ===================== NAVBAR ===================== --}}
<nav style="background:#fff; border-bottom:1px solid #f1f2f6; position:sticky; top:0; z-index:50;">
    <div style="max-width:1200px; margin:0 auto; padding:10px 28px; display:flex; align-items:center; justify-content:space-between;">

        {{-- Logo --}}
        <div style="display:flex; align-items:center; gap:12px;">
            <div style="width:40px; height:40px; background:#2563eb; border-radius:12px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(37,99,235,0.25);">
                <svg style="width:20px; height:20px;" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3v18h18M7 14l3-3 3 2 4-5"/>
                </svg>
            </div>
            <div>
                <div style="font-weight:700; color:#111827; font-size:15px; line-height:1.2;">SPK Kredit</div>
                <div style="font-size:11px; color:#9ca3af; line-height:1.2;"></div>
            </div>
        </div>

        {{-- Navigation Links --}}
        <div style="display:flex; align-items:center; gap:4px; position:absolute; left:50%; transform:translateX(-50%);">
            <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">
                <i class="fa-solid fa-table-cells-large" style="font-size:13px;"></i>
                Dashboard
            </a>
            <a href="{{ route('prediksi') }}"
            class="nav-link {{ request()->routeIs('prediksi*') ? 'nav-active' : '' }}">
                <i class="fa-solid fa-chart-line" style="font-size:13px;"></i>
                Prediksi
            </a>
            <a href="{{ route('riwayat') }}"
            class="nav-link {{ request()->routeIs('riwayat*') ? 'nav-active' : '' }}">
                <i class="fa-regular fa-clock" style="font-size:13px;"></i>
                Riwayat
            </a>
            <a href="{{ route('tentang') }}"
            class="nav-link {{ request()->routeIs('tentang*') ? 'nav-active' : '' }}">
                <i class="fa-solid fa-circle-info" style="font-size:13px;"></i>
                Tentang
            </a>
        </div>

    </div>
</nav>
<main class="p-6">
    @yield('content')
</main>