@props([
    "data",
])
<div>
    <x-frontend.page-content-components.section-heading :title="$data['section_title']" />

    <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($data["cards"] as $service)
            @php
                $starItems = [];

                if (! empty($service["description"])) {
                    $starItems = preg_split("/\r\n|\n|\r/", $service["description"]);
                }
            @endphp

            <div
                class="group rounded-xl bg-white p-8 shadow-md ring-1 ring-gray-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:ring-sky-500"
            >
                <div class="mb-4 text-5xl text-sky-500 transition duration-300 group-hover:text-sky-600">
                    <i class="fas fa-{{ $service["icon"] }}"></i>
                </div>
                <h3 class="mb-4 text-xl font-semibold text-gray-800">{{ $service["title"] }}</h3>
                @if (! empty($starItems))
                    <ul class="space-y-2 text-gray-600">
                        @foreach ($starItems as $item)
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check mt-1 text-sky-500"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</div>
