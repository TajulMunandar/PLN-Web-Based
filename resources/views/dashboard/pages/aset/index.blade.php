@extends('dashboard.layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <!-- Page Title -->
    <div data-aos="fade-down" data-aos-duration="1500">
        <div class="row d-flex align-items-center">
            <div class="col">
                <div class="page-title mb-4 pt-5">
                    <h1 class="fw-bold">Asset</h1>
                </div>
            </div>
            <div class="col pt-4">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Asset</li>
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
    
    <!-- Page Title -->
    <div data-aos="fade-up" data-aos-duration="1500">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Table Asset</h5>

                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col"><a href="{{ route('aset.create') }}">
                                <button class="btn btn-primary mb-3 p-10" type="button">
                                    <i class="ti ti-plus fs-3 me-1"></i>Tambah
                                </button></a>
                        </div>
                    </div>
                    <div class="row">
                        <table id="myTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>KATEGORI</th>
                                    <th>HARGA</th>
                                    <th>ALAMAT</th>
                                    <th>KABUPATEN</th>
                                    <th>JANGKA SEWA</th>
                                    <th>LOKASI</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assets as $aset)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $aset->nama }}</td>
                                        <td>{{ $aset->kategori->kategori }}</td>
                                        <td>Rp.{{ number_format($aset->harga, 0, ',', '.') }}</td>
                                        <td>{{ $aset->alamat }}</td>
                                        <td>{{ $aset->kabupaten }}</td>
                                        <td>{{ $aset->jangka_sewa }}</td>
                                        <td class="text-truncate">{{ $aset->lokasi }}</td>
                                        <td>
                                            <a href="{{ route('foto_asset.show', $aset->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="ti ti-eye"></i>
                                            </a>
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
                                                    <h1 class="modal-title fs-5">Edit Asset</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('aset.update', $aset->id) }}" method="post">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text"
                                                                class="form-control @error('nama') is-invalid @enderror"
                                                                name="nama" id="nama"
                                                                value="{{ old('nama', $aset->nama) }}" autofocus required>
                                                            @error('nama')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label">Kategori</label>
                                                            <select
                                                                class="form-control @error('kategori') is-invalid @enderror"
                                                                name="kategori" id="kategori" required>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ $category->id == old('kategori', $aset->id_kategori) ? 'selected' : '' }}>
                                                                        {{ $category->kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('kategori')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga" class="form-label">Harga</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">Rp</span>
                                                                <input type="text"
                                                                    class="form-control @error('harga') is-invalid @enderror"
                                                                    name="harga" id="harga"
                                                                    value="{{ old('harga', number_format($aset->harga, 0, ',', '.')) }}"
                                                                    required>
                                                            </div>
                                                            @error('harga')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat</label>
                                                            <input type="text"
                                                                class="form-control @error('alamat') is-invalid @enderror"
                                                                name="alamat" id="alamat"
                                                                value="{{ old('alamat', $aset->alamat) }}" required>
                                                            @error('alamat')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kabupaten" class="form-label">Kabupaten</label>
                                                            <input type="text"
                                                                class="form-control @error('kabupaten') is-invalid @enderror"
                                                                name="kabupaten" id="kabupaten"
                                                                value="{{ old('kabupaten', $aset->kabupaten) }}" required>
                                                            @error('kabupaten')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jangka_sewa" class="form-label">Jangka
                                                                Sewa</label>
                                                            <input type="text"
                                                                class="form-control @error('jangka_sewa') is-invalid @enderror"
                                                                name="jangka_sewa" id="jangka_sewa"
                                                                value="{{ old('jangka_sewa', $aset->jangka_sewa) }}"
                                                                required>
                                                            @error('jangka_sewa')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="lokasi" class="form-label">Lokasi</label>
                                                            <input type="text"
                                                                class="form-control @error('lokasi') is-invalid @enderror"
                                                                name="lokasi" id="lokasi"
                                                                value="{{ old('lokasi', $aset->lokasi) }}" required>
                                                            @error('lokasi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade modalHapus" id="modalHapus{{ $loop->iteration }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Hapus Asset</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('aset.destroy', $aset->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus Asset ini?</p>
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
        </div>
    </div>
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
