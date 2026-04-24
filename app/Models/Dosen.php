<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model Dosen.
 *
 * Merepresentasikan data dosen dan staff jurusan.
 * Menggunakan SoftDeletes agar data yang dihapus bisa dipulihkan.
 *
 * @property int    $id
 * @property string $nama             Nama lengkap
 * @property string $nidn             NIDN
 * @property string $jabatan          Jabatan fungsional
 * @property string $email
 * @property string $telepon
 * @property string $foto             Path foto
 * @property string $bidang_keahlian  Bidang keahlian
 * @property string $bio              Biografi singkat
 * @property int    $urutan           Urutan tampil
 * @property bool   $is_active        Status aktif
 */
class Dosen extends Model
{
    use SoftDeletes;

    /**
     * Kolom yang boleh diisi secara mass-assignment.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nama',
        'nidn',
        'jabatan',
        'email',
        'telepon',
        'foto',
        'bidang_keahlian',
        'bio',
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
     * Scope: hanya dosen yang aktif.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: urutkan berdasarkan kolom urutan.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
