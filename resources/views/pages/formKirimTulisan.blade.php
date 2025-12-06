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
        <h1 class="font-bold text-2xl md:text-4xl">FORM KIRIM TULISAN</h1>
        <h1 class="font-medium text-xl md:text-2xl">CERITA DEDIKASI</h1>
    </header>
    <main>
        <section class="px-6 md:px-30 mt-5">
            <form action="" method="POST" enctype="multipart/form-data"
                class="flex flex-col rounded-t-4xl p-6 md:p-10 h-fit w-full bg-white shadow-lg shadow-neutral-500 max-w-3xl mx-auto">
                <div class="mb-5">
                    <label for="name" class="block font-medium text-gray-700 mb-2">Nama Penulis</label>
                    <input id="name" name="name" type="text" placeholder="Contoh: Mohammad David"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent" required>
                </div>

                <div class="mb-5">
                    <label for="status" class="block font-medium text-gray-700 mb-2">Status</label>
                    <input id="status" name="status" type="text" placeholder="Contoh: Volunteer"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent" required>
                </div>

                <div class="mb-5">
                    <label for="nohp" class="block font-medium text-gray-700 mb-2">No. HP (WhatsApp)</label>
                    <input type="tel" id="nohp" name="nohp" placeholder="Contoh: 081234567890"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent" required>
                </div>

                <div class="mb-5">
                    <label for="ig" class="block font-medium text-gray-700 mb-2">Akun Instagram</label>
                    <input type="text" id="ig" name="ig" placeholder="@username"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent" required>
                </div>

                <div class="mb-5">
                    <label for="instansi" class="block font-medium text-gray-700 mb-2">Instansi
                        (Sekolah/Universitas/Kerja)</label>
                    <input type="text" id="instansi" name="instansi" placeholder="Universitas Brawijaya"
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent" required>
                </div>

                <div class="mb-5">
                    <label for="buktiig" class="block text-sm font-medium text-gray-700 mb-1">Foto kamu</label>
                    <input type="file" id="buktiig" name="buktiig" accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"
                        required>
                </div>

                <div class="mb-5">
                    <label for="cerita" class="block font-medium text-gray-700 mb-2">Cerita Kamu</label>
                    <textarea name="cerita" id="cerita" rows="4" placeholder="Tuliskan alasanmu di sini..."
                        class="w-full bg-neutral-100 p-3 rounded-xl border border-transparent" required></textarea>
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