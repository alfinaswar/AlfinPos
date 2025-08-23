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
    <title>Dreams Pos Admin Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/css/bootstrap.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/css/bootstrap-datetimepicker.min.css">

    <!-- animation CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/css/animate.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/select2/css/select2.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/css/dataTables.bootstrap5.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/fontawesome/css/all.min.css">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/daterangepicker/daterangepicker.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/plugins/owlcarousel/owl.theme.default.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('')}}assets/css/style.css">
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
                    <img src="{{asset('')}}assets/img/logo.png" alt="">
                </a>
                <a href="index.html" class="logo logo-white">
                    <img src="{{asset('')}}assets/img/logo-white.png" alt="">
                </a>
                <a href="index.html" class="logo-small">
                    <img src="{{asset('')}}assets/img/logo-small.png" alt="">
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
                                                    src="{{asset('')}}assets/img/profiles/avator1.jpg" alt=""
                                                    class="img-fluid"></a>
                                        </li>
                                        <li><a href="javascript:void(0);">Jonita<img
                                                    src="{{asset('')}}assets/img/profiles/avator1.jpg" alt=""
                                                    class="img-fluid"></a>
                                        </li>
                                        <li><a href="javascript:void(0);">Aaron<img
                                                    src="{{asset('')}}assets/img/profiles/avator1.jpg" alt=""
                                                    class="img-fluid"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <a class="btn"  id="searchdiv"><img src="{{asset('')}}assets/img/icons/search.svg" alt="img"></a> -->
                        </form>
                    </div>
                </li>
                <!-- /Search -->

                <!-- Select Store -->
                <li class="nav-item dropdown has-arrow main-drop select-store-dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link select-store"
                        data-bs-toggle="dropdown">
                        <span class="user-info">
                            <span class="user-letter">
                                <img src="{{asset('')}}assets/img/store/store-01.png" alt="Store Logo"
                                    class="img-fluid">
                            </span>
                            <span class="user-detail">
                                <span class="user-name">Select Store</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('')}}assets/img/store/store-01.png" alt="Store Logo" class="img-fluid">
                            Grocery Alpha
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('')}}assets/img/store/store-02.png" alt="Store Logo" class="img-fluid">
                            Grocery Apex
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('')}}assets/img/store/store-03.png" alt="Store Logo" class="img-fluid">
                            Grocery Bevy
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('')}}assets/img/store/store-04.png" alt="Store Logo" class="img-fluid">
                            Grocery Eden
                        </a>
                    </div>
                </li>
                <!-- /Select Store -->

                <!-- Flag -->
                <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"
                        role="button">
                        <img src="{{asset('')}}assets/img/flags/us.png" alt="Language" class="img-fluid">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item active">
                            <img src="{{asset('')}}assets/img/flags/us.png" alt="" height="16"> English
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('')}}assets/img/flags/fr.png" alt="" height="16"> French
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('')}}assets/img/flags/es.png" alt="" height="16"> Spanish
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('')}}assets/img/flags/de.png" alt="" height="16"> German
                        </a>
                    </div>
                </li>
                <!-- /Flag -->

                <li class="nav-item nav-item-box">
                    <a href="javascript:void(0);" id="btnFullscreen">
                        <i data-feather="maximize"></i>
                    </a>
                </li>
                <li class="nav-item nav-item-box">
                    <a href="email.html">
                        <i data-feather="mail"></i>
                        <span class="badge rounded-pill">1</span>
                    </a>
                </li>
                <!-- Notifications -->
                <li class="nav-item dropdown nav-item-box">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i data-feather="bell"></i><span class="badge rounded-pill">2</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt="" src="{{asset('')}}assets/img/profiles/avatar-02.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment booking</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt="" src="{{asset('')}}assets/img/profiles/avatar-03.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                    changed the task name <span class="noti-title">Appointment booking
                                                        with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt="" src="{{asset('')}}assets/img/profiles/avatar-06.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt="" src="{{asset('')}}assets/img/profiles/avatar-17.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt="" src="{{asset('')}}assets/img/profiles/avatar-13.jpg">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                                    added new task <span class="noti-title">Private chat module</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->

                <li class="nav-item nav-item-box">
                    <a href="general-settings.html"><i data-feather="settings"></i></a>
                </li>
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-info">
                            <span class="user-letter">
                                <img src="{{asset('')}}assets/img/profiles/avator1.jpg" alt="" class="img-fluid">
                            </span>
                            <span class="user-detail">
                                <span class="user-name">John Smilga</span>
                                <span class="user-role">Super Admin</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="{{asset('')}}assets/img/profiles/avator1.jpg" alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>John Smilga</h6>
                                    <h5>Super Admin</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My
                                Profile</a>
                            <a class="dropdown-item" href="general-settings.html"><i class="me-2"
                                    data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="signin.html"><img
                                    src="{{asset('')}}assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
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
                    <a href="javascript:void(0);" class="btn btn-secondary mb-xs-3" data-bs-toggle="modal"
                        data-bs-target="#orders"><span class="me-1 d-flex align-items-center"><i
                                data-feather="shopping-cart" class="feather-16"></i></span>View Orders</a>
                    <a href="javascript:void(0);" class="btn btn-info"><span class="me-1 d-flex align-items-center"><i
                                data-feather="rotate-cw" class="feather-16"></i></span>Reset</a>
                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#recents"><span class="me-1 d-flex align-items-center"><i
                                data-feather="refresh-ccw" class="feather-16"></i></span>Transaction</a>
                </div>

                <div class="row align-items-start pos-wrapper">
                    <div class="col-md-12 col-lg-8">
                        <div class="pos-categories tabs_wrapper">
                            <h5>Kategori Produk</h5>
                            <p>Pilih Berdasarkan Kategori Produk</p>
                            <ul class="tabs owl-carousel pos-category">
                                <li id="all">
                                    <a href="javascript:void(0);">
                                        <img src="{{asset('')}}assets/img/categories/category-01.png" alt="Categories">
                                    </a>
                                    <h6><a href="javascript:void(0);">Semua Kategori</a></h6>
                                    <span>80 Items</span>
                                </li>
                                @foreach ($produk as $kat)
                                    <li id="{{$kat->id}}">
                                        <a href="javascript:void(0);">
                                            <img src="{{asset('')}}assets/img/categories/category-02.png" alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">{{$kat->Nama}}</a></h6>
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
                                        <div class="tab_content active" data-tab="{{$kategori->id}}">
                                            <div class="row">
                                                @foreach ($kategori->getProduk as $item)
                                                    <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3">
                                                        <div class="product-info default-cover card"
                                                            data-product-id="{{$item->id}}" data-product-name="{{$item->Nama}}"
                                                            data-product-price="{{$item->HargaJual}}"
                                                            data-category-name="{{$kategori->Nama}}"
                                                            data-product-image="{{asset('storage/uploads/produk/' . $item->Gambar)}}">
                                                            <a href="javascript:void(0);" class="img-bg">
                                                                <img src="{{asset('storage/uploads/produk/' . $item->Gambar)}}"
                                                                    alt="Products" width="150px" height="100px"
                                                                    style="object-fit: cover;">
                                                                <span><i data-feather="check" class="feather-16"></i></span>
                                                            </a>
                                                            <h6 class="cat-name"><a
                                                                    href="javascript:void(0);">{{$kategori->Nama}}</a></h6>
                                                            <h6 class="product-name"><a
                                                                    href="javascript:void(0);">{{$item->Nama}}</a></h6>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between price">
                                                                <span>{{$item->HargaJual}}</span>
                                                                <p>{{ 'Rp ' . number_format($item->HargaJual, 0, ',', '.') }}
                                                                </p>
                                                            </div>
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
                                    <a href="javascript:void(0);" class="text-default"><i data-feather="more-vertical"
                                            class="feather-16"></i></a>
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
                                    <h6 class="d-flex align-items-center mb-0">Produk Dibeli<span class="count">0</span>
                                    </h6>
                                    <a href="javascript:void(0);" class="d-flex align-items-center text-danger"
                                        id="clear-all-btn">
                                        <span class="me-1"><i data-feather="x" class="feather-16"></i></span>Clear all
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
        $(document).ready(function () {
            $('#checkout-btn').on('click', function () {
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
                    url: '{{route('pos.store')}}', // route Laravel
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        products: selectedProducts,
                        customer: $('#InformasiPelanggan').val(),
                    },
                    success: function (response) {
                        if (response.success) {
                            alert('Checkout berhasil!');
                            clearAllProducts();
                            $('#total-items').text(0);
                            $('#total-amount').text('Rp 0');
                        } else {
                            alert('Checkout gagal: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan server!');
                    }
                });
            });
            // Format angka ke Rupiah
            function formatRupiah(angka) {
                return 'Rp ' + (angka ? angka.toLocaleString('id-ID') : '0');
            }

            // Auto-format input uang diterima
            $(document).on('input', '#uang-dibayar', function () {
                let raw = $(this).val().replace(/\D/g, ""); // hanya angka
                let uangDibayar = parseInt(raw) || 0;

                // format ke Rp
                $(this).val(uangDibayar.toLocaleString('id-ID'));

                // ambil total belanja
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
            const existingProductIndex = selectedProducts.findIndex(p => p.id === productData.id);

            if (existingProductIndex > -1) {
                selectedProducts[existingProductIndex].quantity += 1;
                updateProductQuantity(productData.id, selectedProducts[existingProductIndex].quantity);
            } else {
                productData.quantity = 1;
                selectedProducts.push(productData);
                addProductToDOM(productData);
            }

            updateCounter();
        }

        function addProductToDOM(product) {
            const productWrap = document.querySelector('.product-wrap');

            const productHTML = `
            <div class="product-list d-flex align-items-center justify-content-between" data-product-id="${product.id}">
                <div class="d-flex align-items-center product-info" data-bs-toggle="modal" data-bs-target="#products">
                    <a href="javascript:void(0);" class="img-bg">
                        <img src="${product.image}" alt="Products" style="width: 50px; height: 50px; object-fit: cover;">
                    </a>
                    <div class="info">
                        <span>${product.category}</span>
                        <h6><a href="javascript:void(0);">${product.name}</a></h6>
                        <p>${product.formattedPrice}</p>
                    </div>
                </div>
                <div class="qty-item text-center">
                    <a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center"
                       onclick="decreaseQuantity('${product.id}')">
                        <i data-feather="minus-circle" class="feather-14"></i>
                    </a>
                    <input type="text" class="form-control text-center qty-input" name="qty" value="${product.quantity}"
                           onchange="updateQuantityFromInput('${product.id}', this.value)">
                    <a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center"
                       onclick="increaseQuantity('${product.id}')">   
                        <i data-feather="plus-circle" class="feather-14"></i>
                    </a>
                </div>
                <div class="action">
                    <a class="btn-icon delete-icon confirm-text" href="javascript:void(0);" onclick="removeFromCart('${product.id}')">
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

        function increaseQuantity(productId) {
            const productIndex = selectedProducts.findIndex(p => p.id == productId);
            if (productIndex > -1) {
                selectedProducts[productIndex].quantity += 1;
                updateProductQuantity(productId, selectedProducts[productIndex].quantity);
            }
        }

        function decreaseQuantity(productId) {
            const productIndex = selectedProducts.findIndex(p => p.id == productId);
            if (productIndex > -1) {
                if (selectedProducts[productIndex].quantity > 1) {
                    selectedProducts[productIndex].quantity -= 1;
                    updateProductQuantity(productId, selectedProducts[productIndex].quantity);
                } else {
                    removeFromCart(productId);
                }
            }
        }

        function updateQuantityFromInput(productId, newQuantity) {
            const quantity = parseInt(newQuantity);
            if (quantity > 0) {
                const productIndex = selectedProducts.findIndex(p => p.id == productId);
                if (productIndex > -1) {
                    selectedProducts[productIndex].quantity = quantity;
                    updateCounter(); // ✅ ini penting
                }
            } else {
                removeFromCart(productId);
            }
        }

        function updateProductQuantity(productId, quantity) {
            const productElement = document.querySelector(`.product-wrap [data-product-id="${productId}"]`);
            if (productElement) {
                const qtyInput = productElement.querySelector('.qty-input');
                if (qtyInput) {
                    qtyInput.value = quantity;
                }
            }
            updateCounter();
        }


        function removeFromCart(productId) {
            selectedProducts = selectedProducts.filter(p => p.id != productId);

            const productElement = document.querySelector(`.product-wrap [data-product-id="${productId}"]`);
            if (productElement) {
                productElement.remove();
            }

            updateCounter();
        }

        function clearAllProducts() {
            selectedProducts = [];
            const productWrap = document.querySelector('.product-wrap');
            productWrap.innerHTML = '';
            updateCounter();
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Event listener untuk klik produk
            document.addEventListener('click', function (e) {
                const productCard = e.target.closest('.pos-products .product-info');
                if (productCard) {
                    e.preventDefault();

                    const productData = {
                        id: productCard.dataset.productId,
                        image: productCard.dataset.productImage,
                        category: productCard.dataset.categoryName,
                        name: productCard.dataset.productName,
                        price: productCard.dataset.productPrice,
                        formattedPrice: 'Rp ' + parseInt(productCard.dataset.productPrice).toLocaleString('id-ID')
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
                clearAllBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    clearAllProducts();
                });
            }
        });
    </script>
    <script>
        function updateTotalDisplay() {
            const totalItems = selectedProducts.reduce((total, product) => total + product.quantity, 0);
            const totalAmount = selectedProducts.reduce((total, product) => total + (parseInt(product.price) * product.quantity), 0);

            $('#total-items').text(totalItems);
            $('#total-amount').text('Rp ' + totalAmount.toLocaleString('id-ID'));
        }

        // Override function updateCounter untuk juga update total display
        const originalUpdateCounter = updateCounter;
        updateCounter = function () {
            originalUpdateCounter();
            updateTotalDisplay();
        };
        function loadDraftList() {
            $.ajax({
                url: '/pos/draft-list',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        let draftListHTML = '';

                        if (response.drafts.length > 0) {
                            response.drafts.forEach(function (draft) {
                                draftListHTML += `
                            <div class="card mb-2">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-1">Draft #${draft.id}</h6>
                                            <small class="text-muted">
                                                ${draft.total_items} items - Rp ${parseInt(draft.total_amount).toLocaleString('id-ID')}
                                                <br>
                                                ${new Date(draft.created_at).toLocaleString('id-ID')}
                                            </small>
                                        </div>
                                        <button class="btn btn-sm btn-primary load-draft-btn" data-draft-id="${draft.id}">
                                            Load
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                            });
                        } else {
                            draftListHTML = '<p class="text-center text-muted">Tidak ada draft tersimpan</p>';
                        }

                        $('#draft-list').html(draftListHTML);
                    }
                },
                error: function () {
                    $('#draft-list').html('<p class="text-center text-danger">Gagal memuat draft</p>');
                }
            });
        }
        $(document).ready(function () {
            // Tombol untuk membuka modal draft
            $(document).on('click', '#load-draft-btn', function () {
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
