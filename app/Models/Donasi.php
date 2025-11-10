<?php

namespace App\Models;

use App\Enums\StatusPostingan;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $fillable = [
        'title',
        'gambar',
        'deskripsi',
        'link_donasi',
        'slug',
        'status',
    ];

    protected $casts = [
        'status' => StatusPostingan::class,
    ];
}
