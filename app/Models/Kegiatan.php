<?php

namespace App\Models;

use App\Enums\StatusPostingan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch',
        'title',
        'deskripsi',
        'tanggal',
        'gambar',
        'lokasi',
        'slug',
        'link_dokumentasi',
        'status',
    ];

    protected $casts = [
        'status' => StatusPostingan::class,
    ];
}
