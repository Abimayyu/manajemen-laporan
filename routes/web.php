<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanWevController;
use App\Http\Controllers\TanggapanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   // CRUD Kategori
    Route::resource('kategori', KategoriController::class);

    // CRUD Laporan
    Route::resource('laporanweb', LaporanWevController::class);

    // CRUD Tanggapan
    Route::resource('tanggapan', TanggapanController::class);
});

require __DIR__ . '/auth.php';
