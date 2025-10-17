@props([
    "data",
])
@if (count($data["cards"]))
    <div>
        <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($data["cards"] as $card)
                <div
                    class="group rounded-2xl bg-white p-8 text-center shadow-md ring-1 ring-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"
                >
                    @if ($card["icon"])
                        <div
                            class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-sky-500 text-white shadow-md transition-transform duration-300 group-hover:scale-110"
                        >
                            <i class="fas fa-{{ $card["icon"] }} text-3xl"></i>
                        </div>
                    @endif

                    @if ($card["title"])
                        <h3 class="mb-3 text-xl font-bold text-gray-800">{{ $card["title"] }}</h3>
                    @endif

                    @if ($card["description"])
                        <p class="text-sm leading-relaxed text-gray-600">
                            {{ $card["description"] }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
