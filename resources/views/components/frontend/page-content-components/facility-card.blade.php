@props([
    "data",
])
<div>
    <div class="flex justify-center gap-12">
        @foreach ($data["cards"] as $index => $card)
            @php
                $items = [];

                if (! empty($card["items"])) {
                    $items = preg_split("/\r\n|\n|\r/", $card["items"]);
                }
            @endphp

            <div class="group relative w-full overflow-hidden border border-sky-500 bg-white/80 p-8 ring-sky-500 md:w-1/2 lg:w-1/3">
                <div class="absolute left-0 top-0 h-full w-1 bg-sky-500"></div>

                @if ($card["title"])
                    <div class="mb-6 flex items-center space-x-4">
                        <div>
                            <h3 class="text-3xl font-medium text-sky-800">{{ $card["title"] }}</h3>
                        </div>
                    </div>
                @endif

                @if (! empty($items))
                    <ul class="space-y-3 text-sm leading-relaxed text-gray-700">
                        @foreach ($items as $item)
                            <li class="flex items-center">
                                <i class="fas fa-check mr-3 mt-1 text-xl text-sky-400"></i>
                                <span class="text-left text-sm font-medium text-gray-800">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</div>
