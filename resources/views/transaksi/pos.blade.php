<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>DreamPos</title>

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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left active">
                <a href="index.html" class="logo logo-normal">
                    <img src="{{ asset('') }}assets/img/logo.png" alt="">
                </a>
                <a href="index.html" class="logo logo-white">
                    <img src="{{ asset('') }}assets/img/logo-white.png" alt="">
                </a>
                <a href="index.html" class="logo-small">
                    <img src="{{ asset('') }}assets/img/logo-small.png" alt="">
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
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="#" class="dropdown">
                            <div class="searchinputs dropdown-toggle" id="dropdownMenuClickable"
                                data-bs-toggle="dropdown" data-bs-auto-close="false">
                                <input type="text" placeholder="Search">
                                <div class="search-addon">
                                    <span><i data-feather="x-circle" class="feather-14"></i></span>
                                </div>
                            </div>
                            <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuClickable">
                                <div class="search-info">
                                    <h6><span><i data-feather="search" class="feather-16"></i></span>Recent Searches
                                    </h6>
                                    <ul class="search-tags">
                                        <li><a href="javascript:void(0);">Products</a></li>
                                        <li><a href="javascript:void(0);">Sales</a></li>
                                        <li><a href="javascript:void(0);">Applications</a></li>
                                    </ul>
                                </div>
                                <div class="search-info">
                                    <h6><span><i data-feather="help-circle" class="feather-16"></i></span>Help</h6>
                                    <p>How to Change Product Volume from 0 to 200 on Inventory management</p>
                                    <p>Change Product Name</p>
                                </div>
                                <div class="search-info">
                                    <h6><span><i data-feather="user" class="feather-16"></i></span>Customers</h6>
                                    <ul class="customers">
                                        <li><a href="javascript:void(0);">Aron Varu<img
                                                    src="assets/img/profiles/avator1.jpg" alt=""
                                                    class="img-fluid"></a>
                                        </li>
                                        <li><a href="javascript:void(0);">Jonita<img
                                                    src="assets/img/profiles/avatar-01.jpg" alt=""
                                                    class="img-fluid"></a></li>
                                        <li><a href="javascript:void(0);">Aaron<img
                                                    src="assets/img/profiles/avatar-10.jpg" alt=""
                                                    class="img-fluid"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
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
            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="general-settings.html">Settings</a>
                    <a class="dropdown-item" href="signin.html">Logout</a>
                </div>
            </div>
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
                                <li id="all">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('') }}assets/img/categories/category-01.png"
                                            alt="Categories">
                                    </a>
                                    <h6><a href="javascript:void(0);">Semua Kategori</a></h6>
                                    <span>80 Items</span>
                                </li>
                                @foreach ($produk as $kat)
                                    <li id="{{ $kat->id }}">
                                        <a href="javascript:void(0);">
                                            <img src="{{ asset('') }}assets/img/categories/category-02.png"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">{{ $kat->Nama }}</a></h6>
                                        <span>4 Items</span>
                                    </li>
                                @endforeach
                            </ul>
                           <div class="pos-products">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="mb-3">Produk</h5>
    </div>
    <div class="tabs_container">
        @foreach ($produk as $key => $kategori)
            <div class="tab_content active" data-tab="{{ $kategori->id }}">
                <div class="row">
                    @foreach ($kategori->getProduk as $item)
                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3">
                            <div class="product-info default-cover card"
                                data-product-id="{{ $item->id }}"
                                data-product-name="{{ $item->Nama }}"
                                data-product-price="{{ $item->HargaJual }}"
                                data-category-name="{{ $kategori->Nama }}"
                                data-product-image="{{ asset('storage/uploads/produk/' . $item->Gambar) }}"
                                data-product-konversi='@json($item->konversi ? $item->konversi->map(function($k) { return [
                                    "id" => $k->id,
                                    "nama_satuan" => $k->getNamaSatuan->NamaSatuan ?? "Satuan",
                                    "harga_jual" => $k->HargaJual
                                ]; }) : [])'
                            >
                                <a href="javascript:void(0);" class="img-bg">
                                    <img src="{{ asset('storage/uploads/produk/' . $item->Gambar) }}"
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
                                    <a class="confirm-text" href="javascript:void(0);"><i data-feather="trash-2"
                                            class="feather-16 text-danger"></i></a>
                                    <a href="javascript:void(0);" class="text-default"><i
                                            data-feather="more-vertical" class="feather-16"></i></a>
                                </div>
                            </div>
                            <div class="customer-info block-section">
                                <h6>Informasi Pelanggan</h6>
                                <div class="input-block d-flex align-items-center">
                                    <input type="text" class="form-control" name="InformasiPelanggan"
                                        id="InformasiPelanggan" placeholder="Informasi Pelanggan">
                                </div>

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

    <!-- CSS tambahan untuk styling -->
    <style>
        .checkout-section {
            border-top: 1px solid #dee2e6;
            padding-top: 1rem;
        }

        .cart-total {
            border: 1px solid #dee2e6;
        }

        #loading-overlay .loading-content {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .notification {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .checkout-summary .table th {
            border-top: none;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Animation untuk tombol saat disabled */
        .btn:disabled {
            position: relative;
            overflow: hidden;
        }

        .btn:disabled::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }
        .satuan-select {
            min-width: 120px;
            margin-top: 2px;
        }
        .harga-produk {
            font-size: 1rem;
        }
    </style>
    <style>
        .pos-products .product-info.selected {
            transform: scale(0.95);
            transition: transform 0.2s ease;
        }

        .pos-products .product-info {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pos-products .product-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .product-wrap .product-list {
            border-bottom: 1px solid #f0f0f0;
            padding: 10px 0;
            margin-bottom: 10px;
        }

        .qty-item input {
            width: 60px;
        }
    </style>
</body>

</html>
