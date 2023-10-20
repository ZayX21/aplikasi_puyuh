<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'halamanDepan'])->name('halamanDepan');
Route::get('/produk', [App\Http\Controllers\HomeController::class, 'produk'])->name('produk');
Route::get('/produk/{produk}', [App\Http\Controllers\HomeController::class, 'produkDetail'])->name('produkDetail');
Route::get('/produk-data', [App\Http\Controllers\HomeController::class, 'produkData'])->name('produkData');

Route::get('/keranjang', [App\Http\Controllers\HomeController::class, 'keranjang'])->name('keranjang');
Route::delete('/keranjang/{keranjang}', [App\Http\Controllers\HomeController::class, 'deleteKeranjang'])->name('deleteKeranjang');
Route::post('/tambah-keranjang', [App\Http\Controllers\HomeController::class, 'tambahKeranjang'])->name('tambahKeranjang');
Route::post('/update-keranjang/{keranjang}', [App\Http\Controllers\HomeController::class, 'updateKeranjang'])->name('updateKeranjang');

Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'actCheckout'])->name('actCheckout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'checkrole:Admin']], function () {
    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');

    // Kategori
    Route::resource('/admin/kategori', App\Http\Controllers\Admin\KategoriController::class);

    // Produk
    Route::resource('/admin/produk', App\Http\Controllers\Admin\ProdukController::class);
    Route::get('/admin/produk/image/{id}', [App\Http\Controllers\Admin\ProdukController::class, 'image'])->name('produk.image');
    Route::post('/admin/produk/image', [App\Http\Controllers\Admin\ProdukController::class, 'imageAct'])->name('produk.imageAct');
    Route::delete('/admin/produk/image/{id}/{produk}', [App\Http\Controllers\Admin\ProdukController::class, 'imageDel'])->name('produk.imageDel');

    // Produk
    Route::resource('/admin/user', App\Http\Controllers\Admin\UserController::class);

    //akun
    Route::get('/admin/profile', [App\Http\Controllers\Admin\UserController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile', [App\Http\Controllers\Admin\UserController::class, 'profileAct'])->name('admin.profileAct');

    // Rekening
    Route::resource('/admin/rekening', App\Http\Controllers\Admin\RekeningController::class);

    // Slider
    Route::resource('/admin/slider', App\Http\Controllers\Admin\SliderController::class);

    // Pelanggan
    Route::get('/admin/pelanggan', [App\Http\Controllers\Admin\TransaksiController::class, 'pelanggan'])->name('admin.pelanggan');

    // Pesanan
    Route::get('/admin/pesan', [App\Http\Controllers\Admin\TransaksiController::class, 'pesan'])->name('admin.pesan');
    Route::get('/admin/pesan/{pesan}', [App\Http\Controllers\Admin\TransaksiController::class, 'pesanDetail'])->name('admin.pesanDetail');
    Route::get('/admin/pesan/produk/{pesan}', [App\Http\Controllers\Admin\TransaksiController::class, 'pesanDetailProduk'])->name('admin.pesanDetailProduk');
    Route::get('/admin/kirim_produk/{pesan}', [App\Http\Controllers\Admin\TransaksiController::class, 'kirimProduk'])->name('admin.kirimProduk');

    // Pembayaran
    Route::get('/admin/konfirmasi/{pesan}', [App\Http\Controllers\Admin\TransaksiController::class, 'konfirmasiPembayaran'])->name('admin.konfirmasiPembayaran');
    Route::post('/admin/konfirmasi/{pesan}', [App\Http\Controllers\Admin\TransaksiController::class, 'actKonfirmasiPembayaran'])->name('admin.actKonfirmasiPembayaran');

    Route::get('/admin/pembayaran', [App\Http\Controllers\Admin\TransaksiController::class, 'pembayaran'])->name('admin.pembayaran');
    Route::get('/admin/pembayaran/{pembayaran}', [App\Http\Controllers\Admin\TransaksiController::class, 'showPembayaran'])->name('admin.showPembayaran');
    Route::post('/admin/pembayaran/{pembayaran}', [App\Http\Controllers\Admin\TransaksiController::class, 'actPembayaran'])->name('admin.actPembayaran');

    // Setting
    Route::get('/admin/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.setting');
    Route::post('/admin/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.actUpdate');
});

Route::group(['middleware' => ['auth', 'checkrole:Pelanggan']], function () {
    Route::get('/pelanggan', [App\Http\Controllers\Pelanggan\DashboardController::class, 'index'])->name('pelanggan');

    Route::get('/pelanggan/pesan', [App\Http\Controllers\Pelanggan\TransaksiController::class, 'pesan'])->name('pelanggan.pesan');
    Route::get('/pelanggan/pesan/{pesan}', [App\Http\Controllers\Pelanggan\TransaksiController::class, 'pesanDetail'])->name('pelanggan.pesanDetail');
    Route::get('/pelanggan/pesan/produk/{pesan}', [App\Http\Controllers\Pelanggan\TransaksiController::class, 'pesanDetailProduk'])->name('pelanggan.pesanDetailProduk');
    Route::get('/pelanggan/konfirmasi_pesanan/{pesan}', [App\Http\Controllers\Pelanggan\TransaksiController::class, 'konfirmasiPenerimaanBarang'])->name('pelanggan.konfirmasiPenerimaanBarang');

    Route::get('/pelanggan/profile', [App\Http\Controllers\Pelanggan\DashboardController::class, 'profile'])->name('pelanggan.profile');
    Route::put('/pelanggan/profile', [App\Http\Controllers\Pelanggan\DashboardController::class, 'profileAct'])->name('pelanggan.profileAct');
});
