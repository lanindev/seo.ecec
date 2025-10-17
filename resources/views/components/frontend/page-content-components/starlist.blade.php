@props([
    "starItems" => [],
])
<ul class="space-y-2 overflow-auto text-sm text-gray-700">
    @foreach ($starItems as $starItem)
        <li class="flex items-start gap-2">
            <i class="fa-solid fa-star mt-1 text-sky-500"></i>
            <span>{{ $starItem }}</span>
        </li>
    @endforeach
</ul>
