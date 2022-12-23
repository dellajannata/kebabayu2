<?php

use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\AdminPusatController2;
use App\Http\Controllers\AdminPusatController3;
use App\Http\Controllers\BahanCabangController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\GudangController2;
use App\Http\Controllers\GudangController3;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeController1;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MenuAdminController;
use App\Http\Controllers\KaryawanAdminController;
use App\Http\Controllers\PemasukkanAdminController;
use App\Http\Controllers\PemasukkanAdminController2;
use App\Http\Controllers\PemasukkanAdminController3;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
Use Illuminate\Support\Facades\Artisan;

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

Auth::routes();

Route::redirect('/', '/login');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('pesan/{id}', [PesanController::class, 'indexMenu']);
Route::post('pesan/{id}', [PesanController::class, 'pesan']);
Route::get('check-out', [PesanController::class, 'check_out']);
Route::delete('check-out/{id}', [PesanController::class, 'delete']);
Route::post('konfirmasi-check-out', [PesanController::class, 'konfirmasi']);

Route::get('history', [HistoryController::class, 'indexhistory']);
Route::get('historycari', [HistoryController::class, 'cari'])->name('caricabang');
Route::get('history/{id}', [HistoryController::class, 'detail']);
Route::put('history1/{id}', [HistoryController::class, 'buy']);
Route::get('history1/{id}', [HistoryController::class, 'buy']);

//Dashboard
Route::get('/berandaGudang', [GudangController::class, 'indexadmin']);
//Gudang1
Route::resource('admin', GudangController::class);
Route::get('admincari', [GudangController::class, 'cari'])->name('cari');
Route::put('admin/{id}/edit', [GudangController::class, 'statusSelesai']);
Route::put('admin/{id}/update', [GudangController::class, 'statusBatal']);
//Gudang2
Route::resource('admin2', GudangController2::class);
Route::get('admincari2', [GudangController2::class, 'cari'])->name('cari2');
Route::put('admin2/{id}/edit', [GudangController2::class, 'statusSelesai']);
Route::put('admin2/{id}/update', [GudangController2::class, 'statusBatal']);
//Gudang3
Route::resource('admin3', GudangController3::class);
Route::get('admincari3', [GudangController3::class, 'cari'])->name('cari3');
Route::put('admin3/{id}/edit', [GudangController3::class, 'statusSelesai']);
Route::put('admin3/{id}/update', [GudangController3::class, 'statusBatal']);

Route::resource('adminCabang', BahanCabangController::class);

//Dashboard Puast
Route::get('/berandaPusat', [AdminPusatController::class, 'indexPusat']);
Route::get('/carimenu', [MenuAdminController::class, 'carimenu'])->name('carimenu');
//Cabang1
Route::resource('adminPusat', AdminPusatController::class);
Route::get('adminPusatCari', [AdminPusatController::class, 'cari'])->name('caripusat');
Route::resource('/adminPusatPesan', PemasukkanAdminController::class);
Route::get('adminPusatPesan1', [PemasukkanAdminController::class, 'cari'])->name('caripesanpusat1');
//Cabang2
Route::resource('adminPusat2', AdminPusatController2::class);
Route::get('adminPusatCari2', [AdminPusatController2::class, 'cari'])->name('caripusat2');
Route::resource('/adminPusatPesan22', PemasukkanAdminController2::class);
Route::get('adminPusatPesan2', [PemasukkanAdminController2::class, 'cari'])->name('caripesanpusat2');
//Cabang3
Route::resource('adminPusat3', AdminPusatController3::class);
Route::get('adminPusatCari3', [AdminPusatController3::class, 'cari'])->name('caripusat3');
Route::resource('/adminPusatPesan33', PemasukkanAdminController3::class);
Route::get('adminPusatPesan3', [PemasukkanAdminController3::class, 'cari'])->name('caripesanpusat3');

Route::resource('/adminPusatKaryawan', KaryawanAdminController::class);
Route::resource('/adminPusatMenu', MenuAdminController::class);
Route::resource('/adminMenu', MenuController::class);

//cloud

Route::get('/mig', function()
{
    // Call and Artisan command from within your application.
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
});

Route::get('/cc', function()
{
    // Call and Artisan command from within your application.
    Artisan::call('config:clear');
});
?>