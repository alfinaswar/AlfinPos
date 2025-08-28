@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Penyesuaian Stok</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Penyesuaian Stok</li>
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
            <a class="btn btn-primary" href="{{ route('so.create') }}">Tambah Penyesuaian Stok</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title">Daftar Penyesuaian Stok</h4>
                    <p class="card-text">
                        Tabel ini menampilkan seluruh data penyesuaian stok yang tersedia.
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datanew cell-border compact stripe" id="adjustStokTable" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode SO</th>
                                    <th>Tanggal</th>
                                    <th>Petugas</th>
                                    <th>Status</th>
                                    <th>Disetujui Pada</th>
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
                    text: "Apakah Anda yakin ingin menghapus penyesuaian stok ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('so.destroy', ':id') }}'.replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.status === 200) {
                                    Swal.fire('Dihapus!', response.message, 'success');
                                    $('#adjustStokTable').DataTable().ajax.reload();
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
                $('#adjustStokTable').DataTable({
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    bDestroy: true,
                    ajax: {
                        url: "{{ route('so.index') }}",
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
                            data: 'KodeSo',
                            name: 'KodeSo',
                            defaultContent: '-'
                        },
                        {
                            data: 'Tanggal',
                            name: 'Tanggal',
                            defaultContent: '-'
                        },
                        {
                            data: 'UserCreate',
                            name: 'UserCreate',
                            defaultContent: '-'
                        },
                        {
                            data: 'Status',
                            name: 'Status',
                            defaultContent: '-'
                        },
                        {
                            data: 'ApproveAt',
                            name: 'ApproveAt',
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
        });
    </script>
@endpush
