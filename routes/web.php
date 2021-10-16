<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SellController;
use App\Models\Credit;
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
Route::post('/buy/delete', [BuyController::class, 'deleteIdBuy'])->name('delete.buy');

/* Penjualan */
Route::get('/sell/index', [SellController::class, 'SellIndex'])->name('index_sell');
Route::post('/sell/addSell', [SellController::class, 'SellAddData'])->name('sell.add.data');
Route::get('/sell/getData', [SellController::class, 'SellgetData'])->name('getDataSell');
Route::get('/sell/autoLoad/{item}', [SellController::class, 'getAutoLoad']);
Route::post('/sell/delete', [SellController::class, 'deleteIdSell'])->name('sellDelete');


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
Route::get('employee', [EmployeeController::class, 'EmployeeIndex'])->name('employee.index');
Route::post('/employee/Addemployee', [EmployeeController::class, 'insert_employee'])->name('save.employee');
Route::get('/employee/GetEmployee', [EmployeeController::class, 'GetDataEmployee'])->name('get.data.employee');
Route::get('/employee/GetEmployee/{id}', [EmployeeController::class, 'GetDataEmployeeId']);
Route::post('/employee/UpdateEmployee', [EmployeeController::class, 'UpdateEmployee'])->name('update.employee');
Route::post('/employee/PayEmployee', [EmployeeController::class, 'PayEmployee'])->name('pay.employee');
Route::get('/employee/Payment', [EmployeeController::class, 'Payment'])->name('report.payment');
Route::post('/employee/PaymentDel/{id}', [EmployeeController::class, 'PaymentDel']);
Route::post('/employee/EmployeeDel/{id}', [EmployeeController::class, 'EmployeeDel']);

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

/* Credit */
Route::get('/credit', [CreditController::class, 'CreditIndex'])->name('credit.index');
Route::post('/credit/addCredit', [CreditController::class, 'CreditAdd'])->name('credit.add');
Route::get('/credit/getCredit', [CreditController::class, 'CreditGet'])->name('credit.get');
Route::post('/credit/delete/{id}', [CreditController::class, 'deleteIdCredit']);
Route::get('/credit/GetCredit/{id}', [CreditController::class, 'GetDataCreditId']);
Route::post('/credit/PayCredit', [CreditController::class, 'PayCredit'])->name('pay.credit');

/* History Credit */
Route::get('/history/getHistoryCredit', [CreditController::class, 'HistoryCreditGet'])->name('history.credit.get');
Route::post('/history/delete/', [CreditController::class, 'deleteIdHistoryCredit'])->name('delete.histori');


/* Print */
Route::get('/print/kasBank/{from_date}/{to_date}', [MainController::class, 'PrintKB'])->name('print.kb');
Route::get('/print/kasBesar/{from_date}/{to_date}', [MainController::class, 'PrintKBs'])->name('print.kbs');
Route::get('/print/kasKecil/{from_date}/{to_date}', [MainController::class, 'PrintKC'])->name('print.kc');
Route::get('/print/buy/{from_date}/{to_date}', [BuyController::class, 'PrintBuy'])->name('print.buy');
Route::get('/print/sell/{from_date}/{to_date}', [SellController::class, 'PrintSell'])->name('print.sell');
