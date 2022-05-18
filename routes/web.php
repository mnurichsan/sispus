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

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::prefix('pasien')->group(function () {
            Route::get('/',[App\Http\Controllers\PasienController::class,'index'])->name('pasien.index');
            Route::post('/',[App\Http\Controllers\PasienController::class,'store'])->name('pasien.store');
            Route::post('/edit',[App\Http\Controllers\PasienController::class,'edit'])->name('pasien.edit');
            Route::post('/update',[App\Http\Controllers\PasienController::class,'update'])->name('pasien.update');
            Route::post('/delete',[App\Http\Controllers\PasienController::class,'delete'])->name('pasien.delete');
        });

        Route::prefix('pemeriksaan-awal')->group(function () {
            //
        });

        Route::prefix('pemeriksaan-lanjutan')->group(function () {
            //
        });

        Route::prefix('master-data')->group(function () {
            //
        });
    });
    
});

