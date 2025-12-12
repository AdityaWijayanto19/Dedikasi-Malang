<?php
// app/Http/Controllers/GlobalSearchController.php
namespace App\Http\Controllers;

use App\Models\Cerita;
use App\Models\Kegiatan;
use App\Models\Donasi;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $results = collect();

        if (strlen($q) >= 2) {
            // 1. Kegiatan (WAJIB: batch, title, deskripsi, lokasi - Sesuai Migrasi)
            $kegiatan = Kegiatan::whereFullText(['batch', 'title', 'deskripsi', 'lokasi'], $q)
                ->select('title', 'slug', 'gambar', 'deskripsi', 'updated_at')
                ->get()->map(fn($item) => $this->format($item, 'Kegiatan', 'pages.kegiatan.show'));

            // 2. Cerita (title, deskripsi, nama_penulis, jabatan)
            $cerita = Cerita::whereFullText(['title', 'deskripsi', 'nama_penulis', 'jabatan'], $q)
                ->select('title', 'slug', 'gambar', 'deskripsi', 'updated_at')
                ->get()->map(fn($item) => $this->format($item, 'Cerita', 'pages.cerita.show'));

            // 3. Donasi (title, deskripsi)
            $donasi = Donasi::whereFullText(['title', 'deskripsi'], $q)
                ->select('title', 'slug', 'gambar', 'deskripsi', 'updated_at')
                ->get()->map(fn($item) => $this->format($item, 'Donasi', 'donasi.show'));

            // 4. Pengurus (nama, jabatan, periode)
            $pengurus = Pengurus::whereFullText(['nama', 'jabatan', 'periode'], $q)
                ->select('nama as title', 'gambar', 'jabatan as deskripsi', 'updated_at')
                ->get()->map(fn($item) => $this->format($item, 'Pengurus', null));

            $results = $kegiatan->concat($cerita)->concat($donasi)->concat($pengurus);
        }

        return view('pages.search', compact('results', 'q'));
    }

    private function format($model, $category, $routeName)
    {
        return (object)[
            'title'    => $model->title,
            'category' => $category,
            'snippet'  => Str::limit(strip_tags($model->deskripsi), 180),
            'url'      => $routeName ? route($routeName, $model->slug) : '#',
            'date'     => $model->updated_at?->translatedFormat('d F Y') ?? '-',
            'image'    => asset('storage/' . $model->gambar)
        ];
    }
}