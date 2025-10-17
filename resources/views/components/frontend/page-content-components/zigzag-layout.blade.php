@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="space-y-16">
        @foreach ($data["cards"] as $index => $card)
            <div class="{{ $index % 2 === 1 ? "md:flex-row-reverse" : "" }} flex flex-col items-center gap-8 md:flex-row">
                @if ($card["icon"])
                    <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-full bg-white text-4xl text-sky-600 shadow-md">
                        <i class="fas fa-{{ $card["icon"] }}"></i>
                    </div>
                @endif

                <div class="max-w-2xl text-center md:text-left">
                    @if ($card["title"])
                        <h3 class="mb-3 text-2xl font-semibold text-gray-800">{{ $card["title"] }}</h3>
                    @endif

                    @if ($card["description"])
                        <p class="text-sm leading-relaxed text-gray-600 md:text-base">{{ $card["description"] }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
