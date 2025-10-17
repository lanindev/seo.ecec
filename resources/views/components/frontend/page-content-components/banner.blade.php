@props([
    "title",
])
<div class="relative h-40 overflow-hidden">
    <img
        src="{{ asset("images/home/banner.webp") }}"
        loading="lazy"
        alt="banner"
        class="absolute left-0 top-0 h-full w-full object-cover object-left"
    />
    <div class="relative z-10 h-full">
        <div class="absolute bottom-4 left-4 text-left">
            <h1 class="mb-0 text-2xl font-bold text-white drop-shadow-md md:text-2xl">
                {{ $title }}
            </h1>
        </div>
    </div>
</div>
