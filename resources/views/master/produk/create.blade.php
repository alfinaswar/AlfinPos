@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Produk</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                    <li class="breadcrumb-item active">Tambah Produk</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Formulir Tambah Produk</h4>
                    <p class="card-text mb-0">
                        Silakan isi data produk baru di bawah ini.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="kodebarang" class="form-label"><strong>Kode Barang</strong></label>
                                <input type="text" name="KodeBarang"
                                    class="form-control @error('KodeBarang') is-invalid @enderror" id="kodebarang"
                                    placeholder="Kode Barang" value="{{ old('KodeBarang') }}">
                                @error('KodeBarang')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nama" class="form-label"><strong>Nama Produk</strong></label>
                                <input type="text" name="Nama" class="form-control @error('Nama') is-invalid @enderror"
                                    id="nama" placeholder="Nama Produk" value="{{ old('Nama') }}">
                                @error('Nama')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kategoriitem" class="form-label"><strong>Kategori Item</strong></label>
                            <select name="KategoriItem" id="kategoriitem" onchange="getJenisItem(this.value)"
                                class="form-select select2 @error('KategoriItem') is-invalid @enderror">

                                    <option value="">-- Pilih Kategori Item --</option>
                                    @foreach ($KategoriItem as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('KategoriItem') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('KategoriItem')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jenisitem" class="form-label"><strong>Jenis Item</strong></label>
                                <select name="JenisItem" id="jenisitem" class="form-select  select2 @error('JenisItem') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Item --</option>
                                </select>
                                @error('JenisItem')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hargamodal" class="form-label"><strong>Harga Modal</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" name="HargaModal"
                                            class="form-control @error('HargaModal') is-invalid @enderror" id="hargamodal"
                                            placeholder="Harga Modal" value="{{ old('HargaModal') }}">
                                    </div>
                                    @error('HargaModal')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hargajual" class="form-label"><strong>Harga Jual</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" name="HargaJual"
                                            class="form-control @error('HargaJual') is-invalid @enderror" id="hargajual"
                                            placeholder="Harga Jual" value="{{ old('HargaJual') }}">
                                    </div>
                                    @error('HargaJual')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-4">
                                <label for="stok" class="form-label"><strong>Stok</strong></label>
                                <input type="number" name="Stok" class="form-control @error('Stok') is-invalid @enderror"
                                    id="stok" placeholder="Stok" value="{{ old('Stok') }}">
                                @error('Stok')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label"><strong>Deskripsi</strong></label>
                                <textarea name="Deskripsi" class="form-control @error('Deskripsi') is-invalid @enderror"
                                    id="deskripsi" placeholder="Deskripsi">{{ old('Deskripsi') }}</textarea>
                                @error('Deskripsi')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="gambar" class="form-label"><strong>Gambar</strong></label>
                                <div id="drop-area" class="border border-2 rounded p-3 text-center" style="cursor:pointer;">
                                    <p class="mb-2"><i class="fa fa-cloud-upload fa-2x"></i></p>
                                    <p class="mb-2">Seret dan lepas gambar di sini atau klik untuk memilih file</p>
                                    <input type="file" name="Gambar"
                                        class="form-control d-none @error('Gambar') is-invalid @enderror" id="gambar"
                                        accept="image/*">
                                    <div id="preview-gambar" class="mt-2"></div>
                                </div>
                                @error('Gambar')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="status" class="form-label"><strong>Status</strong></label>
                                <select name="Status" id="status" class="form-select @error('Status') is-invalid @enderror">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Aktif" {{ old('Status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('Status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </select>
                                @error('Status')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary me-2">
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

                function formatRupiah(angka) {
                                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                                        var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
                                    }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
                                }

                document.addEventListener('DOMContentLoaded', function () {
                                    const hargaModal = document.getElementById('hargamodal');
                const hargaJual = document.getElementById('hargajual');

                [hargaModal, hargaJual].forEach(function(input) {
                    input.addEventListener('input', function (e) {
                        let value = this.value.replace(/\./g, '');
                        if (value) {
                            this.value = formatRupiah(value);
                        } else {
                            this.value = '';
                        }
                    });
                                    });
                                });

        function getJenisItem(kategoriId) {
            const jenisSelect = document.getElementById('jenisitem');
            jenisSelect.innerHTML = '<option value="">-- Pilih Jenis Item --</option>';

            if (kategoriId) {
                $.ajax({
                    url: "{{ route('produk.getJenisItem', ':id') }}".replace(':id', kategoriId),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        data.forEach(function (item) {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.text = item.Nama;
                            jenisSelect.appendChild(option);
                        });
                    },
                    error: function (xhr) {
                        console.error('Terjadi kesalahan:', xhr);
                    }
                });
            }
        }
    </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dropArea = document.getElementById('drop-area');
                const inputGambar = document.getElementById('gambar');
                const preview = document.getElementById('preview-gambar');

                // Klik area untuk trigger input file
                dropArea.addEventListener('click', function () {
                    inputGambar.click();
                });

                // Drag over
                dropArea.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    dropArea.classList.add('bg-light');
                });

                // Drag leave
                dropArea.addEventListener('dragleave', function (e) {
                    e.preventDefault();
                    dropArea.classList.remove('bg-light');
                });

                // Drop file
                dropArea.addEventListener('drop', function (e) {
                    e.preventDefault();
                    dropArea.classList.remove('bg-light');
                    if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                        inputGambar.files = e.dataTransfer.files;
                        showPreview(e.dataTransfer.files[0]);
                    }
                });

                // Preview saat pilih file
                inputGambar.addEventListener('change', function (e) {
                    if (inputGambar.files && inputGambar.files[0]) {
                        showPreview(inputGambar.files[0]);
                    }
                });

                function showPreview(file) {
                    if (!file.type.startsWith('image/')) {
                        preview.innerHTML = '<span class="text-danger">File bukan gambar!</span>';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px; max-height: 200px;" />';
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
@endpush
