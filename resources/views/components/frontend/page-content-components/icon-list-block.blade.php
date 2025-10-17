@props([
    "data",
])
<div class="py-10">
    <div class="relative grid grid-cols-1 gap-12 overflow-hidden border border-sky-600 bg-white/80 p-8 ring-sky-600 md:grid-cols-2">
        <div>
            @if ($data["section_title"])
                <div class="mb-6 flex items-center space-x-4">
                    <h3 class="text-3xl font-medium text-sky-600">{{ $data["section_title"] }}</h3>
                </div>
            @endif

            <ul class="space-y-3 text-sm leading-relaxed text-gray-700">
                @foreach ($data["items"] as $item)
                    <li class="flex items-start space-x-3 text-sm font-medium text-gray-800">
                        @if ($item["icon"])
                            <i
                                class="{{ in_array($item["icon"], ["weixin", "whatsapp", "facebook", "line", "x-twitter", "weibo", "tiktok"]) ? "fab" : ($item["icon"] === "clock" ? "far" : "fas") }} fa-{{ $item["icon"] }} fa-fw flex-shrink-0 text-lg text-sky-600"
                            ></i>
                        @endif

                        @if ($item["description"])
                            <a href="{{ $item["text_link"] ?? "#" }}" class="font-roboto text-xl font-normal hover:text-sky-600">
                                {{ $item["description"] }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex items-center justify-center">
            @if (! empty($data["image_link"]))
                <a href="{{ $data["image_link"] }}" target="_blank" rel="noopener noreferrer" class="block w-full">
                    <img
                        src="{{ Str::startsWith($data["image"], "settings/") ? asset("storage/" . $data["image"]) : asset($data["image"]) }}"
                        class="h-96 w-full rounded-lg object-cover"
                    />
                </a>
            @else
                <img src="{{ $data["image"] }}" class="h-96 w-full rounded-lg object-cover" />
            @endif
        </div>
    </div>
</div>
