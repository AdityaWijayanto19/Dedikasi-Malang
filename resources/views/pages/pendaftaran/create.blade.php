        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>form pendaftaran</title>

            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
                rel="stylesheet">

            <!-- Font Awesome Icons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
            @vite('resources/css/app.css')
        </head>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
<body class="bg-[#E9C153]">
    

       <header class="mt-10 flex flex-col items-center text-white text-center px-4">
        <h1 class="font-bold text-2xl md:text-4xl">FORM PENDAFTARAN</h1>
        {{-- Mengambil data batch dan title dari objek $kegiatan --}}
        <h2 class="font-medium text-xl md:text-2xl">{{ $kegiatan->title }} ({{ $kegiatan->batch }})</h2>
    </header>

    <main>
        <section class="px-6 md:px-30 mt-5">
            {{-- Tambahkan MX-AUTO untuk membatasi lebar di layar besar --}}
            <form action="{{ route('pages.pendaftaran.store', $kegiatan) }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col rounded-t-4xl p-6 md:p-10 h-fit w-full bg-white shadow-lg shadow-neutral-500 max-w-3xl mx-auto">
                @csrf 
                
                {{-- Menampilkan pesan error atau sukses dari controller --}}
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                
                {{-- 1. NAMA LENGKAP --}}
                <div class="mb-5">
                    <label for="full_name" class="block font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input id="full_name" name="full_name" type="text" placeholder="Contoh: Mohammad David"
                        value="{{ old('full_name') }}"
                        class="w-full bg-neutral-100 p-3 rounded-xl border @error('full_name') border-red-500 @else border-transparent @enderror"
                        required>
                    @error('full_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 2. DOMISILI SEKARANG --}}
                <div class="mb-5">
                    <label for="domisili" class="block font-medium text-gray-700 mb-2">Domisili Sekarang</label>
                    <input id="domisili" name="domisili" type="text" placeholder="Contoh: Kota Malang"
                        value="{{ old('domisili') }}"
                        class="w-full bg-neutral-100 p-3 rounded-xl border @error('domisili') border-red-500 @else border-transparent @enderror"
                        required>
                    @error('domisili')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 3. JENIS KELAMIN (name=jenis_kelamin) --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            {{-- NAME: jenis_kelamin (sesuai controller) VALUE: L/P (sesuai controller) --}}
                            <input type="radio" name="jenis_kelamin" value="L"
                                {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}
                                class="appearance-none w-5 h-5 rounded-full border-2 border-gray-400 checked:bg-blue-500 checked:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                            <span>Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="P"
                                {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                                class="appearance-none w-5 h-5 rounded-full border-2 border-gray-400 checked:bg-pink-500 checked:border-pink-500 focus:ring-2 focus:ring-pink-200 transition">
                            <span>Perempuan</span>
                        </label>
                    </div>
                    @error('jenis_kelamin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 4. USIA --}}
                <div class="mb-5">
                    <label for="usia" class="block font-medium text-gray-700 mb-2">Usia</label>
                    <input type="number" id="usia" name="usia" placeholder="19" min="1"
                        value="{{ old('usia') }}"
                        class="w-full bg-neutral-100 p-3 rounded-xl border @error('usia') border-red-500 @else border-transparent @enderror"
                        required>
                    @error('usia')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 5. NO. HP (WhatsApp) (name=phone_number) --}}
                <div class="mb-5">
                    <label for="phone_number" class="block font-medium text-gray-700 mb-2">No. HP (WhatsApp)</label>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="Contoh: 081234567890"
                        value="{{ old('phone_number') }}"
                        class="w-full bg-neutral-100 p-3 rounded-xl border @error('phone_number') border-red-500 @else border-transparent @enderror"
                        required>
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 6. AKUN INSTAGRAM (name=akun_instagram) --}}
                <div class="mb-5">
                    <label for="akun_instagram" class="block font-medium text-gray-700 mb-2">Akun Instagram</label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-500">@</span>
                        </div>

                        <input type="text" id="akun_instagram" name="akun_instagram" placeholder="username_instagram"
                            value="{{ old('akun_instagram') }}"
                            class="w-full bg-neutral-100 p-3 pl-8 rounded-xl border @error('akun_instagram') border-red-500 @else border-transparent @enderror"
                            required>
                    </div>

                    @error('akun_instagram')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 7. INSTANSI --}}
                <div class="mb-5">
                    <label for="instansi" class="block font-medium text-gray-700 mb-2">Instansi
                        (Sekolah/Universitas/Kerja)</label>
                    <input type="text" id="instansi" name="instansi" placeholder="Universitas Brawijaya"
                        value="{{ old('instansi') }}"
                        class="w-full bg-neutral-100 p-3 rounded-xl border @error('instansi') border-red-500 @else border-transparent @enderror"
                        required>
                    @error('instansi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 8. ALASAN MENGIKUTI KEGIATAN (name=alasan_mendaftar) --}}
                <div class="mb-5">
                    <label for="alasan_mendaftar" class="block font-medium text-gray-700 mb-2">Alasan Mengikuti Kegiatan</label>
                    <textarea name="alasan_mendaftar" id="alasan_mendaftar" rows="4" placeholder="Tuliskan alasanmu di sini..."
                        class="w-full bg-neutral-100 p-3 rounded-xl border @error('alasan_mendaftar') border-red-500 @else border-transparent @enderror"
                        required>{{ old('alasan_mendaftar') }}</textarea>
                    @error('alasan_mendaftar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 9. DOKUMEN PENDUKUNG --}}
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 mb-6 space-y-4">
                    <h3 class="font-semibold text-gray-800">Dokumen Pendukung</h3>

                    {{-- Bukti Follow TikTok (name=bukti_follow_tiktok) --}}
                    <div>
                        <label for="bukti_follow_tiktok" class="block text-sm font-medium text-gray-700 mb-1">Bukti Follow TikTok
                            @dedikasimalang</label>
                        <input type="file" id="bukti_follow_tiktok" name="bukti_follow_tiktok" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"
                            required>
                        @error('bukti_follow_tiktok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bukti Follow Instagram (name=bukti_follow_instagram) --}}
                    <div>
                        <label for="bukti_follow_instagram" class="block text-sm font-medium text-gray-700 mb-1">Bukti Follow Instagram
                            @dedikasimalang</label>
                        <input type="file" id="bukti_follow_instagram" name="bukti_follow_instagram" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"
                            required>
                        @error('bukti_follow_instagram')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bukti Pembayaran (name=bukti_pembayaran) --}}
                    <div>
                        <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Bukti
                            Pembayaran</label>

                        <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 mb-3 text-sm text-blue-800">
                            {{-- Informasi transfer, pastikan data ini sudah benar --}}
                            <p class="font-bold">BRI: 388301029202539</p>
                            <p>A.N: SHOFIYYAH FITHRI</p>
                            <p class="text-xs mt-1 text-blue-600">*Format berita: NAMA_DEDIKASIMALANG</p>
                        </div>

                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*, application/pdf"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"
                            required>
                        @error('bukti_pembayaran')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between items-center mt-4 mb-2">
                    {{-- Tombol Batal diarahkan ke detail kegiatan --}}
                    <a href="{{ route('pages.kegiatan.show', $kegiatan->slug) }}"
                        class="px-6 py-2.5 bg-red-500 rounded-xl text-white font-medium hover:bg-red-600 transition text-center w-32 shadow-sm">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 rounded-xl text-white font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition w-32 shadow-lg shadow-blue-500/30">
                        Kirim
                    </button>
                </div>
            </form>
        </section>
    </main>

    <script>
        // Setup file upload functionality untuk ketiga input
        const fileConfigs = [
            { dropAreaId: 'file-drop-area-tiktok', inputId: 'bukti_follow_tiktok', previewContainerId: 'preview-container-tiktok', imagePreviewId: 'image-preview-tiktok', uploadPromptId: 'upload-prompt-tiktok' },
            { dropAreaId: 'file-drop-area-instagram', inputId: 'bukti_follow_instagram', previewContainerId: 'preview-container-instagram', imagePreviewId: 'image-preview-instagram', uploadPromptId: 'upload-prompt-instagram' },
            { dropAreaId: 'file-drop-area-pembayaran', inputId: 'bukti_pembayaran', previewContainerId: 'preview-container-pembayaran', imagePreviewId: 'image-preview-pembayaran', uploadPromptId: 'upload-prompt-pembayaran' }
        ];

        fileConfigs.forEach(config => {
            const dropArea = document.getElementById(config.dropAreaId);
            const fileInput = document.getElementById(config.inputId);
            const previewContainer = document.getElementById(config.previewContainerId);
            const imagePreview = document.getElementById(config.imagePreviewId);
            const uploadPrompt = document.getElementById(config.uploadPromptId);

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
                dropArea.addEventListener(eventName, () => {
                    dropArea.classList.add('border-blue-500', 'bg-blue-50');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => {
                    dropArea.classList.remove('border-blue-500', 'bg-blue-50');
                }, false);
            });

            dropArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    const file = files[0];
                    
                    // Validate file type
                    const validTypes = config.inputId === 'bukti_pembayaran' 
                        ? ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf']
                        : ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    
                    const validSize = file.size <= 2 * 1024 * 1024; // 2MB

                    if (!validTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Gunakan: ' + (config.inputId === 'bukti_pembayaran' ? 'PNG, JPG, GIF, PDF' : 'PNG, JPG, GIF'));
                        return;
                    }

                    if (!validSize) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB');
                        return;
                    }

                    // Set file to input and show preview
                    fileInput.files = files;
                    showPreview(file);
                }
            }, false);
        });
    </script>
</body>

        </html>