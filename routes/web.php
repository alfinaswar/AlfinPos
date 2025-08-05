<?php

use App\Http\Controllers\DependentDropdownController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JenisItemController;
use App\Http\Controllers\KategoriItemController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
Route::prefix('master-kategori-item')->group(function () {
    Route::GET('/', [KategoriItemController::class, 'index'])->name('kategori.index');
    Route::GET('/create', [KategoriItemController::class, 'create'])->name('kategori.create');
    Route::POST('/simpan', [KategoriItemController::class, 'store'])->name('kategori.store');
    Route::GET('/edit/{id}', [KategoriItemController::class, 'edit'])->name('kategori.edit');
    Route::PUT('/update/{id}', [KategoriItemController::class, 'update'])->name('kategori.update');
    Route::delete('hapus/{id}', [KategoriItemController::class, 'destroy'])->name('kategori.destroy');
});
Route::prefix('master-item')->group(function () {
    Route::GET('/', [ItemController::class, 'index'])->name('item.index');
    Route::GET('/create', [ItemController::class, 'create'])->name('item.create');
    Route::POST('/simpan', [ItemController::class, 'store'])->name('item.store');
    Route::GET('/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
    Route::PUT('/update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('hapus/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
});
Route::prefix('jenis-item')->group(function () {
    Route::GET('/', [JenisItemController::class, 'index'])->name('jenis.index');
    Route::GET('/create', [JenisItemController::class, 'create'])->name('jenis.create');
    Route::POST('/simpan', [JenisItemController::class, 'store'])->name('jenis.store');
    Route::GET('/edit/{id}', [JenisItemController::class, 'edit'])->name('jenis.edit');
    Route::PUT('/update/{id}', [JenisItemController::class, 'update'])->name('jenis.update');
    Route::delete('hapus/{id}', [JenisItemController::class, 'destroy'])->name('jenis.destroy');
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
Route::get('provinces', [DependentDropdownController::class, 'provinces'])->name('provinces');
Route::get('cities', [DependentDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependentDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependentDropdownController::class, 'villages'])->name('villages');
