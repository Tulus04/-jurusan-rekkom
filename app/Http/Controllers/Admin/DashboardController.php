<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\KontakPesan;
use App\Models\Slider;
use App\Models\ProgramStudi;

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
        $stats = [
            'berita'  => Berita::count(),
            'dosen'   => Dosen::count(),
            'galeri'  => Galeri::count(),
            'pesan'   => KontakPesan::count(),
            'slider'  => Slider::count(),
            'prodi'   => ProgramStudi::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
