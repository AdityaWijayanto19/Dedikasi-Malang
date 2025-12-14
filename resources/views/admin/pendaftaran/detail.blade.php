@extends('layouts.admin')
@section('title', 'Detail Verifikasi Pendaftar - Dedikasi Malang')

@section('header')
    <div class="px-6 py-3 flex items-center shadow-sm rounded-lg">
        <a href="{{ route('admin.pendaftaran.show.kegiatan', $pendaftaran->kegiatan) }}"
            class="inline-flex mr-3 items-center text-black hover:text-shadow-gray-800 font-extrabold transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Detail Verifikasi Pendaftar</h1>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white p-8 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold text-indigo-700 mb-4">{{ $pendaftaran->full_name }}</h2>
            <p class="mb-4 text-sm text-gray-600">Mendaftar untuk Kegiatan: <strong>{{ $pendaftaran->kegiatan->title }}</strong></p>

            <hr class="mb-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-xl font-semibold mb-3 border-b pb-2">Informasi Pendaftar</h3>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li><strong>Domisili:</strong> {{ $pendaftaran->domisili }}</li>
                        <li><strong>Usia:</strong> {{ $pendaftaran->usia }} tahun</li>
                        <li><strong>Jenis Kelamin:</strong>
                            {{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</li>
                        <li><strong>Instansi/Sekolah:</strong> {{ $pendaftaran->instansi }}</li>
                        <li><strong>No. HP/WA:</strong> <span
                                class="font-mono bg-gray-100 p-1 rounded">{{ $pendaftaran->phone_number }}</span></li>
                        <li><strong>Akun Instagram:</strong> <a
                                href="https://instagram.com/{{ $pendaftaran->akun_instagram }}" target="_blank"
                                class="text-blue-500 hover:underline">@<span>{{ $pendaftaran->akun_instagram }}</span></a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-3 border-b pb-2">Alasan Bergabung</h3>
                    <p class="bg-indigo-50 p-4 rounded-lg text-gray-700 italic">
                        "{{ $pendaftaran->alasan_mendaftar }}"
                    </p>
                </div>
            </div>

            <h3 class="text-xl font-semibold mt-8 mb-4 border-b pb-2">Bukti Persyaratan (Verifikasi File)</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">

                @php
                    $buktiFiles = [
                        'Bukti Follow TikTok' => $pendaftaran->bukti_follow_tiktok,
                        'Bukti Follow Instagram' => $pendaftaran->bukti_follow_instagram,
                        'Bukti Pembayaran' => $pendaftaran->bukti_pembayaran,
                    ];
                @endphp

                @forelse ($buktiFiles as $label => $path)
                    @php
                        $trimmedPath = trim((string)$path);
                        $fileExists = !empty($trimmedPath) && \Illuminate\Support\Facades\Storage::disk('public')->exists($trimmedPath);
                    @endphp
                    <div class="border p-4 rounded-lg hover:bg-gray-50 transition duration-150">
                        <p class="font-medium mb-2 text-sm">{{ $label }}</p>
                        @if($fileExists)
                            <button onclick="openImageModal('{{ asset('storage/' . $trimmedPath) }}')"
                                class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-800 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.575 3.01 9.963 7.182a1.012 1.012 0 0 1 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.575-3.01-9.963-7.182Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                Lihat Bukti
                            </button>
                        @else
                            <span class="text-sm text-red-600 font-medium">File tidak ditemukan di server</span>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 text-center text-red-600">Tidak ada file bukti yang tersimpan.</div>
                @endforelse
            </div>
        </div>

        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-xl sticky top-6 self-start">
            <h3 class="text-xl font-bold mb-4 border-b pb-2 text-gray-800">Aksi Verifikasi</h3>

            <div class="mb-4 p-3 rounded-lg border-2 
                                        @if ($pendaftaran->status == 'accepted') border-green-400 bg-green-50
                                        @elseif ($pendaftaran->status == 'rejected') border-red-400 bg-red-50
                                        @else border-yellow-400 bg-yellow-50 @endif">
                Status Saat Ini:
                <span class="font-extrabold text-xl">{{ ucfirst($pendaftaran->status) }}</span>
            </div>

            <form action="{{ route('admin.pendaftaran.update.status', $pendaftaran) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="status_action" class="block font-medium mb-2 text-gray-700">Ubah Status Menjadi:</label>
                <select name="status" id="status_action"
                    class="w-full p-3 border border-gray-300 rounded-lg mb-4 text-gray-700">
                    <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>Pending (Perlu Dicek)
                    </option>
                    <option value="accepted" {{ $pendaftaran->status == 'accepted' ? 'selected' : '' }}>ACCEPTED (Diterima)
                    </option>
                    <option value="rejected" {{ $pendaftaran->status == 'rejected' ? 'selected' : '' }}>REJECTED (Ditolak)
                    </option>
                </select>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Simpan Status Verifikasi
                </button>
            </form>

            @if($pendaftaran->status == 'rejected')
                <div class="mt-6 pt-6 border-t">
                    <p class="text-sm text-gray-600 mb-3">Data yang di-reject bisa dihapus permanent:</p>
                    <form id="deleteForm" action="{{ route('admin.pendaftaran.delete', $pendaftaran) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="showDeleteConfirmation()"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition-colors duration-300 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Hapus Data Pendaftaran
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div id="imageModal"
        class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Lihat Bukti Pendaftaran</h2>
                <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div class="flex-1 overflow-auto flex items-center justify-center bg-gray-100 p-4">
                <img id="modalImage" src="" alt="Bukti" class="max-w-full max-h-full object-contain">
            </div>
            <div class="p-4 border-t bg-gray-50">
                <a id="downloadLink" href="" download
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
                    Download Gambar
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openImageModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const downloadLink = document.getElementById('downloadLink');

            // Load image dengan error handling
            modalImage.src = imageUrl;
            modalImage.onerror = function() {
                alert('Gagal memuat gambar. Path mungkin tidak sesuai.');
                console.error('Image URL:', imageUrl);
            };
            
            downloadLink.href = imageUrl;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('imageModal')?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        function showDeleteConfirmation() {
            Swal.fire({
                title: 'Hapus Data Pendaftaran?',
                html: `<p class="text-sm text-gray-600">Data pendaftaran <strong>{{ $pendaftaran->full_name }}</strong> akan dihapus secara permanent.</p>
                       <p class="text-sm text-red-600 mt-2"><strong>Perhatian:</strong> Semua file bukti juga akan dihapus dan tidak bisa dikembalikan.</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                allowOutsideClick: false,
                allowEscapeKey: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
@endsection