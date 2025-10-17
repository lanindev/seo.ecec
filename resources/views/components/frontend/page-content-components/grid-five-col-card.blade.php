@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
        @foreach ($data["cards"] as $card)
            @php
                $starItems = [];

                if (! empty($card["description"])) {
                    $starItems = preg_split("/\r\n|\n|\r/", $card["description"]);
                }
            @endphp

            <div class="flex flex-col rounded-2xl bg-white p-5 shadow">
                @if ($card["title"])
                    <div>
                        <h3 class="mb-3 border-b border-sky-200 pb-2 text-lg font-bold text-sky-700">
                            @if ($card["icon"])
                                <i class="fas fa-{{ $card["icon"] }} mr-1 text-lg"></i>
                            @endif

                            {{ $card["title"] }}
                        </h3>
                    </div>
                @endif

                @if (! empty($starItems))
                    <x-frontend.page-content-components.starlist :starItems="$starItems" />
                @endif
            </div>
        @endforeach
    </div>
</div>
