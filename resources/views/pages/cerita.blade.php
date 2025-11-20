<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerita</title>

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

            <div class="flex relative z-10 text-center text-white justify-center items-center">
                <img src="{{ asset('logo.png') }}" class="h-24 md:h-32 mx-auto mb-4" alt="Logo Dedikasi Malang">
                <h1
                    class="text-4xl md:text-6xl leading-8 md:leading-12 font-extrabold text-shadow-md/40 text-shadow-black/50">
                    CERITA<br>DEDIKASI
                </h1>
            </div>
        </section>
        <x-pengertian/>
        <x-ceritaSection />
        <x-footer/>
    </main>
</body>

</html>