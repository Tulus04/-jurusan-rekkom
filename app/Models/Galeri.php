<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Galeri.
 *
 * Merepresentasikan foto-foto galeri kegiatan jurusan.
 *
 * @property int    $id
 * @property string $judul      Judul/caption foto
 * @property string $deskripsi  Deskripsi singkat
 * @property string $gambar     Path file gambar
 * @property string $kategori   Kategori (Kegiatan, Fasilitas, dll)
 * @property int    $urutan     Urutan tampil
 * @property bool   $is_active  Status aktif
 */
class Galeri extends Model
{
    /**
     * Kolom yang boleh diisi secara mass-assignment.
     *
     * @var array<string>
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'kategori',
        'urutan',
        'is_active',
    ];

    /**
     * Cast tipe data otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: hanya galeri yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: urutkan berdasarkan kolom urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
