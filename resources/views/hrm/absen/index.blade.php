@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Absensi Karyawan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Absensi</li>
                </ul>
            </div>
        </div>
    </div>



    {{-- <div class="row mb-3">
        <div class="col text-end">
            <a class="btn btn-primary" href="{{ route('absen.create') }}">Absen Baru</a>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title">Daftar Absensi</h4>
                    <p class="card-text">
                        Tabel ini menampilkan seluruh data absensi karyawan.
                    </p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="filterKaryawan">Karyawan</label>
                            <select id="filterKaryawan" class="form-control select2">
                                <option value="">-- Semua Karyawan --</option>
                                @foreach ($karyawan as $k)
                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="startDate">Tanggal Awal</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="endDate">Tanggal Akhir</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button id="applyFilter" class="btn btn-primary w-100">Apply Filter</button>
                            <button id="resetFilter" class="btn btn-secondary w-100">Reset</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew cell-border compact stripe" id="absenTable" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Shift</th>
                                    <th>Jenis</th>
                                    <th>Catatan</th>

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
    <script>

        $(document).ready(function () {
            function loadDataTable(karyawan_id = '', start_date = '', end_date = '') {
                $('#absenTable').DataTable({
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    bDestroy: true,
                    ajax: {
                        url: "{{ route('absen.index') }}",
                        data: {
                            karyawan_id: karyawan_id,
                            start_date: start_date,
                            end_date: end_date
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
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'NamaKaryawan', name: 'NamaKaryawan' },
                        { data: 'Tanggal', name: 'Tanggal' },
                        { data: 'Shift', name: 'Shift' },
                        { data: 'Jenis', name: 'Jenis' },
                        { data: 'Catatan', name: 'Catatan' },
                    ]
                });
            }

            loadDataTable();

            $('#applyFilter').click(function () {
                let karyawan_id = $('#filterKaryawan').val();
                let start_date = $('#startDate').val();
                let end_date = $('#endDate').val();
                loadDataTable(karyawan_id, start_date, end_date);
            });

            $('#resetFilter').click(function () {
                $('#filterKaryawan').val('');
                $('#startDate').val('');
                $('#endDate').val('');
                loadDataTable();
            });
        });

    </script>
@endpush
