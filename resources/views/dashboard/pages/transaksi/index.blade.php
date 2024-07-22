@extends('dashboard.layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <!-- Page Title -->
    <div data-aos="fade-down" data-aos-duration="1500">
        <div class="row d-flex align-items-center">
            <div class="col">
                <div class="page-title mb-4 pt-5">
                    <h1 class="fw-bold">Transaksi</h1>
                </div>
            </div>
            <div class="col pt-4">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div data-aos="fade-down" data-aos-duration="1500">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
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
    </div>

    <div data-aos="fade-up" data-aos-duration="1500">
        <!-- Page Title -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Table Transaksi</h5>

                    <!-- Row 1 -->
                    <div class="row">
                        <table id="myTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ASET</th>
                                    <th>USER</th>
                                    <th>START</th>
                                    <th>END</th>
                                    <th>BUKTI</th>
                                    <th>APPROVE</th>
                                    <th>KET</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->asset->nama }}</td>
                                        <td>{{ $transaksi->user->name }}</td>
                                        <td>{{ $transaksi->start }}</td>
                                        <td>{{ $transaksi->end }}</td>
                                        <td>{{ $transaksi->bukti }}</td>
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
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#approveModal{{ $transaksi->id }}">
                                                <i class="fa-solid fa-square-check"></i> <!-- Updated icon -->
                                            </button>

                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#declineModal{{ $transaksi->id }}">
                                                <i class="fas fa-circle-xmark"></i> <!-- Updated icon -->
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Approve -->
                                    <div class="modal fade modalApprove" id="approveModal{{ $transaksi->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Approve Transaksi</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('transaksi.approve', $transaksi->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menyetujui transaksi ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Approve</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Decline -->
                                    <div class="modal fade modalDecline" id="declineModal{{ $transaksi->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Decline Transaksi</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('transaksi.decline', $transaksi->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menolak transaksi ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Decline</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.modalApprove, .modalDecline').on('show.bs.modal', function(e) {
                AOS.init({
                    disable: true
                });
            });

            $('.modalApprove, .modalDecline').on('hidden.bs.modal', function(e) {
                AOS.init({
                    disable: 'mobile'
                });
            });
        });
    </script>
@endpush
