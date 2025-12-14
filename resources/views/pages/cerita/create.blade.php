<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kirim Tulisan</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/rlfut01sybdlz7kikxzo98lo0jo9ki0ep46bdf96m6bjhsnd/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<body class="bg-[#E9C153]">
    <header class="mt-10 flex flex-col items-center text-white">
        <h1 class="font-bold text-2xl md:text-4xl">FORM KIRIM TULISAN</h1>
        <h1 class="font-medium text-xl md:text-2xl">CERITA DEDIKASI</h1>
    </header>
    <main>
        <section class="px-6 md:px-30 w-full mt-5">
            <form action="{{ route('pages.cerita.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col rounded-t-4xl p-6 md:p-10 h-fit w-full bg-white shadow-lg shadow-neutral-500 max-w-3xl mx-auto">
                @csrf

                <div id="form-error"
                    class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 hidden"></div>

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block font-medium text-gray-700 mb-2">
                            Judul
                            <span class="text-red-500">*</span>
                        </label>
                        <input id="title" name="title" type="text"
                            placeholder="Contoh: Perjalanan Saya Bersama Dedikasi Malang"
                            class="w-full bg-neutral-100 p-3 rounded-xl border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                            minlength="5" maxlength="100" required>
                        <p class="text-xs text-gray-500 mt-1">Minimal 5 karakter, maksimal 100 karakter</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_penulis" class="block font-medium text-gray-700 mb-2">
                                Nama Penulis
                                <span class="text-red-500">*</span>
                            </label>
                            <input id="nama_penulis" name="nama_penulis" type="text"
                                placeholder="Contoh: Muhammad David"
                                class="w-full bg-neutral-100 p-3 rounded-xl border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                required>
                            <p class="text-xs text-gray-500 mt-1">Nama lengkap penulis cerita</p>
                        </div>

                        <div>
                            <label for="jabatan" class="block font-medium text-gray-700 mb-2">
                                Jabatan/Posisi
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="jabatan" name="jabatan"
                                placeholder="Contoh: Volunteer, Relawan, Staff"
                                class="w-full bg-neutral-100 p-3 rounded-xl border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                required>
                            <p class="text-xs text-gray-500 mt-1">Posisi atau jabatan Anda</p>
                        </div>
                    </div>

                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">
                            Upload Gambar Utama
                            <x-tooltip>
                                <p class="mb-2">Gunakan gambar rasio <strong>16:9</strong> dan ukuran maksimal
                                    <strong>2MB</strong>.
                                </p>
                            </x-tooltip>
                        </label>
                        <div id="file-drop-area"
                            class="file-drop-area relative w-full h-72 border-2 border-gray-300 border-dashed rounded-lg transition hover:border-yellow-400 hover:bg-yellow-50 cursor-pointer">

                            <div id="preview-container" class="absolute inset-0 p-2 hidden">
                                <img id="image-preview" src="" class="w-full h-full object-contain rounded-lg"
                                    alt="Image Preview">
                            </div>

                            <div id="upload-prompt"
                                class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-16 h-16 text-gray-400 mx-auto mb-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33A3 3 0 0116.5 19.5H6.75Z" />
                                </svg>
                                <p class="mt-2 text-sm"><span class="font-semibold text-yellow-500">Klik untuk
                                        memilih</span>
                                    atau seret & lepas
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF, WEBP (maks. 2MB)</p>
                            </div>

                            <input type="file" id="gambar" name="gambar"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                        </div>

                        <div id="file-error" class="text-red-500 text-xs mt-2 hidden"></div>
                        <div id="file-info" class="text-xs text-gray-600 mt-2"></div>
                        @error('gambar')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block font-medium text-gray-700 mb-2">
                            Cerita Kamu
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="12"
                            class="block w-full border-0 p-3 focus:ring-0 resize-y rounded-lg"
                            placeholder="Tuliskan pengalaman dan cerita menarik Anda bersama Dedikasi Malang..."></textarea>
                        <p class="text-xs text-gray-500 mt-1">Minimal 20 karakter, maksimal 5000 karakter</p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6 mb-2 gap-4">
                    <a href="javascript:history.back()"
                        class="px-6 py-2.5 bg-red-500 rounded-xl text-white font-medium hover:bg-red-600 focus:ring-4 focus:ring-red-300 transition text-center flex-1 shadow-sm">
                        Batal
                    </a>

                    <button type="submit" id="submit-btn"
                        class="px-6 py-2.5 bg-blue-600 rounded-xl text-white font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue         -300 transition flex-1 shadow-lg shadow-yellow-500/30 disabled:opacity-50 disabled:cursor-not-allowed">
                        Kirim Cerita
                    </button>
                </div>
            </form>
        </section>
    </main>
    <script>
        window.addEventListener('load', function () {
            if (typeof tinymce === 'undefined') {
                console.error('TinyMCE gagal dimuat');
                return;
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
                height: 400,
                autoresize_bottom_margin: 20,
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',

                file_picker_callback: (cb, value, meta) => {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/*';

                    input.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        const reader = new FileReader();

                        reader.onload = () => {
                            const id = 'blobid' + new Date().getTime();
                            const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            const base64 = reader.result.split(',')[1];
                            const blobInfo = blobCache.create(id, file, base64);

                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };

                        reader.readAsDataURL(file);
                    });

                    input.click();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const dropArea = document.getElementById('file-drop-area');
            const fileInput = document.getElementById('gambar');
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const uploadPrompt = document.getElementById('upload-prompt');
            const fileError = document.getElementById('file-error');
            const fileInfo = document.getElementById('file-info');
            const formError = document.getElementById('form-error');
            const submitBtn = document.getElementById('submit-btn');

            const MAX_SIZE = 2 * 1024 * 1024;
            const VALID_TYPES = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

            function validateFile(file) {
                if (!VALID_TYPES.includes(file.type)) {
                    return 'Format file tidak didukung (PNG, JPG, GIF, WEBP)';
                }
                if (file.size > MAX_SIZE) {
                    return 'Ukuran file maksimal 2MB';
                }
                return null;
            }

            function showPreview(file) {
                const reader = new FileReader();
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                    fileError.classList.add('hidden');
                    fileInfo.textContent = `${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
                };
                reader.readAsDataURL(file);
            }

            function showError(message) {
                fileError.textContent = message;
                fileError.classList.remove('hidden');
                previewContainer.classList.add('hidden');
                uploadPrompt.classList.remove('hidden');
            }

            fileInput.addEventListener('change', () => {
                if (!fileInput.files.length) return;
                const file = fileInput.files[0];
                const error = validateFile(file);
                if (error) {
                    showError(error);
                    fileInput.value = '';
                } else {
                    showPreview(file);
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
                    dropArea.classList.add('border-yellow-500', 'bg-yellow-50');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropArea.addEventListener(evt, () => {
                    dropArea.classList.remove('border-yellow-500', 'bg-yellow-50');
                });
            });

            dropArea.addEventListener('drop', e => {
                const file = e.dataTransfer.files[0];
                if (!file) return;
                const error = validateFile(file);
                if (error) {
                    showError(error);
                } else {
                    fileInput.files = e.dataTransfer.files;
                    showPreview(file);
                }
            });

            form.addEventListener('submit', function (e) {
                formError.classList.add('hidden');

                const title = document.getElementById('title').value.trim();
                const nama = document.getElementById('nama_penulis').value.trim();
                const jabatan = document.getElementById('jabatan').value.trim();
                const deskripsi = tinymce.get('deskripsi')?.getContent({ format: 'text' }).trim() || '';

                let error = '';

                if (title.length < 5) error = 'Judul minimal 5 karakter';
                else if (!nama) error = 'Nama penulis wajib diisi';
                else if (!jabatan) error = 'Jabatan wajib diisi';
                else if (deskripsi.length < 20) error = 'Cerita minimal 20 karakter';
                else if (!fileInput.files.length) error = 'Gambar wajib diupload';

                if (error) {
                    e.preventDefault();
                    formError.textContent = error;
                    formError.classList.remove('hidden');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Mengirim...';
                }
            });
        });
    </script>
</body>

</html>