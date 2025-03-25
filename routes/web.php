<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\PersyaratanBerkasController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard-siswa', function () {
//     return view('siswa.dashboard');
// })->middleware('role:siswa');

// Route::get('/dashboard-siswa', function () {
//     return 'Anda berada di Dashboard Siswa';
// })->middleware('role:siswa');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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

// FITUR FILTER
Route::get('/get-jurusan', [FilterController::class, 'getJurusan'])->name('filter.getJurusan');
Route::get('/get-lowongan', [FilterController::class, 'getLowongan'])->name('filter.getLowongan');
