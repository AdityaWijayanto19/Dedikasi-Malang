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
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->boolean('is_member')->default(false)->after('member');
            $table->string('size')->nullable()->after('is_member');
            $table->integer('total_bayar')->default(0)->after('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
             $table->dropColumn(['is_member', 'size', 'total_bayar']);
        });
    }
};
