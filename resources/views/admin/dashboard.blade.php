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

        <h1>120</h1>

        <h3>Total Nasabah</h3>

        <p>Semua data nasabah</p>
    </div>

    <div class="card">
        <div class="icon green">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <h1>50</h1>

        <h3>Disetujui</h3>

        <p>Pengajuan diterima</p>
    </div>

    <div class="card">
        <div class="icon red">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <h1>30</h1>

        <h3>Ditolak</h3>

        <p>Pengajuan ditolak</p>
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

            <tr>
                <td>1</td>
                <td>Andi</td>
                <td>Rp 10.000.000</td>
                <td>
                    <span class="success">
                        Disetujui
                    </span>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Budi</td>
                <td>Rp 5.000.000</td>
                <td>
                    <span class="danger">
                        Ditolak
                    </span>
                </td>
            </tr>

        </tbody>

    </table>

</div>

@endsection