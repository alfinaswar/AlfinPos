@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Kategori Item</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori Item</a></li>
                    <li class="breadcrumb-item active">Tambah Kategori</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Formulir Tambah Kategori</h4>
                    <p class="card-text mb-0">
                        Silakan isi data kategori item baru di bawah ini.
                    </p>
                </div>
                <div class="card-body">

                    <!-- Informasi tambahan tentang icon -->
                    <div class="alert alert-info mb-4" role="alert">
                        <i class="fa fa-info-circle me-2"></i>
                        <strong>Catatan:</strong> Icon yang Anda upload akan tampil di halaman kasir sebagai identitas
                        visual kategori.
                    </div>
                    <!-- End Informasi tambahan -->

                    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="nama" class="form-label"><strong>Nama Kategori</strong></label>
                                <input type="text" name="Nama" class="form-control @error('Nama') is-invalid @enderror"
                                    id="nama" placeholder="Nama Kategori" value="{{ old('Nama') }}">
                                @error('Nama')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="icon" class="form-label"><strong>Upload Icon Kategori</strong></label>
                                <div id="drop-area" class="border border-2 border-dashed rounded p-3 text-center"
                                    style="cursor:pointer;">
                                    <p class="mb-2" id="drop-text">
                                        Seret dan lepas ikon di sini, atau klik untuk memilih file.
                                    </p>
                                    <input type="file" name="Icon"
                                        class="form-control d-none @error('Icon') is-invalid @enderror" id="icon"
                                        accept="image/*" onchange="previewIcon(event)">
                                    <div class="mt-2 w-100 d-flex justify-content-center align-items-center"
                                        id="icon-preview-wrapper">
                                        <img id="icon-preview" src="#" alt="Preview Icon"
                                            style="display: none; max-height: 100px; margin: 0 auto;">
                                    </div>
                                </div>
                                @error('Icon')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary me-2">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // Preview icon saat file dipilih
        function previewIcon(event) {
            var input = event.target;
            var preview = document.getElementById('icon-preview');
            var wrapper = document.getElementById('icon-preview-wrapper');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    // Pastikan wrapper tetap flex dan center
                    wrapper.style.display = 'flex';
                    wrapper.style.justifyContent = 'center';
                    wrapper.style.alignItems = 'center';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }

        // Drag and drop logic
        document.addEventListener('DOMContentLoaded', function () {
            var dropArea = document.getElementById('drop-area');
            var fileInput = document.getElementById('icon');
            var dropText = document.getElementById('drop-text');

            // Klik area untuk trigger file input
            dropArea.addEventListener('click', function (e) {
                if (e.target !== fileInput) {
                    fileInput.click();
                }
            });

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false)
            });

            function preventDefaults(e) {
                e.preventDefault()
                e.stopPropagation()
            }

            // Highlight drop area saat drag
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.add('bg-light'), false)
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.remove('bg-light'), false)
            });

            // Handle drop
            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                var dt = e.dataTransfer;
                var files = dt.files;
                if (files && files.length > 0) {
                    fileInput.files = files;
                    previewIcon({ target: fileInput });
                }
            }
        });
    </script>
@endpush
