@props([
    "data",
])
@php
    $blocks = $data["blocks"] ?? [];
@endphp

@foreach ($blocks as $index => $block)
    @php
        $image = $block["image"] ?? null;
        $badgeColor = $block["badge_color"] ?? "sky";
        $badgeText = $block["badge_text"] ?? "";
        $title = $block["title"] ?? "";
        $description = $block["description"] ?? "";
        $checkItems = $block["checklist_items"] ?? [];

        $isEven = $index % 2 === 0;
        $imageOrder = $isEven ? "md:order-2" : "md:order-1";
        $textOrder = $isEven ? "md:order-1" : "md:order-2";
    @endphp

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-center md:gap-12">
        @if ($image)
            <div class="{{ $imageOrder }} order-2">
                <x-frontend.page-content-components.image :src="$image" :alt="$title"
                                                          class="rounded-xl shadow-lg ring-1 ring-gray-200" />
            </div>
        @endif

        <div class="{{ $image ? $textOrder : "" }} order-1 space-y-4">
            <x-frontend.page-content-components.badge :color="$badgeColor" :text="$badgeText" class="text-2xl" />

            <h3 class="text-2xl font-semibold text-gray-800">{{ $title }}</h3>
            <p class="leading-relaxed text-gray-600">{{ $description }}</p>

            <x-frontend.page-content-components.checklist :checkItems="$checkItems" :color="$badgeColor" />
        </div>

        @unless ($image)
            <div class="relative">
                <x-frontend.page-content-components.image :src="$image" :alt="$title"
                                                          class="rounded-xl shadow-lg ring-1 ring-gray-200" />
            </div>
        @endunless
    </div>
@endforeach
