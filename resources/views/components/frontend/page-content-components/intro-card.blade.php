@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-100">
        <div class="flex flex-col items-start gap-6 md:flex-row">
            @if ($data["icon"])
                <div class="flex-shrink-0">
                    <div class="flex h-24 w-24 items-center justify-center rounded-full bg-white shadow-md">
                        <i class="fas fa-{{ $data["icon"] }} text-4xl text-sky-500"></i>
                    </div>
                </div>
            @endif

            <div>
                @if ($data["title"])
                    <h3 class="text-2xl font-bold text-gray-800">{{ $data["title"] }}</h3>
                @endif

                @if ($data["content"])
                    <div class="space-y-4 whitespace-pre-line text-sm leading-relaxed text-gray-700 md:text-base">
                        {{ $data["content"] }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
