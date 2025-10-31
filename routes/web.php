<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 Halaman Utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// 📋 Halaman Antrian & Daftar Online
Route::view('/antrian', 'pages.antrian')->name('antrian');
Route::view('/daftar-online', 'pages.daftar-online')->name('daftar-online');

// 🧾 Proses Pendaftaran
Route::post('/daftar-online', [PendaftaranController::class, 'store'])->name('daftar-online.store');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// 🔍 Cek Antrian
Route::get('/cek-antrian', [AntrianController::class, 'cekAntrian'])->name('cek.antrian');

// 🎥 Display Antrian untuk Pengunjung
Route::get('/antrian/display', [AntrianController::class, 'display'])->name('antrian.display');

// 🖥️ Endpoint JSON untuk nomor yang sedang dipanggil
Route::get('/display-antrian', function () {
    $nomor = Cache::get('nomor_dipanggil', null);
    return response()->json(['nomor' => $nomor]);
})->name('display.antrian');

// === Autentikasi ===
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // form login
Route::post('/login', [AuthController::class, 'login'])->name('login.process'); // proses login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === Halaman Loket (wajib login) ===
Route::middleware(['auth'])->group(function () {
    // contoh: /loket/1, /loket/2
    Route::get('/loket/{loket}', [LoketController::class, 'index'])->name('loket.index');
    Route::post('/loket/{loket}/panggil/{id}', [LoketController::class, 'panggil'])->name('loket.panggil');
    Route::post('/loket/{loket}/next', [LoketController::class, 'next'])->name('loket.next');
    Route::post('/loket/{loket}/skip', [LoketController::class, 'skip'])->name('loket.skip');
});

// 🔊 (Opsional) Pemanggilan dari sisi AntrianController
Route::post('/antrian/panggil/{id}', [AntrianController::class, 'panggil'])->name('antrian.panggil');
