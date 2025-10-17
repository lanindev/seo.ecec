@props([
    "text",
])
@if ($text)
    <div class="rich-text-content space-y-5 py-5">
        {!! $text !!}
    </div>
@endif
