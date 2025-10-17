@props([
    "type",
    "data" => [],
    "property" => null,
])

@php
    $componentMap = [
        "showcase_hero" => "showcase-hero",
        "section_heading" => "section-heading",
        "hero" => "hero",
        "richtext" => "richtext",
        "image" => "image",
        "carousel" => "carousel",
        "slider" => "slider",
        "custom_table" => "custom-table",
        "alternating_layout" => "alternating-layout",
        "zigzag_layout" => "zigzag-layout",
        "grid_two_col_layout" => "grid-two-col-layout",
        "grid_two_col_card" => "grid-two-col-card",
        "grid_three_col_layout" => "grid-three-col-layout",
        "grid_three_col_card" => "grid-three-col-card",
        "grid_four_col_card" => "grid-four-col-card",
        "grid_five_col_card" => "grid-five-col-card",
        "service_card" => "service-card",
        "stack_card" => "stack-card",
        "list_card" => "list-card",
        "chat_card" => "chat-card",
        "step_card" => "step-card",
        "notice_card" => "notice-card",
        "intro_card" => "intro-card",
        "number_card" => "number-card",
        "facility_card" => "facility-card",
        "image_three_col_card" => "image-three-col-card",
        "icon_list_block" => "icon-list-block",
    ];
@endphp

@switch($type)
    @case("showcase_hero")
        <x-frontend.page-content-components.showcase-hero :data="$data" :property="$property" />

        @break
    @case("section_heading")
        <x-frontend.page-content-components.section-heading :title="$data['title']" />

        @break
    @case("richtext")
        <x-frontend.page-content-components.richtext :text="$data['content']" />

        @break
    @case("image")
        <x-frontend.page-content-components.image :src="$data['path']" />

        @break
    @default
        @if (isset($componentMap[$type]))
            <x-dynamic-component :component="'frontend.page-content-components.' . $componentMap[$type]" :data="$data" />
        @endif
@endswitch
