<?php

namespace App\Http\Controllers;

use App\Models\Cerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CeritaController extends Controller
{

    public function publicIndex(){
         $cerita = Cerita::latest()
            ->get();

        return view('pages.cerita.index', compact('cerita',));
    }

    public function publicShow($slug){
         $cerita = Cerita::where('slug', $slug)->firstOrFail();

        return view('pages.cerita.show', compact('cerita'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cerita = Cerita::latest()->paginate(5);
        return view('admin.cerita.index', compact('cerita'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cerita $cerita)
    {
        return view('admin.cerita.show', compact('cerita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cerita $cerita)
    {
        return view('admin.cerita.edit', compact('cerita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cerita.create');
    }

    public function publicCreate()
    {
        return view('pages.cerita.create');
    }

    /**
     * Store a newly created resource in storage.
    */
    public function publicStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|max:255|unique:ceritas,title',
                'deskripsi' => 'required|string',
                'gambar' => 'required|file|mimes:jpeg,jpg,png,svg|max:2048',
                'nama_penulis' => 'required|max:255',
                'jabatan' => 'required|max:255',
            ],
            [
                'title.unique' => 'Judul cerita sudah ada, silakan gunakan judul lain.',
                'title.required' => 'Judul cerita wajib diisi.',
                'gambar.required' => 'Gambar cerita wajib diisi.',
                'deskripsi.required' => 'Deskripsi cerita wajib diisi.',
                'nama_penulis.required' => 'Nama Penulis cerita wajib diisi.',
                'jabatan.required' => 'Jabatan cerita wajib diisi.',
            ]
        );

        $path = null;

        try {
            $validatedData['slug'] = generateUniqueSlug($validatedData['title']);

            $validatedData['deskripsi'] = clean($request->input('deskripsi'));

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('cerita', 'public');
                $validatedData['gambar'] = $path;
            }

            Cerita::create($validatedData);

            return redirect()->route('pages.cerita.index')->with('success', 'Data cerita berhasil ditambahkan!');
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            Log::error('GAGAL MENYIMPAN CERITA: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|max:255|unique:ceritas,title',
                'deskripsi' => 'required|string',
                'gambar' => 'required|file|mimes:jpeg,jpg,png,svg|max:2048',
                'nama_penulis' => 'required|max:255',
                'jabatan' => 'required|max:255',
            ],
            [
                'title.unique' => 'Judul cerita sudah ada, silakan gunakan judul lain.',
                'title.required' => 'Judul cerita wajib diisi.',
                'gambar.required' => 'Gambar cerita wajib diisi.',
                'deskripsi.required' => 'Deskripsi cerita wajib diisi.',
                'nama_penulis.required' => 'Nama Penulis cerita wajib diisi.',
                'jabatan.required' => 'Jabatan cerita wajib diisi.',
            ]
        );

        $path = null;

        try {
            $validatedData['slug'] = generateUniqueSlug($validatedData['title']);

            $validatedData['deskripsi'] = clean($request->input('deskripsi'));

            // CONTOH CARA MEMANGGIL DESKRIPSI DENGAN BENAR DI VIEW, AGAR UI DARI TINYMCE BERFUNGSI
            //     <div class="prose lg:prose-xl max-w-full">
            //     {{-- Gunakan {!! !!} untuk merender konten dari TinyMCE --}}
            //     {!! $cerita->deskripsi !!}
            // </div>

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('cerita', 'public');
                $validatedData['gambar'] = $path;
            }

            Cerita::create($validatedData);

            return redirect()->route('admin.cerita.index')->with('success', 'Data cerita berhasil ditambahkan!');
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            Log::error('GAGAL MENYIMPAN CERITA: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cerita $cerita)
    {
        $validatedData = $request->validate(
            [
                'title' => ['required', 'max:255', Rule::unique('ceritas')->ignore($cerita->id)],
                'deskripsi' => 'required|string',
                'gambar' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:2048',
                'nama_penulis' => 'required|max:255',
                'jabatan' => 'required|max:255',
            ],
            [
                'title.unique' => 'Judul cerita sudah ada, silakan gunakan judul lain.',
                'title.required' => 'Judul cerita wajib diisi.',
                'deskripsi.required' => 'Deskripsi cerita wajib diisi.',
                'nama_penulis.required' => 'Nama Penulis cerita wajib diisi.',
                'jabatan.required' => 'Jabatan cerita wajib diisi.',
            ]
        );

        $pathBaru = null;

        try {
            if ($request->hasFile('gambar')) {

                if ($cerita->gambar) {
                    Storage::disk('public')->delete($cerita->gambar);
                }

                $pathBaru = $request->file('gambar')->store('cerita', 'public');
                $validatedData['gambar'] = $pathBaru;
            }

            $validatedData['deskripsi'] = clean($request->input('deskripsi'));

            if ($cerita->title != $validatedData['title']) {
                $validatedData['slug'] = generateUniqueSlug($validatedData['title'], $cerita->id);
            }

            $cerita->update($validatedData);
            return redirect()->route('admin.cerita.index')->with('success', 'Data Cerita berhasil diperbarui!');
        } catch (\Throwable $e) {

            if ($pathBaru) {
                Storage::disk('public')->delete($pathBaru);
            }

            Log::error('GAGAL PERBARUI DATA CERITA: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat perbarui data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cerita $cerita)
    {
        try {
            if ($cerita->gambar) {
                Storage::disk('public')->delete($cerita->gambar);
            }

            $cerita->delete();

            return redirect()->route('admin.cerita.index')->with('success', 'Data cerita berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('GAGAL MENGHAPUS DATA CERITA: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $query = Cerita::query()->latest();

        if ($searchQuery) {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('title', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('nama_penulis', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('jabatan', 'LIKE', "%{$searchQuery}%");
            });
        } else {
            return view('admin.cerita._table_rows', ['cerita' => collect()]);
        }

        $cerita = $query->get();

        return view('admin.cerita._table_rows', compact('cerita'));
    }
}
