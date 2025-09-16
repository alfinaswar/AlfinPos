@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Produk</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master Produk</li>
                </ul>
            </div>
        </div>
    </div>

    @if (Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ Session::get('success') }}',
                iconColor: '#4BCC1F',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#4BCC1F',
            });
        </script>
    @endif

    <div class="row mb-3">
        <div class="col text-end">
            <a class="btn btn-primary" href="{{ route('produk.create') }}">Tambah Produk Baru</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title">Daftar Produk</h4>
                    <p class="card-text">
                        Tabel ini menampilkan seluruh data produk yang tersedia.
                    </p>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-4 mb-2">
                            <label for="filter_kategori" class="form-label">Filter berdasarkan Kategori</label>
                            <select name="filter_kategori" id="filter_kategori" class="form-control select2">
                                <option value="">Semua Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->Nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="filter_urutan_produk" class="form-label">Urutkan Data Berdasarkan</label>
                            <select name="filter_urutan_produk" id="filter_urutan_produk" class="form-control select2">
                                <option value="">Pilih Urutan Data</option>
                                <option value="ASC">Urutkan dari A - Z</option>
                                <option value="DESC">Urutkan dari Z - A</option>
                            </select>
                        </div>



                    </div>

                    <div class="row mb-2">
                        <div class="col d-flex justify-content-end">
                            <button type="button" id="btnFilter" class="btn btn-secondary me-2">Filter</button>
                            <button type="button" id="btnReset" class="btn btn-light">Reset</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew cell-border compact stripe" id="produkTable" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori Item</th>
                                    <th>Jenis Item</th>
                                    <th>Harga Modal</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('body').on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Apakah Anda yakin ingin menghapus produk ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('produk.destroy', ':id') }}'.replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.status === 200) {
                                    Swal.fire('Dihapus!', response.message, 'success');
                                    $('#produkTable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire('Gagal!', response.message, 'error');
                                }
                            },
                            error: function (xhr) {
                                Swal.fire('Gagal!', xhr.responseJSON?.message ?? 'Terjadi kesalahan saat menghapus.', 'error');
                            }
                        });
                    }
                });
            });

            function loadDataTable() {
                $('#produkTable').DataTable({
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    bDestroy: true,
                    ajax: {
                        url: "{{ route('produk.index') }}",
                        data: function (d) {
                            d.filter_kategori = $('#filter_kategori').val();
                            d.filter_urutan_produk = $('#filter_urutan_produk').val();
                        }
                    },
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span>',
                        paginate: {
                            next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                            previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                        }
                    },
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'KodeBarang',
                            name: 'KodeBarang'
                        },
                        {
                            data: 'Nama',
                            name: 'Nama'

                        },
                        {
                            data: 'get_kategori.Nama',
                            name: 'get_kategori.Nama',

                        },
                        {
                            data: 'get_jenis.Nama',
                            name: 'get_jenis.Nama',

                        },
                        {
                            data: 'HargaModal',
                            name: 'HargaModal'
                        },
                        {
                            data: 'HargaJual',
                            name: 'HargaJual'
                        },
                        {
                            data: 'Stok',
                            name: 'Stok'
                        },

                        {
                            data: 'Gambar',
                            name: 'Gambar',
                            orderable: false,
                            searchable: false,
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            }
            loadDataTable();
            $('#btnFilter').on('click', function () {
                $('#produkTable').DataTable().ajax.reload();
            });
            $('#btnReset').on('click', function () {
                $('#filter_kategori').val('').trigger('change');
                $('#filter_urutan_produk').val('').trigger('change');
                $('#produkTable').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
