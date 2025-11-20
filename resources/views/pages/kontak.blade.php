<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>

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

    <main class="mt-10">
        <section class="relative w-full h-[35vh] md:h-[90vh] flex items-center justify-center bg-cover bg-center"
            style="background-image: url('{{ asset('/hero/hero1.jpg') }}')" id="hero">

            <div class="absolute inset-0 bg-yellow-300/40"></div>

            <div class="flex relative z-10 text-center text-white justify-center items-center">
                <img src="{{ asset('logo.png') }}" class="h-24 md:h-32 mx-auto mb-4" alt="Logo Dedikasi Malang">
                <h1
                    class="text-4xl md:text-6xl leading-8 md:leading-12 font-extrabold text-shadow-md/40 text-shadow-black/50">
                    KONTAK<br>DEMA
                </h1>
            </div>
        </section>

        <x-pengertian />

        <div
            class="flex justify-center items-center -z-10  mt-10 fixed inset-0 bg-no-repeat bg-center bg-cover opacity-10 pointer-events-none">
            <img src="/assets/logoDedikasi.png" alt="logo dedikasi" class="h-80">
        </div>

        <Section class="px-15 mt-5">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-md md:text-lg text-[#E9C153]">KONTAK DEDIKASI MALANG</h1>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
            </div>
            <div class="flex justify-center items-center">
                <div
                    class="h-50 w-100 bg-linear-to-t from-yellow-500 to-yellow-100 rounded-md flex justify-center items-center">
                    <h1>087874807000</h1>
                </div>
            </div>
        </Section>
    </main>
    <x-footer />
</body>

</html>