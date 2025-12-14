<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anda berhasil - Tunggu di terima ya!</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .double-logo-background {
            background-image:
                url('/assets/logoDedikasi.png'),
                url('/assets/logoDedikasi.png');

            background-size: 100vh auto, 100vh auto;

            background-position:
                right -48vh center,
                left -51vh center;

            background-repeat: no-repeat;
            opacity: 0.07;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -20;
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="double-logo-background"></div>

    <main class="min-h-screen flex items-start justify-center p-6 md:p-10">

        <div class="max-w-xl w-full bg-white rounded-xl shadow-2xl p-8 md:p-12 mt-10 text-center relative z-10">

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
                Terima kasih,<strong>{{ old('full_name') ?? 'Pendaftar' }}!</strong> Data pendaftaran Anda untuk
                kegiatan ini telah
                kami terima.
                Status pendaftaran Anda saat ini adalah <strong>PENDING</strong>.
            </p>

            <hr class="my-6 border-gray-200">

            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 mb-8">
                <p class="font-bold text-yellow-800 mb-2 flex items-center justify-center">
                    Langkah Selanjutnya
                </p>
                <ul class="text-sm text-yellow-800 list-disc list-inside text-left mx-auto max-w-sm">
                    <li>Tim Admin akan melakukan verifikasi data dan bukti transfer Anda (Maks. 1x24 Jam).</li>
                    <li>Status verifikasi akan kami kirimkan melalui <strong>WhatsApp</strong> ke nomor yang Anda
                        daftarkan.</li>
                </ul>
            </div>

            <div class="space-y-3">
                <a href="{{ route('pages.kegiatan.show', $kegiatan->slug) }}"
                    class="block w-full px-6 py-3 border border-[#E9C153] text-yellow-800 font-semibold rounded-lg hover:bg-yellow-50 transition duration-150">
                    Kembali ke Halaman Kegiatan
                </a>
            </div>

        </div>
    </main>
</body>

</html>