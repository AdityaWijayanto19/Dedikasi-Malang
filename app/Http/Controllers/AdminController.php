<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loginUserId = Auth::id();

        $admin = User::latest()->where('id', '!=', $loginUserId)->paginate(5);
        return view('admin.manage-admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manage-admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'status' => 'required|in:0,1',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // Konversi status ke enum
        $validated['status'] = (int) $validated['status'] === 1
            ? UserStatus::Active
            : UserStatus::Block;

        $validated['password'] = bcrypt($validated['password']);

        if ($request->hasFile('gambar')) {
            $validated['avatar'] = $request->file('gambar')->store('avatars', 'public');
        }

        \App\Models\User::create($validated);

        return redirect()->route('admin.manage-admin.index')
            ->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('admin.manage-admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255|string',
                'email' => ['required', 'max:255', 'string', 'email', Rule::unique('users')->ignore($admin->id)],
                'password' => 'nullable|string|min:8',
                'status' => ['required', new Enum(UserStatus::class)],
                'avatar' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:2048',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
                'password.min' => 'Password minimal 8 karakter.',
            ]
        );

        $pathBaru = null;

        try {
            if ($request->hasFile('avatar')) {

                if ($admin->avatar) {
                    Storage::disk('public')->delete($admin->avatar);
                }

                $pathBaru = $request->file('avatar')->store('avatars', 'public');
                $validatedData['avatar'] = $pathBaru;
            }

            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($request->password);
            } else {
                unset($validatedData['password']);
            }

            $admin->update($validatedData);
            return redirect()->route('admin.manage-admin.index')->with('success', 'Data Admin berhasil diperbarui!');
        } catch (\Throwable $e) {
            if ($pathBaru) {
                Storage::disk('public')->delete($pathBaru);
            }

            Log::error('GAGAL PERBARUI DATA ADMIN BARU: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat perbarui data. Silahkan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        try {
            if ($admin->avatar) {
                Storage::disk('public')->delete($admin->avatar);
            }

            $admin->delete();

            return redirect()->route('admin.manage-admin.index')->with('success', 'Data Admin berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('GAGAL MENGHAPUS DATA ADMIN: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $query = User::query()->latest();

        if ($searchQuery) {
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('name', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('email', 'LIKE', "%{$searchQuery}%");
            });
        } else {
            return view('admin.manage-admin._table_rows', ['admin' => collect()]);
        }

        $admin = $query->get();

        return view('admin.manage-admin._table_rows', compact('admin'));
    }
}
