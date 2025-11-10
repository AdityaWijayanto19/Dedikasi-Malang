<?php

namespace App\Http\Controllers;

use App\Enums\StatusPostingan;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donasi = Donasi::latest()->paginate(5);
        return view('admin.donasi.index', compact('donasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.donasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|max:255|unique:donasis,title',
                'gambar' => 'required|file|mimes:jpeg,jpg,png,svg|max:2048',
                'link_donasi' => 'required|max:255',
                'deskripsi' => 'required|string|max:1000',
                'status' => ['required', new Enum(StatusPostingan::class)],
            ],
            [
                'title.unique' => 'Batch donasi sudah ada, silakan gunakan Batch lain.',
                'title.required' => 'Judul donasi wajib diisi.',
                'gambar.required' => 'Gambar donasi wajib diisi.',
                'deskripsi.required' => 'Deskripsi donasi wajib diisi.',
                'link_donasi.required' => 'Link Donasi donasi wajib diisi.',
            ]
        );

        $path = null;

        try {
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('donasi', 'public');
                $validatedData['gambar'] = $path;
            }

            $validatedData['slug'] = generateUniqueSlug($validatedData['title']);

            Donasi::create($validatedData);

            return redirect()->route('admin.donasi.index')->with('success', 'Data donasi berhasil ditambahkan!');
        } catch (\Throwable $e) {

            if ($path) {
                Storage::disk('public')->delete($path);
            }

            Log::error('GAGAL MENYIMPAN DONASI: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Donasi $donasi)
    {
        return view('admin.donasi.show', compact('donasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donasi $donasi)
    {
        return view('admin.donasi.edit', compact('donasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donasi $donasi)
    {

         $validatedData = $request->validate(
            [
                'title' => ['required', 'max:255', Rule::unique('donasis')->ignore($donasi->id)],
                'gambar' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:2048',
                'link_donasi' => 'required|max:255',
                'deskripsi' => 'required|string|max:1000',
                'status' => ['required', new Enum(StatusPostingan::class)],
            ],
            [
                'title.unique' => 'Batch donasi sudah ada, silakan gunakan Batch lain.',
                'title.required' => 'Judul donasi wajib diisi.',
                'gambar.required' => 'Gambar donasi wajib diisi.',
                'deskripsi.required' => 'Deskripsi donasi wajib diisi.',
                'link_donasi.required' => 'Link Donasi donasi wajib diisi.',
            ]
        );

        $pathBaru = null;

        try {

            if ($request->hasFile('gambar')) {

                if ($donasi->gambar) {
                    Storage::disk('public')->delete($donasi->gambar);
                }

                $pathBaru = $request->file('gambar')->store('donasi', 'public');
                $validatedData['gambar'] = $pathBaru;
            }


            if ($donasi->title != $validatedData['title']) {
                $validatedData['slug'] = generateUniqueSlug($validatedData['title'], $donasi->id);
            }

            $donasi->update($validatedData);
            return redirect()->route('admin.donasi.index')->with('success', 'Data donasi berhasil diperbarui!');
        } catch (\Throwable $e) {

            if ($pathBaru) {
                Storage::disk('public')->delete($pathBaru);
            }

            Log::error('GAGAL PERBARUI DATA DONASI: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat perbarui data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donasi $donasi)
    {
        try {
            if ($donasi->gambar) {
                Storage::disk('public')->delete($donasi->gambar);
            }

            $donasi->delete();

            return redirect()->route('admin.donasi.index')->with('success', 'Data donasi berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('GAGAL MENGHAPUS DATA DONASI: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $query = Donasi::query()->latest();

        if ($searchQuery) {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('title', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('link_donasi', 'LIKE', "%{$searchQuery}%");
            });
        } else {
            return view('admin.donasi._table_rows', ['donasi' => collect()]);
        }

        $donasi = $query->get();

        return view('admin.donasi._table_rows', compact('donasi'));
    }
}
