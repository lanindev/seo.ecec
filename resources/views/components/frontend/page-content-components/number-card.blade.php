@props([
    "data",
])
<div class="bg-white py-12">
    <div class="mx-auto max-w-4xl px-6">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            @foreach ($data["cards"] as $card)
                <div class="rounded-lg border border-sky-200 bg-white p-6 text-center">
                    @if (isset($card["number"]))
                        <div class="mb-2 text-6xl font-light text-sky-500">{{ $card["number"] }}</div>
                    @endif

                    @if ($card["title"])
                        <h3 class="mb-1 text-lg font-semibold text-sky-500">{{ $card["title"] }}</h3>
                    @endif

                    @if ($card["description"])
                        <p class="text-sm text-sky-500">{{ $card["description"] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
