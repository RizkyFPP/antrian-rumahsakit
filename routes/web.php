<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/antrian', function () {
    return view('pages.antrian');
})->name('antrian');

Route::get('/daftar-online', function () {
    return view('pages.daftar-online');
})->name('daftar-online');