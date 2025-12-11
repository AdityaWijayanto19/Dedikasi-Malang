@php
    use Illuminate\Support\Str;
    use App\Enums\PendaftaranStatus as RegistrationStatus;
@endphp

@extends('layouts.admin')
@section('title', 'Manajemen Pendaftaran Relawan - Dedikasi Malang')

@section('header')
    <div class="px-6 py-3 flex justify-between items-center shadow-sm rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Pendaftaran Relawan</h1>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 hover:text-red-400 text-red-600 cursor-pointer font-semibold py-2 rounded-lg transition-all duration-200">
                Logout
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
            </button>
        </form>
    </div>
@endsection

@section('content')
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <p class="text-gray-600 mb-6">Pilih kegiatan di bawah ini untuk melihat dan memverifikasi data pendaftar.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        {{-- BLOK UTAMA UNTUK MENANGANI ADA/TIDAK ADA DATA --}}
        @forelse ($kegiatans as $kegiatan)
            {{-- Bagian Card Kegiatan (Seperti sebelumnya) --}}
            <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-200 flex flex-col justify-between h-full hover:shadow-2xl transition-shadow duration-300">
                
                <div>
                    <span class="text-xs font-semibold px-2 py-1 rounded-full 
                        @if ($kegiatan->is_open_for_registration === RegistrationStatus::Buka) bg-green-100 text-green-800 
                        @else bg-red-100 text-red-800 @endif">
                        Pendaftaran: {{ $kegiatan->is_open_for_registration->label() }}
                    </span>
                    
                    <h3 class="text-xl font-bold mt-3 text-gray-800 line-clamp-2">
                        {{ $kegiatan->title }} ({{ $kegiatan->batch }})
                    </h3>
                    
                    <p class="text-sm text-gray-500 mt-1 mb-4">{{ Str::limit($kegiatan->lokasi, 17) }} | {{ $kegiatan->tanggal }}</p>

                    <hr class="my-3">
                    
                    <div class="grid grid-cols-3 gap-2 text-center text-sm mb-4">
                        <div>
                            <p class="text-gray-500">Total</p>
                            <span class="font-bold text-2xl text-gray-800">{{ $kegiatan->total_pendaftar }}</span>
                        </div>
                        <div>
                            <p class="text-gray-500">Pending</p>
                            <span class="font-bold text-2xl text-yellow-600">{{ $kegiatan->pending_count }}</span>
                        </div>
                        <div>
                            <p class="text-gray-500">Diterima</p>
                            <span class="font-bold text-2xl text-green-600">{{ $kegiatan->accepted_count }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-2 mt-4">
                    <a href="{{ route('admin.pendaftaran.show.kegiatan', $kegiatan) }}" 
                        class="w-full text-center py-2 px-4 rounded-lg text-white font-semibold 
                            @if ($kegiatan->pending_count > 0) bg-indigo-600 hover:bg-indigo-700 
                            @else bg-gray-500 hover:bg-gray-600 @endif transition-colors duration-300">
                        Kelola Pendaftar ({{ $kegiatan->pending_count }} Baru)
                    </a>
                    
                    <form action="{{ route('admin.pendaftaran.toggle.status', $kegiatan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                            class="w-full py-2 rounded-lg text-xs font-medium border
                            @if ($kegiatan->is_open_for_registration === RegistrationStatus::Buka) text-red-600 border-red-300 bg-red-50 hover:bg-red-100
                            @else text-green-600 border-green-300 bg-green-50 hover:bg-green-100 @endif transition-colors duration-300">
                            {{ $kegiatan->is_open_for_registration === RegistrationStatus::Buka ? 'TUTUP Pendaftaran' : 'BUKA Pendaftaran' }}
                        </button>
                    </form>
                </div>
            </div>
        @empty
            {{-- FALLBACK JIKA TIDAK ADA KEGIATAN --}}
            <div class="md:col-span-4 p-10 text-center bg-white rounded-lg shadow-xl border-2 border-dashed border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.826c.078.444.36.831.752 1.042 1.48.832 2.76 1.87 3.555 3.012a2.346 2.346 0 0 0 1.258 1.442v4.872a.75.75 0 0 1-.75.75H4.694a.75.75 0 0 1-.75-.75v-4.872c.407-.245.89-.588 1.44-.997.74-.53 1.554-1.22 2.228-2.062a3.868 3.868 0 0 0 1.077-1.396A1.5 1.5 0 0 1 11.35 3.826Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.721 14.283c-.702-.55-1.57-1.1-2.43-1.428a2.124 2.124 0 0 0-.466-1.53c-.34-.447-.796-.826-1.282-1.041a.75.75 0 0 1-.365-1.059 1.5 1.5 0 0 0-.419-.844c-.75-.68-1.55-1.2-2.3-1.425a1.5 1.5 0 0 0-.58-.198c-.469 0-1.01.12-1.516.355a1.5 1.5 0 0 0-.568 1.053c0 .354.19.7.534.921.432.28.895.597 1.35.945.474.356.97.77 1.46.994.492.224.992.336 1.49.336h.055c.343 0 .685-.084 1.01-.253.473-.243.882-.578 1.25-.975.337-.36.634-.738.89-1.126.31-.47.533-.974.67-1.515.138-.54.175-1.1.107-1.656a.75.75 0 0 1 .792-.705c.57.073 1.12.3 1.62.663a1.5 1.5 0 0 0 .532 1.314c.148.163.298.328.448.498.44.47.85 1.002 1.218 1.6.398.636.72 1.332.93 2.06.21.728.293 1.49.23 2.253a.75.75 0 0 1-.798.705Z" />
                </svg>

                <h4 class="font-bold text-xl text-gray-700 mb-2">Belum Ada Kegiatan Dibuat</h4>
                <p class="text-gray-500">Anda perlu membuat kegiatan terlebih dahulu agar pendaftaran bisa di kelola.</p>
                <a href="{{ route('admin.kegiatan.create') }}" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                    + Tambah Kegiatan Baru
                </a>
            </div>
        @endforelse
    </div>
@endsection