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
    return view('index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [App\Http\Controllers\LoginController::class, 'login'])->name('home');

// ログイン処理
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

// データ登録処理
Route::post('/entry', [App\Http\Controllers\PurchaseController::class, 'entry']);

// データ取得処理
Route::post('/getData', [App\Http\Controllers\InquiryController::class, 'getData']);

// データ集計処理
Route::post('/summary', [App\Http\Controllers\AnalyseController::class, 'summary']);

// メール送信処理
Route::post('/send', [App\Http\Controllers\SendController::class, 'send']);

