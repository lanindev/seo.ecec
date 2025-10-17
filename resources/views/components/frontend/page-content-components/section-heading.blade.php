@props([
    "title",
])

@if ($title)
    <div class="pb-10 text-center">
        <h2 class="mb-2 text-3xl font-bold text-gray-800 md:text-4xl">
            {{ $title }}
        </h2>
        <div class="mx-auto h-1 w-24 bg-gradient-to-r from-sky-400 to-sky-500"></div>
    </div>
@endif
