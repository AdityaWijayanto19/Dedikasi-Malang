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
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white p-8 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold text-indigo-700 mb-4">{{ $pendaftaran->full_name }}</h2>
            <p class="mb-4 text-sm text-gray-600">Mendaftar untuk Kegiatan: **{{ $pendaftaran->kegiatan->title }}**</p>

            <hr class="mb-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Data Diri --}}
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
                                class="text-blue-500 hover:underline">{{ $pendaftaran->akun_instagram }}</a></li>
                    </ul>
                </div>

                {{-- Alasan Mendaftar --}}
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

                @foreach ($buktiFiles as $label => $path)
                    <div class="border p-4 rounded-lg hover:bg-gray-50 transition duration-150">
                        <p class="font-medium mb-2 text-sm">{{ $label }}</p>
                        <a href="{{ Storage::url($path) }}" target="_blank"
                            class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.575 3.01 9.963 7.182a1.012 1.012 0 0 1 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.575-3.01-9.963-7.182Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Lihat Bukti
                        </a>
                    </div>
                @endforeach
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
        </div>
    </div>
@endsection