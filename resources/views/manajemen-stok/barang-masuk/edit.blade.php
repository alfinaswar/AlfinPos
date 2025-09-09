@extends('layouts.app')

@section('content')
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Barang Masuk</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bm.index') }}">Barang Masuk</a></li>
                            <li class="breadcrumb-item active">Edit Barang Masuk</li>
                        </ul>
                    </div>
                </div>
            </div>

            <form action="{{ route('bm.update', $bm->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card mb-4">
                    <div class="card-header bg-dark">
                        <h4 class="card-title mb-0">Edit Barang Masuk</h4>
                        <p class="card-text mb-0">
                            Silakan ubah data barang masuk di bawah ini.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label for="tanggal" class="form-label"><strong>Tanggal</strong></label>
                                <input type="date" name="Tanggal" id="tanggal"
                                    class="form-control @error('Tanggal') is-invalid @enderror"
                                    value="{{ old('Tanggal', $bm->Tanggal ?? date('Y-m-d')) }}">
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
                                    <option value="{{ $supplier->id }}" {{ old('Supplier', $bm->Supplier ?? '')==$supplier->id ? 'selected' : '' }}>
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
                                    class="form-control @error('Keterangan') is-invalid @enderror"
                                    value="{{ old('Keterangan', $bm->Keterangan ?? '') }}"
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
                                        <div id="invoice-preview" class="mb-2">
                                            @if($bm->Invoice)
                                                @php
        $ext = pathinfo($bm->Invoice, PATHINFO_EXTENSION);
        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                                @endphp
                                                @if($isImage)
                                                    <img src="{{ asset('storage/' . $bm->Invoice) }}" class="img-thumbnail" style="max-width:200px;max-height:200px;" />
                                                @else
                                                    <a href="{{ asset('storage/' . $bm->Invoice) }}" target="_blank">
                                                        <i class="bi bi-file-earmark" style="font-size:2rem;"></i>
                                                        <div>{{ basename($bm->Invoice) }}</div>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
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
                            Ubah produk yang masuk beserta jumlah dan harga modalnya.
                        </p>
                        <div class="table-responsive">
                            <table class="table align-middle" id="table-barang-masuk">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 30%">Produk</th>
                                        <th style="width: 12%">Qty</th>
                                        <th style="width: 13%">Satuan</th>
                                        <th style="width: 20%">Harga Modal</th>
                                        <th style="width: 20%">Subtotal</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
    $details = old('idproduk') ? collect(old('idproduk'))->map(function ($id, $i) use ($produk, $bm) {
        return [
            'idproduk' => $id,
            'Qty' => old('Qty')[$i] ?? 1,
            'Satuan' => old('Satuan')[$i] ?? '',
            'HargaModal' => old('HargaModal')[$i] ?? 0,
            'Subtotal' => old('Subtotal')[$i] ?? 0,
        ];
    }) : ($bm->DetailBarangMasuk ?? collect());
                                    @endphp
                                    @if($details && count($details))
                                        @foreach($details as $i => $detail)
                                                                                                                        <tr>
                                                                                                                            <td>
                                                                                                                                <select name="idproduk[]" class="form-control select2 produk-select" required>
                                                                                                                                    <option value="">Pilih Produk</option>
                                                                                                                                    @foreach($produk ?? [] as $p)
                                                                                                                                        <option value="{{ $p->id }}"
                                                                                                                                            data-satuan='@json(
                                                            $p->konversi->map(function ($k) {
                                                                return [
                                                                    'id' => $k->id,
                                                                    'Satuan' => $k->getNamaSatuan ? $k->getNamaSatuan->NamaSatuan : '',
                                                                    'Isi' => $k->Isi
                                                                ];
                                                            })
                                                        )'
                                                                                                                                            {{ (old('idproduk') ? old('idproduk')[$i] : ($detail->idProduk ?? $detail['idProduk'] ?? null)) == $p->id ? 'selected' : '' }}>
                                                                                                                                            {{ $p->Nama }}
                                                                                                                                        </option>
                                                                                                                                    @endforeach
                                                                                                                                </select>
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                <input type="number" name="Qty[]" class="form-control qty-input" min="1"
                                                                                                                                    value="{{ old('Qty')[$i] ?? ($detail->Qty ?? $detail['Qty'] ?? 1) }}" required>
                                                                                                                            </td>
                                                                                                                            <td>
                                            @php
                                                $selectedProdukId = old('idproduk') ? old('idproduk')[$i] : ($detail->idProduk ?? $detail['idProduk'] ?? null);
                                                $selectedSatuanId = old('Satuan')[$i]
                                                    ?? ($detail->IdSatuan ?? $detail['IdSatuan'] ?? $detail->Satuan ?? $detail['Satuan'] ?? null);

                                            
                                                $produkItem = ($produk ?? collect())->firstWhere('id', $selectedProdukId);
                                                $satuanList = $produkItem && $produkItem->konversi ? $produkItem->konversi : collect();
                                            @endphp
                                            <select name="Satuan[]" class="form-control satuan-select" required>
                                                <option value="">Pilih Satuan</option>
                                                @foreach($satuanList as $satuan)
                                                    <option value="{{ $satuan->id }}"
                                                        {{ (string)$selectedSatuanId === (string)$satuan->id ? 'selected' : '' }}>
                                                        {{ $satuan->getNamaSatuan ? $satuan->getNamaSatuan->NamaSatuan : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                                                                                                            <td>
                                                                                                                                <input type="text" name="HargaModal[]" class="form-control harga-input" min="0"
                                                                                                                                    value="{{ old('HargaModal')[$i] ?? ($detail->HargaModal ?? $detail['HargaModal'] ?? 0) }}" required>
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                <input type="text" class="form-control subtotal-input" name="Subtotal[]"
                                                                                                                                    value="{{ old('Subtotal')[$i] ?? ($detail->Subtotal ?? $detail['Subtotal'] ?? 0) }}" readonly>
                                                                                                                            </td>
                                                                                                                            <td class="text-center">
                                                                                                                                <button type="button" class="btn btn-danger btn-sm btn-remove-row" {{ $loop->first && count($details) == 1 ? 'disabled' : '' }}>
                                                                                                                                    <i class="fa fa-trash"></i>
                                                                                                                                </button>
                                                                                                                            </td>
                                                                                                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <select name="idproduk[]" class="form-control select2 produk-select" required>
                                                    <option value="">Pilih Produk</option>
                                                    @foreach($produk ?? [] as $p)
                                                        <option value="{{ $p->id }}" data-satuan='@json(
                $p->konversi->map(function ($k) {
                    return [
                        'id' => $k->id,
                        'Satuan' => $k->getNamaSatuan ? $k->getNamaSatuan->NamaSatuan : '',
                        'Isi' => $k->Isi
                    ];
                })
            )'>
                                                            {{ $p->Nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="Qty[]" class="form-control qty-input" min="1" value="1"
                                                    required>
                                            </td>
                                            <td>
                                                <select name="Satuan[]" class="form-control satuan-select" required>
                                                    <option value="">Pilih Satuan</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="HargaModal[]" class="form-control harga-input" min="0"
                                                    value="0" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control subtotal-input" name="Subtotal[]" value="0"
                                                    readonly>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm btn-remove-row" disabled>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn btn-success btn-sm" id="btn-tambah-baris">
                                                <i class="fa fa-plus"></i> Tambah Baris
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total</strong></td>
                                        <td>
                                            <input type="text" name="Total" id="total-barang-masuk" class="form-control"
                                                value="{{ old('Total', $bm->Total ?? 0) }}" readonly>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <a href="{{ route('bm.index') }}" class="btn btn-secondary me-2">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Drag & Drop Invoice ---
            const dropArea = document.getElementById('drop-area-invoice');
            const inputInvoice = document.getElementById('invoice');
            const preview = document.getElementById('invoice-preview');
            const dropText = document.getElementById('drop-text-invoice');

            if (dropArea && inputInvoice && preview && dropText) {
                dropArea.addEventListener('click', () => inputInvoice.click());

                dropArea.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    dropArea.classList.add('bg-light');
                });

                dropArea.addEventListener('dragleave', function (e) {
                    e.preventDefault();
                    dropArea.classList.remove('bg-light');
                });

                dropArea.addEventListener('drop', function (e) {
                    e.preventDefault();
                    dropArea.classList.remove('bg-light');
                    if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                        inputInvoice.files = e.dataTransfer.files;
                        showPreview(e.dataTransfer.files[0]);
                    }
                });

                inputInvoice.addEventListener('change', function () {
                    if (inputInvoice.files && inputInvoice.files[0]) {
                        showPreview(inputInvoice.files[0]);
                    }
                });

                function showPreview(file) {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            preview.innerHTML =
                                '<img src="' + e.target.result +
                                '" class="img-thumbnail" style="max-width:200px;max-height:200px;" />';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        let icon = '';
                        if (file.type === 'application/pdf') {
                            icon = '<i class="bi bi-file-earmark-pdf text-danger" style="font-size:2rem;"></i>';
                        } else if (
                            file.type === 'application/msword' ||
                            file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                        ) {
                            icon = '<i class="bi bi-file-earmark-word text-primary" style="font-size:2rem;"></i>';
                        } else if (
                            file.type === 'application/vnd.ms-excel' ||
                            file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        ) {
                            icon = '<i class="bi bi-file-earmark-excel text-success" style="font-size:2rem;"></i>';
                        } else {
                            icon = '<i class="bi bi-file-earmark" style="font-size:2rem;"></i>';
                        }
                        preview.innerHTML = icon + '<div>' + file.name + '</div>';
                    }
                }
            }


            let rowIdx = $('#table-barang-masuk tbody tr').length;
            const produkOptions = `
                    <option value="">Pilih Produk</option>
                    @foreach($produk ?? [] as $p)
                        <option value="{{ $p->id }}" data-satuan='@json(
        $p->konversi->map(function ($k) {
            return [
                'id' => $k->id,
                'Satuan' => $k->getNamaSatuan ? $k->getNamaSatuan->NamaSatuan : '',
                'Isi' => $k->Isi
            ];
        })
    )'>
                            {{ $p->Nama }}
                        </option>
                    @endforeach
                `;

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
                return parseInt((str || '').replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
            }

            function hitungSubtotal($row) {
                let qty = parseFloat($row.find('.qty-input').val()) || 0;
                let hargaStr = $row.find('.harga-input').val();
                let harga = parseRupiah(hargaStr);
                let subtotal = qty * harga;
                $row.find('.subtotal-input').val(formatRupiah(subtotal));
            }

            function hitungTotal() {
                let total = 0;
                $('#table-barang-masuk tbody tr').each(function () {
                    let subtotalStr = $(this).find('.subtotal-input').val();
                    let subtotal = parseRupiah(subtotalStr);
                    total += subtotal;
                });
                $('#total-barang-masuk').val(formatRupiah(total));
            }

            function updateSatuanSelect($produkSelect) {
                let $row = $produkSelect.closest('tr');
                let $satuanSelect = $row.find('.satuan-select');
                $satuanSelect.empty().append('<option value="">Pilih Satuan</option>');

                let satuanData = $produkSelect.find('option:selected').data('satuan');
                if (typeof satuanData === 'string') {
                    try {
                        satuanData = JSON.parse(satuanData);
                    } catch (e) {
                        satuanData = [];
                    }
                }

                if (satuanData && Array.isArray(satuanData)) {
                    satuanData.forEach(function (s) {
                        let namaSatuan = s.Satuan || s.NamaSatuan || (s.getNamaSatuan && s.getNamaSatuan.NamaSatuan) || '-';
                        $satuanSelect.append('<option value="' + s.id + '">' + namaSatuan + '</option>');
                    });
                }
            }

            // Init table events
            $('.select2').select2({ dropdownParent: $('#table-barang-masuk').parent() });

            // Set satuan select for each row on load
            $('#table-barang-masuk tbody tr').each(function () {
                let $row = $(this);
                let $produkSelect = $row.find('.produk-select');
                updateSatuanSelect($produkSelect);

                // Set selected satuan if exists
                let selectedSatuan = $row.find('.satuan-select').data('selected');
                if (selectedSatuan) {
                    $row.find('.satuan-select').val(selectedSatuan);
                }
            });

            $('#table-barang-masuk').on('change', '.produk-select', function () {
                updateSatuanSelect($(this));
            });

            $('#table-barang-masuk').on('input', '.harga-input', function () {
                let angka = parseRupiah($(this).val());
                $(this).val(formatRupiah(angka));
            });

            $('#table-barang-masuk').on('input', '.qty-input, .harga-input', function () {
                let row = $(this).closest('tr');
                hitungSubtotal(row);
                hitungTotal();
            });

            // Hitung ulang saat load
            $('#table-barang-masuk tbody tr').each(function () {
                hitungSubtotal($(this));
            });
            hitungTotal();

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
                            <select name="Satuan[]" class="form-control satuan-select" required>
                                <option value="">Pilih Satuan</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="HargaModal[]" class="form-control harga-input" value="0" required>
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
                $('#table-barang-masuk tbody').append(newRow);
                let $lastRow = $('#table-barang-masuk tbody tr:last');
                $lastRow.find('.select2').select2({ dropdownParent: $('#table-barang-masuk').parent() });
                updateSatuanSelect($lastRow.find('.produk-select'));
                hitungSubtotal($lastRow);
                hitungTotal();
                rowIdx++;
            });

            $('#table-barang-masuk').on('click', '.btn-remove-row', function () {
                $(this).closest('tr').remove();
                hitungTotal();
            });
        });
    </script>
@endpush
