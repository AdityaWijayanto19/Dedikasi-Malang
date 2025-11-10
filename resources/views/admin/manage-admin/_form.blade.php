@php
    $isEdit = isset($admin);
@endphp

<form action="{{ $isEdit ? route('admin.manage-admin.update', $admin->id) : route('admin.manage-admin.store') }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $isEdit ? $admin->name : '') }}"
                        class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3 focus:border-primary-yellow focus:ring focus:ring-primary-yellow/50 transition duration-150"
                        placeholder="Contoh: Dedi Cahyadi">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3 focus:border-primary-yellow focus:ring focus:ring-primary-yellow/50 transition duration-150">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $isEdit ? $admin->email : '') }}"
                    class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3 focus:border-primary-yellow focus:ring focus:ring-primary-yellow/50 transition duration-150"
                    placeholder="Contoh: user@gmail.com">
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                    Upload Gambar Utama
                    <x-tooltip>
                        <p class="mb-2">Gunakan gambar rasio <strong>16:9</strong> dan ukuran maksimal
                            <strong>2MB</strong>.
                        </p>
                    </x-tooltip>
                </label>
                <div id="file-drop-area"
                    class="file-drop-area relative w-full h-64 border-2 border-gray-300 border-dashed rounded-md transition hover:border-yellow-400">

                    <div id="preview-container"
                        class="absolute inset-0 p-2 @unless($isEdit && $admin->gambar) hidden @endunless">
                        @if ($isEdit && $admin->gambar)
                            @php
                                $imageUrl = Str::startsWith($admin->gambar, 'http') ? $admin->gambar : asset('storage/' . $admin->gambar);
                            @endphp
                            <img id="image-preview" src="{{ $imageUrl }}" class="w-full h-full object-contain rounded-lg"
                                alt="Image Preview">
                        @else
                            <img id="image-preview" src="" class="w-full h-full object-contain rounded-lg"
                                alt="Image Preview">
                        @endif
                    </div>

                    <div id="upload-prompt"
                        class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 @if(isset($admin) && $admin->gambar) opacity-0 hover:opacity-100 bg-black/50 text-white transition-opacity @endif">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48" aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="mt-2 text-sm"><span class="font-semibold text-yellow-500">Klik untuk memilih</span>
                            atau seret & lepas
                        </p>
                        <p class="text-xs text-blue-light">PNG, JPG, GIF, WEBP (maks. 2MB)</p>
                    </div>

                    <input type="file" id="gambar" name="gambar"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                </div>

                @error('gambar')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status"
                        class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3 focus:border-primary-yellow focus:ring focus:ring-primary-yellow/50 transition duration-150">
                        @php
                            $currentStatusValue = old('status', $isEdit ? $admin->status->value : null);
                        @endphp
                        <option value="0" @selected((int) $currentStatusValue === 0)>Block</option>
                        <option value="1" @selected((int) $currentStatusValue === 1)>Aktif</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 mt-8 pt-6 flex items-center justify-end space-x-3">
            <a href="{{ route('admin.manage-admin.index') }}"
                class="bg-white py-2 px-5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit"
                class="inline-flex justify-center py-2 px-5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-gray-800 bg-primary-yellow hover:bg-yellow-400 focus:outline-none">
                Simpan Data Admin
            </button>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('toggle');
            const statusText = document.getElementById('status-text');
            if (toggle) {
                toggle.addEventListener('change', function () {
                    statusText.textContent = this.checked ? 'Aktif' : 'Nonaktif';
                });
            }

            const dropArea = document.getElementById('file-drop-area');
            const fileInput = document.getElementById('gambar');
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const uploadPrompt = document.getElementById('upload-prompt');

            function showPreview(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');

                    uploadPrompt.classList.add('opacity-0', 'hover:opacity-100', 'bg-black/50', 'text-white');
                }
                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    showPreview(fileInput.files[0]);
                }
            });

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.add('is-dragging'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.remove('is-dragging'), false);
            });

            dropArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    showPreview(files[0]);
                }
            }, false);
        });

    </script>
@endpush