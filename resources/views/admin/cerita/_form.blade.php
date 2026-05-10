@php
    $isEdit = isset($cerita);
@endphp

<form action="{{ $isEdit ? route('admin.cerita.update', $cerita->id) : route('admin.cerita.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="space-y-8">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title', $isEdit ? $cerita->title : '') }}"
                    class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3 focus:border-primary-yellow focus:ring focus:ring-primary-yellow/50 transition duration-150"
                    placeholder="Ketik judul cerita di sini...">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_penulis" class="block text-sm font-medium text-gray-700 mb-1">Nama Penulis</label>
                    <input type="text" name="nama_penulis" id="title"
                        value="{{ old('nama_penulis', $isEdit ? $cerita->nama_penulis : '') }}"
                        class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3 focus:border-primary-yellow focus:ring focus:ring-primary-yellow/50 transition duration-150"
                        placeholder="Ketik nama penulis di sini...">
                </div>
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" name="jabatan" id="title"
                        value="{{ old('jabatan', $isEdit ? $cerita->jabatan : '') }}"
                        class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3 focus:border-primary-yellow focus:ring focus:ring-primary-yellow/50 transition duration-150"
                        placeholder="Ketik jabatan cerita di sini...">
                </div>
            </div>

            <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Status Cerita
            </label>

            <select name="status" class="block w-full rounded-lg border-gray-300 shadow-sm py-2 px-3">

                <option value=1 {{ old('status', $isEdit ? $cerita->status : 1) == 1 ? 'selected' : '' }}>
                    Publish
                </option>

                <option value=0 {{ old('status', $isEdit ? $cerita->status : 1) == 0 ? 'selected' : '' }}>
                    Draft
                </option>
            </select>
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
                        class="absolute inset-0 p-2 @unless($isEdit && $cerita->gambar) hidden @endunless">
                        @if ($isEdit && $cerita->gambar)
                            @php
                                $imageUrl = Str::startsWith($cerita->gambar, 'http') ? $cerita->gambar : asset('storage/' . $cerita->gambar);
                            @endphp
                            <img id="image-preview" src="{{ $imageUrl }}" class="w-full h-full object-contain rounded-lg"
                                alt="Image Preview">
                        @else
                            <img id="image-preview" src="" class="w-full h-full object-contain rounded-lg"
                                alt="Image Preview">
                        @endif
                    </div>

                    <div id="upload-prompt"
                        class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 @if(isset($cerita) && $cerita->gambar) opacity-0 hover:opacity-100 bg-black/50 text-white transition-opacity @endif">
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

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                    Isi Cerita
                    <x-tooltip>
                        <p class="mb-2">Apabila anda <strong>tidak paham</strong> dengan TinyMCE silahkan cari dan
                            <strong>pelajari terlebih dahulu</strong>.
                        </p>
                        <a target="blank" href="https://www.tiny.cloud/docs/tinymce/latest/how-to-guides/"
                            class="text-blue-400 hover:underline text-xs">Baca panduan lengkap</a>
                    </x-tooltip>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="12"
                    class="block w-full border-0 p-3 focus:ring-0 resize-y"
                    placeholder="Mulai tulis ceritamu di sini...">{{ old('deskripsi', $isEdit ? $cerita->deskripsi : '') }}</textarea>
            </div>
        </div>

        <div class="border-t border-gray-200 mt-8 pt-6 flex items-center justify-end space-x-3">
            <a href="{{ route('admin.cerita.index') }}"
                class="bg-white py-2 px-5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit"
                class="inline-flex justify-center py-2 px-5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-gray-800 bg-primary-yellow hover:bg-yellow-400 focus:outline-none">
                Simpan Cerita
            </button>
        </div>

    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const toggle = document.getElementById('toggle');
            const statusText = document.getElementById('status-text');

            if (toggle && statusText) {
                toggle.addEventListener('change', function () {
                    statusText.textContent = this.checked ? 'Aktif' : 'Nonaktif';
                });
            }

            const dropArea = document.getElementById('file-drop-area');
            const fileInput = document.getElementById('gambar');
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const uploadPrompt = document.getElementById('upload-prompt');

            if (!dropArea || !fileInput) return;

            function showPreview(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');

                    uploadPrompt.classList.add(
                        'opacity-0',
                        'hover:opacity-100',
                        'bg-black/50',
                        'text-white'
                    );
                };
                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    showPreview(fileInput.files[0]);
                }
            });

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
                dropArea.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            ['dragenter', 'dragover'].forEach(evt => {
                dropArea.addEventListener(evt, () => {
                    dropArea.classList.add('is-dragging');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropArea.addEventListener(evt, () => {
                    dropArea.classList.remove('is-dragging');
                });
            });

            dropArea.addEventListener('drop', e => {
                const file = e.dataTransfer.files[0];
                if (file) {
                    fileInput.files = e.dataTransfer.files;
                    showPreview(file);
                }
            });
        });

        window.addEventListener('load', function () {

            if (typeof tinymce === 'undefined') {
                console.error('TinyMCE gagal dimuat (CDN tidak tersedia)');
                return;
            }

            if (tinymce.get('deskripsi')) {
                tinymce.remove('#deskripsi');
            }

            tinymce.init({
                selector: 'textarea#deskripsi',
                menubar: false,
                branding: false,

                plugins: 'autoresize image link media lists table wordcount preview fullscreen',
                toolbar: 'undo redo | blocks | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | fullscreen preview',

                skin: 'oxide',
                content_css: 'default',

                content_style: `
                    ::selection {
                        background-color: #FEEA6E !important;
                        color: #1f2937 !important;
                    }
                    ::-moz-selection {
                        background-color: #FEEA6E !important;
                        color: #1f2937 !important;
                    }
                `,

                height: 500,
                autoresize_bottom_margin: 20,

                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',

                file_picker_callback: function (cb, value, meta) {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/*';

                    input.onchange = function () {
                        const file = this.files[0];
                        if (!file) return;

                        const reader = new FileReader();
                        reader.onload = function () {
                            const id = 'blobid' + new Date().getTime();
                            const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            const base64 = reader.result.split(',')[1];
                            const blobInfo = blobCache.create(id, file, base64);

                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                }
            });
        });
    </script>
@endpush