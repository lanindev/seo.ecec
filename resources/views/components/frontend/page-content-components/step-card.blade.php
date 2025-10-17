@props([
    "data",
])

<div class="py-5">
    <div class="rounded-lg bg-white p-8 shadow-md">
        @if ($data["title"])
            <h3 class="text-{{ $data["title_color"] }}-700 mb-6 border-b-2 border-gray-200 pb-2 text-2xl font-bold">
                【{{ $data["title"] }}】
            </h3>
        @endif

        <div class="space-y-4">
            @if ($data["description"])
                <div class="mb-6 rounded-lg bg-sky-50 p-6">
                    <p class="text-justify text-sm leading-relaxed text-gray-700 lg:text-lg">
                        {{ $data["description"] }}
                    </p>
                </div>
            @endif

            @foreach ($data["steps"] as $index => $step)
                <div class="flex items-center space-x-4 rounded-md bg-gray-50 p-4 transition hover:bg-gray-100">
                    <div
                        class="bg-{{ $data["title_color"] }}-600 flex h-10 w-10 min-w-[2.5rem] items-center justify-center rounded-full text-base font-bold leading-none text-white"
                    >
                        {{ $index + 1 }}
                    </div>
                    <div class="text-gray-700">{{ $step }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
