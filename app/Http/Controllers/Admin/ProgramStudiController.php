<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProgramStudiRequest;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProgramStudiController extends Controller
{
    public function index()
    {
        return view('admin.program-studi.index');
    }

    public function datatable()
    {
        return DataTables::of(ProgramStudi::latest()->get())
            ->addIndexColumn()
            ->addColumn('status', fn($p) => $p->is_active
                ? '<span class="badge bg-success">Aktif</span>'
                : '<span class="badge bg-secondary">Nonaktif</span>')
            ->addColumn('aksi', fn($p) => view('admin.program-studi._aksi', ['prodi' => $p])->render())
            ->rawColumns(['status', 'aksi'])
            ->toJson();
    }

    public function create()
    {
        return view('admin.program-studi.create');
    }

    public function store(ProgramStudiRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('prodi', 'public');
        }
        $prodi = ProgramStudi::create($data);
        activity()->causedBy(auth()->user())->performedOn($prodi)->log('Menambahkan prodi: ' . $prodi->nama);
        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    public function edit(ProgramStudi $program_studi)
    {
        $prodi = $program_studi;
        return view('admin.program-studi.edit', compact('prodi'));
    }

    public function update(ProgramStudiRequest $request, ProgramStudi $program_studi)
    {
        $prodi = $program_studi;
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            if ($prodi->gambar && Storage::disk('public')->exists($prodi->gambar)) {
                Storage::disk('public')->delete($prodi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('prodi', 'public');
        }
        $prodi->update($data);
        activity()->causedBy(auth()->user())->performedOn($prodi)->log('Mengubah prodi: ' . $prodi->nama);
        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil diperbarui!');
    }

    public function destroy(ProgramStudi $program_studi)
    {
        $nama = $program_studi->nama;
        $program_studi->delete();
        activity()->causedBy(auth()->user())->log('Menghapus prodi: ' . $nama);
        return response()->json(['success' => true, 'message' => 'Program Studi berhasil dihapus!']);
    }
}
