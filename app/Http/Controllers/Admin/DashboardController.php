<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Controller untuk halaman dashboard admin.
 *
 * Menampilkan ringkasan statistik dan informasi penting
 * untuk pengelola website jurusan.
 */
class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
