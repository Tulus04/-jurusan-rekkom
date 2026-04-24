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

    // Placeholder routes untuk CRUD admin (controller dibuat nanti)
    Route::get('/profil-jurusan', function () {
        return view('admin.dashboard');
    })->name('profil.edit');

    Route::get('/slider', function () {
        return view('admin.dashboard');
    })->name('slider.index');

    Route::get('/berita', function () {
        return view('admin.dashboard');
    })->name('berita.index');

    Route::get('/dosen', function () {
        return view('admin.dashboard');
    })->name('dosen.index');

    Route::get('/program-studi', function () {
        return view('admin.dashboard');
    })->name('program-studi.index');

    Route::get('/galeri', function () {
        return view('admin.dashboard');
    })->name('galeri.index');

    Route::get('/fasilitas', function () {
        return view('admin.dashboard');
    })->name('fasilitas.index');

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
