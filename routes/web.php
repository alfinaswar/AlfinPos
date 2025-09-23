<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DependentDropdownController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JenisItemController;
use App\Http\Controllers\KategoriItemController;
use App\Http\Controllers\KonversiItemController;
use App\Http\Controllers\LaporanPenjualan;
use App\Http\Controllers\MasterSatuanController;
use App\Http\Controllers\MasterShiftController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockAdjustController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
Route::prefix('transaksi')->group(function () {
    Route::GET('/', [TransaksiController::class, 'index'])->name('pos.index');
    Route::GET('/create', [TransaksiController::class, 'create'])->name('pos.create');
    Route::POST('/simpan', [TransaksiController::class, 'store'])->name('pos.store');
    Route::GET('/edit/{id}', [TransaksiController::class, 'edit'])->name('pos.edit');
    Route::GET('/show/{id}', [TransaksiController::class, 'show'])->name('pos.show');
    Route::get('/pos/struk/{id}', [TransaksiController::class, 'cetakStruk'])->name('pos.struk');
    Route::get('/transaksi/{id}/download', [TransaksiController::class, 'downloadPdf'])->name('pos.download');
    Route::PUT('/update/{id}', [TransaksiController::class, 'update'])->name('pos.update');
    Route::delete('hapus/{id}', [TransaksiController::class, 'destroy'])->name('pos.destroy');
});

Route::prefix('master-kategori-item')->group(function () {
    Route::GET('/', [KategoriItemController::class, 'index'])->name('kategori.index');
    Route::GET('/create', [KategoriItemController::class, 'create'])->name('kategori.create');
    Route::POST('/simpan', [KategoriItemController::class, 'store'])->name('kategori.store');
    Route::GET('/edit/{id}', [KategoriItemController::class, 'edit'])->name('kategori.edit');
    Route::PUT('/update/{id}', [KategoriItemController::class, 'update'])->name('kategori.update');
    Route::delete('hapus/{id}', [KategoriItemController::class, 'destroy'])->name('kategori.destroy');
});
Route::prefix('adjust-stok')->group(function () {
    Route::GET('/', [StockAdjustController::class, 'index'])->name('so.index');
    Route::GET('/create', [StockAdjustController::class, 'create'])->name('so.create');
    Route::POST('/simpan', [StockAdjustController::class, 'store'])->name('so.store');
    Route::GET('/edit/{id}', [StockAdjustController::class, 'edit'])->name('so.edit');
    Route::GET('/show/{id}', [StockAdjustController::class, 'show'])->name('so.show');
    Route::PUT('/update/{id}', [StockAdjustController::class, 'update'])->name('so.update');
    Route::delete('hapus/{id}', [StockAdjustController::class, 'destroy'])->name('so.destroy');
    Route::POST('/approve/{id}', [StockAdjustController::class, 'approve'])->name('so.approve');
    Route::POST('/reject/{id}', [StockAdjustController::class, 'reject'])->name('so.reject');
});
Route::prefix('master-item')->group(function () {
    Route::GET('/', [ItemController::class, 'index'])->name('item.index');
    Route::GET('/create', [ItemController::class, 'create'])->name('item.create');
    Route::POST('/simpan', [ItemController::class, 'store'])->name('item.store');
    Route::GET('/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
    Route::PUT('/update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('hapus/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
});
Route::prefix('master-shift')->group(function () {
    Route::GET('/', [MasterShiftController::class, 'index'])->name('shift.index');
    Route::GET('/create', [MasterShiftController::class, 'create'])->name('shift.create');
    Route::POST('/simpan', [MasterShiftController::class, 'store'])->name('shift.store');
    Route::GET('/edit/{id}', [MasterShiftController::class, 'edit'])->name('shift.edit');
    Route::PUT('/update/{id}', [MasterShiftController::class, 'update'])->name('shift.update');
    Route::delete('hapus/{id}', [MasterShiftController::class, 'destroy'])->name('shift.destroy');
});
Route::prefix('jenis-item')->group(function () {
    Route::GET('/', [JenisItemController::class, 'index'])->name('jenis.index');
    Route::GET('/create', [JenisItemController::class, 'create'])->name('jenis.create');
    Route::POST('/simpan', [JenisItemController::class, 'store'])->name('jenis.store');
    Route::GET('/edit/{id}', [JenisItemController::class, 'edit'])->name('jenis.edit');
    Route::PUT('/update/{id}', [JenisItemController::class, 'update'])->name('jenis.update');
    Route::delete('hapus/{id}', [JenisItemController::class, 'destroy'])->name('jenis.destroy');
});
Route::prefix('satuan-item')->group(function () {
    Route::GET('/', [MasterSatuanController::class, 'index'])->name('satuan.index');
    Route::GET('/create', [MasterSatuanController::class, 'create'])->name('satuan.create');
    Route::POST('/simpan', [MasterSatuanController::class, 'store'])->name('satuan.store');
    Route::GET('/edit/{id}', [MasterSatuanController::class, 'edit'])->name('satuan.edit');
    Route::PUT('/update/{id}', [MasterSatuanController::class, 'update'])->name('satuan.update');
    Route::delete('hapus/{id}', [MasterSatuanController::class, 'destroy'])->name('satuan.destroy');
});
Route::prefix('konversi-satuan')->group(function () {
    Route::GET('/', [KonversiItemController::class, 'index'])->name('konversi-satuan.index');
    Route::GET('/create', [KonversiItemController::class, 'create'])->name('konversi-satuan.create');
    Route::POST('/simpan', [KonversiItemController::class, 'store'])->name('konversi-satuan.store');
    Route::GET('/edit/{id}', [KonversiItemController::class, 'edit'])->name('konversi-satuan.edit');
    Route::PUT('/update/{id}', [KonversiItemController::class, 'update'])->name('konversi-satuan.update');
    Route::delete('hapus/{id}', [KonversiItemController::class, 'destroy'])->name('konversi-satuan.destroy');
});
Route::prefix('produk')->group(function () {
    Route::GET('/get-jenis-item/{id}', [ProdukController::class, 'getJenisItem'])->name('produk.getJenisItem');
    Route::GET('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::GET('/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::POST('/simpan', [ProdukController::class, 'store'])->name('produk.store');
    Route::GET('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::PUT('/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('hapus/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});
Route::prefix('barang-masuk')->group(function () {
    Route::GET('/', [BarangMasukController::class, 'index'])->name('bm.index');
    Route::GET('/create', [BarangMasukController::class, 'create'])->name('bm.create');
    Route::POST('/simpan', [BarangMasukController::class, 'store'])->name('bm.store');
    Route::GET('/edit/{id}', [BarangMasukController::class, 'edit'])->name('bm.edit');
    Route::GET('/show/{id}', [BarangMasukController::class, 'show'])->name('bm.show');
    Route::PUT('/update/{id}', [BarangMasukController::class, 'update'])->name('bm.update');
    Route::delete('hapus/{id}', [BarangMasukController::class, 'destroy'])->name('bm.destroy');
});
Route::prefix('hrm')->group(function () {
    Route::GET('/', [AbsensiController::class, 'index'])->name('absen.index');
    Route::GET('/create', [AbsensiController::class, 'create'])->name('absen.create');
    Route::POST('/simpan', [AbsensiController::class, 'store'])->name('absen.store');
    Route::GET('/edit/{id}', [AbsensiController::class, 'edit'])->name('absen.edit');
    Route::PUT('/update/{id}', [AbsensiController::class, 'update'])->name('absen.update');
    Route::delete('hapus/{id}', [AbsensiController::class, 'destroy'])->name('absen.destroy');
});
Route::prefix('laporan')->group(function () {
    Route::GET('/', [LaporanPenjualan::class, 'index'])->name('laporan.index');
    Route::POST('/download', [LaporanPenjualan::class, 'store'])->name('laporan.store');
});
Route::prefix('pos')->group(function () {
    Route::post('/scan-barcode', [TransaksiController::class, 'scanBarcode'])->name('pos.scan-barcode');
    Route::GET('/', [TransaksiController::class, 'kasir'])->name('pos.kasir');
});
Route::get('provinces', [DependentDropdownController::class, 'provinces'])->name('provinces');
Route::get('cities', [DependentDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependentDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependentDropdownController::class, 'villages'])->name('villages');
