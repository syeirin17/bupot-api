<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengController;
use App\Http\Controllers\PPController;
use App\Http\Controllers\SPTController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




// Route::middleware(['cors'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::get('pengaturan/{id}', [PengController::class, 'get_pengaturan']);
    Route::post('pengaturan/{id}', [PengController::class, 'proses_tambah_pengaturan']);
    
    Route::post('tambahpphsendiri', [PPController::class, 'proses_tambah_pphsendiri']);
    Route::get('daftarpphsendiri', [PPController::class, 'daftarbuktisetorsendiri']);
    Route::get('pphsendiridelete/{id}', [PPController::class, 'hapus_pphsendiri']);
    
    Route::post('tambahpphpasal', [PPController::class, 'proses_tambah_pphpasal']);
    Route::get('pphpasal', [PPController::class, 'get_pphpasal']);
    Route::get('hapusdokumen/{id}', [PPController::class, 'hapus_dokumen']);
    Route::get('hapus_pphpasal/{id}', [PPController::class, 'hapus_pphpasal']);

    Route::post('tambahpphnon', [PPController::class, 'proses_tambah_pphnon']);
    Route::get('pphnon', [PPController::class, 'get_pphnon']);
    Route::get('hapus_dokumennon/{id}', [PPController::class, 'hapus_dokumennon']);
    Route::get('hapus_pphnon/{id}', [PPController::class, 'hapus_pphnon']);
    
    Route::get('posting', [PPController::class, 'get_posting']);


    Route::get('daftarbuktisetor', [SPTController::class, 'sptmasa']);
    Route::post('tambah_buktisetor', [SPTController::class, 'proses_tambah_buktisetor']);
    Route::get('hapus_buktisetor/{id}', [SPTController::class, 'hapus_buktisetor']);



// });