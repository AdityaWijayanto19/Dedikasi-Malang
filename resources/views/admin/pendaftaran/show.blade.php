@extends('layouts.admin')
@section('title', 'Pendaftar - Dedikasi Malang')

@section('header')
    <div class="px-6 py-3 flex items-center shadow-sm rounded-lg">
        <a href="{{ route('admin.pendaftaran.index') }}"
            class="inline-flex mr-3 items-center text-black hover:text-shadow-gray-800 font-extrabold transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Pendaftar: {{ $kegiatan->title }}</h1>
    </div>
@endsection

@section('content')

    <div class="mb-4">
        <h3 class="text-xl font-semibold">Status Pendaftaran Kegiatan:</h3>
        @php
            use App\Enums\PendaftaranStatus as RegistrationStatus;
            $isOpen = $kegiatan->is_open_for_registration === RegistrationStatus::Buka;
        @endphp
        <span class="text-2xl font-bold 
                                {{ $isOpen ? 'text-green-600' : 'text-red-600' }}">
            {{ $kegiatan->is_open_for_registration->label() }}
        </span>

        <form action="{{ route('admin.pendaftaran.toggle.status', $kegiatan) }}" method="POST" class="inline ml-4">
            @csrf
            @method('PUT')
            <button type="submit"
                class="py-1 px-3 rounded text-sm font-medium 
                                    {{ $isOpen ? 'bg-red-500 hover:bg-red-600 text-white' : 'bg-green-500 hover:bg-green-600 text-white' }}">
                {{ $isOpen ? 'Tutup Pendaftaran' : 'Buka Pendaftaran' }}
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-x-auto">

        @if ($pendaftarans->isEmpty())
            <div class="p-10 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-12 h-12 mx-auto text-gray-400 mb-4">
                    <path
                        d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                    <path fill-rule="evenodd"
                        d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.133 2.845a.75.75 0 0 1 1.06 0l1.72 1.72 1.72-1.72a.75.75 0 1 1 1.06 1.06l-1.72 1.72 1.72 1.72a.75.75 0 1 1-1.06 1.06L12 15.685l-1.72 1.72a.75.75 0 1 1-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>
                <h4 class="font-bold text-xl text-gray-700 mb-2">Belum Ada Pendaftar</h4>
                <p class="text-gray-500">Saat ini belum ada pendaftar yang masuk untuk kegiatan
                    <strong>{{ $kegiatan->title }}.</strong></p>
                <p class="text-sm text-gray-500 mt-2">Pastikan status pendaftaran kegiatan di atas sudah <strong>Buka</strong>.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pendaftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. HP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($pendaftarans as $pendaftaran)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pendaftaran->full_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pendaftaran->phone_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ Str::limit($pendaftaran->instansi, 30) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pendaftaran->is_member ? 'Member' : 'Non-member' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pendaftaran->size ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                                                @if ($pendaftaran->status == 'accepted') bg-green-100 text-green-800
                                                                                                @elseif ($pendaftaran->status == 'rejected') bg-red-100 text-red-800
                                                                                                @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($pendaftaran->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.pendaftaran.detail.pendaftar', $pendaftaran) }}"
                                    class="text-indigo-600 hover:text-indigo-900 text-xs font-semibold">
                                    Check & Verifikasi
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $pendaftarans->links() }}
            </div>
        @endif

    </div>
@endsection