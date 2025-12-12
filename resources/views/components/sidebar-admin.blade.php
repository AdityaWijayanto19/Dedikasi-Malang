<aside class="relative z-40 min-h-screen">
    <div class="lg:hidden absolute top-4 left-4 z-50">
        <button @click="open = !open" class="p-2 bg-primary-yellow rounded-md shadow-md focus:outline-none">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition.opacity @click="open = false"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm lg:hidden z-30"></div>

    <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
        :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed lg:static inset-y-0 left-0 w-64 bg-[#142233] text-white transform lg:transform-none transition-transform duration-300 ease-in-out z-40 flex flex-col justify-between min-h-screen overflow-hidden">

        <div class="p-6 flex flex-col flex-grow">
            <div class="flex items-center space-x-2 mb-6">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-12 h-12">
                <h1 class="text-l font-bold ml-2">Dedikasi Malang</h1>
            </div>

            <nav class="space-y-1 flex-1">
                <a href="{{ route('admin.kegiatan.index') }}"
                    class="flex items-center space-x-2 py-2.5 px-4 rounded font-semibold transition {{ request()->routeIs('admin.kegiatan.*') ? 'bg-primary-yellow text-gray-900 hover:bg-yellow-400' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-5 w-5 mr-3">
                        <path
                            d="M12 11.993a.75.75 0 0 0-.75.75v.006c0 .414.336.75.75.75h.006a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75H12ZM12 16.494a.75.75 0 0 0-.75.75v.005c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H12ZM8.999 17.244a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.006ZM7.499 16.494a.75.75 0 0 0-.75.75v.005c0 .414.336.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H7.5ZM13.499 14.997a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.005a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.005ZM14.25 16.494a.75.75 0 0 0-.75.75v.006c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75h-.005ZM15.75 14.995a.75.75 0 0 1 .75-.75h.005a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75H16.5a.75.75 0 0 1-.75-.75v-.006ZM13.498 12.743a.75.75 0 0 1 .75-.75h2.25a.75.75 0 1 1 0 1.5h-2.25a.75.75 0 0 1-.75-.75ZM6.748 14.993a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" />
                        <path fill-rule="evenodd"
                            d="M18 2.993a.75.75 0 0 0-1.5 0v1.5h-9V2.994a.75.75 0 1 0-1.5 0v1.497h-.752a3 3 0 0 0-3 3v11.252a3 3 0 0 0 3 3h13.5a3 3 0 0 0 3-3V7.492a3 3 0 0 0-3-3H18V2.993ZM3.748 18.743v-7.5a1.5 1.5 0 0 1 1.5-1.5h13.5a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5h-13.5a1.5 1.5 0 0 1-1.5-1.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Kegiatan</span>
                </a>
                <a href="{{ route('admin.pendaftaran.index') }}"
                    class="flex items-center space-x-2 py-2.5 px-4 rounded font-semibold transition {{ request()->routeIs('admin.pendaftaran.*') ? 'bg-primary-yellow text-gray-900 hover:bg-yellow-400' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 mr-3">
                        <path
                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path
                            d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>

                    <span>Pendaftaran</span>
                </a>
                <a href="{{ route('admin.cerita.index') }}"
                    class="flex items-center space-x-2 py-2.5 px-4 rounded font-semibold transition {{ request()->routeIs('admin.cerita.*') ? 'bg-primary-yellow text-gray-900 hover:bg-yellow-400' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span>Cerita</span>
                </a>
                <a href="{{ route('admin.donasi.index') }}"
                    class="flex items-center space-x-2 py-2.5 px-4 rounded font-semibold transition {{ request()->routeIs('admin.donasi.*') ? 'bg-primary-yellow text-gray-900 hover:bg-yellow-400' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                    <span>Donasi</span>
                </a>
                <a href="{{ route('admin.pengurus.index') }}"
                    class="flex items-center space-x-2 py-2.5 px-4 rounded font-semibold transition {{ request()->routeIs('admin.pengurus.*') ? 'bg-primary-yellow text-gray-900 hover:bg-yellow-400' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span>Pengurus</span>
                </a>
                <a href="{{ route('admin.manage-admin.index') }}"
                    class="flex items-center space-x-2 py-2.5 px-4 rounded font-semibold transition {{ request()->routeIs('admin.admin.*') ? 'bg-primary-yellow text-gray-900 hover:bg-yellow-400' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    <span>Admin</span>
                </a>
            </nav>
        </div>

        <div class="p-6 bg-[#142233]">
            <div class="bg-gray-700 rounded-xl p-4 text-center relative">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2">
                    @if(auth()->user()->avatar)
                        <img class="w-20 h-20 rounded-full object-cover border-4 border-gray-800"
                            src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Foto Profil">
                    @else
                        <div
                            class="w-20 h-20 rounded-full border-4 border-gray-800 bg-gray-600 text-white text-3xl flex flex-col">
                            <div class="mt-auto flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-15 h-15">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mt-12">
                    <p class="text-l font-semibold text-white"> {{ auth()->user()->name }}</p>
                    <p class="text-sm text-gray-400 mb-4">{{ auth()->user()->email }}</p>
                    <a href="#" @click.prevent="profileModalOpen = true"
                        class="block w-full bg-primary-yellow text-gray-800 text-sm font-semibold py-2 rounded-lg transition duration-200 hover:bg-yellow-400 mt-2">
                        Ubah Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>