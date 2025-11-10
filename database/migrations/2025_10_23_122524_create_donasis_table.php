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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('gambar');
            $table->text('deskripsi');
            $table->string('link_donasi');
            $table->string('slug');
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    //     'title',
    //     'gambar',
    //     'deskripsi',
    //     'link_donasi',
    //     'slug',
    //     'status',

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
