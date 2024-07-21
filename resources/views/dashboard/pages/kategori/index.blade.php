@extends('dashboard.layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <!-- Page Title -->
    <div data-aos="fade-down" data-aos-duration="1500" data-aos-once="true">
        <div class="row d-flex align-items-center">
            <div class="col">
                <div class="page-title mb-4 pt-5">
                    <h1 class="fw-bold">Kategori</h1>
                </div>
            </div>
            <div class="col pt-4">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                    </ol>
                </nav>
            </div>
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

    <div data-aos="fade-up" data-aos-duration="1500" data-aos-once="true">
        <!-- Page Title -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Table Kategori</h5>

                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary mb-3 p-10" type="button" data-bs-toggle="modal"
                                data-bs-target="#tambahModal">
                                <i class="ti ti-plus fs-3 me-1"></i>Tambah
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <table id="myTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KATEGORI</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($katagoris as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->kategori }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $loop->iteration }}">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapus{{ $loop->iteration }}">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade editModal" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Edit Kategori</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label">Nama Kategori</label>
                                                            <input type="text"
                                                                class="form-control @error('kategori') is-invalid @enderror"
                                                                name="kategori" id="kategori"
                                                                value="{{ old('kategori', $kategori->kategori) }}" autofocus
                                                                required>
                                                            @error('kategori')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal Hapus -->
                                    <div class="modal fade modalHapus" id="modalHapus{{ $loop->iteration }}" tabindex="-1"
                                        aria-hidden="true" data-aos="none">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Hapus Kategori</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('kategori.destroy', $kategori->id) }}"
                                                    method="post" id="deleteForm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus Kategori ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
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

            {{-- add Modal Tambah --}}
            <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true" data-aos="none">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Tambah Katagori</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('kategori.store') }}" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                        name="kategori" id="kategori" value="" autofocus required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#tambahModal, .editModal, .modalHapus').on('show.bs.modal', function(e) {
                AOS.init({
                    disable: true
                });
            });

            $('#tambahModal, .editModal, .modalHapus').on('hidden.bs.modal', function(e) {
                AOS.init({
                    disable: 'mobile'
                });
            });
        });
    </script>
@endpush
