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
            {{-- FORM START --}}
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- CARD: DATA PRODUK --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="card-title mb-0">Formulir Tambah Produk</h4>
                        <small>Silakan isi data produk baru di bawah ini.</small>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">

                            {{-- Kode Barang --}}
                            <div class="col-md-6">
                                <label for="kodebarang" class="form-label"><strong>Kode Barang</strong></label>
                                <input type="text" name="KodeBarang"
                                    class="form-control @error('KodeBarang') is-invalid @enderror" id="kodebarang"
                                    placeholder="Kode Barang" value="{{ old('KodeBarang') }}">
                                @error('KodeBarang')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nama Produk --}}
                            <div class="col-md-6">
                                <label for="nama" class="form-label"><strong>Nama Produk</strong></label>
                                <input type="text" name="Nama"
                                    class="form-control @error('Nama') is-invalid @enderror" id="nama"
                                    placeholder="Nama Produk" value="{{ old('Nama') }}">
                                @error('Nama')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kategori Item --}}
                            <div class="col-md-6">
                                <label for="kategoriitem" class="form-label"><strong>Kategori Item</strong></label>
                                <select name="KategoriItem" id="kategoriitem" onchange="getJenisItem(this.value)"
                                    class="form-select select2 @error('KategoriItem') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori Item --</option>
                                    @foreach ($KategoriItem as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ old('KategoriItem') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('KategoriItem')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jenis Item --}}
                            <div class="col-md-6">
                                <label for="jenisitem" class="form-label"><strong>Jenis Item</strong></label>
                                <select name="JenisItem" id="jenisitem"
                                    class="form-select select2 @error('JenisItem') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Item --</option>
                                </select>
                                @error('JenisItem')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stok --}}
                            <div class="col-md-6">
                                <label for="stok" class="form-label"><strong>Stok</strong></label>
                                <input type="number" name="Stok"
                                    class="form-control @error('Stok') is-invalid @enderror" id="stok"
                                    placeholder="Stok" value="{{ old('Stok') }}">
                                @error('Stok')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label"><strong>Status</strong></label>
                                <select name="Status" id="status"
                                    class="form-select @error('Status') is-invalid @enderror">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Aktif" {{ old('Status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('Status') == 'Tidak Aktif' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
                                @error('Status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label"><strong>Deskripsi</strong></label>
                                <textarea name="Deskripsi" class="form-control @error('Deskripsi') is-invalid @enderror" id="deskripsi" rows="3"
                                    placeholder="Deskripsi">{{ old('Deskripsi') }}</textarea>
                                @error('Deskripsi')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Upload Gambar --}}
                            <div class="col-md-12">
                                <label for="gambar" class="form-label"><strong>Gambar</strong></label>
                                <div id="drop-area" class="border border-2 rounded p-3 text-center" style="cursor:pointer;">
                                    <p class="mb-2"><i class="fa fa-cloud-upload fa-2x"></i></p>
                                    <p class="mb-2">Seret & lepas gambar atau klik untuk memilih file</p>
                                    <input type="file" name="Gambar"
                                        class="form-control d-none @error('Gambar') is-invalid @enderror" id="gambar"
                                        accept="image/*">
                                    <div id="preview-gambar" class="mt-2"></div>
                                </div>
                                @error('Gambar')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- CARD: KONVERSI & HARGA --}}
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="card-title mb-0">Konversi Dan Harga</h4>
                            <small>Silakan isi data Konversi Dan Harga baru di bawah ini.</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="konversi-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th>Satuan</th>
                                            <th>Isi</th>
                                            <th>Harga Modal</th>
                                            <th>Harga Jual</th>
                                            <th style="width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="konversi-table-body">
                                        <tr>
                                            <td class="row-number">1</td>
                                            <td>
                                                <select name="Satuan[]" class="form-control select2">
                                                    <option value="">Pilih Satuan</option>
                                                    @foreach ($Satuan as $s)
                                                        <option value="{{ $s->id }}">{{ $s->NamaSatuan }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" name="Isi[]" class="form-control" placeholder="Isi"></td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" name="HargaModal[]" class="form-control rupiah"
                                                        placeholder="Harga Modal"
                                                        onkeyup="this.value = formatRupiah(this.value)">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" name="HargaJual[]" class="form-control rupiah"
                                                        placeholder="Harga Jual"
                                                        onkeyup="this.value = formatRupiah(this.value)">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-success btn-sm mt-2" id="add-konversi-row">
                                <i class="fa fa-plus"></i> Tambah Satuan Konversi
                            </button>
                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary me-2">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>

                    </div>


                </div>

                {{-- TOMBOL --}}

            </form>
            {{-- FORM END --}}
        </div>
    </div>
@endsection


@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableBody = document.getElementById('konversi-table-body');
            const addRowBtn = document.getElementById('add-konversi-row');

            function updateRowNumbers() {
                [...tableBody.querySelectorAll('tr')].forEach((row, index) => {
                    row.querySelector('.row-number').innerText = index + 1;
                });
            }

            function addRow() {

                const row = document.createElement('tr');
                row.innerHTML = `
                <td class="row-number"></td>
                <td>
                    <select name="Satuan[]" class="form-control select2-dynamic">
                        <option value="">Pilih Satuan</option>
                        @foreach ($Satuan as $s)
                            <option value="{{ $s->id }}">{{ $s->NamaSatuan }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="Isi[]" class="form-control" placeholder="Isi">
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="HargaModal[]" class="form-control rupiah"
                            placeholder="Harga Modal"
                            onkeyup="this.value = formatRupiah(this.value)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="HargaJual[]" class="form-control rupiah"
                            placeholder="Harga Jual"
                            onkeyup="this.value = formatRupiah(this.value)">
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            `;
                tableBody.appendChild(row);
                updateRowNumbers();

                // Inisialisasi select2 jika digunakan
                if (typeof $ !== 'undefined' && $.fn.select2) {
                    $(row).find('.select2-dynamic').select2();
                }
            }

            addRowBtn.addEventListener('click', addRow);

            tableBody.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    e.target.closest('tr').remove();
                    updateRowNumbers();
                }
            });
        });
    </script>
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

        // Catatan: id="hargamodal" dan id="hargajual" tidak ada di form, jadi event ini tidak akan jalan
        // Jika ingin auto-format di semua input harga, gunakan class selector
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input.rupiah').forEach(function(input) {
                input.addEventListener('input', function(e) {
                    let value = this.value.replace(/\./g, '');
                    if (value) {
                        this.value = formatRupiah(value);
                    } else {
                        this.value = '';
                    }
                });
            });
        });

        function getJenisItem(kategoriId, selectedJenis = null) {
            const jenisSelect = document.getElementById('jenisitem');
            jenisSelect.innerHTML = '<option value="">-- Pilih Jenis Item --</option>';

            if (kategoriId) {
                $.ajax({
                    url: "{{ route('produk.getJenisItem', ':id') }}".replace(':id', kategoriId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        data.forEach(function(item) {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.text = item.Nama;
                            if (selectedJenis && selectedJenis == item.id) {
                                option.selected = true;
                            }
                            jenisSelect.appendChild(option);
                        });
                    },
                    error: function(xhr) {
                        console.error('Terjadi kesalahan:', xhr);
                    }
                });
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropArea = document.getElementById('drop-area');
            const inputGambar = document.getElementById('gambar');
            const preview = document.getElementById('preview-gambar');

            // Klik area untuk trigger input file
            dropArea.addEventListener('click', function() {
                inputGambar.click();
            });

            // Drag over
            dropArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropArea.classList.add('bg-light');
            });

            // Drag leave
            dropArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                dropArea.classList.remove('bg-light');
            });

            // Drop file
            dropArea.addEventListener('drop', function(e) {
                e.preventDefault();
                dropArea.classList.remove('bg-light');
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    inputGambar.files = e.dataTransfer.files;
                    showPreview(e.dataTransfer.files[0]);
                }
            });

            // Preview saat pilih file
            inputGambar.addEventListener('change', function(e) {
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
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result +
                        '" class="img-thumbnail" style="max-width: 200px; max-height: 200px;" />';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
