<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware(['auth', 'role:admin,kepala']);

Route::group(['prefix' => 'master-data', 'middleware' => ['auth', 'role:admin']], function(){
    
    Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
        Route::get('/',[App\Http\Controllers\UserController::class,'index'])->name('index');
        Route::post('/',[App\Http\Controllers\UserController::class,'store'])->name('store');
        // Route::post('/edit',[App\Http\Controllers\UserController::class,'edit'])->name('edit');
        // Route::put('/',[App\Http\Controllers\UserController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\UserController::class,'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'poli', 'as' => 'poli.'], function(){
        Route::get('/',[App\Http\Controllers\PoliController::class,'index'])->name('index');
        Route::post('/',[App\Http\Controllers\PoliController::class,'store'])->name('store');
        Route::post('/edit',[App\Http\Controllers\PoliController::class,'edit'])->name('edit');
        Route::put('/',[App\Http\Controllers\PoliController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\PoliController::class,'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'dokter', 'as' => 'dokter.'], function(){
        Route::get('/',[App\Http\Controllers\DokterController::class,'index'])->name('index');
        Route::post('/',[App\Http\Controllers\DokterController::class,'store'])->name('store');
        Route::post('/edit',[App\Http\Controllers\DokterController::class,'edit'])->name('edit');
        Route::put('/',[App\Http\Controllers\DokterController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\DokterController::class,'destroy'])->name('destroy');
    });
    
    Route::group(['prefix' => 'pegawai', 'as' => 'pegawai.'], function(){
        Route::get('/',[App\Http\Controllers\PegawaiController::class,'index'])->name('index');
        Route::get('/list',[App\Http\Controllers\PegawaiController::class,'list'])->name('list');
        Route::post('/',[App\Http\Controllers\PegawaiController::class,'store'])->name('store');
        Route::put('/',[App\Http\Controllers\PegawaiController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\PegawaiController::class,'destroy'])->name('destroy');
        Route::post('/edit',[App\Http\Controllers\PegawaiController::class,'edit'])->name('edit');
    });

});

Route::group(['prefix' => 'pendaftaran', 'middleware' => ['auth', 'role:staf']], function(){
    Route::group(['prefix' => 'pasien', 'as' => 'pasien.'], function () {
        Route::get('/',[App\Http\Controllers\PasienController::class,'index'])->name('index');
        Route::get('/list',[App\Http\Controllers\PasienController::class,'list'])->name('list');
        Route::post('/',[App\Http\Controllers\PasienController::class,'store'])->name('store');
        Route::post('/edit',[App\Http\Controllers\PasienController::class,'edit'])->name('edit');
        Route::put('/',[App\Http\Controllers\PasienController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\PasienController::class,'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'kepala-keluarga', 'as' => 'kepalaKeluarga.'], function () {
        Route::get('/',[App\Http\Controllers\KepalaKeluargaController::class,'index'])->name('index');
        Route::get('/list',[App\Http\Controllers\KepalaKeluargaController::class,'list'])->name('list');
        Route::post('/',[App\Http\Controllers\KepalaKeluargaController::class,'store'])->name('store');
        Route::post('/edit',[App\Http\Controllers\KepalaKeluargaController::class,'edit'])->name('edit');
        Route::put('/',[App\Http\Controllers\KepalaKeluargaController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\KepalaKeluargaController::class,'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'input-data-kunjungan', 'as' => 'kunjungan.'], function(){
        Route::get('/',[App\Http\Controllers\KunjunganController::class,'index'])->name('index');
        Route::post('/',[App\Http\Controllers\KunjunganController::class,'store'])->name('store');
        Route::post('/edit',[App\Http\Controllers\KunjunganController::class,'edit'])->name('edit');
        Route::put('/',[App\Http\Controllers\KunjunganController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\KunjunganController::class,'destroy'])->name('destroy');
        Route::get('/cetak-kartu/{id}',[App\Http\Controllers\KunjunganController::class,'cetak'])->name('cetak');
    });

    Route::group(['prefix' => 'antrian', 'as' => 'antrian.'], function(){
        Route::get('/',[App\Http\Controllers\AntrianController::class,'index'])->name('index');
        Route::get('/list',[App\Http\Controllers\AntrianController::class,'list'])->name('list');
        Route::get('/jumlah-antrian',[App\Http\Controllers\AntrianController::class,'jumlahAntrian'])->name('jumlah');
        Route::get('/antrian-sekarang',[App\Http\Controllers\AntrianController::class,'antrianSekarang'])->name('sekarang');
        Route::get('/antrian-selanjutnya',[App\Http\Controllers\AntrianController::class,'antrianSelanjutnya'])->name('selanjutnya');
        Route::get('/sisa-antrian',[App\Http\Controllers\AntrianController::class,'sisaAntrian'])->name('sisa');
        Route::post('/update',[App\Http\Controllers\AntrianController::class,'update'])->name('update');
        Route::post('/ambil-nomor-antrian',[App\Http\Controllers\AntrianController::class,'store'])->name('store');
        Route::get('/cetak-antrian',[App\Http\Controllers\AntrianController::class,'cetak'])->name('cetak');
    });
});

Route::group(['prefix' => 'apoteker', 'middleware' => ['auth', 'role:apoteker']], function(){
    Route::group(['prefix' => 'obat', 'as' => 'obat.'], function () {
        Route::get('/',[App\Http\Controllers\ObatController::class,'index'])->name('index');
        Route::get('/list',[App\Http\Controllers\ObatController::class,'list'])->name('list');
        Route::post('/',[App\Http\Controllers\ObatController::class,'store'])->name('store');
        Route::post('/edit',[App\Http\Controllers\ObatController::class,'edit'])->name('edit');
        Route::put('/',[App\Http\Controllers\ObatController::class,'update'])->name('update');
        Route::delete('/',[App\Http\Controllers\ObatController::class,'destroy'])->name('destroy');
    });
});


// list
Route::get('poli/list',[App\Http\Controllers\PoliController::class,'list'])->name('poli.list');
Route::get('dokter/list',[App\Http\Controllers\DokterController::class,'list'])->name('dokter.list');
