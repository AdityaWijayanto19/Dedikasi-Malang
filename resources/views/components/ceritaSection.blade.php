@props(['cerita'])
<section class="px-15 md:px-30 mt-5 z-40" id="cerita">
    <div class="flex flex-col justify-center items-center">
        <hr class="border-0.5 border-gray-400 w-full mb-2">
        <h1 class="font-bold text-xl md:text-4xl text-[#E9C153]">CERITA DEDIKASI</h1>
        <hr class="border-0.5 border-gray-400 w-full mt-2 mb-5">
    </div>
    <div class="grid grid-cols-1 gap-4 px-5 md:px-10 place-items-center">
        @foreach ($cerita as $item)
            <div class="flex justify-center md:gap-10">
                <a href="{{ route('pages.cerita.show', $item->slug) }}" target="_blank">
                    <div class="h-45 w-30 md:h-75 md:w-60 bg-cover bg-center flex flex-col justify-end p-4 text-white rounded-md hover:shadow-xl duration-200 cursor-pointer hover:-translate-y-1"
                        style="background-image: url('{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}');"
                        alt="$item -> nama_penulis">
                        <h1 class="font-bold leading-4 text-[9px] md:text-xl" style="text-transform:uppercase">{{$item->
            nama_penulis}}</h1>
                        <p class="font-thin leading-3 md:leading-4 text-[12px] md:text-lg"
                            style="text-transform: uppercase">{{$item->
            jabatan}}</p>
                    </div>
                </a>
                <div class=" md:w-150">
                    <h1 class="font-bold text-xl/5 md:text-3xl text-center md:text-start text-[#E9C153]">
                        {{ strtoupper($item->title) }}
                    </h1>
                    <p class="text-sm md:text-lg font-thin text-neutral-600 mt-5">Penulis : {{ $item->nama_penulis }}</p>
                    <p class="text-sm md:text-lg font-thin text-neutral-600">Terbit pada :
                        {{ $item->created_at->format('d-m-Y') }}
                    </p>
                    <p class="text-sm md:text-lg font-thin text-neutral-600 mt-5">Silahkan tekan untuk informasi lebih
                        lanjut
                    </p>
                    <div class="flex justify-center items-center md:justify-start">
                        <a href="{{ route('pages.cerita.show', $item->slug)  }}"
                            class="p-1 w-50 md:w-60 rounded-md border border-[#E9C153] text-[#E9C153] font-semibold text-center text-md md:text-lg mt-2 hover:bg-[#E9C153] hover:text-white hover:shadow-md hover:scale-101 duration-200">BACA
                            SELENGKAPNYA</a>
                    </div>
                </div>
            </div>
            <hr class="border-0.5 border-gray-400 w-full mb-2">

        @endforeach
    </div>
    <a href="{{ route('pages.cerita.create') }}">
        <button
            class="text-md md:text-lg text-white bg-[#E9C153] font-semibold w-full p-1 rounded-md mt-2 hover:shadow-md hover:scale-101 duration-200">KIRIM
            TULISAN</button>
    </a>
</section>