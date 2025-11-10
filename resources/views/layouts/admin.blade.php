<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Dedikasi Malang') }}</title>

    @stack('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script src="https://cdn.tiny.cloud/1/rlfut01sybdlz7kikxzo98lo0jo9ki0ep46bdf96m6bjhsnd/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{
        open: false,
        profileModalOpen: false,
        avatarPreview: '{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : null }}',
        avatarRemoved: false
    }" class="bg-gray-100 font-sans antialiased overflow-hidden">

    <div class="flex min-h-screen">
        <x-sidebar-admin></x-sidebar-admin>

        <div class="relative flex-1 flex flex-col h-screen overflow-y-auto">
            <header class="bg-primary-yellow shadow-md">
                @yield('header')
            </header>

            <x-alert></x-alert>

            <main class="flex-1 p-4 bg-gray-50">
                <x-alert-delete></x-alert-delete>
                @yield('content')
            </main>
        </div>
    </div>

    <div x-show="profileModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-50 backdrop-blur-lg p-4"
        @keydown.escape.window="profileModalOpen = false" style="display: none;" x-cloak>

        <div @click.away="profileModalOpen = false" x-show="profileModalOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="bg-white rounded-lg shadow-xl w-full max-w-md flex flex-col">

            <div class="relative p-4 flex justify-center items-center">
                <h2 class="text-xl font-bold text-gray-800">Ubah Profil</h2>
                <button @click="profileModalOpen = false"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
            </div>

            <div class="px-6 pb-6 flex justify-center">
                <div class="relative group">
                    <div @click="$refs.avatarInput.click()" class="cursor-pointer">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="Preview Foto Profil"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md ring-1 ring-gray-200">
                        </template>
                        <template x-if="!avatarPreview">
                            <div
                                class="w-24 h-24 rounded-full border-4 border-white shadow-md ring-1 ring-gray-200 bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </template>
                        <div
                            class="absolute inset-0 bg-black rounded-full flex items-center justify-center opacity-0 group-hover:opacity-40 transition-opacity duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <template x-if="avatarPreview">
                        <button type="button" @click="avatarPreview = null; avatarRemoved = true"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1.5 shadow-md opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            title="Hapus Foto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </template>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                            required>
                    </div>

                    <input type="file" name="avatar" id="avatar" x-ref="avatarInput" @change="
                        let reader = new FileReader(); 
                        reader.onload = (e) => { 
                            avatarPreview = e.target.result;
                            avatarRemoved = false;
                        }; 
                        reader.readAsDataURL($event.target.files[0])" class="hidden">

                    <input type="checkbox" name="remove_avatar" x-model="avatarRemoved" class="hidden" value="1">

                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" @click="profileModalOpen = false"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-primary-yellow text-gray-900 font-semibold rounded-md hover:bg-yellow-400">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>

</html>