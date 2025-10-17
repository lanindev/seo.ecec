@props([
    "checkItems" => [],
])

@php
    if (is_string($checkItems)) {
        $checkItems = array_filter(array_map("trim", explode(";", $checkItems)));
    }
@endphp

<ul class="space-y-3 text-gray-700">
    @foreach ($checkItems as $checkItem)
        <li class="flex items-center gap-3">
            <i class="fa-solid fa-check-circle text-lg text-green-500"></i>
            {{ $checkItem }}
        </li>
    @endforeach
</ul>
