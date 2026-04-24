<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable = [
        'alamat',
        'email',
        'telepon',
        'koordinat',
        'tiktok',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
    ];
}
