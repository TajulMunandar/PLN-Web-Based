@extends('dashboard.layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <!-- Page Title -->
    <div class="row d-flex align-items-center">
        <div class="col">
            <div class="page-title mb-4 pt-5">
                <h1 class="fw-bold">Laporan</h1>
            </div>
        </div>
        <div class="col pt-4">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb float-end">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Page Title -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Table Laporan</h5>

                <!--  Row 1 -->
                <div class="row">
                    <table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Nama Asset</th>
                                <th>Nama User</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->asset->nama }}</td>
                                    <td>{{ $transaksi->user->name }}</td>
                                    <td>{{ $transaksi->start }}</td>
                                    <td>{{ $transaksi->end }}</td>
                                    <td><a href="{{ asset($transaksi->bukti) }}" target="_blank">Lihat Bukti</a></td>
                                    <td>
                                        @if ($transaksi->approve == 0)
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($transaksi->approve == 1)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $transaksi->ket }}</td>
                                    <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
