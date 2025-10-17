@props([
    "data",
])
<div class="space-y-12 rounded-xl p-10">
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        @foreach ($data["cards"] as $card)
            <div class="group p-6 text-center transition hover:-translate-y-1">
                @if ($card["icon"])
                    <div class="mb-3 flex items-center justify-center text-4xl text-sky-500">
                        @if ($card["icon"] === "phone")
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6 h-12 w-12 text-sky-500"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"
                                />
                            </svg>
                        @else
                            <i
                                class="{{ in_array($card["icon"], ["weixin", "whatsapp", "facebook", "line", "x-twitter", "weibo", "tiktok"]) ? "fab" : ($card["icon"] === "clock" ? "far" : "fas") }} fa-{{ $card["icon"] }} text-5xl text-sky-500"
                            ></i>
                        @endif
                    </div>
                @endif

                @if ($card["title"])
                    <h4 class="text-lg font-semibold text-gray-800">{{ $card["title"] }}</h4>
                @endif

                @if ($card["description"])
                    <div class="text-gray-600">{{ $card["description"] }}</div>
                @endif
            </div>
        @endforeach
    </div>
</div>
