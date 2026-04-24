<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaleriRequest;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
{
    public function index()
    {
        return view('admin.galeri.index');
    }

    public function datatable()
    {
        return DataTables::of(Galeri::ordered()->get())
            ->addIndexColumn()
            ->addColumn('gambar_preview', fn($g) => '<img src="' . ($g->gambar ? asset('storage/' . $g->gambar) : '') . '" height="50" class="rounded"/>')
            ->addColumn('status', fn($g) => $g->is_active
                ? '<span class="badge bg-success">Aktif</span>'
                : '<span class="badge bg-secondary">Nonaktif</span>')
            ->addColumn('aksi', fn($g) => view('admin.galeri._aksi', ['galeri' => $g])->render())
            ->rawColumns(['gambar_preview', 'status', 'aksi'])
            ->toJson();
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(GaleriRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }
        $galeri = Galeri::create($data);
        activity()->causedBy(auth()->user())->performedOn($galeri)->log('Menambahkan galeri: ' . $galeri->judul);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(GaleriRequest $request, Galeri $galeri)
    {
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }
        $galeri->update($data);
        activity()->causedBy(auth()->user())->performedOn($galeri)->log('Mengubah galeri: ' . $galeri->judul);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        $judul = $galeri->judul;
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();
        activity()->causedBy(auth()->user())->log('Menghapus galeri: ' . $judul);
        return response()->json(['success' => true, 'message' => 'Galeri berhasil dihapus!']);
    }
}
