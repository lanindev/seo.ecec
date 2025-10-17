@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="space-y-8">
        @foreach ($data["cards"] as $i => $card)
            <div class="{{ $i % 2 === 1 ? "md:flex-row-reverse" : "md:flex-row" }} flex flex-row items-start items-center gap-4 md:gap-6">
                @if ($card["icon"])
                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-sky-100 text-2xl text-sky-600 shadow-md"
                    >
                        <i class="fas fa-{{ $card["icon"] }}"></i>
                    </div>
                @endif

                <div class="relative w-full rounded-xl bg-white p-5 shadow ring-1 ring-gray-200 md:w-2/3">
                    <div class="{{ $i % 2 === 1 ? "right-full mr-2" : "left-full ml-2" }} absolute top-5 hidden md:block">
                        <div
                            class="{{ $i % 2 === 1 ? "rotate-180 transform" : "" }} h-0 w-0 border-y-8 border-r-8 border-y-transparent border-r-white"
                        ></div>
                    </div>
                    @if ($card["title"])
                        <h3 class="{{ $card["description"] ? "mb-2" : "" }} text-lg font-semibold text-gray-800">{{ $card["title"] }}</h3>
                    @endif

                    @if ($card["description"])
                        <p class="text-sm leading-relaxed text-gray-600">{{ $card["description"] }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
