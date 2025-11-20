<div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-5 md:px-10 place-items-center">
    <x-teamCard foto="{{asset($foto)}}" role="{{ str($role) }}" name="{{ strtoupper($name) }}" link="{{ $link }}" />
    <div class="col-span-2 md:w-100">
        <h1 class="font-bold text-lg/5 md:text-xl text-center md:text-start text-[#E9C153]">{{ strtoupper($judul) }}</h1>
        <p class="text-xs font-thin text-neutral-600 mt-5">Penulis : {{ $name }}</p>
        <p class="text-xs font-thin text-neutral-600">Terbit pada : {{date($tanggal)}}</p>
        <p class="text-xs font-thin text-neutral-600 mt-5">Silahkan tekan untuk informasi lebih lanjut</p>
        <div class="flex justify-center items-center md:justify-start">
            <a href="/artikel cerita"
                class="p-1 w-45 md:w-60 rounded-md border border-[#E9C153] text-[#E9C153] font-semibold text-center text-sm mt-2 hover:bg-[#E9C153] hover:text-white hover:shadow-md hover:scale-101 duration-200">BACA
                SELENGKAPNYA</a>
        </div>
    </div>
</div>
<hr class="border-0.5 border-gray-400 w-full mb-2">