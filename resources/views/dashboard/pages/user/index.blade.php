@extends('dashboard.layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <!-- Page Title -->
    <div class="row d-flex align-items-center">
        <div class="col">
            <div class="page-title mb-4 pt-5">
                <h1 class="fw-bold">User Management</h1>
            </div>
        </div>
        <div class="col pt-4">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb float-end">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Management</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Page Title -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Table User</h5>

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
                                <th>STATUS</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>NO HP</th>
                                <th>INSTANSI</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Surya</td>
                                <td>Not Admin</td>
                                <td>Surya@gmail.com</td>
                                <td>Surya123</td>
                                <td>08960345583</td>
                                <td>TIK</td>
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
                                            <h1 class="modal-title fs-5">Edit User</h1>
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
                                                    <label for="admin_status" class="form-label">Admin Status</label>
                                                    <div>
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input @error('admin_status') is-invalid @enderror"
                                                                type="radio" name="admin_status" id="admin_yes"
                                                                value="1" required>
                                                            <label class="form-check-label" for="admin_yes">
                                                                Admin
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input @error('admin_status') is-invalid @enderror"
                                                                type="radio" name="admin_status" id="admin_no"
                                                                value="0" required>
                                                            <label class="form-check-label" for="admin_no">
                                                                Not Admin
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Email</label>
                                                    <input type="text"
                                                        class="form-control @error('alamat') is-invalid @enderror"
                                                        name="alamat" id="alamat" value="" autofocus required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kabupaten" class="form-label">Password</label>
                                                    <input type="text"
                                                        class="form-control @error('kabupaten') is-invalid @enderror"
                                                        name="kabupaten" id="kabupaten" value="" autofocus required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jangka_sewa" class="form-label">No.HP</label>
                                                    <input type="text"
                                                        class="form-control @error('jangka_sewa') is-invalid @enderror"
                                                        name="jangka_sewa" id="jangka_sewa" value="" autofocus
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lokasi" class="form-label">Instansi</label>
                                                    <input type="text"
                                                        class="form-control @error('lokasi') is-invalid @enderror"
                                                        name="lokasi" id="lokasi" value="" autofocus required>
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
                                            <h1 class="modal-title fs-5">Hapus User</h1>
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
                        <h1 class="modal-title fs-5">Tambah User</h1>
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
                                <label for="admin_status" class="form-label">Admin Status</label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('admin_status') is-invalid @enderror"
                                            type="radio" name="admin_status" id="admin_yes" value="1" required>
                                        <label class="form-check-label" for="admin_yes">
                                            Admin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('admin_status') is-invalid @enderror"
                                            type="radio" name="admin_status" id="admin_no" value="0" required>
                                        <label class="form-check-label" for="admin_no">
                                            Not Admin
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Email</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" id="alamat" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="kabupaten" class="form-label">Password</label>
                                <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                    name="kabupaten" id="kabupaten" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="jangka_sewa" class="form-label">No.HP</label>
                                <input type="text" class="form-control @error('jangka_sewa') is-invalid @enderror"
                                    name="jangka_sewa" id="jangka_sewa" value="" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Instansi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    name="lokasi" id="lokasi" value="" autofocus required>
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
    @endpush
