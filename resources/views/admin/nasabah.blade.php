@extends('admin.layouts.app')

@section('content')

<div class="table-box">

    <div class="table-header">
        <h2>Data Nasabah</h2>
    </div>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>

            @forelse($nasabah as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
            </tr>

            @empty

            <tr>
                <td colspan="3" style="text-align:center;">
                    Belum ada data nasabah
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection