@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Atasan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master Atasan</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Pilihan Multiple Nama Users --}}
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Pilih Atasan</h4>
                    <p class="card-text mb-0">
                        Silakan pilih satu atau beberapa atasan dari daftar user di bawah ini.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('atasan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ListAtasan" class="form-label"><strong>Nama Atasan</strong></label>
                            <select class="select2" multiple="multiple" name="ListAtasan[]">
                                <option value="m-1">Pilih</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->jabatan ?? 'Tidak Ada' }}</option>
                                @endforeach
                            </select>
                            @error('ListAtasan')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Simpan Atasan
                            </button>
                        </div>
                    </form>
                    <div class="table-responsive mt-3">
                        <table id="tabel-atasan" class="table datanew" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Atasan</th>
                                    <th>Jabatan</th>
                                    <th>Unit</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Budi Santoso</td>
                                    <td>budi@example.com</td>
                                    <td>Keuangan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('js')
        <script>
            $(document).ready(function () {
                $('#tabel-atasan').DataTable();
            });
        </script>
    @endpush
@endsection