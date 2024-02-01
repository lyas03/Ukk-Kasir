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

Route::get('logout', [LoginC::class, 'logout'])->middleware('auth');



// Route::middleware(['checkRole:admin'])->group(function () {
    Route::get('dashboard', [DashboardC::class, 'dashboard'])->name('dashboard');
    
    Route::get('product', [ProductC::class, 'product'])->name('product');
    Route::get('/add-product', [ProductC::class, 'addProductForm'])->name('add.product.form');
    Route::post('/store-product', [ProductC::class, 'storeProduct'])->name('store.product');
    Route::get('/product/{id}/edit', [ProductC::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductC::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductC::class, 'deleteProduct'])->name('product.delete');
    Route::get('/print-product', [ProductC::class, 'printProduct'])->name('product.print');

    Route::get('users', [UserC::class,'users'])->name('users');
    Route::get('/add-user', [UserC::class, 'addUserForm'])->name('add.user.form');
    Route::post('/store-user', [UserC::class, 'storeUser'])->name('store.user');
    Route::get('/users/{id}/edit', [UserC::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserC::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [UserC::class, 'deleteUser'])->name('users.delete');
    Route::get('/print-users', [UserC::class, 'printUsers'])->name('users.print');

    Route::get('meja', [MejaC::class, 'meja'])->name('meja');
    Route::get('/add-meja', [MejaC::class, 'addMejaForm'])->name('add.meja.form');
    Route::post('/store-meja', [MejaC::class, 'storeMeja'])->name('store.meja');
    Route::get('/meja/delete/{id}', [MejaC::class, 'deleteMeja'])->name('meja.delete');
    Route::get('/meja/{id}/edit', [MejaC::class, 'edit'])->name('meja.edit');
    Route::put('/meja/{id}', [MejaC::class, 'update'])->name('meja.update');
    Route::get('/print-meja', [MejaC::class, 'printMeja'])->name('meja.print');

    Route::get('transaksi', [TransaksiC::class, 'showForm'])->name('transaksi');
    Route::post('/store-transaksi', [TransaksiC::class, 'store'])->name('store.transaksi');
    // Route::get('/transaksi/{id}/data', [DetailTransaksiC::class, 'data'])->name('transaksi.data');
    Route::get('history-transaksi', [TransaksiC::class, 'showHistoryForm'])->name('history-transaksi');
    Route::get('/print-transaksi', [TransaksiC::class, 'printTransaksi'])->name('transaksi.print');

    Route::get('log', [LogC::class, 'log'])->name('log');

    Route::get('kategori', [KategoriC::class,'kategori'])->name('kategori');
    Route::post('/store-kategori', [KategoriC::class, 'storeKategori'])->name('store.kategori');
// });

// Route::middleware(['checkRole:kasir'])->group(function () {
    

    
// });