@props([
    "page_slug",
    "property" => null,
    "components" => [],
    "bg" => "white",
    "class" => "",
])

@php
    $baseClass = match ($page_slug ?? "") {
        //        "about" => "max-w-4xl",
        default => "max-w-6xl",
    };

    $sectionTypes = [
        "alternating_layout",
        "zigzag_layout",
        "grid_two_col_layout",
        "grid_two_col_card",
        "grid_three_col_layout",
        "grid_three_col_card",
        "grid_four_col_card",
        "grid_five_col_card",
        "service_card",
        "stack_card",
        "list_card",
        "chat_card",
        "intro_card",
    ];

    $sectionIndex = 0;
@endphp

@foreach ($components as $component)
    @php
        $type = $component["type"];
        $data = $component["data"] ?? [];
        $isSection = in_array($type, $sectionTypes);
        $isSlider = $type === "slider";

        $pt = ! $isSlider && (($loop->first && ! $isSection) || (! $loop->first && $type === "section_heading")) ? "pt-16" : "";
        $pb = $loop->last ? "pb-16" : "";
        $padding = trim("{$pt} {$pb}");

        if ($isSlider) {
            $currentBaseClass = "";
            $px = "";
        } elseif (in_array($type, ["facility_card", "icon_list_block"])) {
            $currentBaseClass = "max-w-7xl";
            $px = "px-4";
        } else {
            $currentBaseClass = $baseClass;
            $px = "px-4";
        }

        if (isset($property) && ($type === "image" || $type === "showcase_hero")) {
            $innerClass = "";
        } else {
            $innerClass = trim("{$currentBaseClass} {$padding} mx-auto {$px} space-y-16");
        }

        $sectionClass = "py-28 ";
        if ($isSection) {
            $sectionClass .= $sectionIndex % 2 !== 0 ? "bg-gray-50" : "";
            $sectionIndex++;
        }
    @endphp

    @if ($isSection)
        <section class="{{ $sectionClass }}">
            <div class="{{ $innerClass }}">
                <x-frontend.page-content-components.content-component :type="$type" :data="$data" :property="$property ?? null" />
            </div>
        </section>
    @else
        <div class="{{ $innerClass }}">
            <x-frontend.page-content-components.content-component :type="$type" :data="$data" :property="$property ?? null" />
        </div>
    @endif
@endforeach
