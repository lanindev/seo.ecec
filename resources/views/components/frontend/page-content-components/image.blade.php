@props([
    "src",
    "alt" => "image",
    "class" => "mx-auto block h-auto w-auto max-w-full",
])

@php
    if (request()->routeIs("property_id")) {
        $class = "h-auto w-full";
    }
@endphp

@if ($src)
    <img
        src="{{ Str::startsWith($src, "settings/") ? asset("storage/" . $src) : asset($src) }}"
        alt="{{ $alt }}"
        loading="lazy"
        {{ $attributes->merge(["class" => $class]) }}
    />
@endif
