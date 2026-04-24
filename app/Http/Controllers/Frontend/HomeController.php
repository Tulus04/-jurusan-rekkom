<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;

/**
 * Controller untuk halaman beranda website publik.
 *
 * Menampilkan halaman utama dengan hero slider
 * dan konten dinamis (berita terbaru).
 */
class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda.
     *
     * Query 6 berita terbaru yang sudah dipublikasi
     * untuk ditampilkan di section berita.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $beritas = Berita::published()
            ->latest('tanggal_publikasi')
            ->take(6)
            ->get();

        return view('frontend.home', compact('beritas'));
    }
}
