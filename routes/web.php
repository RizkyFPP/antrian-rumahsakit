<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PendaftaranController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/antrian', function () {
    return view('pages.antrian');
})->name('antrian');

Route::get('/daftar-online', function () {
    return view('pages.daftar-online');
})->name('daftar-online');

Route::post('/daftar-online', [PendaftaranController::class, 'store'])->name('daftar-online.store');
Route::get('/cek-antrian', [PendaftaranController::class, 'cekAntrian'])->name('cek.antrian');

Route::get('/cek-antrian', [AntrianController::class, 'cek'])->name('cek.antrian');
Route::get('/antrian', [AntrianController::class, 'cekAntrian'])->name('cek.antrian');
Route::get('/cek-antrian', [AntrianController::class, 'cekAntrian'])->name('cek.antrian');