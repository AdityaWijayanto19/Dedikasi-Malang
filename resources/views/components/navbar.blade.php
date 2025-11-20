<nav class="w-full fixed top-0 z-50 shadow-md bg-[#FFE26F]">
    <div class="flex justify-center p-2 bg-[#E9C153]">
        <a href="/kegiatan"
            class="text-[8px] text-white border border-white rounded-sm px-2 py-1 cursor-pointer hover:bg-[#E0B94F] hover:scale-102 duration-200">Daftar
            Kegiatan</a>
    </div>

    <div class="px-5 py-1 flex justify-between items-center">
        <a href="#" class="flex gap-1">
            <img src="assets/logoDedikasi.png" alt="logo dedikasi" class="h-5">
            <p class="text-[12px] font-medium">DEDIKASI MALANG</p>
        </a>

        <ul class="hidden text-[10px] md:flex gap-2" id="nav-menu">
            <li><a href="/" class=" hover:text-white duration-150 hover:underline">Beranda</a></li>
            <li><a href="/kegiatan" class=" hover:text-white duration-150 hover:underline">Kegiatan</a></li>
            <li><a href="/cerita" class=" hover:text-white duration-150 hover:underline">Cerita Dedikasi</a></li>
            <li><a href="/kontak" class=" hover:text-white duration-150 hover:underline">Kontak</a></li>
            <li><a href="/donasi" class=" hover:text-white duration-150 hover:underline">Donasi</a></li>
        </ul>

        <button id="nav-toggle" class="md:hidden text-2xl">
            ☰
        </button>
    </div>

    <div id="mobile-menu" class="bg-[#FFE26F] text-[12px] grid grid-cols-1 px-5 pb-4 md:hidden">
        <a href="/" class="py-2 border-b">Beranda</a>
        <a href="/kegiatan" class="py-2 border-b">Kegiatan</a>
        <a href="/cerita" class="py-2 border-b">Cerita Dedikasi</a>
        <a href="/kontak" class="py-2 border-b">Kontak</a>
        <a href="/donasi" class="py-2">Donasi</a>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("nav-toggle");
        const mobileMenu = document.getElementById("mobile-menu");

        toggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    });
</script>