@foreach ($pengurus as $item)
    <a href="{{ $item->link_instagram }}" target="_blank">
            <div class="z-10 h-45 w-30 md:h-75 md:w-60 bg-cover bg-center flex flex-col justify-end p-4 text-white rounded-md hover:shadow-xl duration-200 cursor-pointer hover:-translate-y-1"
                style="background-image: url('{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}');"
                alt="{{ $item->nama }}">
                <h1 class="font-bold leading-3 text-[9px] md:text-xl" style="text-transform: uppercase">
                    {{ $item->jabatan }}</h1>
                <p class="font-thin leading-3 md:leading-6 text-[12px] md:text-lg" style="text-transform: uppercase">
                    {{ $item->nama }}</p>
            </div>
    </a>
@endforeach