<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Service Provider untuk menghubungkan Repository Interface
 * dengan implementasi Repository yang sesuai.
 *
 * Setiap modul akan memiliki pasangan Interface + Repository:
 * - BeritaRepositoryInterface → BeritaRepository
 * - DosenRepositoryInterface → DosenRepository
 * - dst.
 *
 * Binding akan ditambahkan di method register() saat
 * masing-masing repository dibuat.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Daftarkan binding repository ke interface.
     *
     * @return void
     */
    public function register(): void
    {
        // Binding akan ditambahkan di sini saat repository dibuat.
        // Contoh:
        // $this->app->bind(
        //     \App\Repositories\Contracts\BeritaRepositoryInterface::class,
        //     \App\Repositories\BeritaRepository::class
        // );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
