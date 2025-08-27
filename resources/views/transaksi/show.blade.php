@extends('layouts.app')

@section('content')
    <div class="content mb-3">
        <div class="pay-slip-box" id="pay-slip">
            <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
                <div class="modal-content">
                    <div class="page-wrapper-new p-0">
                        <div class="contents">
                            <div class="modal-header border-0 custom-modal-header">
                                <div class="page-header mb-0 w-100">
                                    <div class="add-item payslip-list d-flex justify-content-between">
                                        <div class="page-title">
                                            <h4>Detail Transaksi</h4>
                                        </div>
                                        <div class="page-btn d-flex align-items-center mt-3 mt-md-0">
                                            <div class="d-block d-sm-flex align-items-center">
                                                {{-- <a href="#" class="btn btn-added me-2"><i data-feather="mail"
                                                        class="me-2"></i> Kirim Email</a> --}}
                                                <a href="{{ route('pos.download', $data->id) }}"
                                                    class="btn btn-added downloader mt-3 mb-3 m-sm-0">
                                                    <i data-feather="download" class="me-2"></i> Download
                                                </a>
                                                <a href="#" class="btn btn-added printer ms-2" onclick="window.print();"><i
                                                        data-feather="printer" class="me-2"></i>
                                                    Cetak Struk</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body custom-modal-body">
                                <div class="card mb-0">
                                    <div class="card-body border-0">
                                        {{-- Header transaksi --}}
                                        <div class="payslip-month d-flex">
                                            <div class="slip-logo">
                                                <img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo">
                                            </div>
                                            <div class="month-of-slip">
                                                <h4>Kode Transaksi: {{ $data->Kode }}</h4>
                                                <p>Tanggal: {{ $data->Tanggal }}</p>
                                            </div>
                                        </div>

                                        {{-- Info umum --}}
                                        <div class="emp-details d-flex">
                                            <div class="emp-name-id">
                                                <h6>Kasir : <span>{{ $data->NamaKasir->name ?? '-' }}</span></h6>
                                                {{-- <h6>Outlet : <span>{{ $data->outlet->nama_outlet ?? '-' }}</span></h6>
                                                --}}
                                            </div>
                                            <div class="emp-location-info">
                                                <h6>Metode Pembayaran : <span>{{ $data->MetodePembayaran ?? 'Cash' }}</span>
                                                </h6>
                                                <h6>Status : <span>{{ ucfirst($data->status_transaksi) }}</span></h6>
                                            </div>
                                        </div>

                                        {{-- Tabel detail item --}}
                                        <div class="row mt-3">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="paysilp-table-border text-center">
                                                            <th>Produk</th>
                                                            <th>Qty</th>
                                                            <th>Harga Satuan</th>
                                                            <th>Diskon</th>
                                                            <th>Subtotal</th>
                                                            <th>Total Akhir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="paysilp-table-borders">
                                                        @foreach ($data->detailTransaksi as $item)
                                                            <tr>
                                                                <td>{{ $item->getProduk->NamaProduk ?? '-' }}</td>
                                                                <td class="text-center">{{ $item->Qty }}</td>
                                                                <td>{{ number_format($item->HargaSatuan, 0, ',', '.') }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->Diskon > 0)
                                                                        {{ $item->Diskon }} ({{ $item->TipeDiskon }})
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                                <td>{{ number_format($item->Subtotal, 0, ',', '.') }}
                                                                </td>
                                                                <td>{{ number_format($item->TotalAkhir, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- Ringkasan pembayaran --}}
                                            <div class="emp-details d-flex justify-content-end mt-3">
                                                <div class="emp-name-id pay-slip-salery text-end">
                                                    <h6>Subtotal</h6>
                                                    <h6>Diskon</h6>
                                                    <h6>Pajak</h6>
                                                    <h6>Biaya Layanan</h6>
                                                    <h6>Total Akhir</h6>
                                                    <h6>Jumlah Bayar</h6>
                                                    <h6>Kembalian</h6>
                                                </div>
                                                <div class="emp-location-info pay-slip-salery text-end">
                                                    <h6>Rp.{{ number_format($data->Subtotal, 0, ',', '.') }}</h6>
                                                    <h6>Rp.{{ number_format($data->TotalDiskon, 0, ',', '.') }}</h6>
                                                    <h6>Rp.{{ number_format($data->Pajak, 0, ',', '.') }}</h6>
                                                    <h6>Rp.{{ number_format($data->BiayaLayanan, 0, ',', '.') }}</h6>
                                                    <h6>Rp.{{ number_format($data->TotalAkhir, 0, ',', '.') }}</h6>
                                                    <h6>Rp.{{ number_format($data->JumlahBayar, 0, ',', '.') }}</h6>
                                                    <h6>Rp.{{ number_format($data->kembalian, 0, ',', '.') }}</h6>
                                                </div>
                                            </div>

                                            {{-- Footer --}}
                                            <div class="product-name-slip text-center mt-4">
                                                <h4>DreamsPOS</h4>
                                                <p>Alfin Aswar</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- modal body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection