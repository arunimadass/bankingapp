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

Route::get('/', function () {
   // return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');

Route::middleware(['auth',  'verified'])->group(function () {
   
Route::get('/home', [App\Http\Controllers\BankingController::class, 'home'])->name('view');
Route::post('/add-deposit', [App\Http\Controllers\BankingController::class, 'addDeposit'])->name('add-deposit');
Route::get('/deposit', [App\Http\Controllers\BankingController::class, 'Deposit'])->name('deposit');
Route::get('/withdraw', [App\Http\Controllers\BankingController::class, 'Withdraw'])->name('withdraw');
Route::post('/add-withdraw', [App\Http\Controllers\BankingController::class, 'addWithdraw'])->name('add-withdraw');
Route::get('/transfer', [App\Http\Controllers\BankingController::class, 'Transfer'])->name('transfer');
Route::post('/add-transfer', [App\Http\Controllers\BankingController::class, 'addTransfer'])->name('add-transfer');
Route::get('/statement', [App\Http\Controllers\BankingController::class, 'Statement'])->name('statement');
});