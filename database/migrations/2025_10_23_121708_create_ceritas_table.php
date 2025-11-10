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
        Schema::create('ceritas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('slug');
            $table->string('nama_penulis');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    //     'title',
    //     'deskripsi',
    //     'gambar',
    //     'slug',
    //     'nama_penulis',
    //     'jabatan',

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ceritas');
    }
};
