@props([
    "data",
])

@php
    $title = $data["title"] ?? "";
    $subtitle = $data["subtitle"] ?? "";
    $description = $data["description"] ?? "";
@endphp

<div class="py-10 text-center">
    <h2 class="space-y-5 text-4xl font-bold text-gray-900 sm:text-5xl">
        @if ($title)
            <div class="relative inline-block">
                <span class="relative z-10 bg-gradient-to-r from-sky-600 to-sky-400 bg-clip-text text-transparent">
                    {{ $title }}
                </span>
                <span class="absolute bottom-0 left-0 h-2 w-full rounded-full bg-sky-100 opacity-50"></span>
            </div>
        @endif

        @if ($subtitle)
            <div class="text-2xl font-medium text-gray-700">{{ $subtitle }}</div>
        @endif
    </h2>

    @if ($description)
        <p class="mt-6 text-lg text-gray-600">{{ $description }}</p>
    @endif
</div>
