@props([
    "color" => "sky",
    "text" => "",
    "class" => "",
])

<span class="bg-{{ $color }}-100 text-{{ $color }}-500 {{ $class }} inline-block rounded-full px-5 font-medium">
    {{ $text }}
</span>
