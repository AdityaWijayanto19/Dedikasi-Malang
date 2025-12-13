<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Enums\PendaftaranStatus;

class PendaftaranController extends Controller
{

    public function index()
    {
        $kegiatans = Kegiatan::withCount([
            'pendaftarans as total_pendaftar',
            'pendaftarans as pending_count' => function ($query) {
                $query->where('status', 'pending');
            },
            'pendaftarans as accepted_count' => function ($query) {
                $query->where('status', 'accepted');
            }
        ])->latest()->get(); 

        return view('admin.pendaftaran.index', compact('kegiatans')); 
    }

    public function showDetailPendaftar(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load('kegiatan');

        return view('admin.pendaftaran.detail', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate(['status' => ['required', 'string', \Illuminate\Validation\Rule::in(['accepted', 'rejected', 'pending'])]]);

        $pendaftaran->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui menjadi ' . $request->status);
    }

    public function toggleRegistrationStatus(Kegiatan $kegiatan)
    {
        $newStatus = ($kegiatan->is_open_for_registration === \App\Enums\PendaftaranStatus::Buka) ? \App\Enums\PendaftaranStatus::Tutup : \App\Enums\PendaftaranStatus::Buka;
        $message = ($newStatus === \App\Enums\PendaftaranStatus::Buka) ? 'dibuka' : 'ditutup';

        $kegiatan->update(['is_open_for_registration' => $newStatus]);

        return back()->with('success', 'Pendaftaran untuk "' . $kegiatan->title . '" berhasil ' . $message . '.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $pendaftarans = Pendaftaran::where('kegiatan_id', $kegiatan->id)
            ->orderByRaw("FIELD(status, 'pending', 'accepted', 'rejected')")
            ->paginate(10);

        return view('admin.pendaftaran.show', compact('kegiatan', 'pendaftarans'));
    }


    public function store(Request $request, Kegiatan $kegiatan)
    {
        if ($kegiatan->is_open_for_registration === PendaftaranStatus::Tutup) {
            return back()->with('error', 'Mohon maaf, pendaftaran untuk kegiatan ini telah ditutup.');
        }

        $validatedData = $request->validate(
            [
                'full_name' => 'required|string|max:150',
                'domisili' => 'required|string|max:150',
                'jenis_kelamin' => 'required|in:L,P',
                'usia' => 'required|integer|min:1',
                'phone_number' => 'required|string|max:20|unique:pendaftarans,phone_number,NULL,id,kegiatan_id,' . $kegiatan->id,
                'akun_instagram' => 'required|string|max:100',
                'instansi' => 'required|string|max:100',
                'alasan_mendaftar' => 'required|string|max:255',
                'bukti_follow_tiktok' => 'required|file|image|max:2048',
                'bukti_follow_instagram' => 'required|file|image|max:2048',
                'bukti_pembayaran' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            ],
            [
                'phone_number.unique' => 'Nomor HP ini sudah terdaftar untuk kegiatan yang sama.',
                'required' => ':attribute wajib diisi.',
                'file' => ':attribute harus berupa file gambar atau PDF.',
                'image' => 'Bukti follow harus berupa file gambar (JPEG, PNG, dll.).',
                'mimes' => 'Bukti pembayaran harus berupa JPEG, JPG, PNG, atau PDF.',
            ]
        );

        $path_tiktok = null;
        $path_instagram = null;
        $path_pembayaran = null;

        try {
            $path_tiktok = $request->file('bukti_follow_tiktok')->store('pendaftaran/bukti_tiktok', 'public');
            $path_instagram = $request->file('bukti_follow_instagram')->store('pendaftaran/bukti_instagram', 'public');
            $path_pembayaran = $request->file('bukti_pembayaran')->store('pendaftaran/bukti_tf', 'public');

            Pendaftaran::create([
                'kegiatan_id' => $kegiatan->id,
                'full_name' => $validatedData['full_name'],
                'domisili' => $validatedData['domisili'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'usia' => $validatedData['usia'],
                'phone_number' => $validatedData['phone_number'],
                'akun_instagram' => $validatedData['akun_instagram'],
                'instansi' => $validatedData['instansi'],
                'alasan_mendaftar' => $validatedData['alasan_mendaftar'],
                'bukti_follow_tiktok' => $path_tiktok,
                'bukti_follow_instagram' => $path_instagram,
                'bukti_pembayaran' => $path_pembayaran,
                'status' => 'pending',
            ]);

            return redirect()->route('pendaftaran.success', $kegiatan);
        } catch (\Throwable $e) {
            Storage::disk('public')->delete([$path_tiktok, $path_instagram, $path_pembayaran]);

            Log::error('Pendaftaran Gagal: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    public function create(Kegiatan $kegiatan)
    {
        return view('pages.pendaftaran.create', compact('kegiatan'));
    }

    public function successPage(Kegiatan $kegiatan)
    {
        return view('pages.pendaftaran.success', compact('kegiatan'));
    }

    public function showCheckStatusForm(Kegiatan $kegiatan)
    {
        return view('pages.pendaftaran.check_status_form', compact('kegiatan'));
    }

    public function checkStatus(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20',
        ]);

        $pendaftaran = Pendaftaran::where('kegiatan_id', $kegiatan->id)
            ->where('phone_number', $request->phone_number)
            ->first();

        if ($pendaftaran) {
            return redirect()->route('pendaftaran.status.result', [
                'kegiatan' => $kegiatan,
                'pendaftaran' => $pendaftaran
            ]);
        }

        return back()->with('error', 'Nomor HP tidak ditemukan untuk kegiatan ini.')->withInput();
    }

    /**
     * [ADMIN] Delete pendaftaran yang di-reject dan cleanup file-nya.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        // Hanya bisa delete jika status rejected
        if ($pendaftaran->status !== 'rejected') {
            return back()->with('error', 'Hanya data dengan status REJECTED yang bisa dihapus.');
        }

        try {
            $kegiatan = $pendaftaran->kegiatan;

            // Hapus file-file terkait
            $files = [
                $pendaftaran->bukti_follow_tiktok,
                $pendaftaran->bukti_follow_instagram,
                $pendaftaran->bukti_pembayaran,
            ];

            foreach ($files as $file) {
                if (!empty($file)) {
                    Storage::disk('public')->delete(trim($file));
                }
            }

            // Hapus record dari database
            $pendaftaran->delete();

            return redirect()->route('admin.pendaftaran.show.kegiatan', $kegiatan)
                ->with('success', 'Data pendaftaran dan file bukti berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus pendaftaran: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function showStatusResult(Kegiatan $kegiatan, Pendaftaran $pendaftaran)
    {
        if ($pendaftaran->kegiatan_id !== $kegiatan->id) {
            abort(404);
        }

        return view('pages.pendaftaran.status_result', compact('kegiatan', 'pendaftaran'));
    }
}
