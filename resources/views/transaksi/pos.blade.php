<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Lumina POS - Sistem Point of Sale Modern">
    <meta name="keywords"
        content="lumina, pos, kasir, penjualan, toko, retail, inventori, responsive, aplikasi, transaksi">
    <meta name="author" content="Lumina POS">
    <meta name="robots" content="noindex, nofollow">
    <title>Lumina POS</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap-datetimepicker.min.css">

    <!-- animation CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/animate.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/select2/css/select2.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/dataTables.bootstrap5.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/fontawesome/css/all.min.css">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/owlcarousel/owl.theme.default.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/custom-ozora.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Mode Fullscreen Wajib</h5>
                </div>
                <div class="modal-body">
                    Untuk menggunakan aplikasi POS ini, Anda <b>wajib mengaktifkan mode layar penuh (fullscreen)</b> agar pengalaman kasir lebih optimal, tidak ada gangguan tampilan, <b>dan tidak ada gangguan saat scan produk</b>.<br><br>
                    Silakan klik tombol <b>"Aktifkan Fullscreen"</b> di bawah ini untuk melanjutkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100" id="btn-activate-fullscreen">Aktifkan Fullscreen</button>
                </div>
            </div>
        </div>
    </div>



    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left active">
                <a href="{{route('pos.kasir')}}" class="logo logo-normal">
                    <img src="{{ asset('assets/img/logo/lumina.png') }}" alt="">
                </a>
                <a href="{{route('pos.kasir')}}" class="logo logo-white">
                    <img src="{{ asset('assets/img/logo/lumina.png') }}" alt="">
                </a>
                <a href="{{route('pos.kasir')}}" class="logo-small">
                    <img src="{{ asset('assets/img/logo/lumina.png') }}" alt="">
                </a>
            </div>
            <!-- /Logo -->

            <a id="mobile_btn" class="mobile_btn d-none" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Search -->
                <li class="nav-item nav-searchinputs">

                </li>
                <!-- /Search -->



                <!-- /Notifications -->

                <li class="nav-item d-flex align-items-center ms-2">
                    <a href="{{ route('home') }}"
                        class="btn btn-primary shadow-sm px-4 py-2 d-flex align-items-center gap-2" title="Buka POS"
                        style="border-radius: 30px; font-weight: 600; font-size: 1rem;">
                        <span class="d-none d-md-inline">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center ms-2">
                    <button class="btn btn-outline-secondary shadow-sm px-3 py-2 d-flex align-items-center gap-2"
                        title="Mode Layar Penuh"
                        style="border-radius: 30px; font-weight: 600; font-size: 1rem;"
                        id="fullscreen-btn"
                        type="button">
                        <i class="fas fa-expand"></i>
                        <span class="d-none d-md-inline">Fullscreen</span>
                    </button>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link userset" title="Edit Profil">
                        <span class="user-info">
                            <span class="user-letter">
                                <span class="user-icon">
                                    <i class="fas fa-user-circle fa-2x"></i>
                                </span>
                            </span>
                            <span class="user-detail">
                                <span class="user-name">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                                <span class="user-role">Super Admin</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="btn btn-danger" style="margin-left: 10px;" title="Keluar"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2" style="width: 18px; height: 18px;"></i>Keluar
                    </button>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            {{-- <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="general-settings.html">Settings</a>
                    <a class="dropdown-item" href="signin.html">Logout</a>
                </div>
            </div> --}}
            <!-- /Mobile Menu -->
        </div>
        <!-- Header -->

        <div class="page-wrapper pos-pg-wrapper ms-0">
            <div class="content pos-design p-0">
                <div class="btn-row d-sm-flex align-items-center">
                    <a href="javascript:void(0);" class="btn btn-info" onclick="location.reload();"><span
                            class="me-1 d-flex align-items-center"><i data-feather="rotate-cw"
                                class="feather-16"></i></span>Reset</a>
                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#recents"><span class="me-1 d-flex align-items-center"><i
                                data-feather="refresh-ccw" class="feather-16"></i></span>Riwayat Transaksi</a>
                </div>

                <div class="row align-items-start pos-wrapper">
                    <div class="col-md-12 col-lg-8">
                        <div class="pos-categories tabs_wrapper">
                            <h5>Kategori Produk</h5>
                            <p>Pilih Berdasarkan Kategori Produk</p>
                            <ul class="tabs owl-carousel pos-category">
                                <li id="">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('') }}assets/img/categories/category-01.png"
                                            alt="Categories">
                                    </a>
                                    <h6><a href="javascript:void(0);">Semua Kategori</a></h6>
                                    <span>Items</span>
                                </li>
                                @foreach ($produk as $kat)
                                    <li id="{{ $kat->id }}">
                                        <a href="javascript:void(0);">
                                            @if($kat->Icon)
                                                <img src="{{ asset('storage/uploads/icon-kategori/' . $kat->Icon) }}" alt="Icon Kategori" style="max-height: 60px;">
                                            @else
                                                <img src="{{ asset('assets/img/pos/imagenotfound.png') }}" alt="Gambar Tidak Ditemukan">
                                            @endif
                                        </a>
                                        <h6><a href="javascript:void(0);">{{ $kat->Nama }}</a></h6>
                                        <span>{{$kat->get_produk_count}}</span>
                                    </li>
                                @endforeach
                            </ul>
                           <div class="pos-products">
                            <div class="d-flex align-items-center justify-content-between">
        <h5 class="mb-3">Produk</h5>
    </div>
<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text bg-primary text-white" id="search-addon">
            <i class="fa fa-search"></i>
        </span>
        <input
            type="text"
            id="search-barcode-kode"
            class="form-control"
            placeholder="🔍 Cari produk dengan Barcode atau Kode..."
            aria-label="Cari produk"
            aria-describedby="search-addon"
        >
        <button class="btn btn-danger" type="button" id="clear-search">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <small class="form-text text-muted ms-2">Ketik kode barcode atau kode produk untuk pencarian cepat.</small>
</div>

    <div class="tabs_container">
        @foreach ($produk as $key => $kategori)
            <div class="tab_content active" data-tab="{{ $kategori->id }}">
                <div class="row produk-list-row">
                    @foreach ($kategori->getProduk as $item)
                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 produk-item"
                            data-kode-barcode="{{ $item->KodeBarcode }}"
                            data-kode="{{ $item->KodeBarang }}"
                        >
                            <div class="product-info default-cover card"
                                data-product-id="{{ $item->id }}"
                                data-kode-barcode="{{ $item->KodeBarcode }}"
                                data-kode="{{ $item->KodeBarang }}"
                                data-product-name="{{ $item->Nama }}"
                                data-product-price="{{ $item->HargaJual }}"
                                data-category-name="{{ $kategori->Nama }}"
                                data-product-image="{{ asset('storage/uploads/produk/' . $item->Gambar ?? 'imagenotfound.png') }}"
                                data-product-konversi='@json($item->konversi ? $item->konversi->map(function($k) { return [
                                    "id" => $k->id,
                                    "nama_satuan" => $k->getNamaSatuan->NamaSatuan ?? "Satuan",
                                    "harga_jual" => $k->HargaJual
                                ]; }) : [])'
                            >
                                <a href="javascript:void(0);" class="img-bg">
                                    <img src="{{ asset('storage/uploads/produk/' . $item->Gambar ?? 'imagenotfound.png') }}"
                                        alt="Products" width="150px" height="100px"
                                        style="object-fit: cover;">
                                    <span><i data-feather="check" class="feather-16"></i></span>
                                </a>
                                <h6 class="cat-name"><a href="javascript:void(0);">{{ $kategori->Nama }}</a></h6>
                                <h6 class="product-name"><a href="javascript:void(0);">{{ $item->Nama }}</a></h6>
                                @if($item->konversi && $item->konversi->count() > 0)
                                    <div class="konversi-price mt-2">
                                        @foreach ($item->konversi as $idx => $konv)
                                            <div class="d-flex align-items-center justify-content-between"
                                                @if($idx == 0)
                                                    style="background-color: #e8f8f5; border-radius: 5px; padding: 4px 8px;"
                                                @elseif($idx == 1)
                                                    style="background-color: #f9ebea; border-radius: 5px; padding: 4px 8px;"
                                                @endif
                                            >
                                                <span>{{ $konv->getNamaSatuan->NamaSatuan ?? 'Satuan' }}</span>
                                                <p class="mb-0" style="color: #1abc9c; font-weight: bold;">
                                                    {{ 'Rp ' . number_format($konv->HargaJual, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

</div>



                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 ps-0">
                        <aside class="product-order-list">
                            <div class="head d-flex align-items-center justify-content-between w-100">
                                <div class="">
                                    <h5>Daftar Pesanan</h5>
                                    <span>Daftar Pesanan Pelanggan</span>
                                </div>
                                <div class="">
                                    <span id="waktu-sekarang" style="font-weight:bold;"></span>
                                </div>


                                {{-- <!-- Modal Scan Barcode  Kamera Biasa-->
                                <div class="modal fade" id="scanBarcodeModal" tabindex="-1" aria-labelledby="scanBarcodeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="scanBarcodeModalLabel">Scan Barcode Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="reader" style="width:100%;"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>


                            <div class="customer-info block-section">
                                <h6>Informasi Pelanggan</h6>
                                <div class="input-block d-flex align-items-center">
                                    <input type="text" class="form-control" name="InformasiPelanggan"
                                        id="InformasiPelanggan" placeholder="Informasi Pelanggan">
                                </div>
                                <input type="text" id="barcodeInput" placeholder="Scan Barcode..." autofocus
       style="opacity:0;position:absolute;left:-9999px;">

                            </div>

                            <div class="product-added block-section">
                                <div class="head-text d-flex align-items-center justify-content-between">
                                    <h6 class="d-flex align-items-center mb-0">Produk Dibeli<span
                                            class="count">0</span>
                                    </h6>
                                    <a href="javascript:void(0);" class="d-flex align-items-center text-danger"
                                        id="clear-all-btn">
                                        <span class="me-1"><i data-feather="x" class="feather-16"></i></span>Clear
                                        all
                                    </a>
                                </div>
                                <div class="product-wrap">
                                    <!-- Template produk yang akan ditambahkan via JavaScript -->
                                    <!-- Kosongkan bagian ini, akan diisi otomatis -->
                                </div>
                            </div>

                            <div class="checkout-section mt-3">
                                <div class="card shadow-sm border-0 rounded-3">
                                    <div class="card-body">
                                        <!-- Total Belanja -->
                                        <div class="cart-total bg-light p-3 rounded mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0 text-muted">Total Item</h6>
                                                <h6 class="mb-0 fw-bold"><span id="total-items">0</span></h6>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 fw-bold">Total Belanja</h5>
                                                <h4 class="mb-0 text-primary fw-bold" id="total-amount">Rp 0</h4>
                                            </div>
                                        </div>

                                        <!-- Uang Diterima -->
                                        <div class="mb-3">
                                            <label for="uang-dibayar" class="form-label fw-semibold">Uang
                                                Diterima</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" id="uang-dibayar" class="form-control text-end"
                                                    placeholder="0">
                                            </div>
                                        </div>

                                        <!-- Kembalian -->
                                        <div class="bg-success bg-opacity-10 p-3 rounded mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0 fw-bold text-success">Kembalian</h6>
                                                <h5 class="mb-0 fw-bold text-success" id="kembalian">Rp 0</h5>
                                            </div>
                                        </div>

                                        <!-- Tombol Checkout -->
                                        <div class="d-grid">
                                            <button type="button" class="btn btn-success btn-lg" id="checkout-btn">
                                                <i data-feather="shopping-cart" class="me-1"></i> Checkout
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </aside>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Main Wrapper -->

    <!-- Payment Completed -->
    <div class="modal fade modal-default" id="payment-completed" aria-labelledby="payment-completed">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form action="pos.html">
                        <div class="icon-head">
                            <a href="javascript:void(0);">
                                <i data-feather="check-circle" class="feather-40"></i>
                            </a>
                        </div>
                        <h4>Payment Completed</h4>
                        <p class="mb-0">Do you want to Print Receipt for the Completed Order</p>
                        <div class="modal-footer d-sm-flex justify-content-between">
                            <button type="button" class="btn btn-primary flex-fill" data-bs-toggle="modal"
                                data-bs-target="#print-receipt">Print Receipt<i
                                    class="feather-arrow-right-circle icon-me-5"></i></button>
                            <button type="submit" class="btn btn-secondary flex-fill">Next Order<i
                                    class="feather-arrow-right-circle icon-me-5"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Payment Completed -->


    <!-- Recent Transactions -->
    <div class="modal fade pos-modal" id="recents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-4">
                    <h5 class="modal-title">Recent Transactions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="tabs-sets">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                                aria-labelledby="purchase-tab">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                    src="assets/img/icons/search-white.svg" alt="img"></a>
                                        </div>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode Transaksi</th>
                                                <th>Total </th>
                                                <th>Status</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($history as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->Tanggal }}</td>
                                                    <td>{{ $value->Kode }}</td>
                                                    <td>Rp.{{ number_format((int) $value->TotalAkhir, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        @switch($value->status_transaksi)
                                                            @case('Pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @break

                                                            @case('Berhasil')
                                                                <span class="badge bg-success">Berhasil</span>
                                                            @break

                                                            @case('Dibatalkan')
                                                                <span class="badge bg-danger">Dibatalkan</span>
                                                            @break

                                                            @case('Refund Sebagian')
                                                                <span class="badge bg-info">Refund Sebagian</span>
                                                            @break

                                                            @case('Refund Penuh')
                                                                <span class="badge bg-secondary">Refund Penuh</span>
                                                            @break

                                                            @default
                                                                <span class="badge bg-light">Status Tidak Diketahui</span>
                                                        @endswitch
                                                    </td>
                                                    <td class="action-table-data">
                                                        <div class="edit-delete-action">
                                                            <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                    data-feather="eye" class="feather-eye"></i></a>
                                                            <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                    data-feather="edit" class="feather-edit"></i></a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    <!-- /Recent Transactions -->

    <!-- Recent Transactions -->
    <div class="modal fade pos-modal" id="orders" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-4">
                    <h5 class="modal-title">Orders</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4">

                </div>
            </div>
        </div>
    </div>

    @include('layouts.javascript-pos')
    <script>
        $(document).ready(function() {

    $("#barcodeInput").keydown(function(e){
        if(e.which==17 || e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
            $('#checkout-btn').on('click', function() {
                if (selectedProducts.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Keranjang kosong!',
                        text: 'Silakan tambahkan produk ke keranjang sebelum checkout.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('pos.store') }}', // route Laravel
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        products: selectedProducts,
                        customer: $('#InformasiPelanggan').val(),
                        uangditerima: $('#uang-dibayar').val(),
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Checkout berhasil!',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                clearAllProducts();
                                $('#total-items').text(0);
                                $('#total-amount').text('Rp 0');
                                if (response.url_struk) {
                                    window.open(response.url_struk, '_blank');
                                }
                                location.reload();

                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Checkout gagal',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan server!');
                    }
                });
            });
            function formatRupiah(angka) {
                return 'Rp ' + (angka ? angka.toLocaleString('id-ID') : '0');
            }


            $(document).on('input', '#uang-dibayar', function() {
                let raw = $(this).val().replace(/\D/g, ""); // hanya angka
                let uangDibayar = parseInt(raw) || 0;
                $(this).val(uangDibayar.toLocaleString('id-ID'));
                const totalText = $('#total-amount').text().replace(/[^\d]/g, '');
                const totalBelanja = parseInt(totalText) || 0;

                const kembalian = uangDibayar - totalBelanja;
                $('#kembalian').text(formatRupiah(kembalian >= 0 ? kembalian : 0));
            });

        });
    </script>
    <script>
        let selectedProducts = [];

        function addToCart(productData) {
            const existingProductIndex = selectedProducts.findIndex(p => p.id === productData.id && p.satuan_id === productData.satuan_id);

            if (existingProductIndex > -1) {
                selectedProducts[existingProductIndex].quantity += 1;
                updateProductQuantity(productData.id, productData.satuan_id, selectedProducts[existingProductIndex].quantity);
            } else {
                productData.quantity = 1;
                selectedProducts.push(productData);
                addProductToDOM(productData);
            }

            updateCounter();
        }

        function addProductToDOM(product) {
            const productWrap = document.querySelector('.product-wrap');

            // Hapus dulu DOM produk dengan id & satuan yang sama (agar tidak dobel di DOM)
            const existingElement = productWrap.querySelector(`[data-product-id="${product.id}"][data-satuan-id="${product.satuan_id}"]`);
            if (existingElement) existingElement.remove();

            const productHTML = `
            <div class="product-list d-flex align-items-center justify-content-between" data-product-id="${product.id}" data-satuan-id="${product.satuan_id}">
                <div class="d-flex align-items-center product-info" data-bs-toggle="modal" data-bs-target="#products">
                    <a href="javascript:void(0);" class="img-bg">
                        <img src="${product.image}" alt="Products" style="width: 50px; height: 50px; object-fit: cover;">
                    </a>
                    <div class="info">
                        <span>${product.category}</span>
                        <h6><a href="javascript:void(0);">${product.name}</a></h6>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select form-select-sm satuan-select" style="width:auto;display:inline-block;" onchange="changeSatuan('${product.id}', this.value)">
                                ${product.konversi.map(konv => `
                                    <option value="${konv.id}" ${konv.id == product.satuan_id ? 'selected' : ''} data-harga="${konv.harga_jual}">
                                        ${konv.nama_satuan} - Rp ${parseInt(konv.harga_jual).toLocaleString('id-ID')}
                                    </option>
                                `).join('')}
                            </select>
                        </div>
                        <p class="harga-produk mb-0 mt-1" style="font-weight:bold;color:#1abc9c;">
                            Rp ${parseInt(product.price).toLocaleString('id-ID')}
                        </p>
                    </div>
                </div>
                <div class="qty-item text-center">
                    <a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center"
                       onclick="decreaseQuantity('${product.id}', '${product.satuan_id}')">
                        <i data-feather="minus-circle" class="feather-14"></i>
                    </a>
                    <input type="text" class="form-control text-center qty-input" name="qty" value="${product.quantity}"
                           onchange="updateQuantityFromInput('${product.id}', '${product.satuan_id}', this.value)">
                    <a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center"
                       onclick="increaseQuantity('${product.id}', '${product.satuan_id}')">
                        <i data-feather="plus-circle" class="feather-14"></i>
                    </a>
                </div>
                <div class="action">
                    <a class="btn-icon delete-icon confirm-text" href="javascript:void(0);" onclick="removeFromCart('${product.id}', '${product.satuan_id}')">
                        <i data-feather="trash-2" class="feather-14"></i>
                    </a>
                </div>
            </div>
        `;

            productWrap.insertAdjacentHTML('beforeend', productHTML);

            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }

        function updateCounter() {
            const counterElement = document.querySelector('.count');
            if (counterElement) {
                counterElement.textContent = selectedProducts.length;
            }
        }

        function increaseQuantity(productId, satuanId) {
            const productIndex = selectedProducts.findIndex(p => p.id == productId && p.satuan_id == satuanId);
            if (productIndex > -1) {
                selectedProducts[productIndex].quantity += 1;
                updateProductQuantity(productId, satuanId, selectedProducts[productIndex].quantity);
            }
        }

        function decreaseQuantity(productId, satuanId) {
            const productIndex = selectedProducts.findIndex(p => p.id == productId && p.satuan_id == satuanId);
            if (productIndex > -1) {
                if (selectedProducts[productIndex].quantity > 1) {
                    selectedProducts[productIndex].quantity -= 1;
                    updateProductQuantity(productId, satuanId, selectedProducts[productIndex].quantity);
                } else {
                    removeFromCart(productId, satuanId);
                }
            }
        }

        function updateQuantityFromInput(productId, satuanId, newQuantity) {
            const quantity = parseInt(newQuantity);
            if (quantity > 0) {
                const productIndex = selectedProducts.findIndex(p => p.id == productId && p.satuan_id == satuanId);
                if (productIndex > -1) {
                    selectedProducts[productIndex].quantity = quantity;
                    updateCounter(); // ✅ ini penting
                }
            } else {
                removeFromCart(productId, satuanId);
            }
        }

        function updateProductQuantity(productId, satuanId, quantity) {
            const productElement = document.querySelector(`.product-wrap [data-product-id="${productId}"][data-satuan-id="${satuanId}"]`);
            if (productElement) {
                const qtyInput = productElement.querySelector('.qty-input');
                if (qtyInput) {
                    qtyInput.value = quantity;
                }
            }
            updateCounter();
        }

        function removeFromCart(productId, satuanId) {
            if (satuanId === null || typeof satuanId === 'undefined') {
                // Hapus SEMUA varian produk dengan id tsb (untuk ganti satuan)
                selectedProducts = selectedProducts.filter(p => p.id != productId);
                // Hapus semua DOM produk dengan id tsb
                document.querySelectorAll(`.product-wrap [data-product-id="${productId}"]`).forEach(el => el.remove());
            } else {
                selectedProducts = selectedProducts.filter(p => !(p.id == productId && p.satuan_id == satuanId));
                const productElement = document.querySelector(`.product-wrap [data-product-id="${productId}"][data-satuan-id="${satuanId}"]`);
                if (productElement) {
                    productElement.remove();
                }
            }
            updateCounter();
        }

        function clearAllProducts() {
            selectedProducts = [];
            const productWrap = document.querySelector('.product-wrap');
            productWrap.innerHTML = '';
            updateCounter();
        }

        // Fungsi untuk mengganti satuan pada cart
        function changeSatuan(productId, satuanId) {
            // Temukan product di cart (apapun satuannya)
            const productIndex = selectedProducts.findIndex(p => p.id == productId);
            if (productIndex === -1) return;

            const product = selectedProducts[productIndex];

            // Jika satuan sama, tidak perlu update
            if (product.satuan_id == satuanId) return;

            // Dapatkan data konversi dari product.konversi
            const konv = product.konversi.find(k => k.id == satuanId);
            if (!konv) return;

            // Update satuan_id, price, formattedPrice
            product.satuan_id = konv.id;
            product.satuan_nama = konv.nama_satuan;
            product.price = konv.harga_jual;
            product.formattedPrice = 'Rp ' + parseInt(konv.harga_jual).toLocaleString('id-ID');

            // Update DOM: hapus semua varian produk id tsb, lalu render ulang hanya satu
            removeFromCart(productId, null); // hapus semua varian produk id tsb
            selectedProducts.push(product); // masukkan kembali produk dengan satuan baru
            addProductToDOM(product);

            updateCounter();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk klik produk
            document.addEventListener('click', function(e) {
                const productCard = e.target.closest('.pos-products .product-info');
                if (productCard) {
                    e.preventDefault();

                    // Ambil data konversi satuan
                    let konversi = [];
                    try {
                        konversi = JSON.parse(productCard.dataset.productKonversi || '[]');
                    } catch (err) {
                        konversi = [];
                    }

                    // Default satuan: ambil yang pertama (atau null jika tidak ada)
                    let satuan_id = null, satuan_nama = '', harga_jual = productCard.dataset.productPrice;
                    if (konversi.length > 0) {
                        satuan_id = konversi[0].id;
                        satuan_nama = konversi[0].nama_satuan;
                        harga_jual = konversi[0].harga_jual;
                    } else {
                        satuan_id = 'default';
                        satuan_nama = 'Satuan';
                        harga_jual = productCard.dataset.productPrice;
                        konversi = [{
                            id: 'default',
                            nama_satuan: 'Satuan',
                            harga_jual: harga_jual
                        }];
                    }

                    const productData = {
                        id: productCard.dataset.productId,
                        image: productCard.dataset.productImage,
                        category: productCard.dataset.categoryName,
                        name: productCard.dataset.productName,
                        price: harga_jual,
                        formattedPrice: 'Rp ' + parseInt(harga_jual).toLocaleString('id-ID'),
                        satuan_id: satuan_id,
                        satuan_nama: satuan_nama,
                        konversi: konversi
                    };

                    addToCart(productData);

                    // Visual feedback
                    productCard.classList.add('selected');
                    setTimeout(() => {
                        productCard.classList.remove('selected');
                    }, 200);
                }
            });

            // Event listener untuk clear all
            const clearAllBtn = document.getElementById('clear-all-btn');
            if (clearAllBtn) {
                clearAllBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    clearAllProducts();
                });
            }
        });
    </script>
    <script>
        function updateTotalDisplay() {
            const totalItems = selectedProducts.reduce((total, product) => total + product.quantity, 0);
            const totalAmount = selectedProducts.reduce((total, product) => total + (parseInt(product.price) * product
                .quantity), 0);

            $('#total-items').text(totalItems);
            $('#total-amount').text('Rp ' + totalAmount.toLocaleString('id-ID'));
        }

        // Override function updateCounter untuk juga update total display
        const originalUpdateCounter = updateCounter;
        updateCounter = function() {
            originalUpdateCounter();
            updateTotalDisplay();
        };
        $(document).ready(function() {
            // Tombol untuk membuka modal draft
            $(document).on('click', '#load-draft-btn', function() {
                loadDraftList();
                $('#draftModal').modal('show');
            });

            // Update total display saat pertama kali load
            updateTotalDisplay();
        });
    </script>
 <script>
                                    // Update jam setiap detik
                                    setInterval(function() {
                                        var now = new Date();
                                        var jam = now.getHours().toString().padStart(2, '0');
                                        var menit = now.getMinutes().toString().padStart(2, '0');
                                        var detik = now.getSeconds().toString().padStart(2, '0');
                                        document.getElementById('jam-sekarang').textContent = jam + ':' + menit + ':' + detik;
                                    }, 1000);
                                </script>


<script>
    let beep = new Audio('{{ asset('assets/sound/beep.mp3') }}');
    let beepError = new Audio('{{ asset('assets/sound/beep-error.mp3') }}');
    beep.load();
    beepError.load();

    // Inisialisasi pertama biar bisa play (user interaction dulu)
    document.body.addEventListener("click", function initBeep() {
        beep.play().catch(()=>{});
        beep.pause(); beep.currentTime = 0;
        beepError.play().catch(()=>{});
        beepError.pause(); beepError.currentTime = 0;
        document.body.removeEventListener("click", initBeep);
    });

    let lastScanTime = 0;
    const scanCooldown = 1500;

    function handleBarcodeScan(decodedText) {
        let now = Date.now();
        if (now - lastScanTime < scanCooldown) {
            console.log("Scan diabaikan (cooldown)");
            return;
        }
        lastScanTime = now;

        console.log("Hasil Scan:", decodedText);

        fetch("{{ route('pos.scan-barcode') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ barcode: decodedText })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                beep.currentTime = 0;
                beep.play().catch(err => console.warn("Beep gagal:", err));

                let satuan_id = data.product.Konversi.length > 0 ? data.product.Konversi[0].id : 0;
                let existingIndex = selectedProducts.findIndex(
                    p => p.id == data.product.id && p.satuan_id == satuan_id
                );

                if (existingIndex > -1) {
                    selectedProducts[existingIndex].quantity += 1;
                    updateProductQuantity(
                        data.product.id,
                        satuan_id,
                        selectedProducts[existingIndex].quantity
                    );
                } else {
                    const product = {
                        id: data.product.id,
                        satuan_id: satuan_id,
                        name: data.product.Nama,
                        category: data.product.Kategori ?? "-",
                        price: data.product.HargaJual,
                        image: data.product.Gambar
                            ? `/storage/uploads/produk/${data.product.Gambar}`
                            : `/assets/img/pos/imagenotfound.png`,
                        konversi: data.product.Konversi,
                        quantity: 1
                    };
                    selectedProducts.push(product);
                    addProductToDOM(product);
                }
                updateCounter();
            } else {
                beepError.currentTime = 0;
                beepError.play().catch(err => console.warn("Beep error gagal:", err));
                toastr.error("Produk dengan barcode " + decodedText + " tidak ditemukan.");
            }
        })
        .catch(err => {
            beepError.currentTime = 0;
            beepError.play().catch(err => console.warn("Beep error gagal:", err));
            console.error(err);
            toastr.error("Terjadi kesalahan koneksi ke server.");
        });
    }

    const barcodeInput = document.getElementById("barcodeInput");


    barcodeInput.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            const code = this.value.trim();
            if (code !== "") {
                handleBarcodeScan(code);
                this.value = "";
            }
        }
    });

    // window.addEventListener("load", () => barcodeInput.focus());
    // document.body.addEventListener("click", () => barcodeInput.focus());
</script>
<script>
                                    function updateWaktuSekarang() {
                                        const bulan = [
                                            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                                        ];
                                        const hari = [
                                            "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"
                                        ];
                                        const now = new Date();
                                        const namaHari = hari[now.getDay()];
                                        const tanggal = now.getDate().toString().padStart(2, '0');
                                        const namaBulan = bulan[now.getMonth()];
                                        const tahun = now.getFullYear();
                                        const jam = now.getHours().toString().padStart(2, '0');
                                        const menit = now.getMinutes().toString().padStart(2, '0');
                                        const detik = now.getSeconds().toString().padStart(2, '0');
                                        const waktu = `${namaHari}, ${tanggal} ${namaBulan} ${tahun} ${jam}:${menit}:${detik}`;
                                        document.getElementById('waktu-sekarang').textContent = waktu;
                                    }
                                    updateWaktuSekarang();
                                    setInterval(updateWaktuSekarang, 1000);
                                </script>
                                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const btn = document.getElementById('fullscreen-btn');
                        btn.addEventListener('click', function() {
                            if (!document.fullscreenElement) {
                                document.documentElement.requestFullscreen();
                            } else {
                                if (document.exitFullscreen) {
                                    document.exitFullscreen();
                                }
                            }
                        });
                    });
                </script>
               <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalWelcome = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            var barcodeInput = document.getElementById('barcodeInput');
            if (!document.fullscreenElement) {
                modalWelcome.show();
            }
            document.getElementById('btn-activate-fullscreen').addEventListener('click', function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen().then(function() {
                        modalWelcome.hide();
                        if (barcodeInput) {
                            barcodeInput.focus();
                        }
                    });
                } else {
                    modalWelcome.hide();
                    if (barcodeInput) {
                        barcodeInput.focus();
                    }
                }
            });
            document.addEventListener('fullscreenchange', function() {
                if (!document.fullscreenElement) {
                    modalWelcome.show();
                } else {
                    if (barcodeInput) {
                        barcodeInput.focus();
                    }
                }
            });

            // Autofocus ke input barcode saat halaman dimuat jika sudah fullscreen
            if (document.fullscreenElement && barcodeInput) {
                barcodeInput.focus();
            }
        });
    </script>
    <script>
    document.getElementById('clear-search').onclick = function() {
        document.getElementById('search-barcode-kode').value = '';
         document.getElementById('barcodeInput').focus();
        // Trigger event pencarian ulang jika ada
        var event = new Event('input');
        document.getElementById('search-barcode-kode').dispatchEvent(event);
    };
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-barcode-kode');
            searchInput.addEventListener('input', function () {
                const keyword = this.value.trim().toLowerCase();
                document.querySelectorAll('.produk-list-row').forEach(function(row) {
                    row.querySelectorAll('.produk-item').forEach(function(item) {
                        const kodeBarcode = (item.getAttribute('data-kode-barcode') || '').toLowerCase();
                        const kode = (item.getAttribute('data-kode') || '').toLowerCase();
                        if (keyword === '' || kodeBarcode.includes(keyword) || kode.includes(keyword)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
<script>

    document.addEventListener('keydown', function(e) {

        if (e.key === 'F11') {
            e.preventDefault();
            return false;
        }
        if (e.key === 'F5') {
            e.preventDefault();
            return false;
        }
        if (e.key === 'Escape' || e.key === 'Esc' || e.key === 'esc') {
            e.preventDefault();
            return false;
        }
        if ((e.ctrlKey || e.metaKey) && (e.key === 'u' || e.key === 'U')) {
            e.preventDefault();
            return false;
        }
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'I' || e.key === 'i')) {
            e.preventDefault();
            return false;
        }
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'C' || e.key === 'c')) {
            e.preventDefault();
            return false;
        }
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'J' || e.key === 'j')) {
            e.preventDefault();
            return false;
        }
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'K' || e.key === 'k')) {
            e.preventDefault();
            return false;
        }
        if ((e.ctrlKey || e.metaKey) && (e.key === 'S' || e.key === 's')) {
            e.preventDefault();
            return false;
        }
    });

    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        return false;
    });

    // Kunci drag
    document.addEventListener('dragstart', function(e) {
        e.preventDefault();
        return false;
    });

    // Kunci select
    document.addEventListener('selectstart', function(e) {
        e.preventDefault();
        return false;
    });
</script>
</body>

</html>
