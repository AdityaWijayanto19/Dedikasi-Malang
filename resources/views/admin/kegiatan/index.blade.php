@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.admin')
@section('title', 'Manajemen Kegiatan - Dedikasi Malang')
@section('header')
    <div class="px-6 py-3 flex justify-between items-center shadow-sm rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Kegiatan</h1>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 hover:text-red-400 text-red-600 cursor-pointer font-semibold py-2 rounded-lg transition-all duration-200">
                Logout
                <svg xmlns="http://www.w.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
            </button>
        </form>
    </div>
@endsection

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div class="relative w-full max-w-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-5 h-5 text-gray-400">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" id="searchInput"
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-yellow focus:border-primary-yellow sm:text-sm"
                placeholder="Cari berdasarkan judul, tanggal...">
        </div>

        <a href="{{ route('admin.kegiatan.create') }}"
            class="inline-flex items-center bg-yellow-200 text-yellow-600 font-semibold py-2 px-5 rounded-lg shadow-md hover:bg-yellow-300 transition-colors duration-300 ml-4 flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2">
                <path
                    d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
            </svg>
            <span>Tambah Kegiatan</span>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-x-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Gambar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        batch</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Lokasi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi</th>
                </tr>
            </thead>
            <tbody id="kegiatanTableBody" class="bg-white divide-y divide-gray-200">
                @include('admin.kegiatan._table_rows', ['kegiatan' => $kegiatan])
            </tbody>
        </table>
        <div id="pagination-container" class="px-6 py-4 border-t border-gray-200">
            {{ $kegiatan->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('kegiatanTableBody');
            const paginationContainer = document.getElementById('pagination-container');
            const searchUrl = "{{ route('admin.kegiatan.search') }}";
            const originalUrl = "{{ route('admin.kegiatan.index') }}"; 
            let debounceTimer;

            function debounce(func, delay) {
                return function (...args) {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        func.apply(this, args);
                    }, delay);
                };
            }

            function performSearch(query) {
                if (query.trim() === '') {
                    window.location.href = originalUrl;
                    return; 
                }

                paginationContainer.style.display = 'none';

                fetch(`${searchUrl}?search=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(html => {
                        tableBody.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        tableBody.innerHTML = `<tr><td colspan="7" class="text-center text-red-500 py-10">Gagal memuat data. Silakan coba lagi.</td></tr>`;
                    });
            }

            searchInput.addEventListener('input', debounce(function () {
                performSearch(this.value);
            }, 350)); 
        });
    </script>
@endpush