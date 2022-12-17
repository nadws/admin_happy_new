<?php

use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\Hasil_pemeriksaan;
use App\Http\Controllers\Invoice;
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

Route::get('tb_user', [UserController::class, 'index'])->middleware(['auth'])->name('tb_user');
Route::post('save_user', [UserController::class, 'save_user'])->name('save_user');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('permission', [UserController::class, 'permission'])->name('permission');
Route::post('save_permission', [UserController::class, 'save_permission'])->name('save_permission');
Route::get('delete_user/{id}', [UserController::class, 'delete_user'])->name('delete_user');
Route::get('verifikasi/{val}/{id}', [UserController::class, 'verifikasi'])->name('verifikasi');

Route::post('save_theme', function(Request $r){
    DB::table('cms_konten')->where('id',1)->update(['isi' => $r->warna1]);
    DB::table('cms_konten')->where('id',2)->update(['isi' => $r->warna2]);
    DB::table('cms_konten')->where('id',3)->update(['isi' => $r->warna3]);
    DB::table('cms_konten')->where('id',4)->update(['isi' => $r->warna4]);

    return redirect()->back();
})->middleware(['auth'])->name('save_theme');

Route::get('cms', function(){
    return redirect('http://127.0.0.1:2222/dashboard');
})->name('cms');



Route::get('data_dokter', [DataDokterController::class, 'index'])->name('data_dokter');

// data pasien
Route::get('data_pasien', [DataPasienController::class, 'index'])->name('data_pasien');
Route::get('load_view_pasien', [DataPasienController::class, 'load_view_pasien'])->name('load_view_pasien');
Route::get('load_view_member', [DataPasienController::class, 'load_view_member'])->name('load_view_member');

// pertanyaan
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

// Hasil Pemeriksaan
Route::get('h_pemeriksaaan', [Hasil_pemeriksaan::class, 'index'])->name('h_pemeriksaaan');
Route::get('cetak', [Hasil_pemeriksaan::class, 'cetak'])->name('cetak');


Route::get('/dashboard', function () {
    $data = [
        'title' => 'Dashboard'
    ];
    return view('dashboard.dashboard', $data);
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
