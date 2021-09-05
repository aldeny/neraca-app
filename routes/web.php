<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\MainController;
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

Route::get('/', function () {
    return view('login');
});

// Route::get('/kas/bank', function(){
//     return view('admin.kas_bank');
// });

Route::get('/index', [MainController::class, 'index'])->name('index');
Route::get('/kas/bank', [MainController::class, 'getIndexKasBank'])->name('kas_bank');
Route::post('kas/add', [MainController::class, 'addData']);
Route::get('/kas/getData', [MainController::class, 'getDataCash'])->name('getData');
Route::get('/kas/getData/out', [MainController::class, 'getDataCashOut'])->name('getDataOut');
Route::post('/kas/delete/{id}', [MainController::class, 'deleteId']);

Route::get('/bank/index', [BankController::class, 'index_bank'])->name('index_bank');
Route::get('/bank/getData', [BankController::class, 'getDataBank'])->name('getDataBank');
Route::post('/bank/addBank', [BankController::class, 'addBank'])->name('add.bank');
Route::get('/bank/getData/{id}', [BankController::class, 'getDataId']);
Route::post('/bank/updateBank', [BankController::class, 'updateBank'])->name('update.bank');
Route::post('/bank/delete/{id}', [BankController::class, 'deleteIdBank']);
