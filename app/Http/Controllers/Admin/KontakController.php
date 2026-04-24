<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

/**
 * Controller Kontak Jurusan.
 *
 * Mengelola informasi kontak jurusan (alamat, email, telepon, sosial media).
 * Single record — hanya ada 1 baris di tabel kontaks.
 */
class KontakController extends Controller
{
    /**
     * Tampilkan form edit kontak.
     */
    public function edit()
    {
        $kontak = Kontak::first() ?? new Kontak();

        return view('admin.kontak.edit', compact('kontak'));
    }

    /**
     * Simpan/update kontak jurusan.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'alamat'    => 'nullable|string|max:500',
            'email'     => 'nullable|email|max:255',
            'telepon'   => 'nullable|string|max:20',
            'koordinat' => 'nullable|string|max:100',
            'tiktok'    => 'nullable|url|max:255',
            'facebook'  => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube'   => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
        ]);

        $kontak = Kontak::first();

        if ($kontak) {
            $kontak->update($validated);
        } else {
            Kontak::create($validated);
        }

        activity()
            ->causedBy(auth()->user())
            ->log('Memperbarui informasi kontak jurusan');

        return redirect()
            ->route('admin.kontak.edit')
            ->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
