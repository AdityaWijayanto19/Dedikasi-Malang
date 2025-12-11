<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CeritaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfileController;
use App\Models\Donasi;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'indexKegiatan']);

Route::get('/kegiatan', [KegiatanController::class, 'publicIndex'])->name('pages.kegiatan.index');
Route::get('/kegiatan/{kegiatan:slug}', [KegiatanController::class, 'PublicShow'])->name('pages.kegiatan.show');

Route::get('/cerita', [CeritaController::class, 'publicIndex'])->name('pages.cerita.index');
Route::get('/cerita/{cerita:slug}', [CeritaController::class, 'publicShow'])->name('pages.cerita.show');

Route::get('/donasi', [DonasiController::class, 'publicIndex'])->name('pages.donasi');

Route::get('/kegiatan/{kegiatan:slug}/formulir-pendaftaran', [PendaftaranController::class, 'create'])->name('pages.pendaftaran.create');
Route::post('/kegiatan/{kegiatan}/formulir-pendaftaran', [PendaftaranController::class, 'store'])->name('pages.pendaftaran.store');
Route::get('/kegiatan/{kegiatan:slug}/pendaftaran-sukses', [PendaftaranController::class, 'successPage'])
     ->name('pendaftaran.success');

Route::get('/kontak', function () {
    return view('/pages/kontak');
});

Route::get('/kirim cerita', function () {
    return view('/pages/formKirimTulisan');
});

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

    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        // 1. Index: Menampilkan semua Kegiatan sebagai navigasi (Cards)
        // URL: /admin/pendaftaran
        Route::get('/', [PendaftaranController::class, 'index'])->name('index');

        // 2. Show Pendaftar per Kegiatan: Menampilkan tabel pendaftar
        // URL: /admin/pendaftaran/kegiatan/{kegiatan}
        Route::get('/kegiatan/{kegiatan}', [PendaftaranController::class, 'show'])->name('show.kegiatan');

        // 3. Detail Pendaftar: Menampilkan detail pendaftar dan Form Aksi
        // URL: /admin/pendaftaran/detail/{pendaftaran}
        Route::get('/detail/{pendaftaran}', [PendaftaranController::class, 'showDetailPendaftar'])->name('detail.pendaftar');

        // 4. Aksi: Mengubah status pendaftaran (Accepted/Rejected)
        // URL: /admin/pendaftaran/detail/{pendaftaran}/status [PUT]
        Route::put('/detail/{pendaftaran}/status', [PendaftaranController::class, 'updateStatus'])->name('update.status');

        // 5. Aksi: Toggle status Buka/Tutup Pendaftaran (Kontrol Admin Kegiatan)
        // URL: /admin/pendaftaran/kegiatan/{kegiatan}/toggle-status [PUT]
        Route::put('/kegiatan/{kegiatan}/toggle-status', [PendaftaranController::class, 'toggleRegistrationStatus'])->name('toggle.status');
    });

    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::resource('manage-admin', AdminController::class)->parameters([
        'manage-admin' => 'admin'
    ]);

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// cara menghapus cache windows r -> prefetch, temp, %temp%
