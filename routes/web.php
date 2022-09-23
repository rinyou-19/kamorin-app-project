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

// ユーザー登録処理
Route::post('/entryUser', [App\Http\Controllers\EntryUserController::class, 'entryUser']);

// ユーザーの重複チェック
Route::post('/userConflictcheck', [App\Http\Controllers\EntryUserController::class, 'userConflictcheck']);

// 二要素認証メール送信
Route::post('/sendPassword', [App\Http\Controllers\TwoFactorAuthController::class, 'sendPassword']);

// 二要素認証処理
Route::post('/auth', [App\Http\Controllers\TwoFactorAuthController::class, 'auth']);

// データ登録処理
Route::post('/entry', [App\Http\Controllers\PurchaseController::class, 'entry']);

// データ取得処理
Route::post('/getData', [App\Http\Controllers\InquiryController::class, 'getData']);

// データ集計処理
Route::post('/summary', [App\Http\Controllers\AnalyseController::class, 'summary']);

// メール送信処理
Route::post('/send', [App\Http\Controllers\SendController::class, 'send']);

// データ更新処理
Route::post('/update', [App\Http\Controllers\updateController::class, 'update']);

// データ削除処理
Route::post('/delete', [App\Http\Controllers\DeleteController::class, 'delete']);

