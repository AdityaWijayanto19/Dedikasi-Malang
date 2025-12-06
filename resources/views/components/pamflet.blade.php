<a href="/detail kegiatan">
    <div
        class="flex flex-col justify-center items-center h-fit w-60 hover:-translate-y-1 cursor-pointer duration-200 mb-2">
        <img class="h-70 w-fit rounded-md hover:shadow-xl" src="{{ asset($poster) }}" alt="poster kegiatan">
        <h1 class="font-semibold text-xl text-neutral-800">{{ strtoupper($batch) }}</h1>
        <h2 class="text-sm font-thin text-neutral-600 text-center">{{ str($tema) }}</h2>
    </div>
</a>