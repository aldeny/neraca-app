<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SellController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

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

Route::get('/', function () {
    return view('login');
});

// Route::get('/kas/bank', function(){
//     return view('admin.kas_bank');
// });

Route::get('/index', [MainController::class, 'index'])->name('index');

/* Saldo Masuk - Kas Bank */
Route::get('/kas/bank', [MainController::class, 'getIndexKasBank'])->name('kas_bank');
Route::post('kas/add', [MainController::class, 'addData']);
Route::get('/kas/getData', [MainController::class, 'getDataCash'])->name('getData');
Route::post('/kas/delete/{id}', [MainController::class, 'deleteId']);

/* Saldo Masuk - Kas Besar */
Route::get('/kas/besar', [MainController::class, 'getIndexKasBesar'])->name('kas_besar');
Route::get('/kas/getData/BigCash', [MainController::class, 'getDataKasBesar'])->name('getDataBigCash');

/* Saldo Masuk - Kas Besar */
Route::get('/kas/kecil', [MainController::class, 'getIndexKasKecil'])->name('kas_kecil');
Route::get('/kas/getData/SmallCash', [MainController::class, 'getDataKasKecil'])->name('getDataSmallCash');

/* Pembelian */
Route::get('/buy/index', [BuyController::class, 'BuyIndex'])->name('buyIndex');
Route::post('/buy/addData', [BuyController::class, 'BuyAdd']);
Route::get('/buy/getData', [BuyController::class, 'BuygetData'])->name('getDataBuy');
Route::post('/buy/delete/{id}', [BuyController::class, 'deleteIdBuy']);

/* Penjualan */
Route::get('/sell/index', [SellController::class, 'SellIndex'])->name('index_sell');

/* Bank */
Route::get('/bank/index', [BankController::class, 'index_bank'])->name('index_bank');
Route::get('/bank/getData', [BankController::class, 'getDataBank'])->name('getDataBank');
Route::post('/bank/addBank', [BankController::class, 'addBank'])->name('add.bank');
Route::get('/bank/getData/{id}', [BankController::class, 'getDataId']);
Route::post('/bank/updateBank', [BankController::class, 'updateBank'])->name('update.bank');
Route::post('/bank/delete/{id}', [BankController::class, 'deleteIdBank']);

/* Assets */
Route::get('/asset/index', [AssetsController::class, 'index_assets'])->name('index_assets');
Route::post('/asset/Addassets', [AssetsController::class, 'insert_assets'])->name('save.asset');
Route::get('/asset/Getassets', [AssetsController::class, 'GetDataassets'])->name('GetDataAssets');
Route::get('/asset/Editassets', [AssetsController::class, 'EditDataassets'])->name('edit.aset');
Route::post('/asset/Updateassets', [AssetsController::class, 'UpdateDataassets'])->name('update.asset');
Route::post('/asset/delete', [AssetsController::class, 'deleteIdAsset'])->name('delete.aset');

/* Karyawan */
Route::get('employee/index', [EmployeeController::class, 'EmployeeIndex'])->name('employee.index');

/* Jabatan */
Route::get('/position', [PositionController::class, 'PositionIndex'])->name('position.index');
Route::post('/position/addPosition', [PositionController::class, 'addPosition'])->name('add.position');
Route::get('/position/getData', [PositionController::class, 'getDataPosition'])->name('getDataPosition');
Route::get('/position/getData/{id}', [PositionController::class, 'getIdPosition']);
Route::post('/position/updatePosition', [PositionController::class, 'updatePosition'])->name('update.position');
Route::post('/position/delete/{id}', [PositionController::class, 'deleteIdPosition']);

/* Product */
Route::get('/product', [ProductController::class, 'ProductIndex'])->name('product.index');
Route::post('/product/addProduct', [ProductController::class, 'ProductAdd'])->name('product.add');
Route::get('/product/getProduct', [ProductController::class, 'getDataProduct'])->name('product.GetData');
Route::get('/product/getData/{id}', [ProductController::class, 'getIdProduct']);
Route::post('/product/updateProduct', [ProductController::class, 'updateProduct'])->name('product.add.update');
Route::post('/product/delete/{id}', [ProductController::class, 'deleteIdProduct']);
