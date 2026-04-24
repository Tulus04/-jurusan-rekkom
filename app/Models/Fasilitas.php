<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Fasilitas.
 *
 * Merepresentasikan data fasilitas jurusan (lab, ruangan, dll).
 *
 * @property int    $id
 * @property string $nama       Nama fasilitas
 * @property string $deskripsi  Deskripsi
 * @property string $gambar     Path gambar
 * @property string $icon       Class Bootstrap icon
 * @property int    $urutan     Urutan tampil
 * @property bool   $is_active  Status aktif
 */
class Fasilitas extends Model
{
    /**
     * Kolom yang boleh diisi secara mass-assignment.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'icon',
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
     * Scope: hanya fasilitas yang aktif.
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
