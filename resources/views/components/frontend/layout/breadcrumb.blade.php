<nav class="mb-6" aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center text-base text-gray-600">
        @foreach ($breadcrumbs as $crumb)
            <li class="{{ $loop->last ? "break-words" : "" }} flex items-center">
                @if (! $loop->first)
                    <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
                @endif

                @if (! empty($crumb["url"]) && ! $loop->last)
                    <a href="{{ $crumb["url"] }}" class="transition-colors hover:text-sky-600">
                        {{ $crumb["label"] }}
                    </a>
                @else
                    <span class="break-words font-medium text-gray-900">{{ $crumb["label"] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
