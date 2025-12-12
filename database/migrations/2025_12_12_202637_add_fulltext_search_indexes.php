<?php
// database/migrations/2025_01_01_000000_add_fulltext_search_indexes.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE kegiatans ADD FULLTEXT idx_fts_kegiatan (batch, title, deskripsi, lokasi)');
        DB::statement('ALTER TABLE ceritas ADD FULLTEXT idx_fts_cerita (title, deskripsi, nama_penulis, jabatan)');
        DB::statement('ALTER TABLE donasis ADD FULLTEXT idx_fts_donasi (title, deskripsi)');
        DB::statement('ALTER TABLE penguruses ADD FULLTEXT idx_fts_pengurus (nama, jabatan, periode)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE kegiatans DROP INDEX idx_fts_kegiatan');
        DB::statement('ALTER TABLE ceritas DROP INDEX idx_fts_cerita');
        DB::statement('ALTER TABLE donasis DROP INDEX idx_fts_donasi');
        DB::statement('ALTER TABLE penguruses DROP INDEX idx_fts_pengurus');
    }
};
