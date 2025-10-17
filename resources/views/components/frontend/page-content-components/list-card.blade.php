@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="space-y-8">
        @foreach ($data["cards"] as $card)
            <div class="flex items-start gap-6 rounded-xl bg-white p-6 shadow ring-1 ring-gray-200 transition hover:ring-sky-500">
                @if ($card["icon"])
                    <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-sky-100 text-3xl text-sky-600">
                        <i class="fas fa-{{ $card["icon"] }}"></i>
                    </div>
                @endif

                <div class="flex-1">
                    @if ($card["title"])
                        <h3 class="text-xl font-semibold text-gray-800">{{ $card["title"] }}</h3>
                    @endif

                    @if ($card["description"])
                        <p class="{{ $card["title"] ? "mt-2" : "" }} leading-relaxed text-gray-600">{{ $card["description"] }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
