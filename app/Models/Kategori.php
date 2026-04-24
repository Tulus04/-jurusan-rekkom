<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Kategori extends Model
{
    protected $fillable = [
        'nama',
        'slug',
    ];

    /**
     * Auto-generate slug dari nama saat create/update.
     */
    protected static function booted(): void
    {
        static::creating(function (Kategori $kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama);
            }
        });

        static::updating(function (Kategori $kategori) {
            if ($kategori->isDirty('nama')) {
                $kategori->slug = Str::slug($kategori->nama);
            }
        });
    }

    /**
     * Relasi many-to-many ke Berita.
     */
    public function beritas(): BelongsToMany
    {
        return $this->belongsToMany(Berita::class, 'berita_kategori');
    }
}
