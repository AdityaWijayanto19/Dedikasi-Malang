<a href="{{ $link }}" target="_blank">
    <div class="h-45 w-30 md:h-75 md:w-60 bg-cover bg-center flex flex-col justify-end p-4 text-white rounded-md hover:shadow-xl duration-200 cursor-pointer hover:-translate-y-1"
        style="background-image: url('{{ asset($foto) }}');" alt="{{ $name }}">
        <h1 class="font-bold leading-3 text-[9px] md:text-xl">{{ strtoupper($role) }}</h1>
        <p class="font-thin leading-3 md:leading-6 text-[12px] md:text-lg">{{ strtoupper($name) }}</p>
    </div>
</a>