@extends('layouts.app')

@section('content')
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Detail Penyesuaian Stok</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('so.index') }}">Penyesuaian Stok</a></li>
                        <li class="breadcrumb-item active">Detail Penyesuaian Stok</li>
                    </ul>
                </div>
            </div>
        </div>

        <form>
            <div class="card mb-4">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Informasi Penyesuaian Stok</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-3" style="max-width: 500px;">
                        <tbody>
                            <tr>
                                <th style="width: 150px;">Kode SO</th>
                                <td>: {{ $data->KodeSo }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>: {{ \Carbon\Carbon::parse($data->Tanggal)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Alasan</th>
                                <td>: {{ $data->Alasan }}</td>
                            </tr>
                            <tr>
                                <th>Petugas</th>
                                <td>: {{ $data->UserCreate }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @php
    $details = \App\Models\StockAjustDetail::where('IdSo', $data->id)->get();
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 30%;">Nama Produk</th>
                                    <th style="width: 15%;">Stok Awal</th>
                                    <th style="width: 15%;">Stok Akhir</th>
                                    <th style="width: 15%;">Penyesuaian</th>
                                    <th style="width: 20%;">Jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($details as $key => $detail)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ optional(\App\Models\Produk::find($detail->IdProduk))->Nama ?? '-' }}
                                        </td>
                                        <td>{{ $detail->StokAwal }}</td>
                                        <td>{{ $detail->StokAkhir }}</td>
                                        <td>{{ $detail->Penyesuaian }}</td>
                                        <td>
                                            @if($detail->Jenis == 'Penambahan' || $detail->Jenis == 'tambah')
                                                <span class="badge bg-success">Penambahan</span>
                                            @elseif($detail->Jenis == 'Pengurangan' || $detail->Jenis == 'kurang')
                                                <span class="badge bg-danger">Pengurangan</span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada detail penyesuaian stok.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




            <div class="col-12 text-end mt-3">
                <a href="{{ route('so.index') }}" class="btn btn-secondary me-2">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
@endsection
