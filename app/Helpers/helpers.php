<?php

use Illuminate\Support\Str;
use App\Models\Kegiatan;

if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug(string $batch, ?int $excludeId = null): string
    {
        $slug = Str::slug($batch);
        $originalSlug = $slug;
        $count = 1;

        while (Kegiatan::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
