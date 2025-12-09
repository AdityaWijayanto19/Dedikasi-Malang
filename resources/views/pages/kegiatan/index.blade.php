<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kegiatan</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

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

<body>
    <header>
        <x-navbar></x-navbar>
    </header>
    <main class="mt-10">
        <section class="relative w-full h-[35vh] md:h-[90vh] flex items-center justify-center bg-cover bg-center"
            style="background-image: url('{{ asset('/hero/hero1.jpg') }}')" id="hero">

            <div class="absolute inset-0 bg-yellow-300/40"></div>

            <div class="flex relative z-10 text-white justify-center items-center">
                <img src="{{ asset('logo.png') }}" class="h-24 md:h-64 mx-auto mb-4" alt="Logo Dedikasi Malang">
                <h1
                    class="text-4xl md:text-8xl leading-8 md:leading-20 font-extrabold text-shadow-md/40 text-shadow-black/50">
                    KEGIATAN<br>DEDIKASI
                </h1>
            </div>
        </section>

        <x-pengertian />

        <div
            class="flex justify-center items-center -z-10  mt-10 fixed inset-0 bg-no-repeat bg-center bg-cover opacity-10 pointer-events-none">
            <img src="/assets/logoDedikasi.png" alt="logo dedikasi" class="h-100 md:h-150">
        </div>

        <section class="px-15 mt-5 md:px-30">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-md md:text-4xl text-[#E9C153]">KEGIATAN TERBARU</h1>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
            </div>
            <div class="grid grid-cols-1 place-items-center md:flex justify-center items-center gap-4">

                @if($newKegiatan->count())

                @foreach ($newKegiatan as $item)
                    <a href="{{ route('pages.kegiatan.show', $item->slug) }}">
                        <div
                            class="flex flex-col justify-center items-center h-fit w-60 hover:-translate-y-1 cursor-pointer duration-200 mb-2">

                            <img class="h-70 w-fit rounded-md hover:shadow-xl" src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}"
                                alt="poster kegiatan">

                            <h1 class="font-semibold text-xl text-neutral-800">
                                {{ strtoupper($item->batch) }}
                            </h1>

                            <h2 class="text-sm font-thin text-neutral-600 text-center">
                                {{ $item->tema }}
                            </h2>
                        </div>
                    </a>
                @endforeach
                @endif
            </div>
        </section>
        <x-persyaratan />
        <x-roadMap :kegiatan="$kegiatan" />
        <x-galeri />
        <x-footer />

    </main>
</body>

</html>