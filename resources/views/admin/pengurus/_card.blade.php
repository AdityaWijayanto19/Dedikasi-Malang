<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">

    @if($pengurus->isEmpty())
        <div class="col-span-full text-center py-10 text-gray-500">
            <div class="flex flex-col items-center justify-center space-y-4">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" viewBox="0 0 640 640">
                    <path
                        d="M88 289.6L64.4 360.2L64.4 160C64.4 124.7 93.1 96 128.4 96L267.1 96C280.9 96 294.4 100.5 305.5 108.8L343.9 137.6C349.4 141.8 356.2 144 363.1 144L480.4 144C515.7 144 544.4 172.7 544.4 208L544.4 224L179 224C137.7 224 101 250.4 87.9 289.6zM509.8 512L131 512C98.2 512 75.1 479.9 85.5 448.8L133.5 304.8C140 285.2 158.4 272 179 272L557.8 272C590.6 272 613.7 304.1 603.3 335.2L555.3 479.2C548.8 498.8 530.4 512 509.8 512z" />
                </svg>

                <h3 class="text-xl font-semibold text-gray-700">
                    Belum Ada pengurus yang Ditambahkan
                </h3>

                <p class="text-sm text-gray-500 max-w-sm">
                    Tambahkan pengurus baru untuk mulai mengisi tabel ini. Semua data pengurus yang Anda buat akan muncul di
                    sini.
                </p>
            </div>
        </div>
    @else
        @foreach ($pengurus as $p)
            <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col items-center">
                @if($p->gambar)
                    <img class="w-24 h-24 rounded-full object-cover shadow-lg"
                        src="{{ Str::startsWith($p->gambar, 'http') ? $p->gambar : asset('storage/' . $p->gambar) }}"
                        alt="{{ $p->nama }}">
                @else
                    <div class="h-10 w-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">No Image</div>
                @endif

                <h3 class="mt-4 text-lg font-semibold text-gray-800">{{ Str::limit($p->nama, 15) }}</h3>
                <p class="text-sm text-gray-600">{{ $p->jabatan }}</p>
                <p class="mt-1 text-xs text-gray-400">Periode {{ $p->periode }}</p>
                <p class="mt-1 text-sm font-medium px-2 py-1 rounded-full {{ $p->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $p->status ? 'Active' : 'Purna' }}
                </p>

                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('admin.pengurus.edit', $p->id) }}"
                        class="p-2 rounded-md bg-yellow-400 hover:bg-yellow-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-800" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" />
                        </svg>
                    </a>
                    <form action="{{ route('admin.pengurus.destroy', $p->id) }}" method="POST" class="inline-block"
                        @click.prevent="$dispatch('open-delete-modal', { action: '{{ route('admin.pengurus.destroy', $p->id) }}',
                                                                title: 'Hapus pengurus',
                                                                message: 'Apakah Anda yakin ingin menghapus pengurus \'{{ Str::limit($p->nama, 20) }}\'? Data ini tidak dapat dikembalikan.'
                                                            })">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-md bg-red-500 hover:bg-red-600 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>