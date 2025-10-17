@props([
    "data",
])
<div class="space-y-12 rounded-xl p-10">
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        @foreach ($data["cards"] as $card)
            <div class="group space-y-3 p-6 text-center transition hover:-translate-y-1">
                @if ($card["icon"])
                    <div class="flex items-center justify-center text-4xl text-sky-600">
                        <i class="fas fa-{{ $card["icon"] }}"></i>
                    </div>
                @endif

                @if ($card["title"])
                    <h4 class="text-lg font-bold text-gray-800">{{ $card["title"] }}</h4>
                @endif

                @if ($card["description"])
                    <p class="whitespace-pre-line text-sm text-gray-600">{{ $card["description"] }}</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
