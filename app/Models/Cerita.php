<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerita extends Model
{
    protected $fillable = [
        'title',
        'deskripsi',
        'gambar',
        'slug',
        'nama_penulis',
        'jabatan',
    ];
}
