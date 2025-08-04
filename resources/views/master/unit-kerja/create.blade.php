@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Unit Kerja</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('muk.index') }}">Daftar Unit Kerja</a></li>
                    <li class="breadcrumb-item active">Tambah Unit Kerja</li>
                </ul>
            </div>
        </div>
    </div>



    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Formulir Tambah Unit Kerja</h4>
                    <p class="card-text mb-0">
                        Silakan isi data unit kerja baru di bawah ini.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('muk.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="nama" class="form-label"><strong>Nama Unit Kerja</strong></label>
                                <input type="text" name="Nama" class="form-control @error('Nama') is-invalid @enderror"
                                    id="nama" placeholder="Nama Unit Kerja" value="{{ old('Nama') }}">
                                @error('Nama')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kode_unit" class="form-label"><strong>Kode Unit</strong></label>
                                <input type="text" name="KodeUnit"
                                    class="form-control @error('KodeUnit') is-invalid @enderror" id="KodeUnit"
                                    placeholder="Kode Unit" value="{{ old('KodeUnit') }}">
                                @error('KodeUnit')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="Deskripsi" class="form-label"><strong>Deskripsi</strong></label>
                                <textarea name="Deskripsi" id="Deskripsi"
                                    class="form-control @error('Deskripsi') is-invalid @enderror" rows="4"
                                    placeholder="Deskripsi Unit Kerja">{{ old('Deskripsi') }}</textarea>
                                @error('Deskripsi')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('muk.index') }}" class="btn btn-secondary me-2">
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