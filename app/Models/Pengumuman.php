<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'is_published',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'tanggal_publikasi' => 'date',
    ];

    /**
     * Auto-generate slug dari judul saat create.
     */
    protected static function booted(): void
    {
        static::creating(function (Pengumuman $pengumuman) {
            if (empty($pengumuman->slug)) {
                $pengumuman->slug = Str::slug($pengumuman->judul);
            }
        });
    }
}
