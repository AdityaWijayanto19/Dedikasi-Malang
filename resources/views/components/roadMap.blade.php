@props(['kegiatan'])
<section class="px-15 md:px-30 z-40 mt-5" id="roadmap">
    <div class="flex flex-col justify-center items-center">
        <hr class="border-0.5 border-gray-400 w-full mb-2">
        <h1 class="font-bold text-xl md:text-4xl text-center text-[#E9C153]">ROADMAP PROJECT DEDIKASI MALANG</h1>
        <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 place-items-center gap-2">

        @foreach ($kegiatan as $item)
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

    </div>
</section>
