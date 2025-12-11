<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <main class="min-h-screen flex items-start justify-center p-6 md:p-10">

        <div class="max-w-xl w-full bg-white rounded-xl shadow-2xl p-8 md:p-12 mt-10 text-center">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-20 h-20 text-green-500 mx-auto mb-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-3">
                Pendaftaran Berhasil!
            </h1>

            <h2 class="text-xl font-semibold text-indigo-600 mb-6">
                {{ $kegiatan->title }} ({{ $kegiatan->batch }})
            </h2>

            <p class="text-gray-600 mb-6 leading-relaxed">
                Terima kasih, **{{ old('full_name') ?? 'Pendaftar' }}**! Data pendaftaran Anda untuk kegiatan ini telah
                kami terima.
                Status pendaftaran Anda saat ini adalah **PENDING**.
            </p>

            <hr class="my-6 border-gray-200">

            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 mb-8">
                <p class="font-bold text-yellow-800 mb-2 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.86 1.547-.361 3.35.303 4.116c.86 1.547 2.361 2.95 3.593 3.716C7.593 6.95 8.95 6.053 10.35 6.053c1.4.0 2.757.897 3.593 1.663c1.232.766 2.733 2.169 3.593 3.716c.86 1.547.361 3.35-.303 4.116c-1.232.766-2.733 2.169-3.593 3.716c-.86 1.547-.361 3.35.303 4.116" />
                    </svg>
                    Langkah Selanjutnya
                </p>
                <ul class="text-sm text-yellow-800 list-disc list-inside text-left mx-auto max-w-sm">
                    <li>Tim Admin akan melakukan verifikasi data dan bukti transfer Anda (Maks. 1x24 Jam).</li>
                    <li>Status verifikasi akan kami kirimkan melalui **WhatsApp** ke nomor yang Anda daftarkan.</li>
                </ul>
            </div>

            {{-- Tombol Aksi Lanjutan --}}
            <div class="space-y-3">
                <a href="{{ route('pages.kegiatan.show', $kegiatan->slug) }}"
                    class="block w-full px-6 py-3 border border-indigo-600 text-indigo-600 font-semibold rounded-lg hover:bg-indigo-50 transition duration-150">
                    Kembali ke Halaman Kegiatan
                </a>

                {{-- Anda perlu membuat route dan controller untuk Cek Status --}}
                <a href="#"
                    class="block w-full px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-150">
                    Cek Status Pendaftaran (Segera Hadir)
                </a>
            </div>

        </div>
    </main>
</body>

</html>