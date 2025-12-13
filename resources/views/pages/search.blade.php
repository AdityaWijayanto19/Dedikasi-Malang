<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $q ? $q . ' - Penelusuran Dedikasi' : 'Penelusuran' }}</title>

    @vite(['resources/css/app.css'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }

        .google-link {
            color: #1a0dab;
        }

        .google-snippet {
            color: #4d5156;
            line-height: 1.58;
        }

        .search-shadow:focus-within {
            box-shadow: 0 1px 6px rgba(32, 33, 36, .28);
            border-color: rgba(223, 225, 229, 0);
        }
    </style>
</head>

<body class="bg-white">

    <header class="border-b border-gray-200 sticky top-0 bg-white z-50">
        <div class="max-w-5xl mx-auto px-4 md:px-36">

            <div class="flex flex-col md:flex-row items-center pt-6 pb-4">
                <div class="md:mr-6 mb-4 md:mb-0">
                    <a href="/" class="text-2xl font-bold flex items-center">
                        <span class="text-blue-500">D</span>
                        <span class="text-red-500">e</span>
                        <span class="text-yellow-500">d</span>
                        <span class="text-blue-500">i</span>
                        <span class="text-green-500">k</span>
                        <span class="text-red-500">a</span>
                        <span class="text-blue-500">s</span>
                        <span class="text-green-500">i</span>
                    </a>
                </div>

                <form action="{{ route('search.index') }}" method="GET" class="w-full max-w-2xl">
                    <div
                        class="search-shadow flex items-center w-full border border-gray-200 rounded-full px-5 py-2.5 transition">
                        <input type="text" name="q" value="{{ $q }}"
                            class="flex-grow outline-none text-gray-800 text-base" placeholder="Telusuri situs ini">
                        <div class="flex items-center space-x-3 border-l pl-3 ml-2 border-gray-300">
                            <button type="submit" class="text-blue-500">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex space-x-6 text-sm text-gray-600">
                <div
                    class="flex items-center space-x-1 border-b-4 border-blue-500 pb-3 text-blue-600 font-medium cursor-pointer">
                    <i class="fas fa-search text-xs"></i>
                    <span>Situs ini</span>
                </div>
                {{-- <div class="flex items-center space-x-1 pb-3 hover:text-blue-600 transition cursor-pointer">
                    <i class="far fa-file-alt text-xs"></i>
                    <span>File disematkan</span>
                </div> --}}
            </div>

        </div>
    </header>


    <main class="max-w-5xl mx-auto px-4 md:px-36 py-4">

        @if($q)
            <div class="text-sm text-gray-500 mb-2">
                <a href="/" class="text-blue-600 hover:text-blue-400">Beranda</a>
                <span class="mx-1">›</span>
                <span class="underline">Penelusuran</span>
            </div>

            <div class="text-sm text-gray-500 mb-8">
                Menampilkan {{ $results->count() }} hasil untuk
                <span class="font-bold">"{{ $q }}"</span>
            </div>
        @endif

        <div class="space-y-8 max-w-2xl">
            @forelse($results as $item)
                <div class="group">
                    <div class="text-sm text-gray-800 mb-1 truncate">
                        {{ url('/') }} › <span class="text-gray-500">{{ strtolower($item->category) }}</span>
                    </div>

                    <a href="{{ $item->url }}" class="group-hover:underline">
                        <h3 class="text-xl google-link font-normal mb-1">
                            {{ $item->title }}
                        </h3>
                    </a>

                    <div class="google-snippet text-sm mb-1">
                        <span class="text-gray-500">{{ $item->date }} — </span>
                        {{ $item->snippet }}
                    </div>
                </div>
            @empty
                <div class="py-10">
                    <p class="text-gray-800">Penelusuran Anda - <span class="font-bold">{{ $q }}</span> - tidak cocok dengan
                        dokumen apa pun.</p>
                    <p class="mt-4 text-gray-800 font-medium">Saran:</p>
                    <ul class="list-disc ml-8 mt-2 text-gray-700 space-y-1">
                        <li>Pastikan semua kata dieja dengan benar.</li>
                        <li>Coba kata kunci lain.</li>
                        <li>Coba kata kunci yang lebih umum.</li>
                    </ul>
                </div>
            @endforelse
        </div>

        @if($results->count() > 0)
            <div class="mt-12 flex items-center justify-center space-x-2 text-blue-600 font-medium pb-9">
                <span class="text-red-500 text-2xl">D</span>
                <span class="text-yellow-500">e</span>
                <span class="text-yellow-500 border-b-2 border-red-500">d</span>
                <span class="text-yellow-500">i</span>
                <span class="text-blue-500">k</span>
                <span class="text-green-500">a</span>
                <span class="text-red-500">s</span>
                <span class="text-blue-500">i</span>
                {{-- <a href="#" class="ml-4 hover:underline">Berikutnya</a> --}}
            </div>
        @endif
    </main>
</body>

</html>