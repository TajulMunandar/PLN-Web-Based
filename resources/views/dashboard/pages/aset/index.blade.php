@extends('dashboard.layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Asset</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Table Asset</h5>

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
                                <th>NAMA</th>
                                <th>KATEGORI</th>
                                <th>HARGA</th>
                                <th>ALAMAT</th>
                                <th>KABUPATEN</th>
                                <th>JANGKA SEWA</th>
                                <th>LOKASI</th>
                                <th>FOTO ASET</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Surya</td>
                                <td>SCP202</td>
                                <td>$320,800</td>
                                <td>Meulaboh</td>
                                <td>Meulaboh</td>
                                <td>2 bulan</td>
                                <td>Aceh</td>
                                <td>
                                    <li>asset 1.png</li>
                                    <li>asset 2.png</li>
                                    <li>asset 3.png</li>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalHapus">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Edit Asset</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        name="nama" id="nama" value="" autofocus required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_kategori" class="form-label">Kategori</label>
                                                    <select class="form-control @error('id_kategori') is-invalid @enderror"
                                                        name="id_kategori" id="id_kategori" required>
                                                        <option value="">Pilih Kategori</option>
                                                        <option value="kategori1">Kategori 1</option>
                                                        <option value="kategori2">Kategori 2</option>
                                                        <option value="kategori3">Kategori 3</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga" class="form-label">Harga</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="text"
                                                            class="form-control @error('harga') is-invalid @enderror"
                                                            name="harga" id="harga" value="" autofocus required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input type="text"
                                                        class="form-control @error('alamat') is-invalid @enderror"
                                                        name="alamat" id="alamat" value="" autofocus required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kabupaten" class="form-label">Kabupaten</label>
                                                    <input type="text"
                                                        class="form-control @error('kabupaten') is-invalid @enderror"
                                                        name="kabupaten" id="kabupaten" value="" autofocus required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jangka_sewa" class="form-label">Jangka
                                                        sewa</label>
                                                    <input type="text"
                                                        class="form-control @error('jangka_sewa') is-invalid @enderror"
                                                        name="jangka_sewa" id="jangka_sewa" value="" autofocus
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lokasi" class="form-label">Lokasi</label>
                                                    <input type="text"
                                                        class="form-control @error('lokasi') is-invalid @enderror"
                                                        name="lokasi" id="lokasi" value="" autofocus required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="photos" class="form-label">Poto</label>
                                                    <input type="file"
                                                        class="form-control @error('photos') is-invalid @enderror"
                                                        name="photos[]" id="photos" multiple required>
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

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Hapus Asset</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post" id="deleteForm">
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus divisi ini?</p>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- add Modal Tambah --}}
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Asset</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="id_kategori" class="form-label">Kategori</label>
                                <select class="form-control @error('id_kategori') is-invalid @enderror" name="id_kategori"
                                    id="id_kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="kategori1">Kategori 1</option>
                                    <option value="kategori2">Kategori 2</option>
                                    <option value="kategori3">Kategori 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                        name="harga" id="harga" value="" autofocus required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" id="alamat" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                    name="kabupaten" id="kabupaten" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="jangka_sewa" class="form-label">Jangka
                                    sewa</label>
                                <input type="text" class="form-control @error('jangka_sewa') is-invalid @enderror"
                                    name="jangka_sewa" id="jangka_sewa" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    name="lokasi" id="lokasi" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="photos" class="form-label">Poto</label>
                                <input type="file" class="form-control @error('photos') is-invalid @enderror"
                                    name="photos[]" id="photos" multiple required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal Tambah --}}
    @endsection
    @push('js')
        <script>
            document.querySelector('form').addEventListener('submit', function(event) {
                var photosInput = document.getElementById('photos');
                if (photosInput.files.length < 1 || photosInput.files.length > 5) {
                    event.preventDefault();
                    alert('Please upload between 1 and 5 photos.');
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                    "scrollX": true,
                    "language": {
                        "search": "",
                        "searchPlaceholder": "Search...",
                        "decimal": ",",
                        "thousands": "."
                    }
                });
                $(document).ready(function() {
                    $('.dataTables_filter input[type="search"]').css({
                        "marginBottom": "10px"
                    });
                    $('.dataTables_paginate ').css({
                        "marginTop": "10px"
                    });
                });
            });
        </script>
    @endpush
