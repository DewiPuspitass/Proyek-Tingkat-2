<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\PersyaratanBerkasController;
use App\Http\Controllers\TipeLowonganController;
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

// CRUD JURUSAN
Route::resource('jurusan', JurusanController::class);

// CRUD LOKER
Route::resource('lowongan_pekerjaan', LowonganKerjaController::class);

// CRUD TIPE LOKER
Route::resource('tipe_lowongan', TipeLowonganController::class);

// CRUD PERSYARATAN BERKAS
Route::resource('persyaratan_berkas', PersyaratanBerkasController::class);

// FITUR PENCARIAN


// FITUR FILTER
