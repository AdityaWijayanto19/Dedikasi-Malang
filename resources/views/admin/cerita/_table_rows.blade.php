@forelse ($cerita as $item)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            @if($item->gambar)
                <img class="h-10 w-16 object-cover rounded"
                    src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}"
                    alt="{{ $item->title }}">
            @else
                <div class="h-10 w-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">No Image</div>
            @endif
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 max-w-sm" title="{{ $item->title }}">
            {{ Str::limit($item->title, 12) }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 max-w-sm" title="{{ $item->deskripsi }}">
            {!! \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 12, '...') !!}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ Str::limit($item->nama_penulis, 15)}}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 max-w-sm" title="{{ $item->jabatan }}">
            {{ Str::limit($item->jabatan, 10) }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $item->created_at->isoFormat('D MMM YYYY') }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <span class="px-2 py-1 rounded-full {{ $item->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $item->status ? 'Publish' : 'Draft' }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-2">
            <a href="{{ route('admin.cerita.edit', $item->id) }}"
                class="p-2 rounded-md bg-yellow-400 hover:bg-yellow-500 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-800" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" />
                </svg>
            </a>
            <form action="{{ route('admin.cerita.destroy', $item->id) }}" method="POST" class="inline-block" @click.prevent="$dispatch('open-delete-modal', { action: '{{ route('admin.cerita.destroy', $item->id) }}',
                                            title: 'Hapus Cerita',
                                            message: 'Apakah Anda yakin ingin menghapus Cerita \'{{ Str::limit($item->title, 30) }}\'? Data ini tidak dapat dikembalikan.'
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
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="px-6 py-10 text-center">

            <div class="flex flex-col items-center justify-center space-y-4">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" viewBox="0 0 640 640">
                    <path
                        d="M88 289.6L64.4 360.2L64.4 160C64.4 124.7 93.1 96 128.4 96L267.1 96C280.9 96 294.4 100.5 305.5 108.8L343.9 137.6C349.4 141.8 356.2 144 363.1 144L480.4 144C515.7 144 544.4 172.7 544.4 208L544.4 224L179 224C137.7 224 101 250.4 87.9 289.6zM509.8 512L131 512C98.2 512 75.1 479.9 85.5 448.8L133.5 304.8C140 285.2 158.4 272 179 272L557.8 272C590.6 272 613.7 304.1 603.3 335.2L555.3 479.2C548.8 498.8 530.4 512 509.8 512z" />
                </svg>

                <h3 class="text-xl font-semibold text-gray-700">
                    Belum Ada Cerita yang Ditambahkan
                </h3>

                <p class="text-sm text-gray-500 max-w-sm">
                    Tambahkan cerita baru untuk mulai mengisi tabel ini. Semua data cerita yang Anda buat akan muncul di
                    sini.
                </p>
            </div>

        </td>
    </tr>
@endforelse