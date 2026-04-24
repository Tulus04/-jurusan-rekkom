<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ProfilJurusan.
 *
 * Merepresentasikan data profil jurusan yang disimpan
 * secara key-value (visi, misi, sejarah, dll).
 *
 * @property int    $id
 * @property string $kunci     Key unik (visi, misi, sejarah, sambutan_ketua)
 * @property string $nilai     Konten HTML
 * @property string $gambar    Path gambar pendukung
 */
class ProfilJurusan extends Model
{
    /**
     * Kolom yang boleh diisi secara mass-assignment.
     *
     * @var array<string>
     */
    protected $fillable = [
        'kunci',
        'nilai',
        'gambar',
    ];
}
