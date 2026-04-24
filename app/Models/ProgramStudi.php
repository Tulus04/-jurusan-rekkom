<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ProgramStudi.
 *
 * Merepresentasikan data program studi di jurusan.
 *
 * @property int    $id
 * @property string $nama         Nama prodi
 * @property string $jenjang      Jenjang (D3/D4/S1)
 * @property string $akreditasi   Nilai akreditasi
 * @property string $deskripsi    Deskripsi lengkap
 * @property string $visi
 * @property string $misi
 * @property string $gambar       Path gambar
 * @property bool   $is_active    Status aktif
 */
class ProgramStudi extends Model
{
    /**
     * Kolom yang boleh diisi secara mass-assignment.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nama',
        'jenjang',
        'akreditasi',
        'deskripsi',
        'visi',
        'misi',
        'gambar',
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
     * Scope: hanya prodi yang aktif.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
