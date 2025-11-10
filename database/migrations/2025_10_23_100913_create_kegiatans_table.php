<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('batch');
            $table->string('title');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('lokasi');
            $table->string('slug');
            $table->string('link_dokumentasi');
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    //     'batch',
    //     'title',
    //     'deskripsi',
    //     'tanggal',
    //     'gambar',
    //     'lokasi',
    //     'slug',
    //     'link_dokumentasi',
    //     'status',

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
