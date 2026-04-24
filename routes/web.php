<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Rute-rute web untuk website Jurusan Rekayasa Komputer.
| Dibagi menjadi 3 grup: Frontend (publik), Admin (terautentikasi),
| dan Profil User (Breeze default).
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Publik - bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil Jurusan (placeholder - controller akan dibuat nanti)
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/visi-misi', function () {
        return view('frontend.home'); // Placeholder
    })->name('visi-misi');

    Route::get('/sejarah', function () {
        return view('frontend.home'); // Placeholder
    })->name('sejarah');

    Route::get('/struktur-organisasi', function () {
        return view('frontend.home'); // Placeholder
    })->name('struktur');
});

// Halaman publik lainnya (placeholder)
Route::get('/program-studi', function () {
    return view('frontend.home');
})->name('prodi.index');

Route::get('/dosen', function () {
    return view('frontend.home');
})->name('dosen.index');

Route::get('/berita', function () {
    return view('frontend.home');
})->name('berita.index');

Route::get('/galeri', function () {
    return view('frontend.home');
})->name('galeri');

Route::get('/fasilitas', function () {
    return view('frontend.home');
})->name('fasilitas');

Route::get('/kontak', function () {
    return view('frontend.home');
})->name('kontak');

/*
|--------------------------------------------------------------------------
| Admin Routes (Memerlukan autentikasi)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // === CRUD Resources ===
    Route::get('/slider/datatable', [SliderController::class, 'datatable'])->name('slider.datatable');
    Route::resource('slider', SliderController::class)->except(['show']);

    // Placeholder routes (akan diganti resource saat controller dibuat)
    Route::get('/profil-jurusan', function () {
        return view('admin.dashboard');
    })->name('profil.edit');

    Route::get('/berita/datatable', [BeritaController::class, 'datatable'])->name('berita.datatable');
    Route::resource('berita', BeritaController::class)->except(['show']);

    Route::get('/kategori/datatable', [KategoriController::class, 'datatable'])->name('kategori.datatable');
    Route::resource('kategori', KategoriController::class)->except(['show']);

    Route::get('/dosen/datatable', [DosenController::class, 'datatable'])->name('dosen.datatable');
    Route::resource('dosen', DosenController::class)->except(['show']);

    Route::get('/program-studi/datatable', [ProgramStudiController::class, 'datatable'])->name('program-studi.datatable');
    Route::resource('program-studi', ProgramStudiController::class)->except(['show']);

    Route::get('/galeri/datatable', [GaleriController::class, 'datatable'])->name('galeri.datatable');
    Route::resource('galeri', GaleriController::class)->except(['show']);

    Route::get('/fasilitas/datatable', [FasilitasController::class, 'datatable'])->name('fasilitas.datatable');
    Route::resource('fasilitas', FasilitasController::class)->except(['show']);

    Route::get('/kontak', function () {
        return view('admin.dashboard');
    })->name('kontak.index');
});

/*
|--------------------------------------------------------------------------
| User Profile Routes (Breeze Default)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
