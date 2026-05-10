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
        'status',
    ];

     protected static function booted()
    {
        static::deleting(function ($cerita) {
            if ($cerita->gambar) {
                Storage::disk('public')->delete($cerita->gambar);
            }
        });
    }
}
