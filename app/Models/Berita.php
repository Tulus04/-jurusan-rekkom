<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Model Berita.
 *
 * Merepresentasikan berita/artikel jurusan.
 * Memiliki relasi ke User (penulis) dan menggunakan SoftDeletes.
 *
 * @property int       $id
 * @property string    $judul              Judul berita
 * @property string    $slug               URL-friendly judul
 * @property string    $ringkasan          Ringkasan singkat
 * @property string    $konten             Konten lengkap (HTML)
 * @property string    $gambar             Path gambar utama
 * @property int       $penulis_id         FK ke users
 * @property \DateTime $tanggal_publikasi  Tanggal terbit
 * @property bool      $is_published       Status publikasi
 */
class Berita extends Model
{
    use SoftDeletes;

    /**
     * Kolom yang boleh diisi secara mass-assignment.
     *
     * @var array<string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar',
        'penulis_id',
        'tanggal_publikasi',
        'is_published',
    ];

    /**
     * Cast tipe data otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Auto-generate slug dari judul saat membuat berita baru.
     */
    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    /**
     * Relasi: berita ditulis oleh satu user (penulis).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    /**
     * Scope: hanya berita yang sudah dipublikasi.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('tanggal_publikasi', '<=', now());
    }

    /**
     * Gunakan slug sebagai route key (untuk URL SEO-friendly).
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relasi many-to-many ke Kategori.
     */
    public function kategoris(): BelongsToMany
    {
        return $this->belongsToMany(Kategori::class, 'berita_kategori');
    }
}
