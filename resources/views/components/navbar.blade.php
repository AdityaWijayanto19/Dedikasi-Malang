<nav x-data="{ searchActive: false }" @keydown.escape.window="searchActive = false" id="main-nav"
    class="w-full fixed top-0 z-50 font-sans transition-transform duration-300 ease-in-out">

    <div id="top-bar" class="flex justify-center items-center py-2 bg-[#E9C153] transition-opacity duration-300">
        <a href="/kegiatan"
            class="text-base font-medium text-white border border-white rounded px-6 py-1 hover:bg-white hover:text-[#E9C153] transition-all duration-200">
            Daftar Kegiatan
        </a>
    </div>

    <div id="navbar-container"
        class="bg-transparent h-20 px-6 md:px-12 flex justify-between items-center transition-colors duration-300">

        <a href="/" class="flex items-center gap-3 h-full">
            <img src="{{ asset('assets/logoDedikasi.png') }}" alt="logo dedikasi" class="h-10 w-auto">
            <p class="text-xl font-semibold text-gray-900 mt-1">
                Dedikasi Malang
            </p>
        </a>

        <ul class="hidden md:flex items-center gap-8 h-full">

            <li class="h-full flex items-center">
                <a href="/" class="relative text-lg font-normal transition-all duration-300
                   {{ request()->is('/') ? 'text-white font-bold' : 'text-gray-800 hover:text-gray-600' }}">
                    Beranda
                    <span
                        class="absolute -bottom-2 left-0 w-full h-1 bg-white rounded-full transition-transform duration-300 {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0' }}"></span>
                </a>
            </li>

            <li class="h-full flex items-center group relative">
                <a href="/kegiatan" class="relative text-lg font-normal transition-all duration-300 flex items-center gap-1
                   {{ request()->is('kegiatan*') ? 'text-white font-bold' : 'text-gray-800 hover:text-gray-600' }}">

                    Kegiatan
                    <svg class="w-4 h-4 stroke-2 transition-transform duration-300 group-hover:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>

                    <span class="absolute -bottom-2 left-0 w-full h-1 bg-white rounded-full transition-transform duration-300
                        {{ request()->is('kegiatan*') ? 'scale-x-100' : 'scale-x-0' }}">
                    </span>
                </a>

                <div class="absolute hidden group-hover:block w-56 bg-[#E9C153] shadow-xl rounded-sm -mt-4 top-full -left-16
                transition-all duration-300 z-50 overflow-hidden border border-[#E9C153]">
                    @if (isset($kegiatan_batch) && count($kegiatan_batch) > 0)
                        @foreach ($kegiatan_batch as $batch)
                            <a href="{{ route('pages.kegiatan.show', $batch->slug) }}"
                                class="block px-4 py-2 text-sm text-gray-800 hover:bg-[#E9C153] text-center hover:text-white transition-colors duration-150">
                                {{ $batch->batch }}
                            </a>
                        @endforeach
                    @else
                        <span class="block px-4 py-2 text-sm text-gray-500">Tidak ada data kegiatan.</span>
                    @endif
                </div>
            </li>

            <li class="h-full flex items-center group relative">
                <a href="{{ route('pages.cerita.index') }}" class="relative text-lg font-normal transition-all duration-300 flex items-center gap-1
                {{ request()->is('cerita*') ? 'text-white font-bold' : 'text-gray-800 hover:text-gray-600' }}">
                    Cerita Dedikasi

                    <svg class="w-4 h-4 stroke-2 transition-transform duration-300 group-hover:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>

                    <span class="absolute -bottom-2 left-0 w-full h-1 bg-white rounded-full transition-transform duration-300
                    {{ request()->is('cerita*') ? 'scale-x-100' : 'scale-x-0' }}">
                    </span>
                </a>

                <div class="absolute hidden group-hover:block w-56 bg-[#E9C153] shadow-xl rounded-sm -mt-4 top-full -left-10
                transition-all duration-300 z-50 overflow-hidden border border-[#E9C153]">
                    @if (isset($cerita_batch) && count($cerita_batch) > 0)
                        @foreach ($cerita_batch as $cerita)
                            <a href="{{ route('pages.cerita.show', $cerita->slug) }}"
                                class="block px-4 py-2 text-sm text-gray-800 hover:bg-[#E9C153] text-center hover:text-white transition-colors duration-150">
                                {{ $cerita->title }}
                            </a>
                        @endforeach
                    @else
                        <span class="block px-4 py-1 text-sm text-gray-400">Tidak ada kategori cerita.</span>
                    @endif
                </div>
            </li>

            <li class="h-full flex items-center">
                <a href="/kontak" class="relative text-lg font-normal transition-all duration-300
                   {{ request()->is('kontak*') ? 'text-white font-bold' : 'text-gray-800 hover:text-gray-600' }}">
                    Kontak
                    <span
                        class="absolute -bottom-2 left-0 w-full h-1 bg-white rounded-full transition-transform duration-300 {{ request()->is('kontak*') ? 'scale-x-100' : 'scale-x-0' }}"></span>
                </a>
            </li>

            <li class="h-full flex items-center">
                <a href="/donasi" class="relative text-lg font-normal transition-all duration-300
                   {{ request()->is('donasi*') ? 'text-white font-bold' : 'text-gray-800 hover:text-gray-600' }}">
                    Donasi
                    <span
                        class="absolute -bottom-2 left-0 w-full h-1 bg-white rounded-full transition-transform duration-300 {{ request()->is('donasi*') ? 'scale-x-100' : 'scale-x-0' }}"></span>
                </a>
            </li>

            <li class="h-full flex items-center">
                <button @click="searchActive = true; $nextTick(() => $refs.searchInput.focus())"
                    class="hover:scale-110 duration-200 text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </li>
        </ul>

        <button id="nav-toggle" class="md:hidden text-3xl text-gray-800 flex items-center">
            ☰
        </button>
    </div>

    <div x-show="searchActive" @click.away="searchActive = false"
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
        @transition:enter-end="$refs.searchInput.focus()"
        class="fixed top-[49px] left-0 h-20 w-full bg-gray-50 flex flex-col items-center justify-center z-50"
        style="display: none;">

        <button @click="searchActive = false"
            class="absolute top-1/2 -translate-y-1/2 left-4 text-gray-600 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </button>

        <div class="relative w-full max-w-2xl px-6 mx-auto" @click.stop>
            <div x-data="{ query: '{{ request('q') }}' }" class="w-full">
                <form action="{{ route('search.index') }}" method="GET" class="relative flex items-center">
                    <i class="fas fa-search absolute left-3 text-gray-400"></i>

                    <input type="text" name="q" x-model="query" x-ref="searchInput" placeholder="Telusuri situs ini..."
                        class="w-full bg-transparent text-lg text-gray-900 border-none focus:ring-0 pl-10 pr-10 py-2">

                    <button type="button" x-show="query.length > 0" @click="query = ''; $refs.searchInput.focus()"
                        class="absolute right-3 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden bg-[#FFE26F] border-t border-[#E9C153] md:hidden shadow-lg">
        <div class="flex flex-col px-6 py-4 space-y-4 text-base font-medium text-gray-800">
            <a href="/"
                class="block border-l-4 pl-2 {{ request()->is('/') ? 'border-white font-bold text-gray-900' : 'border-transparent' }}">Beranda</a>

            <div x-data="{ open: {{ request()->is('kegiatan*') ? 'true' : 'false' }} }" class="group">
                <div @click="open = !open" class="flex justify-between items-center cursor-pointer border-l-4 pl-2
                    {{ request()->is('kegiatan*') ? 'border-white font-bold text-gray-900' : 'border-transparent' }}">
                    <span>Kegiatan</span>
                    <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"
                        class="fas text-xs transition-all duration-300"></i>
                </div>

                <div x-show="open" x-collapse.duration.300ms class="pl-6 pt-2 pb-1 space-y-1 bg-white/50">
                    @if (isset($kegiatan_batch) && count($kegiatan_batch) > 0)
                        @foreach ($kegiatan_batch as $batch)
                            <a href="{{ route('pages.kegiatan.show', $batch->slug) }}"
                                class="block text-sm text-gray-700 hover:text-[#E9C153]">
                                {{ $batch->batch }}
                            </a>
                        @endforeach
                    @else
                        <span class="block text-sm text-gray-500">Tidak ada data kegiatan.</span>
                    @endif
                </div>
            </div>

            <a href="/cerita"
                class="block border-l-4 pl-2 {{ request()->is('cerita*') ? 'border-white font-bold text-gray-900' : 'border-transparent' }}">Cerita
                Dedikasi</a>
            <a href="/kontak"
                class="block border-l-4 pl-2 {{ request()->is('kontak*') ? 'border-white font-bold text-gray-900' : 'border-transparent' }}">Kontak</a>
            <a href="/donasi"
                class="block border-l-4 pl-2 {{ request()->is('donasi*') ? 'border-white font-bold text-gray-900' : 'border-transparent' }}">Donasi</a>
        </div>
    </div>
</nav>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("nav-toggle");
        const mobileMenu = document.getElementById("mobile-menu");

        toggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        const nav = document.getElementById('main-nav');
        const navbarContainer = document.getElementById('navbar-container');
        const topBar = document.getElementById('top-bar');

        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            const topBarHeight = topBar.offsetHeight;

            if (currentScrollY > 10) {
                navbarContainer.classList.remove('bg-transparent');
                navbarContainer.classList.add('bg-[#FFE26F]', 'shadow-md');
            } else {
                navbarContainer.classList.add('bg-transparent');
                navbarContainer.classList.remove('bg-[#FFE26F]', 'shadow-md');
            }

            if (currentScrollY > topBarHeight) {
                if (currentScrollY > lastScrollY) {
                    nav.style.transform = `translateY(-${topBarHeight}px)`;
                } else {
                    nav.style.transform = 'translateY(0)';
                }
            } else {
                nav.style.transform = 'translateY(0)';
            }

            lastScrollY = currentScrollY;
        });
    });
</script>