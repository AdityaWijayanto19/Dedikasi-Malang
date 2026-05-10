<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'gambar',
        'periode',
        'link_instagram',
        'status',
    ];
}
