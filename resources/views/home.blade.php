@extends('layouts.app')

@section('content')

    <div class="content">
        {{-- @include('absensi.modal-absen') --}}
        <div class="welcome d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center welcome-text">
                <h3 class="d-flex align-items-center">
                    <img src="assets/img/icons/hi.svg" alt="img">&nbsp;
                    Hi, {{ auth()->user()->name }}!
                </h3>
                &nbsp;
                <h6>Anda telah berhasil masuk ke dalam sistem Point of Sale (POS).</h6>
            </div>
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <span id="tanggal-hari-ini" class="fw-bold"></span>
                    <i data-feather="calendar" class="feather-14 ms-1"></i>
                </div>
                <div class="position-relative">
                    <span id="jam-hari-ini" class="fw-bold"></span>
                    <i data-feather="clock" class="feather-14 ms-1"></i>
                </div>
            </div>

        </div>

        <div class="row sales-cards">
            <div class="col-xl-6 col-sm-12 col-12">
                <div class="card d-flex align-items-center justify-content-between default-cover mb-4">
                    <div>
                        <h6>Total Pendapatan Minggu Ini</h6>
                        <h3>Rp.<span class="counters" data-count="{{ $totalPendapatanMingguIni }}">
                                {{ 'Rp ' . number_format($totalPendapatanMingguIni, 0, ',', '.') }}
                            </span>
                        </h3>
                        <p class="sales-range"><span class="text-success"><i data-feather="chevron-up"
                                    class="feather-16"></i>{{ $persentaseKenaikanMingguIni }}&nbsp;</span>increase compare
                            to
                            last week</p>
                    </div>
                    <img src="assets/img/icons/weekly-earning.svg" alt="img">
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card color-info bg-primary mb-4">
                    <img src="assets/img/icons/total-sales.svg" alt="img">
                    <h3 class="counters" data-count="{{ $totalTransaksiHariIni }}">{{ $totalTransaksiHariIni }}</h3>
                    <p>Total Transaksi Hari Ini</p>
                    <i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Refresh"></i>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card color-info bg-secondary mb-4">
                    <img src="assets/img/icons/purchased-earnings.svg" alt="img">
                    <h3 class="counters" data-count="{{ $totalPendapatanHariIni }}">
                        {{ 'Rp ' . number_format($totalPendapatanHariIni, 0, ',', '.') }}
                    </h3>
                    <p>Total Pendapatan Hari Ini</p>
                    <i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Refresh"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xl-8 d-flex">
                <div class="card flex-fill default-cover w-100 mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Riwayat Transaksi</h4>
                        <div class="dropdown">
                            <a href="{{ route('pos.index') }}" class="view-all d-flex align-items-center">
                                Lihat Semua Transaksi<span class="ps-2 d-flex align-items-center"><i
                                        data-feather="arrow-right" class="feather-16"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless recent-transactions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($RiwayatTransaksi as $key => $rt)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <a class="text-info" href="{{ route('pos.show', $rt->id) }}">
                                                    {{ $rt->Kode }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $rt->Tanggal }}
                                            </td>
                                            @php
                                                $status = $rt->Status ?? 'Pending';
                                                $badgeClass =
                                                    [
                                                        'Pending' =>
                                                            'badge background-less border-warning text-warning',
                                                        'Berhasil' =>
                                                            'badge background-less border-success text-success',
                                                        'Dibatalkan' =>
                                                            'badge background-less border-danger text-danger',
                                                        'Refund Sebagian' =>
                                                            'badge background-less border-info text-info',
                                                        'Refund Penuh' =>
                                                            'badge background-less border-secondary text-secondary',
                                                    ][$status] ?? 'badge background-less border-secondary';
                                            @endphp
                                            <td><span class="{{ $badgeClass }}">{{ $status }}</span></td>
                                            <td>{{ 'Rp ' . number_format($rt->TotalAkhir, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex">
                <div class="card flex-fill w-100 mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Produk Terpopuler</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Total Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ProdukPopuler as $key => $produk)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $produk->getProduk->Nama ?? 'Tidak diketahui' }}</td>
                                            <td>{{ $produk->total_terjual }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data produk terpopuler</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('js')
    <script>
        function updateTanggalJam() {
            const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            const now = new Date();
            const tanggal = hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulan[now.getMonth()] + ' ' + now
                .getFullYear();
            const jam = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('tanggal-hari-ini').textContent = tanggal;
            document.getElementById('jam-hari-ini').textContent = jam;
        }
        updateTanggalJam();
        setInterval(updateTanggalJam, 1000);
    </script>
@endpush
