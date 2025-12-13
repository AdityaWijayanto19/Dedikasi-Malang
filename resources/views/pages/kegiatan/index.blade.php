<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan Dedikasi</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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
            class="flex justify-center items-center -z-10 mt-10 fixed inset-0 bg-no-repeat bg-center bg-cover opacity-10 pointer-events-none">
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

                                <img class="h-70 w-fit rounded-md hover:shadow-xl"
                                    src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}"
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
                @else
                    <p class="text-lg text-gray-500 my-10">Belum ada kegiatan terbaru yang sedang dibuka.</p>
                @endif
            </div>
        </section>

        @if ($kegiatan)
            <x-persyaratan />
            <x-roadMap :kegiatan="Illuminate\Support\Collection::wrap($kegiatan)" />
            <x-galeri />
            <x-footer />
        @endif

    </main>

    @if ($kegiatan)
        <button id="checkStatusBtn"
            class="fixed bottom-5 right-5 bg-[#E9C153] text-white p-4 rounded-full shadow-lg hover:bg-yellow-500 transition duration-300 z-50 transform hover:scale-105">
            <i class="fas fa-search text-2xl"></i>
        </button>

        <div id="statusModal" class="fixed inset-0 bg-black/75 hidden items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Cek Status Pendaftaran</h2>
                    <button id="closeModalBtn" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
                </div>
                <p class="mb-4 text-sm text-gray-600">
                    Masukkan **Nomor HP/WA** yang Anda gunakan saat mendaftar pada kegiatan **{{ strtoupper($kegiatan->batch) }}**.
                </p>

                <form id="checkStatusForm" action="{{ route('pendaftaran.status.check', $kegiatan) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="phone_number_input" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP/WA</label>
                        
                        <input type="text" name="phone_number" id="phone_number_input" placeholder="Contoh: 08123456789"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#E9C153]">

                        @if ($errors->has('phone_number') && old('_token'))
                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('phone_number') }}</p>
                        @endif
                        @if (session('error'))
                            <p class="text-red-500 text-xs mt-1">{{ session('error') }}</p>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full bg-[#E9C153] text-white py-2 rounded-md font-semibold hover:bg-yellow-500 transition duration-300">
                        Cek Status
                    </button>
                </form>

            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkStatusBtn = document.getElementById('checkStatusBtn');
            const statusModal = document.getElementById('statusModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const phoneInput = document.getElementById('phone_number_input');

            if (checkStatusBtn) {
                checkStatusBtn.addEventListener('click', () => {
                    statusModal.classList.remove('hidden');
                    statusModal.classList.add('flex');
                    document.body.style.overflow = 'hidden'; 
                    phoneInput.focus();
                });
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', () => {
                    statusModal.classList.add('hidden');
                    statusModal.classList.remove('flex');
                    document.body.style.overflow = 'auto';
                });
            }

            if (statusModal) {
                statusModal.addEventListener('click', (e) => {
                    if (e.target === statusModal) {
                        closeModalBtn.click();
                    }
                });
            }
            
            <?php if ($kegiatan && ($errors->has('phone_number') || session('error'))): ?>
                if (statusModal) {
                    statusModal.classList.remove('hidden');
                    statusModal.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                }
            <?php endif; ?>
        });
    </script>
</body>

</html>