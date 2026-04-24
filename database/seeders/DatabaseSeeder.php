<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProfilJurusan;
use App\Models\Slider;
use App\Models\Fasilitas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder utama untuk data awal website.
 *
 * Membuat akun admin dan data profil jurusan minimal
 * agar website langsung bisa digunakan setelah migrasi.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // ===== Akun Admin =====
        User::create([
            'name' => 'Admin Jurusan RK',
            'email' => 'admin@rekkom.ac.id',
            'password' => Hash::make('password'),
        ]);

        // ===== Profil Jurusan =====
        $profilData = [
            [
                'kunci' => 'visi',
                'nilai' => 'Menjadi jurusan unggulan dalam bidang rekayasa komputer yang menghasilkan lulusan berkompeten dan berdaya saing tinggi di tingkat nasional.',
            ],
            [
                'kunci' => 'misi',
                'nilai' => '<ul>
                    <li>Menyelenggarakan pendidikan vokasi yang berkualitas di bidang rekayasa komputer.</li>
                    <li>Melaksanakan penelitian terapan yang bermanfaat bagi masyarakat dan industri.</li>
                    <li>Menjalin kerjasama dengan dunia usaha dan industri.</li>
                    <li>Menghasilkan lulusan yang berakhlak mulia dan profesional.</li>
                </ul>',
            ],
            [
                'kunci' => 'sejarah',
                'nilai' => 'Jurusan Rekayasa Komputer Politeknik Pertanian Negeri Samarinda didirikan sebagai jawaban atas kebutuhan tenaga ahli di bidang teknologi informasi dan komputer di wilayah Kalimantan Timur. Seiring perkembangan teknologi, jurusan ini terus berinovasi dalam kurikulum dan metode pembelajaran.',
            ],
            [
                'kunci' => 'sambutan_ketua',
                'nilai' => 'Selamat datang di website resmi Jurusan Rekayasa Komputer Politeknik Pertanian Negeri Samarinda. Kami berkomitmen untuk mencetak lulusan yang tidak hanya menguasai teori tetapi juga terampil dalam praktik di dunia industri.',
            ],
        ];

        foreach ($profilData as $profil) {
            ProfilJurusan::create($profil);
        }

        // ===== Slider Hero =====
        $sliderData = [
            [
                'judul' => 'Selamat Datang di Jurusan Rekayasa Komputer',
                'deskripsi' => 'Politeknik Pertanian Negeri Samarinda — Mencetak lulusan yang kompeten di bidang teknologi informasi dan komputer.',
                'gambar' => 'frontend/img/hero-carousel/hero-carousel-1.jpg',
                'tombol_teks' => 'Pelajari Selengkapnya',
                'tombol_url' => '/profil/visi-misi',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Fasilitas Modern',
                'deskripsi' => 'Didukung dengan laboratorium dan peralatan terkini untuk menunjang proses pembelajaran yang berkualitas.',
                'gambar' => 'frontend/img/hero-carousel/hero-carousel-2.jpg',
                'tombol_teks' => 'Lihat Fasilitas',
                'tombol_url' => '/fasilitas',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Program Studi Unggulan',
                'deskripsi' => 'Kurikulum yang dirancang sesuai kebutuhan industri dengan tenaga pengajar profesional dan berpengalaman.',
                'gambar' => 'frontend/img/hero-carousel/hero-carousel-3.jpg',
                'tombol_teks' => 'Lihat Program Studi',
                'tombol_url' => '/program-studi',
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliderData as $slider) {
            Slider::create($slider);
        }

        // ===== Fasilitas =====
        $fasilitasData = [
            [
                'nama' => 'Laboratorium Komputer',
                'deskripsi' => 'Lab komputer dengan perangkat terbaru untuk mendukung praktikum pemrograman dan jaringan.',
                'icon' => 'bi bi-pc-display',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'nama' => 'Laboratorium Jaringan',
                'deskripsi' => 'Lab jaringan yang dilengkapi router, switch, dan server untuk simulasi infrastruktur jaringan.',
                'icon' => 'bi bi-hdd-network',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama' => 'Ruang Kelas Multimedia',
                'deskripsi' => 'Ruang kelas yang dilengkapi proyektor dan sound system untuk mendukung pembelajaran interaktif.',
                'icon' => 'bi bi-projector',
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($fasilitasData as $fasilitas) {
            Fasilitas::create($fasilitas);
        }
    }
}
