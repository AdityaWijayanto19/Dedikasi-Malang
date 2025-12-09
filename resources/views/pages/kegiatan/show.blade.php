<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan -> batch }}</title>
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
        <x-navbar />
    </header>
    <main>
        <section class="relative w-full h-[35vh] md:h-[90vh] flex items-center justify-center bg-cover bg-center"
            style="background-image: url('{{ asset('/hero/hero1.jpg') }}')" id="hero">

            <div class="absolute inset-0 bg-yellow-300/40"></div>

            <div class="flex relative z-10 text-start text-white justify-center items-center">
                <img src="{{ asset('logo.png') }}" class="h-24 md:h-64 mx-auto mb-4" alt="Logo Dedikasi Malang">
                <h1
                style="text-transform:uppercase"
                    class="text-4xl md:text-8xl leading-8 md:leading-20 font-extrabold text-shadow-md/40 text-shadow-black/50">
                    {{  $kegiatan -> batch }}
                </h1>
            </div>
        </section>
        <div
            class="flex justify-center items-center -z-10  mt-10 fixed inset-0 bg-no-repeat bg-center bg-cover opacity-10 pointer-events-none">
            <img src="/assets/logoDedikasi.png" alt="logo dedikasi" class="h-100 md:h-150">
        </div>

        <section class="px-15 md:px-30 mt-5">
            <hr class="border-0.5 border-gray-400 w-full mb-5">
            <div class="grid grid-cols-1 place-items-center md:flex md:justify-center gap-4">
                <div
                    class="flex flex-col justify-center items-center h-fit w-60 md:w-100 hover:-translate-y-1 cursor-pointer duration-200">
                    <img class="h-70 md:h-100 w-fit rounded-md hover:shadow-xl"
                        src="{{ Str::startsWith($kegiatan->gambar, 'http') ? $kegiatan->gambar : asset('storage/' . $kegiatan->gambar)}}"
                        alt="poster kegiatan">
                    <h1 class="font-medium text-xl text-neutral-800">{{ $kegiatan -> batch }}</h1>
                </div>
                <div class="h-fit w-60 md:w-150">
                    <h1 class="text-center md:text-start text-xl font-bold">{{ $kegiatan -> title }}</h1>
                    <p class="text-justify mt-5">
                        {{ $kegiatan -> deskripsi }}
                    </p>
                </div>
            </div>
        </section>
        <section class="px-15 md:px-30 mt-5">
            <hr class="border-0.5 border-gray-400 w-full mb-5">
            <div class="grid grid-cols-1 md:grid-cols-2 place-items-center gap-4 mt-4">
                <a href="https://drive.google.com/drive/folders/1htKNBxDCBhSO49geZBXSQlIZi1K-T3g_" target="_blank"
                    class="flex justify-center p-1 w-full text-white text-shadow-md font-semibold text-sm md:text-lg bg-[#FFE26F] rounded-sm hover:bg-[#ffdb49] hover:shadow-md hover:scale-101 duration-200">GUIDE
                    BOOK
                </a>
                <a href="/form pendaftaran" target="_blank"
                    class="flex justify-center p-1 w-full text-white text-shadow-md font-semibold text-sm md:text-lg bg-[#FFE26F] rounded-sm hover:bg-[#ffdb49] hover:shadow-md hover:scale-101 duration-200">DAFTAR
                    SEKARANG
                </a>
            </div>
        </section>
        <x-persyaratan />
        <x-footer />
    </main>
</body>

</html>