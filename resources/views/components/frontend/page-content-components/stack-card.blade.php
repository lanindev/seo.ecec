@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="space-y-4">
        @foreach ($data["cards"] as $card)
            <div class="rounded-xl bg-white p-6 shadow ring-1 ring-gray-200 transition hover:ring-sky-500">
                @if ($card["title"] && $card["icon"])
                    <div class="{{ $card["description"] ? "mb-2" : "" }} flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-sky-600">
                            {{ $card["title"] }}
                        </h3>
                        <i class="fas fa-{{ $card["icon"] }} text-lg text-sky-400"></i>
                    </div>
                @endif

                @if ($card["description"])
                    <p class="text-sm leading-relaxed text-gray-600">{{ $card["description"] }}</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
