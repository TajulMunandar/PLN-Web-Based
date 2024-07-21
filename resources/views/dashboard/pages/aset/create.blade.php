@extends('dashboard.layouts.main')

@section('content')
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .card-header {
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .drop-zone {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background-color: #f9f9f9;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .drop-zone.dragover {
            background-color: #e6f7ff;
            border-color: #80bdff;
        }

        .img-thumbnail {
            max-width: 300px;
            max-height: 300px;
            margin: 5px;
        }

        .img-wrapper {
            display: flex;
            align-items: center;
            margin: 5px;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: none;
            background-color: #dc3545;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
            margin-left: 10px;
        }

        .btn-circle i {
            margin: 0;
        }

        .btn-circle:hover {
            background-color: #c82333;
        }
    </style>

    <!-- Breadcrumbs -->
    <div data-aos="fade-down" data-aos-duration="1500">
        <div class="row d-flex align-items-center">
            <div class="col">
                <div class="page-title mb-4 pt-5">
                    <h1 class="fw-bold">Tambah Asset</h1>
                </div>
            </div>
            <div class="col pt-4">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="{{ route('aset.index') }}">Asset</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Asset</li>
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

    <!-- Forms Section -->
    <div data-aos="fade-right" data-aos-duration="1500">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tambah Asset</h5>
                    <form id="combinedForm" action="{{ route('aset.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Asset Details Form -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_kategori" class="form-label">Kategori</label>
                                    <select class="form-control @error('id_kategori') is-invalid @enderror"
                                        name="id_kategori" id="id_kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                            name="harga" id="harga" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kabupaten">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jangka_sewa">Jangka Sewa</label>
                                    <input type="text" class="form-control" id="jangka_sewa" name="jangka_sewa" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                </div>
                            </div>

                            <!-- Image Upload Form -->
                            <div class="col-md-6 pt-4">
                                <div class="card shadow-sm rounded">
                                    <div class="card-header text-white rounded-top"
                                        style="background-image: radial-gradient( circle farthest-corner at 92.3% 71.5%,  rgba(83,138,214,1) 0%, rgba(134,231,214,1) 90% )">
                                        <h5 class="mb-0">Upload Gambar</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="dropZone" class="drop-zone mb-3">
                                            <p>Drag & Drop images here or click to upload</p>
                                        </div>
                                        <div id="imagePreview" class="row mb-3"></div>
                                        <input type="file" id="imageInput" name="images[]" multiple
                                            style="display:none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let dropZone = document.getElementById('dropZone');
            let imagePreview = document.getElementById('imagePreview');
            let imageInput = document.getElementById('imageInput');

            dropZone.addEventListener('click', function() {
                imageInput.click();
            });

            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZone.classList.add('dragover');
            });

            dropZone.addEventListener('dragleave', function() {
                dropZone.classList.remove('dragover');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('dragover');
                let files = Array.from(e.dataTransfer.files);
                handleFiles(files);
            });

            imageInput.addEventListener('change', function() {
                let files = Array.from(this.files);
                handleFiles(files);
            });

            function handleFiles(files) {
                let existingImages = imagePreview.getElementsByTagName('img').length;
                let totalFiles = files.length + existingImages;

                if (totalFiles > 5) {
                    alert('You can only upload a maximum of 5 images');
                    return;
                }

                files.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            let imgWrapper = document.createElement('div');
                            imgWrapper.className = 'img-wrapper';
                            let img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail';
                            let deleteButton = document.createElement('button');
                            deleteButton.className = 'btn-circle';
                            deleteButton.innerHTML = '<i class="fas fa-times"></i>';
                            deleteButton.onclick = function() {
                                imagePreview.removeChild(imgWrapper);
                                // Update the file input
                                let dt = new DataTransfer();
                                Array.from(imageInput.files).forEach(f => {
                                    if (f !== file) dt.items.add(f);
                                });
                                imageInput.files = dt.files;
                            };
                            imgWrapper.appendChild(img);
                            imgWrapper.appendChild(deleteButton);
                            imagePreview.appendChild(imgWrapper);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endpush
