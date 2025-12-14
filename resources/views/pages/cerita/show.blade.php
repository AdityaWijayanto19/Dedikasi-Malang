<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dedikasi Malang - {{ $cerita->title ?? 'Detail Cerita' }}</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<body>
    <header>
        <x-navbar />
    </header>
    <main>
        <section class="relative w-full h-[35vh] md:h-[90vh] flex items-center justify-center bg-cover bg-center"
            style="background-image: url('{{ asset('/hero/HERO.jpg') }}')" id="hero">

            <div class="absolute inset-0 bg-yellow-300/40"></div>

            <div class="flex relative z-10 text-start text-white justify-center items-center">
                <img src="{{ asset('logo.png') }}" class="h-24 md:h-64 mx-auto mb-4" alt="Logo Dedikasi Malang">
                <h1 style="text-transform:uppercase"
                    class="text-4xl md:text-8xl leading-8 md:leading-20 font-extrabold text-shadow-md/40 text-shadow-black/50">
                    {{  $cerita->title   }}
                </h1>
            </div>
        </section>
        <div
            class="flex justify-center items-center -z-10  mt-10 fixed inset-0 bg-no-repeat bg-center bg-cover opacity-10 pointer-events-none">
            <img src="/assets/logoDedikasi.png" alt="logo dedikasi" class="h-100 md:h-150">
        </div>
        <section class="px-15 md:px-30 mt-5">
            <div class="flex flex-col md:flex-row gap-8 md:gap-12 items-start">

                <div class="w-full md:w-1/3 lg:w-1/4 shrink-0">
                    <div class="relative w-full aspect-[3/4] rounded-xl overflow-hidden shadow-xl">
                        <img src="{{ Str::startsWith($cerita->gambar, 'http') ? $cerita->gambar : asset('storage/' . $cerita->gambar) }}"
                            alt="Foto Penulis {{ $cerita->nama_penulis }}" class="w-full h-full object-cover">

                        <div
                            class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent text-white">
                            <h3 class="font-bold text-lg uppercase tracking-wider mb-0">
                                {{ $cerita->jabatan ?? 'Penulis' }}
                            </h3>
                            <p class="text-md font-light">{{ $cerita->nama_penulis }}</p>
                        </div>
                    </div>

                    <div class="mt-4 p-4 border border-gray-200 rounded-lg text-sm text-gray-700">
                        <p class="font-semibold mb-1">Biodata Singkat:</p>
                        <p class="text-xs italic">{{ $cerita->deskripsi_penulis ?? 'Belum ada deskripsi singkat.' }}</p>
                    </div>
                </div>

                <div class="w-full md:w-3/4 lg:w-4/5">

                    <h1 class="font-bold text-3xl md:text-5xl text-gray-800 leading-tight mb-3">
                        {{ $cerita->title }}
                    </h1>

                    <p class="text-md text-gray-500 mb-6">
                        Ditulis oleh <span class="font-semibold">{{ $cerita->nama_penulis }}</span> pada
                        {{ \Carbon\Carbon::parse($cerita->created_at)->translatedFormat('d F Y') }}
                    </p>

                    <hr class="border-t border-gray-300 mb-6">

                    <div class="prose max-w-none text-md text-gray-700 leading-relaxed">
                        {!! $cerita->deskripsi !!}
                    </div>

                </div>
            </div>
        </section>
    </main>
    <x-footer />
</body>

</html>