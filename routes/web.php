<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KabarDesaController;
use App\Http\Controllers\PengaduanController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// pages surat
Route::prefix('surat')->group(function () {
    Route::get('create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('store', [SuratController::class, 'store'])->name('surat.store');
    Route::get('{id}/fields', [SuratController::class, 'getFields'])->name('surat.fields');
    Route::get('success', [SuratController::class, 'success'])->name('surat.success');
})->middleware(['auth', 'verified']);

// pages pengaduan
Route::prefix('pengaduan')->group(function () {
    Route::get('create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('success', [PengaduanController::class, 'success'])->name('pengaduan.success');
})->middleware(['auth', 'verified']);

// pages profile desa
Route::get('profile-desa', function () {
    return view('pages.profile_desa.index');
})->name('profile-desa');

// pages berita
Route::prefix('kabar-desa')->group(function () {
    Route::get('/', [KabarDesaController::class, 'index'])->name('kabar-desa.index');
    Route::get('detail/{id}', [KabarDesaController::class, 'detail'])->name('detail');
});

// pages galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
