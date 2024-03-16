<?php

use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Laporan\AngkasController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\Laporan\LRAController;
use App\Http\Controllers\LRAKasda\LRAKasdaController;
use App\Http\Controllers\master\TandaTanganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tahun_user\TahunUserController;


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
Route::get('/dashboardtahun', [TahunUserController::class, 'index'])->name('reporting.dashboardtahun')->middleware(['auth']);
Route::post('pilihantahun', [TahunUserController::class, 'pilihantahun'])->name('reporting.pilihantahun');
// Dashboard
// Route::prefix('reporting')->group(function () {
Route::get('dashboard', [HomeController::class, 'index'])->name('reporting.dashboard')->middleware(['auth']);
Route::get('profile', [HomeController::class, 'profile'])->name('reporting.profile')->middleware(['auth']);
Route::post('updateprofile', [HomeController::class, 'updateprofile'])->name('reporting.updateprofile');
Route::post('refreshprofile', [HomeController::class, 'refreshprofile'])->name('reporting.refreshprofile');
// });

// Username
Route::middleware(['auth'])->group(function () {
    Route::get('username', [HomeController::class, 'username'])->name('utility.username');
    Route::post('listdatausername', [HomeController::class, 'listdatausername'])->name('utility.listdatausername');
    Route::post('whereupdateusername', [HomeController::class, 'whereupdateusername'])->name('utility.whereupdateusername');
    Route::put('updatestatususername', [HomeController::class, 'updatestatususername'])->name('utility.updatestatususername');
    Route::post('updatestatususernameall', [HomeController::class, 'updatestatususernameall'])->name('utility.updatestatususernameall');
    Route::post('simpandatausername', [HomeController::class, 'simpandatausername'])->name('utility.simpandatausername');
    Route::post('hapususername', [HomeController::class, 'hapususername'])->name('utility.hapususername');
    Route::post('listmenuusername', [HomeController::class, 'listmenuusername'])->name('utility.listmenuusername');

    //Ganti Nama
    Route::get('/gantinama', [HomeController::class, 'gantinama'])->name('utility.gantinama');
    Route::post('/listdatausernameall', [HomeController::class, 'listdatausernameall'])->name('utility.listdatausernameall');
    Route::post('/updateusername', [HomeController::class, 'updateusername'])->name('utility.updateusername');
    //Ganti Password
    Route::post('/updatepassword', [HomeController::class, 'updatepassword'])->name('utility.updatepassword');

    // Route::prefix('report_anggaran')->group(function () {
    // Laporan Anggaran
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

    // Laporan Angkas
    Route::get('angkas', [AngkasController::class, 'index'])->name('laporananggaran.angkas');
    Route::get('cetakangkas', [AngkasController::class, 'cetakangkas'])->name('laporananggaran.cetakangkas');

    // Master Tanda Tangan
    Route::get('tandatangan', [TandaTanganController::class, 'index'])->name('tandatangan');
    Route::post('listdatattd', [TandaTanganController::class, 'listdatattd'])->name('tandatangan.listdatattd');
    Route::post('simpandatatandatangan', [TandaTanganController::class, 'simpandatatandatangan'])->name('tandatangan.simpandatatandatangan');
    Route::post('updatedatatandatangan', [TandaTanganController::class, 'updatedatatandatangan'])->name('tandatangan.updatedatatandatangan');
    Route::post('hapusdatatandatangan', [TandaTanganController::class, 'hapusdatatandatangan'])->name('tandatangan.hapusdatatandatangan');

    // Laporan LRA Kasda
    Route::get('laporanlrakasda', [LRAKasdaController::class, 'index'])->name('laporanlrakasda');
    Route::post('kasda_kode_skpd', [LRAKasdaController::class, 'kasda_kode_skpd'])->name('kasda_kode_skpd');
    Route::post('kasda_jns_anggaran', [LRAKasdaController::class, 'kasda_jns_anggaran'])->name('kasda_jns_anggaran');
    Route::post('kasda_rekening_belanja', [LRAKasdaController::class, 'kasda_rekening_belanja'])->name('kasda_rekening_belanja');
    Route::get('lrakasda', [LRAKasdaController::class, 'laporanlrakasda'])->name('lrakasda');
});
