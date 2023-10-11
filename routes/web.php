<?php

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\Laporan\LRAController;
use App\Http\Controllers\master\TandaTanganController;
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

// Index Login
Route::get('/', [LoginController::class, 'index'])->name('login');
// Aksi Login
Route::post('/login', [LoginController::class, 'actionlogin'])->name('login.action');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Dashboard
// Route::prefix('reporting')->group(function () {
Route::get('/dashboard', [HomeController::class, 'index'])->name('reporting.dashboard')->middleware('auth');
// });

// Username
Route::get('username', [HomeController::class, 'username'])->name('utility.username');
Route::post('listdatausername', [HomeController::class, 'listdatausername'])->name('utility.listdatausername');
Route::post('whereupdateusername', [HomeController::class, 'whereupdateusername'])->name('utility.whereupdateusername');
Route::put('updatestatususername', [HomeController::class, 'updatestatususername'])->name('utility.updatestatususername');
Route::post('updatestatususernameall', [HomeController::class, 'updatestatususernameall'])->name('utility.updatestatususernameall');
Route::post('simpandatausername', [HomeController::class, 'simpandatausername'])->name('utility.simpandatausername');
Route::post('hapususername', [HomeController::class, 'hapususername'])->name('utility.hapususername');

//Ganti Nama
Route::get('/gantinama', [HomeController::class, 'gantinama'])->name('utility.gantinama');
Route::post('/listdatausernameall', [HomeController::class, 'listdatausernameall'])->name('utility.listdatausernameall');
Route::post('/updateusername', [HomeController::class, 'updateusername'])->name('utility.updateusername');
//Ganti Password
Route::post('/updatepassword', [HomeController::class, 'updatepassword'])->name('utility.updatepassword');



// Laporan Anggaran
// Route::prefix('laporananggaran')->group(function () {
Route::get('reportanggaran', [LaporanController::class, 'index'])->name('laporananggaran.reportanggaran');
Route::post('subkegiatan', [LaporanController::class, 'subkegiatan'])->name('laporananggaran.subkegiatan');
// listdata
Route::post('listdata', [LaporanController::class, 'listdata'])->name('laporananggaran.listdata');
// Simpandata
Route::post('simpandata', [LaporanController::class, 'simpandata'])->name('laporananggaran.simpandata');
// Wherelist
Route::post('wherelist', [LaporanController::class, 'wherelist'])->name('laporananggaran.wherelist');
Route::post('whereditdata', [LaporanController::class, 'whereditdata'])->name('laporananggaran.whereditdata');
//update data
Route::post('updatedata', [LaporanController::class, 'updatedata'])->name('laporananggaran.updatedata');
// Hapus data
Route::post('hapusdata', [LaporanController::class, 'hapusdata'])->name('laporananggaran.hapusdata');
// Cetak
Route::get('cetakdatasubkegiatan', [LaporanController::class, 'cetakdatasubkegiatan'])->name('laporananggaran.cetakdatasubkegiatan');
Route::get('cetakdataurusan', [LaporanController::class, 'cetakdataurusan'])->name('laporananggaran.cetakdataurusan');
Route::get('cetakdataprogram', [LaporanController::class, 'cetakdataprogram'])->name('laporananggaran.cetakdataprogram');
Route::get('cetakdatakegiatan', [LaporanController::class, 'cetakdatakegiatan'])->name('laporananggaran.cetakdatakegiatan');
// });

// Master Tanda Tangan
Route::get('tandatangan', [TandaTanganController::class, 'index'])->name('tandatangan');
