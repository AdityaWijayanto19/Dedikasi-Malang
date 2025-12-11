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

    // Contoh PendaftaranAdminController@index
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
        ])->latest()->get(); // Pastikan Anda menggunakan ->get()

        return view('admin.pendaftaran.index', compact('kegiatans')); // Variabel harus bernama 'kegiatans'
    }

    public function showDetailPendaftar(Pendaftaran $pendaftaran)
    {
        // Panggil relasi kegiatan agar detail kegiatan juga muncul
        $pendaftaran->load('kegiatan');

        return view('admin.pendaftaran.detail', compact('pendaftaran'));
    }


    /**
     * [ADMIN] Aksi: Mengubah Status Pendaftaran.
     * Digunakan oleh route: admin.pendaftaran.update.status
     */
    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate(['status' => ['required', 'string', \Illuminate\Validation\Rule::in(['accepted', 'rejected', 'pending'])]]);

        $pendaftaran->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui menjadi ' . $request->status);
    }


    /**
     * [ADMIN] Aksi: Toggle Buka/Tutup Pendaftaran Kegiatan.
     * Digunakan oleh route: admin.pendaftaran.toggle.status
     */
    public function toggleRegistrationStatus(Kegiatan $kegiatan)
    {
        // Menggunakan Enum PendaftaranStatus
        $newStatus = ($kegiatan->is_open_for_registration === \App\Enums\PendaftaranStatus::Buka) ? \App\Enums\PendaftaranStatus::Tutup : \App\Enums\PendaftaranStatus::Buka;
        $message = ($newStatus === \App\Enums\PendaftaranStatus::Buka) ? 'dibuka' : 'ditutup';

        $kegiatan->update(['is_open_for_registration' => $newStatus]);

        return back()->with('success', 'Pendaftaran untuk "' . $kegiatan->title . '" berhasil ' . $message . '.');
    }

    public function show(Kegiatan $kegiatan)
    {
        // Ambil pendaftar untuk kegiatan ini.
        // Sorting: Pendaftar 'pending' akan selalu muncul di baris teratas, diikuti accepted, lalu rejected.
        $pendaftarans = Pendaftaran::where('kegiatan_id', $kegiatan->id)
            ->orderByRaw("FIELD(status, 'pending', 'accepted', 'rejected')")
            ->paginate(10);

        // Mengembalikan view Layer 2: Tabel Pendaftar
        return view('admin.pendaftaran.show', compact('kegiatan', 'pendaftarans'));
    }

    /**
     * Menyimpan data pendaftaran baru dari Guest.
     * Logika: Validasi -> Cek Status Buka/Tutup -> Upload File -> Simpan DB -> Redirect Sukses.
     * Menerapkan try-catch dan rollback file seperti di KegiatanController.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kegiatan $kegiatan)
    {
        // 1. Cek Status Pendaftaran Buka/Tutup Admin
        if ($kegiatan->is_open_for_registration === PendaftaranStatus::Tutup) {
            return back()->with('error', 'Mohon maaf, pendaftaran untuk kegiatan ini telah ditutup.');
        }

        // 2. Validasi Input dan File
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
            // 3. Upload File ke Storage
            // NOTE: Upload dilakukan di dalam try block, agar bisa di-rollback jika DB gagal
            $path_tiktok = $request->file('bukti_follow_tiktok')->store('pendaftaran/bukti_tiktok', 'public');
            $path_instagram = $request->file('bukti_follow_instagram')->store('pendaftaran/bukti_instagram', 'public');
            $path_pembayaran = $request->file('bukti_pembayaran')->store('pendaftaran/bukti_tf', 'public');

            // 4. Simpan Data ke DB
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
                'status' => 'pending', // Status awal selalu pending
            ]);

            // 5. Redirect ke Halaman Sukses
            return redirect()->route('pendaftaran.success', $kegiatan);
        } catch (\Throwable $e) {
            // JIKA ADA ERROR (misal: DB GAGAL DISIMPAN), HAPUS SEMUA FILE YANG SUDAH TERUPLOAD
            Storage::disk('public')->delete([$path_tiktok, $path_instagram, $path_pembayaran]);

            Log::error('Pendaftaran Gagal: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Menampilkan halaman sukses setelah pendaftaran.
     */
    public function create(Kegiatan $kegiatan)
    {
        return view('pages.pendaftaran.create', compact('kegiatan'));
    }

    /**
     * Menampilkan halaman sukses setelah pendaftaran.
     */
    public function successPage(Kegiatan $kegiatan)
    {
        return view('pages.pendaftaran.success', compact('kegiatan'));
    }

    /**
     * Menampilkan form untuk Guest memasukkan Nomor HP untuk cek status.
     */
    public function showCheckStatusForm(Kegiatan $kegiatan)
    {
        return view('pendaftaran.check_status_form', compact('kegiatan'));
    }

    /**
     * Memproses pencarian status berdasarkan Nomor HP dan Kegiatan ID.
     */
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
     * Menampilkan hasil status pendaftaran untuk Guest.
     */
    public function showStatusResult(Kegiatan $kegiatan, Pendaftaran $pendaftaran)
    {
        if ($pendaftaran->kegiatan_id !== $kegiatan->id) {
            abort(404);
        }

        return view('pendaftaran.status_result', compact('kegiatan', 'pendaftaran'));
    }
}
