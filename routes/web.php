<?php

use App\Http\Controllers\LogC;
use App\Http\Controllers\MejaC;
use App\Http\Controllers\UserC;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\ProductC;
use App\Http\Controllers\KategoriC;
use App\Http\Controllers\DashboardC;
use App\Http\Controllers\TransaksiC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailTransaksiC;

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
    return redirect()->route('login');
});

Route::get('login', [LoginC::class, 'login'])->name('login');
Route::post('login', [LoginC::class, 'authenticate'])->name('login');

Route::get('logout', [LoginC::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['checkRole:admin,kasir,owner'])->group(function () {
    Route::get('dashboard', [DashboardC::class, 'dashboard'])->name('dashboard');
    Route::get('product', [ProductC::class, 'product'])->name('product');
    Route::get('meja', [MejaC::class, 'meja'])->name('meja');
    Route::get('/print-transaksi', [TransaksiC::class, 'printTransaksi'])->name('transaksi.print');
    Route::get('/print-transaksi-by-date', [TransaksiC::class, 'printByDate'])->name('transaksi.printByDate');
});
Route::middleware(['checkRole:kasir,owner'])->group(function () {
    Route::get('/history-transaksi', [TransaksiC::class, 'showHistoryForm'])->name('history.transaksi');
});

Route::middleware(['checkRole:admin'])->group(function () {
    Route::get('/add-product', [ProductC::class, 'addProductForm'])->name('add.product.form');
    Route::post('/store-product', [ProductC::class, 'storeProduct'])->name('store.product');
    Route::get('/product/{id_produk}/edit', [ProductC::class, 'edit'])->name('product.edit');
    Route::put('/product/{id_produk}', [ProductC::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id_produk}', [ProductC::class, 'deleteProduct'])->name('product.delete');

    Route::get('users', [UserC::class,'users'])->name('users');
    Route::get('/add-user', [UserC::class, 'addUserForm'])->name('add.user.form');
    Route::post('/store-user', [UserC::class, 'storeUser'])->name('store.user');
    Route::get('/users/{id}/edit', [UserC::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserC::class, 'update'])->name('users.update');
    Route::put('/users/{id}/change', [UserC::class, 'changePassword'])->name('users.change');
    Route::get('/users/delete/{id}', [UserC::class, 'deleteUser'])->name('users.delete');
    Route::get('/print-users', [UserC::class, 'printUsers'])->name('users.print');

    Route::get('/add-meja', [MejaC::class, 'addMejaForm'])->name('add.meja.form');
    Route::post('/store-meja', [MejaC::class, 'storeMeja'])->name('store.meja');
    Route::get('/meja/delete/{id}', [MejaC::class, 'deleteMeja'])->name('meja.delete');
    Route::get('/meja/{id}/edit', [MejaC::class, 'edit'])->name('meja.edit');
    Route::put('/meja/{id}', [MejaC::class, 'update'])->name('meja.update');
    
    Route::get('kategori', [KategoriC::class,'kategori'])->name('kategori');
    Route::post('/store-kategori', [KategoriC::class, 'storeKategori'])->name('store.kategori');
    Route::get('/kategori/delete/{id_kategori}', [KategoriC::class, 'deleteKategori'])->name('kategori.delete');
    Route::get('/kategori/{id_kategori}/edit', [KategoriC::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id_kategori}', [KategoriC::class, 'update'])->name('kategori.update');
});

Route::middleware(['checkRole:kasir'])->group(function () {
    Route::get('/transaksi', [TransaksiC::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiC::class, 'show'])->name('transaksi.show');
    Route::post('/transaksi/store', [TransaksiC::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi-selesai/{transaksi}', [TransaksiC::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/print-struk/{id}', [TransaksiC::class, 'printStruk'])->name('struk.print');

    Route::put('/meja/{id}/change', [MejaC::class, 'changeStatus'])->name('meja.change');
    
});

Route::middleware(['checkRole:owner'])->group(function () {
    Route::get('log', [LogC::class, 'log'])->name('log');
    Route::get('search/log', [LogC::class, 'search'])->name('log.search');
    
    Route::get('/print-product', [ProductC::class, 'printProduct'])->name('product.print');
    Route::get('/print-meja', [MejaC::class, 'printMeja'])->name('meja.print');
});




    
