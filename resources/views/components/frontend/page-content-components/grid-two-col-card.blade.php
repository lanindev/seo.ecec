@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="grid gap-8 md:grid-cols-2">
        @foreach ($data["cards"] as $card)
            <div class="flex gap-5 rounded-xl bg-white p-6 shadow-md ring-1 ring-gray-200 transition hover:ring-sky-500">
                @if ($card["icon"])
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-sky-100 text-xl text-sky-600">
                        <i class="fas fa-{{ $card["icon"] }}"></i>
                    </div>
                @endif

                <div>
                    @if ($card["title"])
                        <h3 class="mb-1 text-lg font-semibold text-gray-800">{{ $card["title"] }}</h3>
                    @endif

                    @if ($card["description"])
                        <p class="text-sm leading-relaxed text-gray-600">{{ $card["description"] }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
