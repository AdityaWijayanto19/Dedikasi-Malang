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
    <header class="mt-10 flex flex-col items-center text-white">
        <h1 class="font-bold text-2xl md:text-4xl">FORM PENDAFTARAN</h1>
        <h1 class="font-medium text-xl md:text-2xl">DEDIKASI BATCH 17</h1>
    </header>
    <main>
        <section class="px-6 md:px-30 mt-5">
            <form action="" method="POST" enctype="multipart/form-data"
                class="flex flex-col rounded-t-4xl p-6 md:p-10 h-fit w-full bg-white shadow-lg shadow-neutral-500 max-w-3xl mx-auto">
                <div class="mb-5">
                    <label for="name" class="block font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input id="name" name="name" type="text" placeholder="Contoh: Mohammad David"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent"
                        required>
                </div>

                <div class="mb-5">
                    <label for="domisili" class="block font-medium text-gray-700 mb-2">Domisili Sekarang</label>
                    <input id="domisili" name="domisili" type="text" placeholder="Contoh: Kota Malang"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent"
                        required>
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="gender" value="L"
                                class="appearance-none w-5 h-5 rounded-full border-2 border-gray-400 checked:bg-blue-500 checked:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                            <span>Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="gender" value="P"
                                class="appearance-none w-5 h-5 rounded-full border-2 border-gray-400 checked:bg-pink-500 checked:border-pink-500 focus:ring-2 focus:ring-pink-200 transition">
                            <span>Perempuan</span>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="usia" class="block font-medium text-gray-700 mb-2">Usia</label>
                    <input type="number" id="usia" name="usia" placeholder="19" min="1"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent"
                        required>
                </div>

                <div class="mb-5">
                    <label for="nohp" class="block font-medium text-gray-700 mb-2">No. HP (WhatsApp)</label>
                    <input type="tel" id="nohp" name="nohp" placeholder="Contoh: 081234567890"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent"
                        required>
                </div>

                <div class="mb-5">
                    <label for="ig" class="block font-medium text-gray-700 mb-2">Akun Instagram</label>
                    <input type="text" id="ig" name="ig" placeholder="@username"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent"
                        required>
                </div>

                <div class="mb-5">
                    <label for="instansi" class="block font-medium text-gray-700 mb-2">Instansi
                        (Sekolah/Universitas/Kerja)</label>
                    <input type="text" id="instansi" name="instansi" placeholder="Universitas Brawijaya"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent"
                        required>
                </div>

                <div class="mb-5">
                    <label for="alasan" class="block font-medium text-gray-700 mb-2">Alasan Mengikuti Kegiatan</label>
                    <textarea name="alasan" id="alasan" rows="4" placeholder="Tuliskan alasanmu di sini..."
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent"
                        required></textarea>
                </div>

                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 mb-6 space-y-4">
                    <h3 class="font-semibold text-gray-800">Dokumen Pendukung</h3>

                    <div>
                        <label for="buktitt" class="block text-sm font-medium text-gray-700 mb-1">Bukti Follow TikTok
                            @dedikasimalang</label>
                        <input type="file" id="buktitt" name="buktitt" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"
                            required>
                    </div>

                    <div>
                        <label for="buktiig" class="block text-sm font-medium text-gray-700 mb-1">Bukti Follow Instagram
                            @dedikasimalang</label>
                        <input type="file" id="buktiig" name="buktiig" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"
                            required>
                    </div>

                    <div>
                        <label for="buktitf" class="block text-sm font-medium text-gray-700 mb-2">Bukti
                            Pembayaran</label>

                        <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 mb-3 text-sm text-blue-800">
                            <p class="font-bold">BRI: 388301029202539</p>
                            <p>A.N: SHOFIYYAH FITHRI</p>
                            <p class="text-xs mt-1 text-blue-600">*Format berita: NAMA_DEDIKASIMALANG</p>
                        </div>

                        <input type="file" id="buktitf" name="buktitf" accept="image/*, application/pdf"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"
                            required>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-4 mb-2">
                    <a href="/detail kegiatan"
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
</body>

</html>