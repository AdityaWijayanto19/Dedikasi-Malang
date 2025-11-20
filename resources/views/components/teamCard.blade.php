<a href="{{ $link }}" target="_blank">
    <div class="h-50 w-35 bg-cover bg-center flex flex-col justify-end p-4 text-white rounded-md hover:shadow-xl duration-200 cursor-pointer hover:-translate-y-1"
        style="background-image: url('{{ asset($foto) }}');" alt="{{ $name }}">
        <h1 class="font-bold leading-2 text-[11px]">{{ strtoupper($role) }}</h1>
        <p class="font-thin text-[8px]">{{ strtoupper($name) }}</p>
    </div>
</a>