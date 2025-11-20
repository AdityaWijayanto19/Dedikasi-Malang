<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kegiatan</title>

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
                <img src="{{ asset('logo.png') }}" class="h-24 md:h-32 mx-auto mb-4" alt="Logo Dedikasi Malang">
                <h1
                    class="text-4xl md:text-6xl leading-8 md:leading-12 font-extrabold text-shadow-md/40 text-shadow-black/50">
                    KEGIATAN<br>DEDIKASI
                </h1>
            </div>
        </section>

        <x-pengertian />
        
         <div class="flex justify-center items-center -z-10  mt-10 fixed inset-0 bg-no-repeat bg-center bg-cover opacity-10 pointer-events-none">
            <img src="/assets/logoDedikasi.png" alt="logo dedikasi"
                class="h-80">
        </div>

        <section class="px-15 mt-5">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-md md:text-lg text-[#E9C153]">KEGIATAN TERBARU</h1>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
            </div>
            <div class="grid grid-cols-1 place-items-center md:flex justify-center items-center gap-4">
                <x-pamflet poster="/assets/posterKegiatan.png" batch="BATCH 15"
                    tema="PEMBERDAYAAN EKONOMI MELALUI PELATIHAN KETERAMPILAN MENJAHIT BAGI IBU-IBU DI DESA NGULINGAN, MALANG." />
                <x-pamflet poster="/assets/posterKegiatan.png" batch="BATCH 16"
                    tema="PEMBERDAYAAN EKONOMI MELALUI PELATIHAN KETERAMPILAN MENJAHIT BAGI IBU-IBU DI DESA NGULINGAN, MALANG." />
                <x-pamflet poster="/assets/posterKegiatan.png" batch="BATCH 17"
                    tema="PEMBERDAYAAN EKONOMI MELALUI PELATIHAN KETERAMPILAN MENJAHIT BAGI IBU-IBU DI DESA NGULINGAN, MALANG." />
            </div>
        </section>

        <section class="px-15 mt-5">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-md md:text-lg text-[#E9C153]">PERSYARATAN</h1>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-center place-items-center">
                <div class="flex flex-col h-fit w-full justify-center items-center">
                    <h1 class="text-lg font-semibold text-[#E9C153]">SYARAT UMUM</h1>
                    <ul
                        class="text-[8px] text-neutral-700 bg-linear-to-t from-[#E9C153] to-[#FFE26F] p-4 rounded-md list-disc list-outside">
                        <li>Pemuda/pemudi Indonesia berusia 16-40 Tahun</li>
                        <li>Tertarik di kegiatan sosial masyarakat</li>
                        <li>Mengikuti alur pendaftaran</li>
                        <li>Mengikuti kegiatan secara keseluruhan</li>
                    </ul>
                </div>
                <div class="flex flex-col h-fit w-full justify-center items-center">
                    <h1 class="text-lg font-semibold text-[#E9C153]">BIAYA KONTRIBUSI</h1>
                    <ul class="text-[8px] text-neutral-700 bg-linear-to-t from-[#E9C153] to-[#FFE26F] p-4 rounded-md">
                        <li class="list-outside font-semibold text-[12px]">1. Member</li>
                        <li class="list-disc list-outside">Biaya Kaos Rp. 90.000</li>
                        <li class="list-disc list-outside">Biaya Kontribusi Kegiatan (sesuai dengan kegiatannya)</li>
                        <li class="list-disc list-outside">Diskon 5.000 (dengan syarat mengikuti kegiatan 3x secara
                            berturut-turut) s.k.*</li>
                        <li class="list-outside font-semibold text-[12px]">2. Reguler</li>
                        <li class="list-disc list-outside">Biaya Kontribusi Kegiatan (sesuai dengan kegiatannya)</li>
                    </ul>
                </div>
                <div class="flex flex-col h-fit w-full justify-center items-center">
                    <h1 class="text-lg font-semibold text-[#E9C153]">BENEFIT</h1>
                    <ul
                        class="text-[8px] text-neutral-700 bg-linear-to-t from-[#E9C153] to-[#FFE26F] p-4 rounded-md list-disc list-outside">
                        <li>Sertifikat Apresiasi</li>
                        <li>Konsumsi</li>
                        <li>Relasi</li>
                        <li>Merchandise</li>
                        <li>Nametag</li>
                        <li>Dokumentasi Kegiatan</li>
                        <li>Panitia Lapang (free htm, konsumsi, sertifikat, dll) s.k.*</li>
                        <li>kelas volunteer</li>
                    </ul>
                </div>
                <div class="flex flex-col h-fit w-full justify-center items-center">
                    <h1 class="text-lg font-semibold text-[#E9C153]">ALUR PENDAFTARAN</h1>
                    <ul
                        class="text-[8px] text-neutral-700 bg-linear-to-t from-[#E9C153] to-[#FFE26F] p-4 rounded-md list-disc list-outside">
                        <li>Wajib Ikuti akun Instagram @dedikasimalang</li>
                        <li>Wajib Ikuti akun Tiktok @dedikasimalang</li>
                        <li>Membaca syarat dan alur pendaftaran</li>
                        <li>Mengisi formulir pendaftaran</li>
                        <li>Melakukan pembayaran biaya kontribusi Pembayaran dapat dilakukan melalui 388301029202539
                            (BRI) a.n. SOFYYAH FITRI</li>
                        <li>Upload bukti pembayaran melalui form pendaftaran dengan format; NAMA_Dedikasi_MALANG</li>
                    </ul>
                </div>
            </div>
        </section>

        <x-roadMap />
        <x-galeri />
        <x-footer />

    </main>
</body>

</html>