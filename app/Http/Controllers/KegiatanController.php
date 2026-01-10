<?php

namespace App\Http\Controllers;

use App\Enums\PendaftaranStatus;
use App\Enums\StatusPostingan;
use App\Models\Kegiatan;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class KegiatanController extends Controller
{

    public function publicIndex()
    {
        $newKegiatan = $this->getNewData();

        $kegiatan = Kegiatan::where('status', 1)->latest()->get();

        if (!$kegiatan) {
            abort(404);
        }

        // Kirim keduanya ke view
        return view('pages.kegiatan.index', compact('newKegiatan', 'kegiatan'));
    }


    private function getNewData()
    {
        return Kegiatan::where('status', StatusPostingan::Publish)
            ->latest()
            ->take(3)
            ->get();
    }

    public function publicShow($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();

        if ($kegiatan->status !== StatusPostingan::Publish) {
            abort(404);
        }

        return view('pages.kegiatan.show', compact('kegiatan'));
    }

    public function index()
    {
        $kegiatan = Kegiatan::latest()->paginate(5);
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'batch' => 'required|max:255|unique:kegiatans,batch',
                'title' => 'required|max:255',
                'deskripsi' => 'required|string|max:1000',
                'tanggal' => 'required|string|max:100',
                'gambar' => 'required|file|mimes:jpeg,jpg,png,svg|max:2048',
                'lokasi' => 'required|max:255',
                'link_dokumentasi' => 'required|max:255',
                'status' => ['required', new Enum(StatusPostingan::class)],
                'link_whatsapp_group' => 'nullable|max:255',
                'is_open_for_registration' => ['required', new Enum(PendaftaranStatus::class)],
            ],
            [
                'batch.unique' => 'Batch kegiatan sudah ada, silakan gunakan Batch lain.',
                'batch.required' => 'Batch kegiatan wajib diisi.',
                'title.required' => 'Judul kegiatan wajib diisi.',
                'gambar.required' => 'Gambar kegiatan wajib diisi.',
                'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
                'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
                'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
                'link_dokumentasi.required' => 'Link Url kegiatan wajib diisi.',
            ]
        );

        $path = null;

        try {
            if ($request->hasFile('gambar')) {
                $validatedData['gambar'] = $this->fileServices->UploadOrUpdate($request->file('gambar'), 'kegiatan');
            }

            $validatedData['slug'] = generateUniqueSlug($validatedData['batch']);

            Kegiatan::create($validatedData);

            return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil ditambahkan!');
        } catch (\Throwable $e) {

            if (isset($validatedData['gambar'])) {
                $this->fileServices->deleteFile($validatedData['gambar']);
            }

            Log::error('GAGAL MENYIMPAN KEGIATAN: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validatedData = $request->validate(
            [
                'batch' => ['required', 'max:255', Rule::unique('kegiatans')->ignore($kegiatan->id)],
                'title' => 'required|max:255',
                'deskripsi' => 'required|string|max:1000',
                'tanggal' => 'required|string|max:100',
                'gambar' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:2048',
                'lokasi' => 'required|max:255',
                'link_dokumentasi' => 'nullable|max:255',
                'status' => ['required', new Enum(StatusPostingan::class)],
                'link_whatsapp_group' => 'nullable|max:255',
                'is_open_for_registration' => ['required', new Enum(PendaftaranStatus::class)],
            ],
            [
                'batch.unique' => 'Judul batch sudah ada, silakan gunakan batch lain.',
                'batch.required' => 'Batch kegiatan wajib diisi.',
                'title.required' => 'Judul kegiatan wajib diisi.',
                'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
                'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
                'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            ]
        );

        $pathBaru = null;

        try {

            if ($request->hasFile('gambar')) {

                if ($kegiatan->gambar) {
                    Storage::disk('public')->delete($kegiatan->gambar);
                }

                $pathBaru = $request->file('gambar')->store('kegiatan', 'public');
                $validatedData['gambar'] = $pathBaru;
            }


            if ($kegiatan->batch != $validatedData['batch']) {
                $validatedData['slug'] = generateUniqueSlug($validatedData['batch'], $kegiatan->id);
            }

            $kegiatan->update($validatedData);
            return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil diperbarui!');
        } catch (\Throwable $e) {

            if ($pathBaru) {
                Storage::disk('public')->delete($pathBaru);
            }

            Log::error('GAGAL PERBARUI DATA KEGIATAN: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat perbarui data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Hapus data kegiatan file dan database.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        try {
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $kegiatan->delete();

            return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('GAGAL MENGHAPUS DATA KEGIATAN: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $query = Kegiatan::query()->latest();

        if ($searchQuery) {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('batch', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('title', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('lokasi', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('tanggal', 'LIKE', "%{$searchQuery}%");
            });
        } else {
            return view('admin.kegiatan._table_rows', ['kegiatan' => collect()]);
        }

        $kegiatan = $query->get();

        return view('admin.kegiatan._table_rows', compact('kegiatan'));
    }
}
