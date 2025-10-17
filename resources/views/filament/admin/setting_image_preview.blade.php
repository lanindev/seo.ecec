@if ($src)
    <img src="{{ Str::startsWith($src, "settings/") ? asset("storage/" . $src) : asset($src) }}" style="height: 40px; object-fit: cover" />
@endif
