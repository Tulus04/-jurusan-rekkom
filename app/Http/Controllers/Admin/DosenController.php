<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DosenRequest;
use App\Models\Dosen;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    public function index()
    {
        return view('admin.dosen.index');
    }

    public function datatable()
    {
        return DataTables::of(Dosen::ordered()->get())
            ->addIndexColumn()
            ->addColumn('foto_preview', function ($d) {
                $url = $d->foto
                    ? asset('storage/' . $d->foto)
                    : asset('admin/img/avatars/placeholder.jpg');
                return '<img src="' . $url . '" alt="' . $d->nama . '" height="50" class="rounded-circle"/>';
            })
            ->addColumn('status', function ($d) {
                return $d->is_active
                    ? '<span class="badge bg-success">Aktif</span>'
                    : '<span class="badge bg-secondary">Nonaktif</span>';
            })
            ->addColumn('aksi', function ($d) {
                return view('admin.dosen._aksi', ['dosen' => $d])->render();
            })
            ->rawColumns(['foto_preview', 'status', 'aksi'])
            ->toJson();
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(DosenRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        $dosen = Dosen::create($data);

        activity()->causedBy(auth()->user())->performedOn($dosen)
            ->log('Menambahkan dosen: ' . $dosen->nama);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan!');
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(DosenRequest $request, Dosen $dosen)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $data['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        $dosen->update($data);

        activity()->causedBy(auth()->user())->performedOn($dosen)
            ->log('Mengubah dosen: ' . $dosen->nama);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui!');
    }

    public function destroy(Dosen $dosen)
    {
        $nama = $dosen->nama;
        $dosen->delete();

        activity()->causedBy(auth()->user())->log('Menghapus dosen: ' . $nama);

        return response()->json(['success' => true, 'message' => 'Data dosen berhasil dihapus!']);
    }
}
