@props(['title', 'body', 'icon' => null])

<div class="relative bg-hijau/50 text-black p-4 rounded-xl shadow-lg w-full sm:w-1/3 text-center mx-1 overflow-hidden flex flex-col justify-between">
    <div class="relative z-10">
        <h3 class="font-semibold text-lg mb-1 uppercase tracking-wide">
            {{ $title }}
        </h3>

        <div class="text-4xl font-extrabold mb-2">
            {{ $body }}
        </div>

        @if ($icon)
        <div class="absolute inset-0 flex items-center justify-center opacity-20 z-0 pointer-events-none">
            <x-dynamic-component :component="$icon" class="w-24 h-24 text-black" />
        </div>
        @endif

        {{ $slot }}

    </div>
</div>