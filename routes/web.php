<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\PersyaratanBerkasController;
use App\Http\Controllers\ProfileController2;
use App\Http\Controllers\TipeLowonganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('beranda');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController2::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController2::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController2::class, 'destroy'])->name('profile.destroy');

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

    // Route::get('/get-user-role', [FilterController::class,'getRole']);

    Route::get('/get-user-role', [FilterController::class, 'getRole'])->middleware('auth');

    // FITUR FILTER
    Route::get('/get-jurusan', [FilterController::class, 'getJurusan'])->name('filter.getJurusan');
    Route::get('/get-lowongan', [FilterController::class, 'getLowongan'])->name('filter.getLowongan');
    Route::get('/get-domisili', [FilterController::class, 'getDomisili'])->name('filter.getDomisili');

    // Email broadcast
    Route::get('send-email/{id}', [EmailController::class, 'sendLowonganEmail'])->name('send-email');

    Route::get('tampilan-email', function(){
        return view('emails.lowonganEmail');
    });

    // Bookmark
    Route::get('/halaman-bookmark', [BookmarkController::class, 'index'])->name('bookmarks.index');;
    Route::post('/bookmarks/{lowonganId}', [BookmarkController::class, 'addBookmark'])->name('bookmarks.add');
    Route::delete('/bookmarks/{lowonganId}', [BookmarkController::class, 'removeBookmark'])->name('bookmarks.remove');
    
    Route::delete('/bookmarks/{lowongan}', [BookmarkController::class, 'removeBookmark']);
});

require __DIR__.'/auth.php';
