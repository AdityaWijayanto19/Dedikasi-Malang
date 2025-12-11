<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke tabel 'kegiatans'
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');

            // Data Diri Pendaftar (Guest)
            $table->string('full_name', 150);
            $table->string('domisili', 150);
            $table->string('jenis_kelamin', 150);
            $table->string('usia', 15);
            $table->string('phone_number', 20);
            $table->string('akun_instagram', 100);
            $table->string('instansi', 100);
            $table->string('alasan_mendaftar', 255);
            $table->string('bukti_follow_tiktok', 255);
            $table->string('bukti_follow_instagram', 255);
            $table->string('bukti_pembayaran', 255);
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->unique(['kegiatan_id', 'phone_number']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
