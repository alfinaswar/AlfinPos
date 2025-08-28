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

        <div class="card mb-4">
            <div class="card-header bg-dark position-relative">
                <h4 class="card-title mb-0">Detail Penyesuaian Stok</h4>
                <p class="card-text mb-0">
                    Berikut adalah detail penyesuaian stok yang diajukan.
                </p>
                {{-- kok ga ada yaa --}}
                @if($data->Status === 'Y')
                    <div style="position: absolute; top: 16px; right: 16px; z-index: 10;">
                        <span class="badge bg-success" style="font-size: 1rem; padding: 0.5em 1em; border-radius: 0.5em;">
                            Diterima
                        </span>
                    </div>
                @elseif($data->Status === 'N')
                    <div style="position: absolute; top: 16px; right: 16px; z-index: 10;">
                        <span class="badge bg-danger" style="font-size: 1rem; padding: 0.5em 1em; border-radius: 0.5em;">
                            Ditolak
                        </span>
                    </div>
                @elseif(is_null($data->Status))
                    <div style="position: absolute; top: 16px; right: 16px; z-index: 10;">
                        <span class="badge bg-warning" style="font-size: 1rem; padding: 0.5em 1em; border-radius: 0.5em;">
                            Pending
                        </span>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="tanggal" class="form-label"><strong>Tanggal</strong></label>
                        <input type="date" name="Tanggal" id="tanggal" class="form-control" value="{{ $data->Tanggal }}"
                            readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="alasan" class="form-label"><strong>Alasan</strong></label>
                        <input type="text" name="Alasan" id="alasan" class="form-control" value="{{ $data->Alasan }}"
                            placeholder="Alasan penyesuaian" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="petugas" class="form-label"><strong>Petugas</strong></label>
                        <input type="text" name="Petugas" id="petugas" class="form-control"
                            value="{{ $data->UserCreate ?? Auth::user()->name ?? '' }}" placeholder="Nama Petugas" readonly>
                    </div>
                </div>
                <h5 class="mb-3"><strong>Detail Penyesuaian Stok</strong></h5>
                <div class="table-responsive">
                    <table class="table align-middle" id="table-adjust-stok">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 25%">Produk</th>
                                <th style="width: 15%">Stok Saat Ini</th>
                                <th style="width: 15%">Real Stok</th>
                                <th style="width: 15%">Penyesuaian</th>
                                <th style="width: 20%">Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
$produkList = $produk ?? \App\Models\Produk::orderBy('Nama', 'ASC')->get();
$details = $data->DetailSO ?? [];
                            @endphp
                            @forelse($details as $key => $detail)
                                <tr>
                                    <td>
                                        @php
    $produkNama = optional($produkList->where('id', $detail->IdProduk)->first())->Nama ?? '-';
                                        @endphp
                                        <input type="text" class="form-control-plaintext" value="{{ $produkNama }}" readonly>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control-plaintext" value="{{ $detail->StokAwal }}"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control-plaintext" value="{{ $detail->StokAkhir }}"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control-plaintext" value="{{ $detail->Penyesuaian }}"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control-plaintext" value="{{ $detail->Jenis }}" readonly>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada detail penyesuaian stok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-end mt-3">
                    <a href="{{ route('so.index') }}" class="btn btn-secondary me-2">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    {{-- Tombol approval, bisa disesuaikan dengan kebutuhan --}}
                    @if($data->Status == 'Y')
                        <button type="button" class="btn btn-success btn-approve" disabled>
                            <i class="fa fa-check"></i> Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-tolak">
                            <i class="fa fa-times"></i> Tolak
                        </button>
                    @else
                        <button type="button" class="btn btn-success btn-approve">
                            <i class="fa fa-check"></i> Approve
                        </button>
                        <button type="button" class="btn btn-danger btn-tolak" disabled>
                            <i class="fa fa-times"></i> Tolak
                        </button>
                    @endif

                    <form id="form-approve" action="{{route('so.approve', $data->id)}}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <form id="form-tolak" action="{{route('so.reject', $data->id)}}" method="POST" class="d-none">
                        @csrf
                    </form>


                </div>
            </div>
        </div>
@endsection
@push('js')
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif
        <script>
            $(document).ready(function () {
                $('.btn-approve').on('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda akan menyetujui penyesuaian stok ini.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Setujui!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#form-approve').submit();
                        }
                    });
                });

                $('.btn-tolak').on('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda akan menolak penyesuaian stok ini.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#form-tolak').submit();
                        }
                    });
                });
            });
        </script>
@endpush
