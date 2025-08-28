@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Laporan Penjualan</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Penjualan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Filter Laporan Penjualan</h4>
                    <p class="card-text mb-0">
                        Silakan pilih filter di bawah untuk menampilkan laporan penjualan.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="produk" class="form-label"><strong>Produk</strong></label>
                                <select class="select2 form-control" name="produk" id="produk">
                                    <option value="">Semua Produk</option>
                                    @foreach ($produk as $p)
                                        <option value="{{ $p->id }}" {{ request('produk') == $p->id ? 'selected' : '' }}>
                                            {{ $p->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="kategori" class="form-label"><strong>Kategori Produk</strong></label>
                                <select class="select2 form-control" name="kategori" id="kategori">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                                            {{ $k->Nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="karyawan" class="form-label"><strong>Karyawan</strong></label>
                                <select class="select2 form-control" name="karyawan" id="karyawan">
                                    <option value="">Semua Karyawan</option>
                                    @foreach ($karyawan as $kar)
                                        <option value="{{ $kar->id }}" {{ request('karyawan') == $kar->id ? 'selected' : '' }}>
                                            {{ $kar->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label"><strong>Periode Tanggal</strong></label>
                                    <div class="input-group">
                                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                                            value="{{ request('tanggal_awal') }}">
                                        <span class="input-group-text">s/d</span>
                                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                            value="{{ request('tanggal_akhir') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Tampilkan Laporan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
