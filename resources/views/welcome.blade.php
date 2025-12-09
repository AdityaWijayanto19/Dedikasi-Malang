<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dedikasi Malang - Welcome</title>
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

    <main class="mt-10">
        <section class="relative w-full h-[35vh] md:h-screen flex items-center justify-center bg-cover bg-center"
            style="background-image: url('{{ asset('/hero/hero1.jpg') }}')" id="hero">

            <div class="absolute inset-0 bg-yellow-300/40"></div>

            <div class="flex relative z-10 text-center text-white justify-center items-center">
                <img src="{{ asset('logo.png') }}" class="h-24 md:h-64 mx-auto mb-4" alt="Logo Dedikasi Malang">
                <h1
                    class="text-4xl md:text-8xl leading-8 md:leading-20 font-bold text-shadow-md/40 text-shadow-black/50">
                    DEDIKASI<br>MALANG
                </h1>
            </div>
        </section>

        <x-pengertian />

        <div
            class="flex justify-center items-center -z-10  mt-10 fixed inset-0 bg-no-repeat bg-center bg-cover opacity-10 pointer-events-none">
            <img src="/assets/logoDedikasi.png" alt="logo dedikasi" class="h-100 md:h-150">
        </div>

        <section class="flex flex-col justify-center items-center px-15 md:px-30 z-40 mt-5" id="profil">
            <hr class="border-0.5 border-gray-400 w-full mb-5">
            <div class="grid grid-cols-1 place-items-center md:flex gap-5 justify-center items-center">
                <img class="h-45 md:h-70 hover:-translate-y-0.5 hover:shadow-xl duration-150 rounded-md"
                    src="/hero/minihero1.png" alt="foto dedikasi">
                <div class="flex flex-col gap-2 justify-center items-center md:justify-start md:items-start">
                    <h2 class="text-xl md:text-4xl font-bold text-[#E9C153]">PROFIL DEDIKASI MALANG</h2>
                    <p class="text-xs md:text-lg text-neutral-600 w-70 md:w-150 text-justify">Dedikasi Malang merupakan
                        ruang
                        kolaboratif bagi
                        pemuda-pemudi
                        Indonesia untuk meningkatkan
                        kepedulian, menumbuhkan empati, serta mengasah kepekaan sosial terhadap masyarakat dan
                        lingkungan. Melalui berbagai aksi pengabdian yang berkelanjutan, Dedikasi Malang mendorong
                        lahirnya kontribusi nyata generasi muda demi tercapainya pembangunan masyarakat yang inklusif
                        dan berdaya. </p>
                </div>
            </div>
            <hr class="border-0.5 border-gray-400 w-full mt-5">
        </section>

        <section class="grid grid-cols-1 place-items=-center md:grid-cols-3 gap-4 px-15 md:px-30 mt-5" id="visi-misi">
            <div
                class="bg-linear-to-t from-[#E9C153] to-[#FFE26F] rounded-md text-white w-full h-fit p-2 text-shadow-md">
                <h2 class="text-xl md:text-4xl font-bold mb-5">VISI</h2>
                <p class="text-xs md:text-lg text-justify">Menciptakan wadah untuk mendorong pemuda-pemudi Indonesia
                    menjadi
                    garda terdepan perubahan guna
                    memberikan kebermanfaatan bagi masyarakat melalui program pengabdian. </p>
            </div>
            <div
                class="bg-linear-to-t from-[#E9C153] to-[#FFE26F] col-span-2 rounded-md text-white w-full h-fit px-6 py-2 text-shadow-md">
                <h2 class="text-xl md:text-4xl font-bold">MISI</h2>
                <ul class="list-decimal text-xs/4 md:text-lg text-justify">
                    <li>Melaksanakan program kerja melalui berbagai bidang kegiatan yang relevan dengan permasalahan
                        sekitar.</li>
                    <li>Menjalin hubungan dengan stakeholder terkait untuk menghadirkan kegiatan yang harmonis.</li>
                    <li>Memberdayakan masyarakat sekitar dalam setiap program kegiatan.</li>
                    <li>Memberdayakan potensi pemuda-pemudi melalui inovasi dan berkomitmen untuk memberikan hak
                        pendidikan guna menciptakan generasi yang berpengetahuan luas, kreatif, dan berkomitmen untuk
                        memajukan kualitas masyarakatnya.</li>
                </ul>
            </div>
        </section>

        <section class="px-15 md:px-30 z-40 mt-5" id="tim dedikasi">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-xl md:text-4xl text-[#E9C153]">TIM DEDIKASI MALANG</h1>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
            </div>
            <div class="grid grid-cols-2 gap-2 md:grid-cols-5 place-items-center px-2" id="web">
                <x-teamCard foto="pengurus/program.png" role="Project Planner" name="ROBERTO MARTHA K"
                    link="https://www.instagram.com/roobertomk_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <x-teamCard foto="pengurus/bndhr.png" role="Bendahara" name="SHOFYYAH FITHRI"
                    link="https://www.instagram.com/sofyaa.__?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <x-teamCard foto="pengurus/leader.png" role="Leader" name="MOHAMMAD DAVID N.S"
                    link="https://www.instagram.com/davv_id._?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <x-teamCard foto="pengurus/prhr.png" role="Public Relation" name="SALMA AYUNDA"
                    link="https://www.instagram.com/salmaynd?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <x-teamCard foto="pengurus/media.png" role="Media Creative" name="FATA ALFAN MA’ARUFI"
                    link="https://www.instagram.com/fatlfanz?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
            </div>

            <div class="md:hidden grid grid-cols-2 gap-2 md:grid-cols-5 place-items-center px-2" id="mobile">
                <x-teamCard foto="pengurus/leader.png" role="Leader" name="MOHAMMAD DAVID NUR S"
                    link="https://www.instagram.com/davv_id._?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <x-teamCard foto="pengurus/bndhr.png" role="Bendahara" name="SHOFYYAH FITHRI"
                    link="https://www.instagram.com/sofyaa.__?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <x-teamCard foto="pengurus/program.png" role="Project Planner" name="ROBERTO MARTHA K"
                    link="https://www.instagram.com/roobertomk_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <x-teamCard foto="pengurus/prhr.png" role="Public Relation" name="SALMA AYUNDA"
                    link="https://www.instagram.com/salmaynd?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                <div class="col-span-2">
                    <x-teamCard foto="pengurus/media.png" role="Media Creative" name="FATA ALFAN MA’ARUFI"
                        link="https://www.instagram.com/fatlfanz?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" />
                </div>

            </div>
        </section>

        <section class="px-15 md:px-30 z-40 mt-5" id="bidang">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-xl md:text-4xl text-center text-[#E9C153]">BIDANG PENGABDIAN & SDGs
                </h1>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
                <p class="text-xs md:text-lg font-thin text-justify md:text-center text-neutral-600 w-70 md:w-200">
                    Dedikasi
                    Malang
                    terfokus dalam berbagai
                    bidang pengabdian yang terarah dengan tujuan keberlanjutan
                    yang sering disebut SDGs yakni 17 fokus pengembangan bidang di Dunia maupun di Indonesia.</p>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
            </div>
            <img src="/assets/campaign.png" alt="dedikasi malang x SDGs" class="h-fit w-full">
            <div class="grid grid-cols-5 gap-1 md:gap-4">
                <div class="flex flex-col justify-center items-center gap-1">
                    <img src="/assets/logoPend.png" alt="logo pendidikan"
                        class="h-12 w-full md:h-55 mx-auto mt-2 md:mt-5 p-2 bg-linear-to-t from-[#E9C153] to-[#FFE26F]">
                    <p class="font-semibold text-neutral-700 text-[8px] md:text-lg">PENDIDIKAN</p>
                </div>
                <div class="flex flex-col justify-center items-center gap-1">
                    <img src="/assets/logoSos.png" alt="logo sosial"
                        class="h-12 w-full md:h-55 mx-auto mt-2 md:mt-5 p-2 bg-linear-to-t from-[#E9C153] to-[#FFE26F]">
                    <p class="font-semibold text-neutral-700 text-[8px] md:text-lg">SOSIAL</p>
                </div>
                <div class="flex flex-col justify-center items-center gap-1">
                    <img src="/assets/logoLing.png" alt="logo lingkungan"
                        class="h-12 w-full md:h-55 mx-auto mt-2 md:mt-5 p-2 bg-linear-to-t from-[#E9C153] to-[#FFE26F]">
                    <p class="font-semibold text-neutral-700 text-[8px] md:text-lg">LINGKUNGAN</p>
                </div>
                <div class="flex flex-col justify-center items-center gap-1">
                    <img src="/assets/logoKreatif.png" alt="logo kreatif"
                        class="h-12 w-full md:h-55 mx-auto mt-2 md:mt-5 p-2 bg-linear-to-t from-[#E9C153] to-[#FFE26F]">
                    <p class="font-semibold text-neutral-700 text-[8px] md:text-lg">KREATIF</p>
                </div>
                <div class="flex flex-col justify-center items-center gap-1">
                    <img src="/assets/logoKes.png" alt="logo kesehatan"
                        class="h-12 w-full md:h-55 mx-auto mt-2 md:mt-5 p-2 bg-linear-to-t from-[#E9C153] to-[#FFE26F]">
                    <p class="font-semibold text-neutral-700 text-[8px] md:text-lg">KESEHATAN</p>
                </div>
            </div>
        </section>

        <x-roadMap :kegiatan="$kegiatan"/>

        <section class="px-15 md:px-30 z-40 mt-5" id="DaftarKegiatan">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-xl md:text-4xl text-[#E9C153]">DAFTAR KEGIATAN</h1>
                <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
            </div>
            <div class="grid grid-cols-1 place-items-center md:flex md:justify-around">
                <img class="h-45 md:h-70" src="/hero/minihero3.png" alt="foto kegiatan">
                <div class="flex flex-col justify-center mt-2">
                    <h1 class="text-xl md:text-4xl text-center leading-4 font-bold text-[#E9C153]">DAFTAR KEGIATAN
                        DEDIKASI MALANG</h1>
                    <p class="font-light text-sm md:text-lg mt-5">Silahkan klik untuk informasi lebih lanjut</p>
                    <a href="/kegiatan"
                        class="bg-[#E9C153] py-2 text-white text-sm md:text-lg text-center font-semibold cursor-pointer rounded-sm hover:shadow-md hover:bg-[#d6af42] hover:scale-101 duration-200">INFORMASI
                        KEGIATAN</a>
                </div>
            </div>
        </section>

        <section class="px-15 md:px-30 z-40 mt-5 mb-5" id="legalitas">
            <div class="flex flex-col justify-center items-center">
                <hr class="border-0.5 border-gray-400 w-full mb-2">
                <h1 class="font-bold text-xl md:text-4xl text-[#E9C153]">LEGALITAS DEDIKASI</h1>
                <a href="https://drive.google.com/drive/folders/11vz-0zKAXePEjFTuqSm-o4JVPHHvHdXb?usp=sharing"
                    target="_blank"
                    class="w-full mt-5 text-sm text-center md:text-lg font-semibold bg-[#E9C153] py-2 text-white cursor-pointer rounded-sm hover:shadow-md hover:bg-[#d6af42] hover:scale-101 duration-200">SURAT
                    LEGALITAS YAYASAN DEDIKASI</a>
            </div>
        </section>

        <x-ceritaSection />
        <x-galeri />
        <x-footer />


    </main>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const webSection = document.getElementById('web');
        const mobileSection = document.getElementById('mobile');

        function handleResize() {
            if (window.innerWidth >= 768) {
                webSection.style.display = 'grid';
                mobileSection.style.display = 'none';
            } else {
                webSection.style.display = 'none';
                mobileSection.style.display = 'grid';
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();
    });

</script>

</html>