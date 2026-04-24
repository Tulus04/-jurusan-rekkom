<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'nama',
        'gambar',
        'link',
        'deskripsi',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
