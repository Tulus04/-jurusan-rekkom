<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakPesan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Controller Pesan Masuk (KontakPesan).
 *
 * Menampilkan pesan dari pengunjung website.
 * Hanya read + mark as read + delete (tanpa create/edit).
 */
class KontakPesanController extends Controller
{
    /**
     * Tampilkan daftar pesan masuk.
     */
    public function index()
    {
        return view('admin.pesan.index');
    }

    /**
     * DataTable server-side.
     */
    public function datatable()
    {
        $query = KontakPesan::query()->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status', function ($pesan) {
                return $pesan->is_read
                    ? '<span class="badge bg-secondary">Dibaca</span>'
                    : '<span class="badge bg-warning text-dark">Belum Dibaca</span>';
            })
            ->addColumn('aksi', function ($pesan) {
                return view('admin.pesan._aksi', compact('pesan'))->render();
            })
            ->editColumn('nama', function ($pesan) {
                $bold = $pesan->is_read ? '' : 'fw-bold';
                return "<span class=\"{$bold}\">{$pesan->nama}</span>";
            })
            ->editColumn('subjek', function ($pesan) {
                $bold = $pesan->is_read ? '' : 'fw-bold';
                return "<span class=\"{$bold}\">{$pesan->subjek}</span>";
            })
            ->editColumn('created_at', function ($pesan) {
                return $pesan->created_at->format('d M Y H:i');
            })
            ->rawColumns(['status', 'aksi', 'nama', 'subjek'])
            ->make(true);
    }

    /**
     * Tampilkan detail pesan.
     */
    public function show(KontakPesan $pesan)
    {
        // Tandai sudah dibaca
        if (!$pesan->is_read) {
            $pesan->update(['is_read' => true]);
        }

        return view('admin.pesan.show', compact('pesan'));
    }

    /**
     * Hapus pesan.
     */
    public function destroy(KontakPesan $pesan)
    {
        $pesan->delete();

        activity()
            ->causedBy(auth()->user())
            ->log("Menghapus pesan dari {$pesan->nama}");

        return response()->json([
            'message' => 'Pesan berhasil dihapus.',
        ]);
    }
}
