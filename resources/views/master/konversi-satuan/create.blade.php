@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Master Konversi Satuan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konversi-satuan.index') }}">Master Konversi Satuan</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Konversi Satuan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Formulir Tambah Konversi Satuan</h4>
                    <p class="card-text mb-0">
                        Silakan isi data konversi satuan baru di bawah ini.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('konversi-satuan.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="produk" class="form-label"><strong>Nama Produk</strong></label>
                                <select name="IdProduk" id="produk"
                                    class="select2 form-control @error('IdProduk') is-invalid @enderror">
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produk as $item)
                                        <option value="{{ $item->id }}" {{ old('IdProduk') == $item->id ? 'selected' : '' }}>
                                            {{ $item->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('IdProduk')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="satuan" class="form-label"><strong>Satuan</strong></label>
                                <select name="Satuan" id="satuan" class="select2 form-control @error('Satuan') is-invalid @enderror">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach($satuan as $item)
                                        <option value="{{ $item->NamaSatuan }}" {{ old('Satuan') == $item->NamaSatuan ? 'selected' : '' }}>
                                            {{ $item->NamaSatuan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Satuan')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="isi" class="form-label"><strong>Isi</strong></label>
                                <input type="number" name="Isi" class="form-control @error('Isi') is-invalid @enderror"
                                    id="isi" placeholder="Isi" value="{{ old('Isi') }}">
                                @error('Isi')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="harga_modal" class="form-label"><strong>Harga Modal</strong></label>
                                <input type="number" step="0.01" name="HargaModal"
                                    class="form-control @error('HargaModal') is-invalid @enderror" id="harga_modal"
                                    placeholder="Harga Modal" value="{{ old('HargaModal') }}">
                                @error('HargaModal')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="harga_jual" class="form-label"><strong>Harga Jual</strong></label>
                                <input type="number" step="0.01" name="HargaJual"
                                    class="form-control @error('HargaJual') is-invalid @enderror" id="harga_jual"
                                    placeholder="Harga Jual" value="{{ old('HargaJual') }}">
                                @error('HargaJual')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('konversi-satuan.index') }}" class="btn btn-secondary me-2">
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
