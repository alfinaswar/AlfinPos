@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Edit Penyesuaian Stok</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('so.index') }}">Penyesuaian Stok</a></li>
                    <li class="breadcrumb-item active">Edit Penyesuaian Stok</li>
                </ul>
            </div>
        </div>
    </div>

    <form action="{{ route('so.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card mb-4">
            <div class="card-header bg-dark">
                <h4 class="card-title mb-0">Formulir Edit Penyesuaian Stok</h4>
                <p class="card-text mb-0">
                    Silakan ubah data penyesuaian stok di bawah ini.
                </p>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="tanggal" class="form-label"><strong>Tanggal</strong></label>
                        <input type="date" name="Tanggal" id="tanggal"
                            class="form-control @error('Tanggal') is-invalid @enderror"
                            value="{{ old('Tanggal', $data->Tanggal) }}">
                        @error('Tanggal')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-5">
                        <label for="alasan" class="form-label"><strong>Alasan</strong></label>
                        <input type="text" name="Alasan" id="alasan"
                            class="form-control @error('Alasan') is-invalid @enderror" value="{{ old('Alasan', $data->Alasan) }}"
                            placeholder="Alasan penyesuaian">
                        @error('Alasan')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="petugas" class="form-label"><strong>Petugas</strong></label>
                        <input type="text" name="Petugas" id="petugas"
                            class="form-control @error('Petugas') is-invalid @enderror"
                            value="{{ old('Petugas', $data->UserCreate ?? Auth::user()->name ?? '') }}" placeholder="Nama Petugas" readonly>
                        @error('Petugas')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h5 class="mb-3"><strong>Detail Penyesuaian Stok</strong></h5>
                <p class="mb-3">
                    Ubah produk yang ingin disesuaikan stoknya.
                </p>
                <div class="table-responsive">
                    <table class="table align-middle" id="table-adjust-stok">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 25%">Produk</th>
                                <th style="width: 15%">Stok Saat Ini</th>
                                <th style="width: 15%">Real Stok</th>
                                <th style="width: 15%">Penyesuaian</th>
                                <th style="width: 20%">Jenis</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $produkList = $produk ?? \App\Models\Produk::orderBy('Nama', 'ASC')->get();
                                $details = $data->DetailSO ?? [];
                            @endphp
                            @forelse($details as $key => $detail)
                                <tr>
                                    <td>
                                        <select name="IdProduk[]" class="form-control select2 produk-select" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach($produkList as $p)
                                                <option value="{{ $p->id }}" data-stok="{{ $p->Stok }}"
                                                    {{ $detail->IdProduk == $p->id ? 'selected' : '' }}>
                                                    {{ $p->Nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="StokAwal[]" class="form-control stok-awal-input" min="0"
                                            value="{{ $detail->StokAwal }}" required readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="StokAkhir[]" class="form-control stok-akhir-input" min="0"
                                            value="{{ $detail->StokAkhir }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="Penyesuaian[]" class="form-control penyesuaian-input"
                                            value="{{ $detail->Penyesuaian }}" readonly>
                                    </td>
                                    <td>
                                        <select name="Jenis[]" class="form-control jenis-select" required>
                                            <option value="">Pilih Jenis</option>
                                            <option value="Penambahan" {{ $detail->Jenis == 'Penambahan' || $detail->Jenis == 'tambah' ? 'selected' : '' }}>Penambahan</option>
                                            <option value="Pengurangan" {{ $detail->Jenis == 'Pengurangan' || $detail->Jenis == 'kurang' ? 'selected' : '' }}>Pengurangan</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-row" {{ $loop->first && count($details) == 1 ? 'disabled' : '' }}>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <select name="IdProduk[]" class="form-control select2 produk-select" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach($produkList as $p)
                                                <option value="{{ $p->id }}" data-stok="{{ $p->Stok }}">
                                                    {{ $p->Nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="StokAwal[]" class="form-control stok-awal-input" min="0"
                                            value="0" required readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="StokAkhir[]" class="form-control stok-akhir-input" min="0"
                                            value="0" required>
                                    </td>
                                    <td>
                                        <input type="text" name="Penyesuaian[]" class="form-control penyesuaian-input" value="0"
                                            readonly>
                                    </td>
                                    <td>
                                        <select name="Jenis[]" class="form-control jenis-select" required>
                                            <option value="">Pilih Jenis</option>
                                            <option value="Penambahan">Penambahan</option>
                                            <option value="Pengurangan">Pengurangan</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-row" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <button type="button" class="btn btn-success btn-sm" id="btn-tambah-baris">
                                        <i class="fa fa-plus"></i> Tambah Baris
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-12 text-end mt-3">
                    <a href="{{ route('so.index') }}" class="btn btn-secondary me-2">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        let rowIdx = {{ isset($details) ? count($details) : 1 }};
        const produkOptions = `
            <option value="">Pilih Produk</option>
            @foreach($produk ?? \App\Models\Produk::orderBy('Nama', 'ASC')->get() as $p)
                <option value="{{ $p->id }}" data-stok="{{ $p->Stok ?? 0 }}">{{ $p->Nama }}</option>
            @endforeach
        `;

        function formatPenyesuaian(val) {
            if (val < 0) {
                return '-' + Math.abs(val);
            }
            return val;
        }

        function hitungPenyesuaian(row) {
            let awal = parseInt(row.find('.stok-awal-input').val()) || 0;
            let akhir = parseInt(row.find('.stok-akhir-input').val()) || 0;
            let penyesuaian = akhir - awal;
            row.find('.penyesuaian-input').val(formatPenyesuaian(penyesuaian));

            // Set Jenis otomatis
            let jenis = '';
            if (penyesuaian > 0) {
                jenis = 'Penambahan';
            } else if (penyesuaian < 0) {
                jenis = 'Pengurangan';
            } else {
                jenis = '';
            }
            row.find('.jenis-select').val(jenis);
        }

        $(document).ready(function () {
            $('.select2').select2({
                dropdownParent: $('#table-adjust-stok').parent()
            });
            $(document).on('change', '.produk-select', function () {
                let stok = $(this).find(':selected').data('stok');
                $(this).closest('tr').find('.stok-awal-input').val(stok);
                let row = $(this).closest('tr');
                hitungPenyesuaian(row);
            });
            $('#table-adjust-stok').on('input', '.stok-awal-input, .stok-akhir-input', function () {
                let row = $(this).closest('tr');
                hitungPenyesuaian(row);
            });

            // Tambah baris baru
            $('#btn-tambah-baris').click(function () {
                let newRow = `
                    <tr>
                        <td>
                            <select name="IdProduk[]" class="form-control select2 produk-select" required>
                                ${produkOptions}
                            </select>
                        </td>
                        <td>
                            <input type="number" name="StokAwal[]" class="form-control stok-awal-input" min="0" value="0" readonly required>
                        </td>
                        <td>
                            <input type="number" name="StokAkhir[]" class="form-control stok-akhir-input" min="0" value="0" required>
                        </td>
                        <td>
                            <input type="text" name="Penyesuaian[]" class="form-control penyesuaian-input" value="0" readonly>
                        </td>
                        <td>
                            <select name="Jenis[]" class="form-control jenis-select" required>
                                <option value="">Pilih Jenis</option>
                                <option value="Penambahan">Penambahan</option>
                                <option value="Pengurangan">Pengurangan</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm btn-remove-row">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#table-adjust-stok tbody').append(newRow);

                // Inisialisasi select2 pada select2 yang baru saja ditambahkan
                $('#table-adjust-stok tbody tr:last .select2').select2({
                    dropdownParent: $('#table-adjust-stok').parent()
                });
            });

            // Hapus baris
            $('#table-adjust-stok').on('click', '.btn-remove-row', function () {
                $(this).closest('tr').remove();
            });

            // Hitung penyesuaian saat load awal
            $('#table-adjust-stok tbody tr').each(function () {
                hitungPenyesuaian($(this));
            });
        });
    </script>
@endpush
