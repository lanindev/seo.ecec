@props([
    "data",
])
<div>
    @if ($data["section_title"])
        <h2 class="mb-10 text-center text-4xl">{{ $data["section_title"] }}</h2>
    @endif

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        @foreach ($data["cards"] as $card)
            <div class="cursor-pointer border-4 hover:border-gold-500">
                @if ($card["image"])
                    <img
                        src="{{ Str::startsWith($card["image"], "settings/") ? asset("storage/" . $card["image"]) : asset($card["image"]) }}"
                        loading="lazy"
                        alt="{{ $card["title"] }}"
                        class="mb-4 h-64 w-full object-cover"
                    />
                @endif

                @if ($card["title"])
                    <h3 class="mb-0 px-4 text-2xl font-semibold text-gold-700">{{ $card["title"] }}</h3>
                @endif

                @if ($card["description"])
                    <p class="px-4 py-2 text-lg leading-relaxed text-gray-700">
                        {{ $card["description"] }}
                    </p>
                @endif
            </div>
        @endforeach
    </div>
</div>
