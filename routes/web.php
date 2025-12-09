<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CeritaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);

Route::get('/kegiatan', [KegiatanController::class, 'publicIndex'])->name('pages.kegiatan.index');
Route::get('/kegiatan/{kegiatan:slug}', [KegiatanController::class, 'PublicShow'])->name('pages.kegiatan.show');

Route::get('/cerita',function(){
    return view('/pages/cerita');
});
Route::get('/kontak',function(){
    return view('/pages/kontak');
});
Route::get('/donasi',function(){
    return view('/pages/donasi');
});
Route::get('/artikel cerita',function(){
    return view('pages/artikelCerita');
});
Route::get('/form pendaftaran',function(){
    return view('/pages/formPendaftaran');
});
Route::get('/kirim cerita', function(){
    return view('/pages/formKirimTulisan');
});

Route::get('/cerita/{cerita:slug}', [KegiatanController::class, 'show'])->name('cerita.show');
Route::get('/donasi/{donasi:slug}', [KegiatanController::class, 'show'])->name('donasi.show');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/kegiatan/search', [KegiatanController::class, 'search'])->name('kegiatan.search');
    Route::resource('kegiatan', KegiatanController::class);

    Route::get('/cerita/search', [CeritaController::class, 'search'])->name('cerita.search');
    Route::resource('cerita', CeritaController::class)->parameters([
        'cerita' => 'cerita'
    ]);

    Route::get('/donasi/search', [DonasiController::class, 'search'])->name('donasi.search');
    Route::resource('donasi', DonasiController::class)->parameters([
        'donasi' => 'donasi'
    ]);

    Route::get('/pengurus/search', [PengurusController::class, 'search'])->name('pengurus.search');
    Route::resource('pengurus', PengurusController::class)->parameters([
        'pengurus' => 'pengurus'
    ]);

    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::resource('manage-admin', AdminController::class)->parameters([
        'manage-admin' => 'admin'
    ]);

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// cara menghapus cache windows r -> prefetch, temp, %temp%
