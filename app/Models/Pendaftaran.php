<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_id',
        'full_name',
        'domisili',
        'jenis_kelamin',
        'usia',
        'phone_number',
        'akun_instagram',
        'instansi',
        'alasan_mendaftar',
        'member',
        'is_member',
        'size',
        'total_bayar',
        'bukti_follow_tiktok',
        'bukti_follow_instagram',
        'bukti_pembayaran',
        'status',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    protected static function booted()
    {
        static::deleting(function ($pendaftaran) {
            $files = [
                $pendaftaran->bukti_follow_tiktok,
                $pendaftaran->bukti_follow_instagram,
                $pendaftaran->bukti_pembayaran,
            ];

            foreach ($files as $file) {
                if (!empty($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
        });
    }
}