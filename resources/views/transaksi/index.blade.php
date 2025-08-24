@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Transaksi</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transaksi</li>
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

    {{-- <div class="row mb-3">
        <div class="col text-end">
            <a class="btn btn-primary" href="{{ route('pos.create') }}">Tambah Transaksi</a>
        </div>
    </div> --}}

    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title">Daftar Transaksi</h4>
                    <p class="card-text">
                        Tabel ini menampilkan seluruh data transaksi yang tersedia.
                    </p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Nama Kasir</label>
                            <select id="filterKasir" class="form-control">
                                <option value="">-- Semua Kasir --</option>
                                @foreach ($kasir as $k)
                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal Transaksi</label>
                            <div class="input-group">
                                <input type="date" id="filterStartDate" class="form-control">
                                <span class="input-group-text">s/d</span>
                                <input type="date" id="filterEndDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Status Transaksi</label>
                            <select id="filterStatus" class="form-control">
                                <option value="">-- Semua Status --</option>
                                <option value="Berhasil">Berhasil</option>
                                <option value="Pending">Pending</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                                <option value="Refund Sebagian">Refund Sebagian</option>
                                <option value="Refund Penuh">Refund Penuh</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button id="applyFilter" class="btn btn-primary me-2">Terapkan</button>
                            <button id="resetFilter" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datanew cell-border compact stripe" id="transaksiTable" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Id Kasir</th>
                                    <th>Jumlah Item</th>
                                    <th>Subtotal</th>
                                    <th>Total Akhir</th>
                                    <th>Status Transaksi</th>
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
        $(document).ready(function() {
            $('body').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Apakah Anda yakin ingin menghapus transaksi ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('pos.destroy', ':id') }}'.replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire('Dihapus!', response.message, 'success');
                                    $('#transaksiTable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire('Gagal!', response.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!', xhr.responseJSON?.message ??
                                    'Terjadi kesalahan saat menghapus.', 'error');
                            }
                        });
                    }
                });
            });

            function loadDataTable() {
                $('#transaksiTable').DataTable({
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    bDestroy: true,
                    ajax: {
                        url: "{{ route('pos.index') }}",
                        data: function(d) {
                            d.kasir = $('#filterKasir').val();
                            d.start_date = $('#filterStartDate').val();
                            d.end_date = $('#filterEndDate').val();
                            d.status = $('#filterStatus').val();
                        }
                    },
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span>',
                        paginate: {
                            next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                            previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'Kode',
                            name: 'Kode',
                            defaultContent: '-'
                        },
                        {
                            data: 'Tanggal',
                            name: 'Tanggal',
                            defaultContent: '-'
                        },
                        {
                            data: 'nama_kasir.name',
                            name: 'nama_kasir.name',
                            defaultContent: '-'
                        },
                        {
                            data: 'JumlahItem',
                            name: 'JumlahItem',
                            defaultContent: '-'
                        },
                        {
                            data: 'Subtotal',
                            name: 'Subtotal',
                            defaultContent: '-'
                        },
                        {
                            data: 'TotalAkhir',
                            name: 'TotalAkhir',
                            defaultContent: '-'
                        },
                        {
                            data: 'Status',
                            name: 'Status',
                            defaultContent: '-'
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

            $('#applyFilter').on('click', function() {
                $('#transaksiTable').DataTable().ajax.reload();
            });

            // reset filter
            $('#resetFilter').on('click', function() {
                $('#filterKasir').val('');
                $('#filterStartDate').val('');
                $('#filterEndDate').val('');
                $('#filterStatus').val('');
                $('#transaksiTable').DataTable().ajax.reload();
            });

        });
    </script>
@endpush
