@extends('dashboard.layouts.main')

@section('content')
    <!-- Breadcrumbs -->
    <!-- Page Title -->
    <div data-aos="fade-down" data-aos-duration="1500">
        <div class="row d-flex align-items-center">
            <div class="col">
                <div class="page-title mb-4 pt-5">
                    <h1 class="fw-bold">Foto Asset</h1>
                </div>
            </div>
            <div class="col pt-4">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="{{ route('aset.index') }}">Asset</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Foto Asset</li>
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

    </div>

    <div data-aos="fade-down" data-aos-duration="1500">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Table Foto Asset</h5>

                    <div class="container-fluid">
                        <!-- Form for adding new photos -->
                        <div class="mb-4">
                            <form action="{{ route('foto_asset.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_asset" value="{{ $asset->id }}">
                                <div class="d-flex align-items-center mb-3">
                                    <!-- Button on the left side -->
                                    <button type="submit" class="btn btn-primary me-3">Tambah Foto</button>

                                    <div class="flex-grow-1">
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                            id="foto" name="foto[]" multiple required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <table id="myTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Foto Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($photos as $photo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#photoModal"
                                                data-photo="{{ $photo->foto }}">
                                                {{ $photo->foto }}
                                            </a>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapus{{ $loop->iteration }}">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade modalHapus" id="modalHapus{{ $loop->iteration }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Hapus Foto Asset</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('foto_asset.destroy', $photo->id) }}" method="post"
                                                    id="deleteForm{{ $photo->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus foto asset ini?</p>
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

                    <!-- Modal for displaying the image -->
                    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="photoModalLabel">Photo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img id="photoImage" src="" alt="Photo" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let photoModal = document.getElementById('photoModal');
            photoModal.addEventListener('show.bs.modal', function(event) {
                let link = event.relatedTarget;
                let photoName = link.getAttribute('data-photo');
                let photoImage = document.getElementById('photoImage');
                photoImage.src = '/storage/foto_asset/' + photoName;
            });
        });

        AOS.init({
            disable: 'mobile'
        });
    </script>
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
