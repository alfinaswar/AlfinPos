@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Shift Kerja</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shift.index') }}">Shift</a></li>
                    <li class="breadcrumb-item active">Tambah Shift</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Formulir Tambah Shift Kerja</h4>
                    <p class="card-text mb-0">
                        Silakan isi data shift kerja baru di bawah ini.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('shift.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="namashift" class="form-label"><strong>Nama Shift</strong></label>
                                <input type="text" name="NamaShift"
                                    class="form-control @error('NamaShift') is-invalid @enderror" id="namashift"
                                    placeholder="Nama Shift" value="{{ old('NamaShift') }}">
                                @error('NamaShift')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jammasuk" class="form-label"><strong>Jam Masuk</strong></label>
                                <input type="time" name="JamMasuk"
                                    class="form-control @error('JamMasuk') is-invalid @enderror" id="jammasuk"
                                    value="{{ old('JamMasuk') }}">
                                @error('JamMasuk')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jampulang" class="form-label"><strong>Jam Pulang</strong></label>
                                <input type="time" name="JamPulang"
                                    class="form-control @error('JamPulang') is-invalid @enderror" id="jampulang"
                                    value="{{ old('JamPulang') }}">
                                @error('JamPulang')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('shift.index') }}" class="btn btn-secondary me-2">
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
