@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Jenis Item</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jenis.index') }}">Jenis Item</a></li>
                    <li class="breadcrumb-item active">Edit Jenis</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Formulir Edit Jenis</h4>
                    <p class="card-text mb-0">
                        Silakan ubah data jenis item di bawah ini.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="KategoriItem" class="form-label"><strong>Kategori Item</strong></label>
                                <select class="select2 form-control @error('KategoriItem') is-invalid @enderror"
                                    name="KategoriItem">
                                    <option value="">Pilih</option>
                                    @foreach ($KategoriItem as $kat)
                                        <option value="{{ $kat->id }}" {{ (old('KategoriItem', $jenis->KategoriItem) == $kat->id) ? 'selected' : '' }}>
                                            {{ $kat->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('KategoriItem')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="form-label"><strong>Nama Jenis</strong></label>
                                <input type="text" name="Nama" class="form-control @error('Nama') is-invalid @enderror"
                                    id="nama" placeholder="Nama Jenis" value="{{ old('Nama', $jenis->Nama) }}">
                                @error('Nama')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('jenis.index') }}" class="btn btn-secondary me-2">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Update
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection