<!-- resources/views/admin/dashboard.blade.php -->

@extends('admin.layouts.app')

@section('content')

<div class="dashboard-grid">

    <div class="card">
        <h3>Total Nasabah</h3>
        <p>120</p>
    </div>

    <div class="card">
        <h3>Total Pengajuan</h3>
        <p>80</p>
    </div>

    <div class="card">
        <h3>Disetujui</h3>
        <p>50</p>
    </div>

    <div class="card">
        <h3>Ditolak</h3>
        <p>30</p>
    </div>

</div>

<div class="table-container">

    <h2>Data Pengajuan Terbaru</h2>

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
                <td>Disetujui</td>
            </tr>

            <tr>
                <td>2</td>
                <td>Budi</td>
                <td>Rp 5.000.000</td>
                <td>Ditolak</td>
            </tr>
        </tbody>

    </table>

</div>

@endsection