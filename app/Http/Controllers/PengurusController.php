<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengurus = Pengurus::latest()->paginate(4);
        return view('admin.pengurus.index', compact('pengurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengurus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|max:100',
                'jabatan' => 'required|max:255',
                'gambar' => 'required|file|mimes:jpeg,jpg,png,svg|max:2048',
                'periode' => 'required|max:255',
            ],
            [
                'nama.required' => 'Nama pengurus wajib diisi',
                'jabatan.required' => 'Jabatan pengurus wajib diisi',
                'gambar.required' => 'Gambar pengurus wajib diisi',
                'periode.required' => 'Periode pengurus wajib diisi',
            ]
        );

        $path = null;

        try {

            if ($request->hasFile('gambar')) {
                $path = $request->File('gambar')->store('pengurus', 'public');
                $validatedData['gambar'] = $path;
            }

            Pengurus::create($validatedData);
            return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil di tambahkan');
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            Log::error('GAGAL MENYIMPAN PENGURUS: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengurus $pengurus)
    {
        return view('admin.pengurus.show', compact('pengurus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengurus $pengurus)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|max:255',
                'jabatan' => 'required|max:255',
                'gambar' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:2048',
                'periode' => 'required|max:255',
            ],
            [
                'nama.required' => 'Nama pengurus wajib diisi',
                'jabatan.required' => 'Jabatan pengurus wajib diisi',
                'periode.required' => 'Periode pengurus wajib diisi',
            ]
        );

        $path = null;

        try {

            if ($request->hasFile('gambar')) {

                if ($pengurus->gambar) {
                    Storage::disk('public')->delete($pengurus->gambar);
                }

                $path = $request->File('gambar')->store('pengurus', 'public');
                $validatedData['gambar'] = $path;
            }

            $pengurus->update($validatedData);
            return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil di perbarui');
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            Log::error('GAGAL MEMPERBARUI PENGURUS: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengurus $pengurus)
    {
        try {
            if ($pengurus->gambar) {
                Storage::disk('public')->delete($pengurus->gambar);
            }
            
            $pengurus->delete();
            return redirect()->route('admin.pengurus.index')->with('success', 'Data Pengurus berhasil di hapus');
        } catch (\Throwable $e) {
            Log::error('GAGAL MENGHAPUS DATA PENGURUS: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $query = Pengurus::query()->latest();

        if ($searchQuery) {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('nama', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('jabatan', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('periode', 'LIKE', "%{$searchQuery}%");
            });
        } else {
            return view('admin.pengurus._card', ['pengurus' => collect()]);
        }

        $pengurus = $query->get();

        return view('admin.pengurus._card', compact('pengurus'));
    }
}
