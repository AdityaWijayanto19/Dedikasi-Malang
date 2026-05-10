<?php

namespace App\Models;

use App\Enums\PendaftaranStatus;
use App\Enums\StatusPostingan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Facades\Storage;

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
        'link_whatsapp_group', 
        'is_open_for_registration',
        'is_member_active',
        'biaya',
        'kuota',
    ];

    protected $casts = [
        'status' => StatusPostingan::class,
        'is_open_for_registration' => PendaftaranStatus::class,
    ];

    protected static function booted()
    {
        static::deleting(function ($kegiatan) {
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
        });
    }
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
