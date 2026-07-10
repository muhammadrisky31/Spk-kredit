<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — SPK Kredit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --success: #16a34a;
            --success-light: #f0fdf4;
            --danger: #ef4444;
            --danger-light: #fef2f2;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --sidebar-w: 240px;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-700: #374151;
            --gray-900: #111827;
            --white: #ffffff;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--white);
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 20px 20px 16px;
            border-bottom: 1px solid var(--gray-100);
        }

        .sidebar-logo .logo-icon {
            width: 36px; height: 36px;
            background: var(--primary);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 16px;
        }

        .sidebar-logo span {
            font-size: 15px;
            font-weight: 800;
            color: var(--gray-900);
        }

        .sidebar-logo small {
            display: block;
            font-size: 10px;
            color: var(--gray-400);
            font-weight: 500;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: 0 8px;
            margin-bottom: 6px;
            margin-top: 16px;
        }

        .nav-label:first-child { margin-top: 0; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--gray-700);
            text-decoration: none;
            transition: all .15s;
            margin-bottom: 2px;
        }

        .nav-item:hover { background: var(--gray-100); color: var(--gray-900); }

        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
        }

        .nav-item i {
            width: 18px;
            text-align: center;
            font-size: 14px;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--gray-100);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar-user .avatar {
            width: 34px; height: 34px;
            background: var(--primary);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 13px; font-weight: 700;
            flex-shrink: 0;
        }

        .sidebar-user .user-info .name { font-size: 13px; font-weight: 700; color: var(--gray-900); }
        .sidebar-user .user-info .role { font-size: 11px; color: var(--gray-400); }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--danger);
            background: var(--danger-light);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all .15s;
        }

        .btn-logout:hover { background: #fee2e2; }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 0 28px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title { font-size: 16px; font-weight: 700; color: var(--gray-900); }
        .topbar-sub   { font-size: 12px; color: var(--gray-400); }

        .content {
            padding: 28px;
            flex: 1;
        }

        /* ── ALERT ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13.5px;
            font-weight: 500;
        }
        .alert-success { background: var(--success-light); color: var(--success); border: 1px solid #bbf7d0; }
        .alert-danger  { background: var(--danger-light);  color: var(--danger);  border: 1px solid #fecaca; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon"><i class="fa-solid fa-chart-simple"></i></div>
            <div>
                <span>SPK Kredit</span>
                <small>Panel Admin</small>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-columns"></i>
                Dashboard Admin
            </a>

            <a href="{{ route('admin.nasabah') }}"
               class="nav-item {{ request()->routeIs('admin.nasabah') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                Kelola User
            </a>

            <a href="{{ route('admin.data-prediksi') }}"
               class="nav-item {{ request()->routeIs('admin.data-prediksi') ? 'active' : '' }}">
                <i class="fa-solid fa-file-lines"></i>
                Data Prediksi
            </a>

            <a href="{{ route('admin.performa-model') }}"
               class="nav-item {{ request()->routeIs('admin.performa-model') ? 'active' : '' }}">
                <i class="fa-solid fa-brain"></i>
                Performa Model
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="avatar">A</div>
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">Administrator</div>
                </div>
            </div>
            <a href="/logout" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <div class="topbar">
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-sub">@yield('page-sub', 'Panel Administrator SPK Kredit')</div>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>