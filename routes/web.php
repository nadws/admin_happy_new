<?php

use App\Http\Controllers\AppDokterController;
use App\Http\Controllers\Data_dokter;
use App\Http\Controllers\Data_paket;
use App\Http\Controllers\Data_paket_pasien;
use App\Http\Controllers\Data_pasien;
use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\Dt_therapy;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\Hasil_pemeriksaan;
use App\Http\Controllers\Invoice;
use App\Http\Controllers\Invoice_kunjungan;
use App\Http\Controllers\Invoice_periksa;
use App\Http\Controllers\Invoice_tp;
use App\Http\Controllers\Pertanyaan;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    return view('welcome');
});

// app dokter

Route::get('app_dokter', [AppDokterController::class, 'index'])->middleware(['auth'])->name('app_dokter');
Route::get('tambah_terapi', [AppDokterController::class, 'tambah_terapi'])->middleware(['auth'])->name('tambah_terapi');
Route::post('save_dokter_app', [AppDokterController::class, 'save_dokter_app'])->middleware(['auth'])->name('save_dokter_app');
Route::post('hapus_dokter_app', [AppDokterController::class, 'hapus_dokter_app'])->middleware(['auth'])->name('hapus_dokter_app');
Route::get('kelola_appoinment', [AppDokterController::class, 'kelola_appoinment'])->middleware(['auth'])->name('kelola_appoinment');
Route::post('edit_jam_appoinment', [AppDokterController::class, 'edit_jam_appoinment'])->middleware(['auth'])->name('edit_jam_appoinment');
Route::get('cancel_appoinment', [AppDokterController::class, 'cancel_appoinment'])->middleware(['auth'])->name('cancel_appoinment');
Route::get('selesai_appoinment', [AppDokterController::class, 'selesai_appoinment'])->middleware(['auth'])->name('selesai_appoinment');
Route::get('cancel_selesai_appoinment', [AppDokterController::class, 'cancel_selesai_appoinment'])->middleware(['auth'])->name('cancel_selesai_appoinment');

Route::get('print_appoinment', [AppDokterController::class, 'print_appoinment'])->middleware(['auth'])->name('print_appoinment');

Route::get('tb_user', [UserController::class, 'index'])->middleware(['auth'])->name('tb_user');
Route::post('save_user', [UserController::class, 'save_user'])->name('save_user');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('permission', [UserController::class, 'permission'])->name('permission');
Route::post('save_permission', [UserController::class, 'save_permission'])->name('save_permission');
Route::get('delete_user/{id}', [UserController::class, 'delete_user'])->name('delete_user');
Route::get('verifikasi/{val}/{id}', [UserController::class, 'verifikasi'])->name('verifikasi');

Route::post('save_theme', function (Request $r) {
    DB::table('cms_konten')->where('id', 1)->update(['isi' => $r->warna1]);
    DB::table('cms_konten')->where('id', 2)->update(['isi' => $r->warna2]);
    DB::table('cms_konten')->where('id', 3)->update(['isi' => $r->warna3]);
    DB::table('cms_konten')->where('id', 4)->update(['isi' => $r->warna4]);

    return redirect()->back();
})->middleware(['auth'])->name('save_theme');

Route::get('cms', function () {
    return redirect('http://127.0.0.1:2222/dashboard');
})->name('cms');



Route::get('data_dokter', [DataDokterController::class, 'index'])->name('data_dokter');

// data pasien
Route::get('data_pasien', [DataPasienController::class, 'index'])->name('data_pasien');
Route::get('load_view_pasien', [DataPasienController::class, 'load_view_pasien'])->name('load_view_pasien');
Route::get('load_view_member', [DataPasienController::class, 'load_view_member'])->name('load_view_member');

// pertanyaan
Route::get('prtnyaan', [PertanyaanController::class, 'index'])->name('prtnyaan');
Route::get('pertanyaan/{kelompok}', [PertanyaanController::class, 'pertanyaan'])->name('pertanyaan');
Route::get('kspp', [PertanyaanController::class, 'kspp'])->name('kspp');
Route::get('peds', [PertanyaanController::class, 'peds'])->name('peds');
Route::get('mchat', [PertanyaanController::class, 'mchat'])->name('mchat');
Route::post('add_pertanyaan', [PertanyaanController::class, 'add_pertanyaan'])->name('add_pertanyaan');
Route::post('edit_pertanyaan', [PertanyaanController::class, 'edit_pertanyaan'])->name('edit_pertanyaan');
Route::get('del_pertanyaan/{id}/{kelompok}', [PertanyaanController::class, 'del_pertanyaan'])->name('del_pertanyaan');
Route::get('get_gerak', [PertanyaanController::class, 'get_gerak'])->name('get_gerak');
Route::get('get_kpsp', [PertanyaanController::class, 'get_kpsp'])->name('get_kpsp');


// foto
Route::get('foto', [FotoController::class, 'index'])->name('foto');
Route::post('add_foto', [FotoController::class, 'add_foto'])->name('add_foto');

// Invoice
Route::get('invoice', [Invoice::class, 'index'])->name('invoice');
Route::get('cetak_invoice', [Invoice::class, 'cetak_invoice'])->name('cetak_invoice');
Route::post('save_invoice', [Invoice::class, 'save_invoice'])->name('save_invoice');
Route::post('save_status', [Invoice::class, 'save_status'])->name('save_status');
Route::get('hapus_invoice', [Invoice::class, 'hapus_invoice'])->name('hapus_invoice');

// Hasil Pemeriksaan
Route::get('h_pemeriksaaan', [Hasil_pemeriksaan::class, 'index'])->name('h_pemeriksaaan');
Route::get('cetak', [Hasil_pemeriksaan::class, 'cetak'])->name('cetak');

// Pertanyaan 
Route::get('kpertanyaan', [Pertanyaan::class, 'index'])->name('kpertanyaan');

Route::get('form1', [Pertanyaan::class, 'form1'])->name('form1');
Route::get('form2', [Pertanyaan::class, 'form2'])->name('form2');
Route::get('form3', [Pertanyaan::class, 'form3'])->name('form3');
Route::get('form4', [Pertanyaan::class, 'form4'])->name('form4');

Route::get('/tbh_pertanyaan1', [Pertanyaan::class, 'tbh_pertanyaan1'])->name('tbh_pertanyaan1');
Route::get('/tbh_pertanyaan2', [Pertanyaan::class, 'tbh_pertanyaan2'])->name('tbh_pertanyaan2');
Route::get('/tbh_pertanyaan3', [Pertanyaan::class, 'tbh_pertanyaan3'])->name('tbh_pertanyaan3');
Route::get('/tbh_pertanyaan4', [Pertanyaan::class, 'tbh_pertanyaan4'])->name('tbh_pertanyaan4');

// dokter
Route::get('tb_dokter', [Data_dokter::class, 'index'])->middleware(['auth'])->name('tb_dokter');
Route::post('tbh_dokter', [Data_dokter::class, 'tbh_dokter'])->middleware(['auth'])->name('tbh_dokter');
Route::post('edit_dokter', [Data_dokter::class, 'edit_dokter'])->middleware(['auth'])->name('edit_dokter');
Route::get('hps_dokter', [Data_dokter::class, 'hps_dokter'])->middleware(['auth'])->name('hps_dokter');


// data pasien
Route::get('data_pasien', [Data_pasien::class, 'index'])->middleware(['auth'])->name('data_pasien');
Route::get('get_pasien', [Data_pasien::class, 'get_pasien'])->middleware(['auth'])->name('get_pasien');
Route::post('save_pasien', [Data_pasien::class, 'save_pasien'])->middleware(['auth'])->name('save_pasien');
Route::get('delete_pasien', [Data_pasien::class, 'delete_pasien'])->middleware(['auth'])->name('delete_pasien');
Route::get('get_edit_pasien', [Data_pasien::class, 'get_edit_pasien'])->middleware(['auth'])->name('get_edit_pasien');
Route::post('edit_pasien', [Data_pasien::class, 'edit_pasien'])->middleware(['auth'])->name('edit_pasien');


Route::get('inv_periksa', [Invoice_periksa::class, 'index'])->middleware(['auth'])->name('inv_periksa');
Route::post('save_invoice_periksa', [Invoice_periksa::class, 'save_invoice_periksa'])->middleware(['auth'])->name('save_invoice_periksa');
Route::get('hapus_invoice_periksa', [Invoice_periksa::class, 'hapus_invoice_periksa'])->middleware(['auth'])->name('hapus_invoice_periksa');


Route::get('dt_paket', [Data_paket::class, 'index'])->middleware(['auth'])->name('dt_paket');
Route::post('save_paket', [Data_paket::class, 'save_paket'])->middleware(['auth'])->name('save_paket');
Route::get('get_edit_paket', [Data_paket::class, 'get_edit_paket'])->middleware(['auth'])->name('get_edit_paket');
Route::post('edit_paket', [Data_paket::class, 'edit_paket'])->middleware(['auth'])->name('edit_paket');
Route::get('delete_paket', [Data_paket::class, 'delete_paket'])->middleware(['auth'])->name('delete_paket');

Route::get('invoice_tp', [Invoice_tp::class, 'index'])->middleware(['auth'])->name('invoice_tp');
Route::get('tambah_paket', [Invoice_tp::class, 'tambah_paket'])->middleware(['auth'])->name('tambah_paket');
Route::get('get_paket', [Invoice_tp::class, 'get_paket'])->middleware(['auth'])->name('get_paket');
Route::post('save_tp', [Invoice_tp::class, 'save_tp'])->middleware(['auth'])->name('save_tp');
Route::get('view_paket', [Invoice_tp::class, 'view_paket'])->middleware(['auth'])->name('view_paket');
Route::get('view_paket2', [Invoice_tp::class, 'view_paket2'])->middleware(['auth'])->name('view_paket2');
Route::get('cetak_invoice_tp', [Invoice_tp::class, 'cetak_invoice_tp'])->middleware(['auth'])->name('cetak_invoice_tp');
Route::get('hapus_invoice_tp', [Invoice_tp::class, 'hapus_invoice_tp'])->middleware(['auth'])->name('hapus_invoice_tp');


Route::get('invoice_kunjungan', [Invoice_kunjungan::class, 'index'])->middleware(['auth'])->name('invoice_kunjungan');
Route::get('get_paket_kunjungan', [Invoice_kunjungan::class, 'get_paket'])->middleware(['auth'])->name('get_paket_kunjungan');
Route::get('data_paket_kunjungan', [Invoice_kunjungan::class, 'data_paket_kunjungan'])->middleware(['auth'])->name('data_paket_kunjungan');
Route::post('save_invoice_kunjungan', [Invoice_kunjungan::class, 'save_invoice_kunjungan'])->middleware(['auth'])->name('save_invoice_kunjungan');

Route::get('tb_therapy', [Dt_therapy::class, 'index'])->middleware(['auth'])->name('tb_therapy');
Route::post('tbh_therapy', [Dt_therapy::class, 'tbh_therapy'])->middleware(['auth'])->name('tbh_therapy');


Route::get('dt_paket_pasien', [Data_paket_pasien::class, 'index'])->middleware(['auth'])->name('dt_paket_pasien');
Route::get('view_paket_pasien', [Data_paket_pasien::class, 'view_paket_pasien'])->middleware(['auth'])->name('view_paket_pasien');
Route::get('view_paket_pasien2', [Data_paket_pasien::class, 'view_paket_pasien2'])->middleware(['auth'])->name('view_paket_pasien2');






Route::get('/dashboard', function () {
    $data = [
        'title' => 'Dashboard'
    ];
    return view('dashboard.dashboard', $data);
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
