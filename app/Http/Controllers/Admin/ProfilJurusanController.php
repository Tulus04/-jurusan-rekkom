<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller Profil Jurusan.
 *
 * Mengelola halaman profil jurusan secara single-page edit.
 * Data disimpan key-value: visi, misi, sejarah, sambutan_ketua.
 */
class ProfilJurusanController extends Controller
{
    /**
     * Daftar kunci profil yang tersedia.
     */
    private array $kunciProfil = [
        'visi'           => 'Visi',
        'misi'           => 'Misi',
        'sejarah'        => 'Sejarah',
        'sambutan_ketua' => 'Sambutan Ketua Jurusan',
    ];

    /**
     * Tampilkan form edit profil jurusan.
     */
    public function edit()
    {
        // Ambil semua profil, buat indexed by 'kunci'
        $profilData = ProfilJurusan::all()->keyBy('kunci');

        // Pastikan semua kunci ada (walau belum ada di DB)
        $profil = [];
        foreach ($this->kunciProfil as $kunci => $label) {
            $profil[$kunci] = $profilData->get($kunci, new ProfilJurusan([
                'kunci' => $kunci,
                'nilai' => '',
                'gambar' => null,
            ]));
        }

        return view('admin.profil.edit', [
            'profil'      => $profil,
            'kunciProfil' => $this->kunciProfil,
        ]);
    }

    /**
     * Simpan/update semua profil jurusan.
     */
    public function update(Request $request)
    {
        $request->validate([
            'profil'          => 'required|array',
            'profil.*.nilai'  => 'nullable|string',
            'profil.*.gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($this->kunciProfil as $kunci => $label) {
            $data = $request->input("profil.{$kunci}", []);

            // updateOrCreate
            $profil = ProfilJurusan::firstOrNew(['kunci' => $kunci]);
            $profil->nilai = $data['nilai'] ?? '';

            // Handle gambar upload
            if ($request->hasFile("profil.{$kunci}.gambar")) {
                // Hapus gambar lama
                if ($profil->gambar && Storage::disk('public')->exists($profil->gambar)) {
                    Storage::disk('public')->delete($profil->gambar);
                }
                $profil->gambar = $request->file("profil.{$kunci}.gambar")
                    ->store('profil-jurusan', 'public');
            }

            $profil->save();
        }

        activity()
            ->causedBy(auth()->user())
            ->log('Memperbarui profil jurusan');

        return redirect()
            ->route('admin.profil.edit')
            ->with('success', 'Profil jurusan berhasil diperbarui.');
    }
}
