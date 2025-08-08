@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Barang Masuk</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bm.index') }}">Barang Masuk</a></li>
                    <li class="breadcrumb-item active">Tambah Barang Masuk</li>
                </ul>
            </div>
        </div>
    </div>

    <form action="{{ route('bm.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-header bg-dark">
                <h4 class="card-title mb-0">Formulir Barang Masuk</h4>
                <p class="card-text mb-0">
                    Silakan isi data barang masuk di bawah ini.
                </p>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="tanggal" class="form-label"><strong>Tanggal</strong></label>
                        <input type="date" name="Tanggal" id="tanggal"
                            class="form-control @error('Tanggal') is-invalid @enderror"
                            value="{{ old('Tanggal', date('Y-m-d')) }}">
                        @error('Tanggal')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-3">
                        <label for="supplier" class="form-label"><strong>Supplier</strong></label>
                        <select name="Supplier" id="supplier"
                            class="form-control select2 @error('Supplier') is-invalid @enderror">
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers ?? [] as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('Supplier')==$supplier->id ? 'selected' : '' }}>
                                {{ $supplier->Nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('Supplier')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}


                    <div class="col-md-3">
                        <label for="keterangan" class="form-label"><strong>Keterangan</strong></label>
                        <input type="text" name="Keterangan" id="keterangan"
                            class="form-control @error('Keterangan') is-invalid @enderror" value="{{ old('Keterangan') }}"
                            placeholder="Keterangan">
                        @error('Keterangan')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="invoice" class="form-label"><strong>Invoice (Upload Gambar/Dokumen)</strong></label>
                        <div class="mb-2">
                            <div id="drop-area-invoice" class="border border-2 border-dashed rounded p-3 text-center"
                                style="cursor:pointer;">
                                <input type="file" name="Invoice" id="invoice" style="display:none;">
                                <div id="invoice-preview" class="mb-2"></div>
                                <span id="drop-text-invoice">Seret & lepas file di sini, atau klik untuk memilih file
                                    (gambar/dokumen)</span>
                            </div>
                        </div>
                        @error('Invoice')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h5 class="mb-3"><strong>Detail Barang Masuk</strong></h5>
                <p class="mb-3">
                    Tambahkan produk yang masuk beserta jumlah dan harga modalnya.
                </p>
                <div class="table-responsive">
                    <table class="table align-middle" id="table-barang-masuk">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 30%">Produk</th>
                                <th style="width: 15%">Qty</th>
                                <th style="width: 20%">Harga Modal</th>
                                <th style="width: 20%">Subtotal</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="idproduk[]" class="form-control select2 produk-select" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produk ?? [] as $p)
                                            <option value="{{ $p->id }}">{{ $p->Nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="Qty[]" class="form-control qty-input" min="1" value="1"
                                        required>
                                </td>
                                <td>
                                    <input type="text" name="HargaModal[]" class="form-control harga-input" min="0"
                                        value="0" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control subtotal-input" value="0" readonly>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm btn-remove-row" disabled>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <button type="button" class="btn btn-success btn-sm" id="btn-tambah-baris">
                                        <i class="fa fa-plus"></i> Tambah Baris
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-12 text-end mt-3">
                    <a href="{{ route('bm.index') }}" class="btn btn-secondary me-2">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        let rowIdx = 1;
        // Perbaiki: gunakan variabel produk yang sama dengan yang di form utama
        const produkOptions = `
                                                                                                                <option value="">Pilih Produk</option>
                                                                                                                @foreach($produk ?? [] as $p)
                                                                                                                    <option value="{{ $p->id }}">{{ $p->Nama }}</option>
                                                                                                                @endforeach
                                                                                                            `;

        // Fungsi untuk format angka ke format rupiah dengan titik
        function formatRupiah(angka) {
            if (typeof angka === "string") {
                angka = angka.replace(/[^,\d]/g, "");
            }
            let number_string = angka.toString().replace(/[^,\d]/g, ""),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
            return rupiah;
        }

        function parseRupiah(str) {
            return parseInt(str.replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
        }

        function hitungSubtotal(row) {
            let qty = parseFloat(row.find('.qty-input').val()) || 0;
            let hargaStr = row.find('.harga-input').val();
            let harga = parseRupiah(hargaStr);
            let subtotal = qty * harga;
            row.find('.subtotal-input').val(formatRupiah(subtotal));
        }

        $(document).ready(function () {
            // Inisialisasi select2 pada semua select2 yang sudah ada
            $('.select2').select2({
                dropdownParent: $('#table-barang-masuk').parent()
            });

            // Format harga modal saat input
            $('#table-barang-masuk').on('input', '.harga-input', function () {
                let val = $(this).val();
                let angka = parseRupiah(val);
                $(this).val(formatRupiah(angka));
            });

            // Hitung subtotal saat qty atau harga berubah
            $('#table-barang-masuk').on('input', '.qty-input, .harga-input', function () {
                let row = $(this).closest('tr');
                hitungSubtotal(row);
            });

            // Format subtotal saat load awal
            $('#table-barang-masuk tbody tr').each(function () {
                hitungSubtotal($(this));
            });

            $('#btn-tambah-baris').click(function () {
                let newRow = `
                                                                                                                        <tr>
                                                                                                                            <td>
                                                                                                                                <select name="idproduk[]" class="form-control select2 produk-select" required>
                                                                                                                                    ${produkOptions}
                                                                                                                                </select>
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                <input type="number" name="Qty[]" class="form-control qty-input" min="1" value="1" required>
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                <input type="text" name="HargaModal[]" class="form-control harga-input" min="0" value="0" required>
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                <input type="text" class="form-control subtotal-input" value="0" readonly>
                                                                                                                            </td>
                                                                                                                            <td class="text-center">
                                                                                                                                <button type="button" class="btn btn-danger btn-sm btn-remove-row">
                                                                                                                                    <i class="fa fa-trash"></i>
                                                                                                                                </button>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    `;
                // Tambahkan baris baru
                $('#table-barang-masuk tbody').append(newRow);

                // Inisialisasi select2 pada select2 yang baru saja ditambahkan
                // Gunakan dropdownParent agar dropdown tidak tertutup
                $('#table-barang-masuk tbody tr:last .select2').select2({
                    dropdownParent: $('#table-barang-masuk').parent()
                });

                // Hitung subtotal untuk baris baru
                hitungSubtotal($('#table-barang-masuk tbody tr:last'));
                rowIdx++;
            });

            $('#table-barang-masuk').on('click', '.btn-remove-row', function () {
                $(this).closest('tr').remove();
            });

            // Hitung subtotal saat load awal
            $('#table-barang-masuk tbody tr').each(function () {
                hitungSubtotal($(this));
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropArea = document.getElementById('drop-area-invoice');
            const input = document.getElementById('invoice');
            const preview = document.getElementById('invoice-preview');
            const dropText = document.getElementById('drop-text-invoice');

            // Klik area untuk trigger input file
            dropArea.addEventListener('click', function () {
                input.click();
            });

            // Drag over
            dropArea.addEventListener('dragover', function (e) {
                e.preventDefault();
                dropArea.classList.add('bg-light');
            });

            dropArea.addEventListener('dragleave', function (e) {
                e.preventDefault();
                dropArea.classList.remove('bg-light');
            });

            // Drop file
            dropArea.addEventListener('drop', function (e) {
                e.preventDefault();
                dropArea.classList.remove('bg-light');
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    input.files = e.dataTransfer.files;
                    showPreview(e.dataTransfer.files[0]);
                }
            });

            // On file change
            input.addEventListener('change', function (e) {
                if (input.files && input.files[0]) {
                    showPreview(input.files[0]);
                }
            });

            function showPreview(file) {
                // Jika file adalah gambar, tampilkan preview gambar
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview Invoice" class="img-fluid rounded" style="max-height:120px;">';
                        dropText.style.display = 'none';
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Jika file adalah dokumen, tampilkan ikon dan nama file
                    let icon = '';
                    let ext = file.name.split('.').pop().toLowerCase();
                    if (['pdf'].includes(ext)) {
                        icon = '<i class="fa fa-file-pdf text-danger fa-2x"></i>';
                    } else if (['doc', 'docx'].includes(ext)) {
                        icon = '<i class="fa fa-file-word text-primary fa-2x"></i>';
                    } else if (['xls', 'xlsx', 'csv'].includes(ext)) {
                        icon = '<i class="fa fa-file-excel text-success fa-2x"></i>';
                    } else if (['ppt', 'pptx'].includes(ext)) {
                        icon = '<i class="fa fa-file-powerpoint text-warning fa-2x"></i>';
                    } else if (['zip', 'rar'].includes(ext)) {
                        icon = '<i class="fa fa-file-archive text-secondary fa-2x"></i>';
                    } else if (['txt'].includes(ext)) {
                        icon = '<i class="fa fa-file-alt text-muted fa-2x"></i>';
                    } else {
                        icon = '<i class="fa fa-file fa-2x"></i>';
                    }
                    preview.innerHTML = icon + '<div class="mt-2">' + file.name + '</div>';
                    dropText.style.display = 'none';
                }
            }
        });
    </script>
@endpush