<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'bukti_follow_tiktok' ,
        'bukti_follow_instagram', 
        'bukti_pembayaran', 
        'status',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}