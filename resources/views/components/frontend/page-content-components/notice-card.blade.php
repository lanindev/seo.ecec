@props([
    "data",
])

<div class="border-{{ $data["color"] }}-400 bg-{{ $data["color"] }}-50 mt-8 border-l-4 p-4">
    @if ($data["title"])
        <h2 class="text-{{ $data["color"] }}-500 mb-2 text-base font-bold">{{ $data["title"] }}</h2>
    @endif

    @if ($data["content"])
        <p class="whitespace-pre-line text-sm leading-loose">{{ $data["content"] }}</p>
    @endif
</div>
