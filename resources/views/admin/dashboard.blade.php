@extends('admin.layouts.app')

@section('content')

<!-- HERO -->

<div class="hero">

    <p>👋 Selamat datang kembali,</p>

    <h1>Admin</h1>

    <p class="desc">
        Sistem SPK Kredit siap membantu mengelola data dan hasil prediksi kredit.
    </p>

</div>

<!-- CARD -->

<div class="card-grid">

    <div class="card">
        <div class="icon blue">
            <i class="fa-solid fa-users"></i>
        </div>

        <h1>{{ $totalNasabah }}</h1>

        <h3>Total Nasabah</h3>

        <p>Semua data nasabah</p>
    </div>

    <div class="card">
        <div class="icon green">
            <i class="fa-solid fa-file-circle-check"></i>
        </div>

        <h1>{{ $totalPrediksi }}</h1>

        <h3>Total Prediksi</h3>

        <p>Semua hasil prediksi</p>
    </div>

    <div class="card">
        <div class="icon green">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <h1>{{ $risikoRendah }}</h1>

        <h3>Risiko Rendah</h3>

        <p>Prediksi risiko rendah</p>
    </div>

    <div class="card">
        <div class="icon red">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <h1>{{ $risikoTinggi }}</h1>

        <h3>Risiko Tinggi</h3>

        <p>Prediksi risiko tinggi</p>
    </div>

</div>

<!-- TABLE -->

<div class="table-box">

    <div class="table-header">
        <h2>Data Pengajuan Terbaru</h2>
    </div>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah Kredit</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @forelse($pengajuanTerbaru as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->nama }}</td>

                <td>
                    Rp {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}
                </td>

                <td>
                    @if($item->hasil == 'Risiko Rendah')

                        <span class="success">
                            Risiko Rendah
                        </span>

                    @else

                        <span class="danger">
                            Risiko Tinggi
                        </span>

                    @endif
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="4" style="text-align:center;">
                    Belum ada data prediksi
                </td>
            </tr>
            @endforelse

        </tbody>

    </table>

</div>

@endsection