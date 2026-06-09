<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >
</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar">

        <div class="logo">
            <i class="fa-solid fa-chart-simple"></i>
            <span>SPK Kredit</span>
        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-table-columns"></i>
                        Dashboard
                </a>
            </li>

            <li>
               <a href="{{ route('admin.nasabah') }}"
                    class="{{ request()->routeIs('admin.nasabah') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                        Nasabah
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-file"></i>
                    Pengajuan
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>

        </ul>

    </nav>

    <!-- CONTENT -->

    <div class="container">

        @yield('content')

    </div>

</body>
</html>