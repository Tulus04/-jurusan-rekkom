<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class FasilitasController extends Controller
{
    public function index()
    {
        return view('admin.fasilitas.index');
    }

    public function datatable()
    {
        return DataTables::of(Fasilitas::ordered()->get())
            ->addIndexColumn()
            ->addColumn('gambar_preview', fn($f) => '<img src="' . ($f->gambar ? asset('storage/' . $f->gambar) : '') . '" height="50" class="rounded"/>')
            ->addColumn('status', fn($f) => $f->is_active
                ? '<span class="badge bg-success">Aktif</span>'
                : '<span class="badge bg-secondary">Nonaktif</span>')
            ->addColumn('aksi', fn($f) => view('admin.fasilitas._aksi', ['fasilitas' => $f])->render())
            ->rawColumns(['gambar_preview', 'status', 'aksi'])
            ->toJson();
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(FasilitasRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }
        $fasilitas = Fasilitas::create($data);
        activity()->causedBy(auth()->user())->performedOn($fasilitas)->log('Menambahkan fasilitas: ' . $fasilitas->nama);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function edit(Fasilitas $fasilita)
    {
        $fasilitas = $fasilita;
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(FasilitasRequest $request, Fasilitas $fasilita)
    {
        $fasilitas = $fasilita;
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar && Storage::disk('public')->exists($fasilitas->gambar)) {
                Storage::disk('public')->delete($fasilitas->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }
        $fasilitas->update($data);
        activity()->causedBy(auth()->user())->performedOn($fasilitas)->log('Mengubah fasilitas: ' . $fasilitas->nama);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $nama = $fasilita->nama;
        if ($fasilita->gambar && Storage::disk('public')->exists($fasilita->gambar)) {
            Storage::disk('public')->delete($fasilita->gambar);
        }
        $fasilita->delete();
        activity()->causedBy(auth()->user())->log('Menghapus fasilitas: ' . $nama);
        return response()->json(['success' => true, 'message' => 'Fasilitas berhasil dihapus!']);
    }
}
